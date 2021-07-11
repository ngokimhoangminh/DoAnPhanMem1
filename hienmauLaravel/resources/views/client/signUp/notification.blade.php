@extends('welcome')
@section('content')
<div class="signin_form pt-3 d-flex">
 	<div class="col-md-5 signin_form--image d-flex align-items-center justify-content-center">
 		<img src="{{asset('assets/client/image/quy_trinh.PNG')}}">
 	</div>
 	<div class="col-md-7 sign_form--info d-flex flex-column justify-content-center">
 		<h1 class="article-title wow animate__fadeInUp" data-wow-duration="2s" itemprop="headline"
			style="text-align: center;text-transform: capitalize;">
			Chúc Mừng Bạn Đã Đăng Ký Tài Khoản Thành Công <br>
		</h1>
		<div class="notification" width="100%" align="center" border="0" cellpadding="0"
			cellspacing="0">

			<div class="notification__info">
				<p>Ông/Bà đã đăng ký thành công tài khoản của hệ thống. Từ giờ Ông/Bà đã trở thành 1 thành viên của đại gia đình <em>"Hành Trình Đỏ"</em> hãy cùng nhau kêu gọi mọi người cùng chung một tấm lòng cao đẹp.</p>
				
			</div>
			<div class="form-group row form-group--center wow animate__fadeInUp mt-2" data-wow-duration="2s" style="margin: 0">
				<div class="col-lg-8 col-md-8 offset-md-3 form-group pl-0 pr-0">
					<a class="btn btn-danger d-flex align-items-center justify-content-center" style="width: 100%; background:#FDD835; border: none; height: 45px; border-radius: 45px;"  href="{{URL::to('/login')}}">Đăng Nhập</a>
					<div class="d-flex justify-content-center">
						<a href="{{URL::to('/sign-up')}}">Trở lại trang Đăng ký </a>
					</div>
					
				</div>
				

			</div>
		</div>
 	</div>
</div>
@endsection