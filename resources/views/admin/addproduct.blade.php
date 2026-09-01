<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="admin/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="admin/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="admin/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="admin/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="admin/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="admin/img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
          <div class="search-inner d-flex align-items-center justify-content-center">
            <div class="close-btn">Close <i class="fa fa-close"></i></div>
            <form id="searchForm" action="#">
              <div class="form-group">
                <input type="search" name="search" placeholder="What are you searching for...">
                <button type="submit" class="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header--><a href="index.html" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Dark</strong><strong>Admin</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div></a>
            <!-- Sidebar Toggle Btn-->
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>
          <div class="right-menu list-inline no-margin-bottom">    
            <div class="list-inline-item"><a href="#" class="search-open nav-link"><i class="icon-magnifying-glass-browser"></i></a></div>
            <div class="list-inline-item dropdown"><a id="navbarDropdownMenuLink1" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link messages-toggle"><i class="icon-email"></i><span class="badge dashbg-1">5</span></a>
              <div aria-labelledby="navbarDropdownMenuLink1" class="dropdown-menu messages"><a href="#" class="dropdown-item message d-flex align-items-center">
                  <div class="profile"><img src="img/avatar-3.jpg" alt="..." class="img-fluid">
                    <div class="status online"></div>
                  </div>
                  <div class="content">   <strong class="d-block">Nadia Halsey</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">9:30am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
                  <div class="profile"><img src="img/avatar-2.jpg" alt="..." class="img-fluid">
                    <div class="status away"></div>
                  </div>
                  <div class="content">   <strong class="d-block">Peter Ramsy</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">7:40am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
                  <div class="profile"><img src="img/avatar-1.jpg" alt="..." class="img-fluid">
                    <div class="status busy"></div>
                  </div>
                  <div class="content">   <strong class="d-block">Sam Kaheil</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">6:55am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
                  <div class="profile"><img src="img/avatar-5.jpg" alt="..." class="img-fluid">
                    <div class="status offline"></div>
                  </div>
                  <div class="content">   <strong class="d-block">Sara Wood</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">10:30pm</small></div></a><a href="#" class="dropdown-item text-center message"> <strong>See All Messages <i class="fa fa-angle-right"></i></strong></a></div>
            </div>
            <!-- Tasks-->
            <div class="list-inline-item dropdown"><a id="navbarDropdownMenuLink2" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link tasks-toggle"><i class="icon-new-file"></i><span class="badge dashbg-3">9</span></a>
              <div aria-labelledby="navbarDropdownMenuLink2" class="dropdown-menu tasks-list"><a href="#" class="dropdown-item">
                  <div class="text d-flex justify-content-between"><strong>Task 1</strong><span>40% complete</span></div>
                  <div class="progress">
                    <div role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-1"></div>
                  </div></a><a href="#" class="dropdown-item">
                  <div class="text d-flex justify-content-between"><strong>Task 2</strong><span>20% complete</span></div>
                  <div class="progress">
                    <div role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-3"></div>
                  </div></a><a href="#" class="dropdown-item">
                  <div class="text d-flex justify-content-between"><strong>Task 3</strong><span>70% complete</span></div>
                  <div class="progress">
                    <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-2"></div>
                  </div></a><a href="#" class="dropdown-item">
                  <div class="text d-flex justify-content-between"><strong>Task 4</strong><span>30% complete</span></div>
                  <div class="progress">
                    <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-4"></div>
                  </div></a><a href="#" class="dropdown-item">
                  <div class="text d-flex justify-content-between"><strong>Task 5</strong><span>65% complete</span></div>
                  <div class="progress">
                    <div role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-1"></div>
                  </div></a><a href="#" class="dropdown-item text-center"> <strong>See All Tasks <i class="fa fa-angle-right"></i></strong></a>
              </div>
            </div>
            <!-- Tasks end-->
            <!-- Log out               -->
            <div class="list-inline-item logout">                   
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
          </div>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="admin/img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">{{ Auth::user()->name}}</h1>
            <p>{{ Auth::user()->email}}</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li><a href="{{ route('dashboard') }}"> <i class="icon-home"></i>Home </a></li>
        </ul>
        <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Category</a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li class="active"><a href="{{ route('add-category') }}">Add Category</a></li>
                    <li><a href="{{ route('view-category') }}">View Category</a></li>
                  </ul>
        </li>
        <li><a href="#brand" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Brand</a>
                  <ul id="brand" class="collapse list-unstyled ">
                    <li><a href="{{ route('store-brand') }}">Add Brand</a></li>
                    <li><a href="{{ route('view-brand') }}">View Brand</a></li>
                  </ul>
        </li>
        <li class="active"><a href="#exampledropdownDropdown1" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Product</a>
                  <ul id="exampledropdownDropdown1" class="collapse list-unstyled ">
                    <li><a href="{{ route('add-product') }}">Add Product</a></li>
                    <li><a href="{{ route('view-all-product') }}">View Product</a></li>
                  </ul>
        </li>
        <li><a href="#exampledropdownDropdown3" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Orders</a>
                  <ul id="exampledropdownDropdown3" class="collapse list-unstyled ">
                    <li><a href="{{ route('orders') }}">View Order</a></li>
                  </ul>
        </li>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
          </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
            
          <div class="container-fluid">
            @if(session('product_message'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('product_message')}}
                </div>
            @endif
            <div class="row">
              <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong>Add Product</strong></div>
                  <div class="block-body">
                    <form class="form-horizontal" method="POST" action="{{ route('store-product') }}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row">
                        <label for="name" class="col-sm-3 form-control-label">Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="slug" class="col-sm-3 form-control-label">Slug</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Slug Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-3 form-control-label">Description</label>
                        <div class="col-sm-9">
                          <textarea type="text" id="description" class="form-control" name="description" placeholder="Enter Product Description"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="specifications" class="col-sm-3 form-control-label">Specifications</label>
                        <div class="col-sm-9">
                          <textarea type="text" id="specifications" class="form-control" name="specifications" placeholder="Enter Product Specifications"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="price" class="col-sm-3 form-control-label">Price</label>
                        <div class="col-sm-9">
                          <input type="number" id="price" class="form-control" name="price" placeholder="Enter Product Price">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="compare_price" class="col-sm-3 form-control-label">Compare Price</label>
                        <div class="col-sm-9">
                          <input type="number" id="compare_price" class="form-control" name="compare_price" placeholder="Enter Product Compare Price">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="stock" class="col-sm-3 form-control-label">Stock</label>
                        <div class="col-sm-9">
                          <input type="number" id="stock" class="form-control" name="stock" placeholder="Enter Product Stock">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="category" class="col-sm-3 form-control-label">Category</label>
                        <div class="col-sm-9">
                          <select name="category" id="category"  class="form-control mb-3 mb-3">
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="brand" class="col-sm-3 form-control-label">Brand</label>
                        <div class="col-sm-9">
                          <select name="brand" id="brand" class="form-control mb-3 mb-3">
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="publish" class="col-sm-3 form-control-label">Publish immediately</label>
                        <div class="col-sm-9">
                          <input type="checkbox" id="publish" class="form-checkbox" name="is_published" >
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="condition" class="col-sm-3 form-control-label">Condtion</label>
                        <div class="col-sm-9">
                          <select name="condition" id="condtion" class="form-control mb-3 mb-3">
                            <option value="" selected>Select Condition</option>
                            <option value="Excellent">Excellent</option>
                            <option value="Good">Good</option>
                            <option value="Fair">Fair</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="grade" class="col-sm-3 form-control-label">Grade</label>
                        <div class="col-sm-9">
                          <select name="grade" id="grade" class="form-control mb-3 mb-3">
                            <option value="">Select Grade</option>
                            <option value="A">A - Like New</option>
                            <option value="B">B - Very Good</option>
                            <option value="C">C - Good</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="image" class="col-sm-3 form-control-label">Image</label>
                        <div class="col-sm-9">
                          <input type="file" id="image" class="form-control" name="images[]" multiple accept="image/*" placeholder="Enter Product Price">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="battery_health" class="col-sm-3 form-control-label">Battery Health</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="battery_health" name="battery_health" placeholder="e.g., 85%">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="accessories" class="col-sm-3 form-control-label">Accessories Included</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="accessories" name="accessories_included" placeholder="Charger, Cable, etc.">
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label"></label>
                        <div class="col-sm-9">
                          <button type="submit" class="btn btn-primary">Save</button></div>
                      </div>
                      

                      
                    </form>
                  </div>
                </div>
              </div>            
            </div>
          </div>
        </section>
        
        
        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
              <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
               <p class="no-margin-bottom">2018 &copy; Your company. Download From <a target="_blank" href="https://templateshub.net">Templates Hub</a>.</p>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="admin/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="admin/vendor/chart.js/Chart.min.js"></script>
    <script src="admin/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="admin/js/charts-home.admin/js"></script>
    <script src="admin/js/front.js"></script>
  </body>
</html>

