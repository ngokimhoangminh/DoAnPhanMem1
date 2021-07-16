<!DOCTYPE html>
<html>
<head>
    <title>Hiến Máu Nhân Đạo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('assets/client/image/favicon_icon.ico')}}" rel="shortcut  icon" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/client/css/slick.css')}}"></li> 
    <link rel="stylesheet" type="text/css" href="{{asset('assets/client/css/animate.min.css')}}"></li>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/client/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/client/css/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/css/nice-toast-js.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/client/select2/select2-bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="fontIcon/themify-icons/themify-icons.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&family=Mulish:wght@200&family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/client/css/style.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('assets/client/css/responsive/responsive.css')}}"></li>
</head>
<body>
    <div class="page-content">
        <div class="d-flex justify-content-center">
            <div class="page-wrapper col-md-11">
                <div id="navbarDropdown">
                    <nav class="navbar navbar-expand-md navbar-dark justify-content-between" style="background: #797979;">
                        <a class="navbar-brand nav-title " href="#" style="font-size: 15px;">Trung tâm hiến máu nhân đạo TP Đà Nẵng</a>
                        <img src="{{asset('assets/client/image/logo.png')}}" alt="" class="navbar-brand nav-logo" width="70px">
                        <form action="{{URL::to('/search-news')}}" method="POST" class="form-inline">
                          {{csrf_field()}}
                            <div class="input-group">
                                <input type="text" class="form-control input-search navbar-search" name="keywords" placeholder="Nhập thông tin tìm kiếm..." style="height: 30px;">
                                <div class="input-group-prepend">
                                  <span  style="border-radius: 0 3px 3px 0;
                                  border: none;
                                  background: white;"class="input-group-text input-group-text__icon"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                          </form>
                          
                          <div class="nav-social">
                            <a class="nav-social__icon" href=""><i class="ti-youtube"></i></a>
                            <a class="nav-social__icon ml-2" href=""><i class="fab fa-facebook-square"></i></a>
                          </div>
                          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          
                    </nav>
                    <header>
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-xl-6 col-lg-6 col-md-4 d-flex align-items-center">
                              <img src="{{asset('assets/client/image/logo.png')}}" alt="" class="header-img">
                              <div class="header-title">
                                <img src="{{asset('assets/client/image/logo_footter.png')}}" alt="" class="header-title__img navbar-brand">
                                <p>Hội chữ thập đỏ Tp Đà Nẵng</p>
                                <h3 >Trung tâm hiến máu nhân đạo</3>
                              </div>
                          </div>
                          <div class="col-xl-6 col-lg-5 col-md-8 d-flex align-items-center">
                            <div class="header-nav collapse navbar-collapse" id="navbarSupportedContent">
                              <div class="navbar navbar-expand-md">
                                
                                <div class="d-flex flex-column header-nav__right pt-1 pb-1" >
                                  <div class="header-nav__button">
                                    

                                     <?php
                                        $customer_name=Session::get('customer_name');
                                        if($customer_name!=NULL)
                                        {
                                      ?>     
                                     
                                        <span class="text-white font-italic font-weight-bold" style="color:#d51e4e!important;">Xin chào, {{$customer_name}}</span>
                                      
                                      <?php
                                      }else
                                      {
                                      ?>
                                      <button type="button" class="btn btn-header-log">
                                        <a href="{{URL::to('/login')}}" class="text-white" style="font-size: 13px;">Đăng nhập</a>
                                      </button>
                                      <?php
                                      }
                                      ?>
                                      <?php
                                        $customer_id=Session::get('customer_id');
                                        if($customer_id!=NULL)
                                        {
                                      ?>
                                        <button type="button" class="btn  btn-header-log" style="background:darkred;">
                                          <a href="{{URL::to('/logout')}}" class="text-white" style="font-size: 13px;">Đăng xuất</a>
                                        </button>
                                        <?php
                                        }else
                                        {
                                        ?>
                                          <button type="button" class="btn  btn-header-log">
                                            <a href="{{URL::to('/sign-up')}}" class="text-white" style="font-size: 13px;">Đăng ký</a>
                                          </button>
                                          <?php
                                          }
                                          ?>
                                  </div>
                                  <div class=" header-nav__menu d-flex  align-items-center align-items-end ">
                                    <a href="{{URL::to('/trang-chu')}}" class="nav-link header-nav__icon-home">
                                      <img src="{{asset('assets/client/image/ic_home.png')}}" alt="">
                                    </a>
                                      <ul class="navbar-nav header-nav__list">
                                        <li class="nav-item">
                                          <a href="" class="nav-link">Giới thiệu</a>
                                        </li>
                                        <li class="nav-item">
                                          <a href="{{URL::to('/blood-donation-schedule')}}" class="nav-link">Hiến máu</a>
                                        </li>
                                        <li class="nav-item">
                                          <a href="" class="nav-link">Tin tức</a>
                                          <ul class="sub-menu">
                                            @foreach($category_news as $key => $value)
                                              <li><a href="{{URL::to('/danh-muc-bai-viet/'.$value->category_news_slug)}}">{{$value->category_news_name}}</a></li>
                                            @endforeach
                                          </ul>
                                        </li>
                                        <li class="nav-item">
                                          <a href="" class="nav-link">Thông tin</a>
                                        </li>
                                        <li class="nav-item">
                                          <a href="" class="nav-link pr-0">Liên hệ</a>
                                        </li>
                                      </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div 
                            class="button_scrolltop" 
                            onclick="page_scrolltop()">
                            <i class="fas fa-angle-up"></i>
                       </div>
                    </header>
                </div>
                    
                    <div class="container-fluid">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                              <ol class="carousel-indicators d-none">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                              </ol>
                              <div class="carousel-inner">
                                <div class="carousel-item active">
                                  <img class="d-block w-100" src="{{asset('assets/client/image/slide1.jpg')}}" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                  <img class="d-block w-100" src="{{asset('assets/client/image/slide2.jpg')}}" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                  <img class="d-block w-100" src="{{asset('assets/client/image/slide3.jpg')}}" alt="Third slide">
                                </div>
                                <div class="carousel-item">
                                  <img class="d-block w-100" src="{{asset('assets/client/image/slide4.jpg')}}" >
                                </div>
                              </div>
                              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
                        </div>
                    </div>
                    <main>
                      <div class="manipulation">
                          <div class="container">
                            <div class="row">
                              <div class="col-md-6">
                                    <div class="manipulation-item d-flex align-items-center justify-content-between">
                                      <a href="" class="manipulation-img">
                                        <img src="{{asset('assets/client/image/search.png')}}" alt="">
                                      </a>
                                      <a href="{{URL::to('/history-blood')}}"class="manipulation-history"><h3>Lịch sử hiến máu</h3></a>
                                      <a href="{{URL::to('/notification')}}"class="btn-view">Xem thông báo</a>
                                    </div>
                              </div>
                              
                                <div class="col-md-6">
                                      <div class="manipulation-item d-flex align-items-center justify-content-between">
                                        <a href="" class="manipulation-img">
                                          <img src="{{asset('assets/client/image/history.png')}}" alt="">
                                        </a>
                                        <a href="{{URL::to('/blood-donation-schedule')}}"class="manipulation-history"><h3>Lịch hiến máu</h3></a>
                                        <a href="{{URL::to('/signup-blood')}}"class="btn-view">Đăng ký hiến máu</a>
                                      </div>
                                </div>
                            </div>
                          </div>
                      </div>
                      <div class="content">
                            @yield('content')
                      </div>
                      <div class="co-operate">
                        <div class="container">
                            <div class="co-operate--title">
                                <p>HỢP TÁC CHUYÊN MÔN</p>
                            </div>
                            <div class="co-operate--slide p-4">
                                <div class="co-operate--slide_items">
                                    <img src="{{asset('assets/client/image/slick_slide_1.png')}}" alt="images">
                                </div>
                                <div class="co-operate--slide_items">
                                    <img src="{{asset('assets/client/image/slick_slide_2.jpg')}}" alt="images">
                                </div>
                                <div class="co-operate--slide_items">
                                    <img src="{{asset('assets/client/image/slick_slide_3.jpg')}}" alt="images">
                                </div>
                                <div class="co-operate--slide_items">
                                    <img src="{{asset('assets/client/image/slick_slide_4.png')}}" alt="images">
                                </div>
                                <div class="co-operate--slide_items">
                                    <img src="{{asset('assets/client/image/slick_slide_5.png')}}" alt="images">
                                </div>
                                <div class="co-operate--slide_items">
                                    <img src="{{asset('assets/client/image/slick_slide_6.jpg')}}" alt="images">
                                </div>
                            </div>
                        </div>
                      </div>
                    </main>
                    <footer>
                      <div class="footer-content">
                        <div class="container">
                          <div class="row">
                            <div class="col-sm-5 col-md-3 footer-content__logo pb-5">
                              <img class="footer-content__img" src="{{asset('assets/client/image/logo.png')}}" alt="">
                              <p class="footer-content__caption">Hãy nghĩ đến người bệnh. Sự sống và cái chết 
                                đang đe dọa họ. Bằng cách hiến máu, Bạn có 
                                thể tạo ra sự khác biệt giữa sự sống và cái chết.</p>
                            </div>
                            <div class="col-sm-4 col-md-2 footer-content__grid-item" style="padding-left: 50px;">
                              <h3 class="footer-content__title">
                                LIÊN KẾT
                              </h3>
                              <ul class="footer-content__list mt-3">
                                <li class="footer-content__item">
                                  <a href="" class="footer-content__link">
                                    Trang chủ
                                  </a>
                                </li>
                                <li class="footer-content__item">
                                  <a href="" class="footer-content__link">
                                    Hiến máu
                                  </a>
                                </li>
                                <li class="footer-content__item">
                                  <a href="" class="footer-content__link">
                                    Tin tức
                                  </a>
                                </li>
                                <li class="footer-content__item">
                                  <a href="" class="footer-content__link">
                                    Thông tin
                                  </a>
                                </li>
                                <li class="footer-content__item">
                                  <a href="" class="footer-content__link">
                                    Liên hệ
                                  </a>
                                </li>
                              </ul>
                            </div>
                            <div class="widget col-sm-5  col-md-3 footer-content__grid-item">
                                <h3 class="footer-top__headings footer-content__title">THÔNG TIN</h3>
                                    <div class="textwidget mt-3">
                                        <p>
                                            
                                            <span class="icon-container">
                                                <span class="fa  fa-map-marker mr-2"></span>
                                            </span>16s Đống Đa, Q. Hải Châu, TP.Đà Nẵng
                                            
                                            <br>
                                            
                                            <span class="icon-container">
                                                <span class="fa  fa-phone mr-2"></span>
                                            </span> 08 3868 5509
                                            
                                            <br>
                                            
                                            <span class="icon-container">
                                                <span class="fa  fa-envelope mr-2"></span>
                                            </span> tthienmau@gmail.com
                                            
                                            <br>
                                            
                                            <span class="icon-container">
                                                <span class="fa  fa-globe mr-2"></span>
                                            </span> hienmaunhandao.org.vn
                                            
                                        </p>
                                    </div>
                            </div>
                            <div class="col-sm-7 col-md-4 footer-content__grid-item map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1959.8764002654043!2d106.6733294!3d10.7535252!3m2!1i1024!2i768! 4f13.1!3m3!1m2!1s0x31752efc2fa97409%3A0x54da553142caa729!2zOTMxIMSQxrDhu51uZyB UcuG6p24gSMawbmcgxJDhuqFvLCBQaMaw4budbmcgNywgUXXhuq1uIDUsIEjhu5MgQ2jDr SBNaW5o!5e0!3m2!1svi!2s!4v1545088896955" width="600" height="450" frameborder="0" style="border:0; width: 350px; height: 300px;" allowfullscreen></iframe>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="footer-img">
                        <img src="{{asset('assets/client/image/logo_footter.png')}}" alt="">
                      </div>
                      <div class="footer-end">
                        <span>Copyright &copy; 2021 Nhom21-Trung Tam Hiến Máu Nhân Đạo</span>
                      </div>
                    </footer>
        </div>
        </div>
        
</div>
    <script type="text/javascript" src="{{asset('assets/client/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/client/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/client/js/wow.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/client/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/client/js/nice-toast-js.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript" src="{{asset('assets/client/js/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/client/js/custom.js')}}"></script>
    
</body>
</html>