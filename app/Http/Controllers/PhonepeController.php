<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;


class PhonepeController extends Controller
{

   public function index()
   {
        return view('payment');
   }

    public function payment(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email',
            'phone'  => 'required|string|max:20',
            'amount' => 'required|numeric',
        ]);

        $amount = $request->input('amount');
        $name   = $request->input('name');
        $email  = $request->input('email');
        $phone  = $request->input('phone');

        // Get PhonePe credentials from .env
        $merchantId   = env('PHONEPE_MERCHANT_ID');
        $apiKey       = env('PHONEPE_API_KEY');
        $environment  = env('PHONEPE_ENV');
        $salt_index   = env('PHONEPE_SALT_INDEX', 1);
        $redirectUrl  = route('phonepe.success');

        // Unique Order ID
        $order_id = uniqid();

        // Prepare transaction data
        $transaction_data = [
            'merchantId'            => $merchantId,
            'merchantTransactionId' => $order_id,
            'merchantUserId'        => $order_id,
            'amount'                => $amount * 100, // Convert to paise
            'redirectUrl'           => $redirectUrl,
            'redirectMode'          => "POST",
            'callbackUrl'           => $redirectUrl,
            'paymentInstrument'     => [
                'type' => "PAY_PAGE",
            ]
        ];

        $encoded      = json_encode($transaction_data);
        $payloadMain  = base64_encode($encoded);
        $payload      = $payloadMain . "/pg/v1/pay" . $apiKey;
        $sha256       = hash("sha256", $payload);
        $final_x_header = $sha256 . '###' . $salt_index;
        $json_request = json_encode(['request' => $payloadMain]);

        // Choose endpoint based on environment
        $url = $environment === 'production'
            ? "https://api.phonepe.com/apis/hermes/pg/v1/pay"
            : "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay";

        // cURL call
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => $json_request,
            CURLOPT_HTTPHEADER     => [
                "Content-Type: application/json",
                "X-VERIFY: " . $final_x_header,
                "accept: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return response()->json(['error' => 'cURL Error: ' . $err], 500);
        }

        $res = json_decode($response);

        // Save to DB
        Payment::create([
            'name'       => $name,
            'email'      => $email,
            'phone'      => $phone,
            'amount'     => $amount,
            'order_id'   => $order_id,
            'payment_id' => $res->data->transactionId ?? null,
            'status'     => 0, // pending
            'other'      => $res,
        ]);

        if (isset($res->code) && $res->code === 'PAYMENT_INITIATED') {
            $payUrl = $res->data->instrumentResponse->redirectInfo->url;
            return redirect()->away($payUrl);
        }

        return response()->json(['error' => 'Transaction Error', 'details' => $res], 400);
    }


    public function success(Request $request)
    {
        try {
            \Log::info('PhonePe Verify Incoming Request:', $request->all());

            // Get the transaction ID from callback
            $transactionId = $request->input('transactionId');

            if (!$transactionId) {
                \Log::error('PhonePe Verify: No transactionId found in callback');
                return redirect()->route('home')->with('error', 'PhonePe payment verification failed!');
            }

            // Get credentials
            $merchantId  = env('PHONEPE_MERCHANT_ID');
            $saltKey     = env('PHONEPE_API_KEY');
            $saltIndex   = env('PHONEPE_SALT_INDEX', 1);
            $environment = env('PHONEPE_ENV');

            // Construct the status check path
            $path = "/pg/v1/status/$merchantId/$transactionId";

            $baseUrl = $environment === 'production'
                ? 'https://api.phonepe.com/apis/hermes'
                : 'https://api-preprod.phonepe.com/apis/pg-sandbox';

            $statusUrl = "$baseUrl/pg/v1/status/$merchantId/$transactionId";

            // Generate checksum
            $checksum = hash('sha256', $path . $saltKey) . "###" . $saltIndex;

            \Log::info("PhonePe Status Check - URL: $statusUrl");
            \Log::info("PhonePe Status Check - Checksum: $checksum");

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-VERIFY'     => $checksum,
                'X-MERCHANT-ID' => $merchantId,
                'Accept'       => 'application/json',
            ])->get($statusUrl);

            $responseData = $response->json();
            \Log::info('PhonePe Status API Response:', $responseData);

            if (!$response->successful()) {
                \Log::error('PhonePe Status API Failed', [
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
                return redirect()->route('home')->with('error', 'PhonePe verification failed. Try again later.');
            }

            // Verify the response
            if (isset($responseData['success']) && $responseData['success'] === true) {
                $paymentData = $responseData['data'] ?? [];

                // Find payment by transactionId (stored as payment_id in your DB)
                $payment = Payment::where('order_id', $transactionId)->first();

                if ($payment) {
                    $payment->update([
                        'status' => 1,
                        'payment_id' => $responseData['data']['transactionId'] ?? null,
                        'other'  => $responseData
                    ]);

                    if ($paymentData['state'] === 'COMPLETED') {
                        return redirect()->route('home')->with([
                            'success' => 'Payment Successful!',
                            'payment_id' => $transactionId,
                            'payment' => $payment,
                        ]);
                    }
                }
            }

            \Log::error('PhonePe Verification Failed', ['response' => $responseData]);
            return redirect()->route('home')->with('error', 'Payment verification failed. Please contact support.');

        } catch (\Exception $e) {
            \Log::error('PhonePe Verify Exception: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return redirect()->route('home')->with('error', 'Something went wrong during payment verification.');
        }
    }
    


}
