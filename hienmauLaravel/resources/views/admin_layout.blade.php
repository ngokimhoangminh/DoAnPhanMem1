<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Trang Quản Lý Admin Website</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link href="{{asset('assets/admin/images/favicon.png')}}" rel="icon">
<link rel="stylesheet" type="text/css" href="{{asset('assets/client/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('assets/admin/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('assets/admin/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('assets/admin/css/font.css')}}" type="text/css"/>
<link href="{{asset('assets/admin/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('assets/admin/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('assets/admin/css/monthly.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/css/nice-toast-js.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/select2/select2-bootstrap.css')}}">
<!-- //calendar -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

<!--PDF-->
<link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"
integrity="sha256-c9vxcXyAG4paArQG3xk6DjyW/9aHxai2ef9RpMWO44A=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<!---->
<!-- //font-awesome icons -->
<script src="{{asset('assets/admin/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('assets/admin/js/raphael-min.js')}}"></script>
<script src="{{asset('assets/admin/js/morris.js')}}"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{URL::to('/dashboard')}}" class="logo d-flex align-items-center">
        <img src="{{asset('assets/admin/images/favicon.png')}}"><b style="font-family: -webkit-pictograph;">ADMIN</b>
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('assets/admin/images/3.png')}}">
                <span class="username">
                <?php
                    $name=Session::get('admin_name');
                    if($name)
                    {
                        echo $name;
                    }
                ?>
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Hồ sơ</a></li>
                <li><a href="#"><i class="fa fa-cog"></i>Thiết lập</a></li>
                <li><a href="{{URL::to('/admin_logout')}}"><i class="fa fa-key"></i>Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <img src="{{asset('assets/admin/images/icon-dashboard.png')}}">
                        <span>Tổng quan</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-hospital"></i>
                        <span>Bệnh Viện</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-hospital')}}">Thêm Bệnh Viện</a></li>
                        <li><a href="{{URL::to('/list-hospital')}}">Danh sách bệnh viện</a></li>
                    </ul>
                </li>
                <li>
                    <a class="active" href="{{URL::to('/list-employee')}}">
                        <img src="{{asset('assets/admin/images/icon-medical.png')}}">
                        <span>Danh sách nhân viên</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="{{URL::to('/list-blooddonation')}}">
                        <img src="{{asset('assets/admin/images/icon-blood.png')}}">
                        <span>Thông Tin Đợt Hiến Máu</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="{{URL::to('/list-signUpblood')}}">
                        <img src="{{asset('assets/admin/images/icon-sphygmomanome.png')}}">
                        <span>Danh sách đăng ký hiến máu</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="{{URL::to('/list-blood-actual')}}">
                        <img src="{{asset('assets/admin/images/icons-rh.png')}}">
                        <span>Danh sách hiến máu thực tế</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="{{URL::to('/list-category-news')}}">
                        <img src="{{asset('assets/admin/images/icons-europe-news.png')}}">
                        <span>Danh mục tin tức</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="{{URL::to('/list-news')}}">
                        <img src="{{asset('assets/admin/images/icons-europe-news-20.png')}}">
                        <span>Tin Tức</span>
                    </a>
                </li>
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        @yield('admin_content')
    </section>
 <!-- footer -->
    <div class="footer">
        <div class="wthree-copyright">
          <p>© Trung Tâm Hiến Máu Nhân Đạo | Thực hiện bởi nhóm 21</p>
        </div>
    </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('assets/admin/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('assets/admin/js/scripts.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('assets/admin/js/jquery.scrollTo.js')}}"></script>
<script src="{{asset('assets/admin/js/nice-toast-js.min.js')}}"></script>
<script src="{{asset('assets/admin/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/admin/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- morris JavaScript -->  
<script type="text/javascript">
    $('#myTable').DataTable({
        "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Tất Cả"]],
        "iDisplayLength": 5,   
        "language": {
            "sLengthMenu": "Hiển thị _MENU_ dòng trên 1 trang",
            "sZeroRecords": "Không tìm thấy dữ liệu",
            "info": "Hiển thị trang _PAGE_ trong tổng số _PAGES_ trang",
            "sInfoEmpty": "Không có dữ liệu nào",
            "sInfoFiltered": "(được lọc từ tổng sô _MAX_ trong dữ liệu)",
            "sSearch": "Tìm kiếm:",
            "sShow": "Hiển Thị:",
            "oPaginate": {
                "sNext": "Sau",
                "sPrevious": "Trước"
            },
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
<script>
    CKEDITOR.replace('ckeditor1');
    CKEDITOR.replace('ckeditor2');
</script>
</body>
</html>
