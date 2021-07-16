@extends('welcome')
@section('content')
<div class="signin_form pt-3 d-flex">
 	<div class="col-md-5 signin_form--image d-flex align-items-center justify-content-center">
 		<img src="{{asset('assets/client/image/quy_trinh.PNG')}}">
 	</div>
 	<div class="col-md-7 sign_form--info d-flex flex-column justify-content-center">
 		<h1 class="article-title wow animate__fadeInUp" data-wow-duration="2s" itemprop="headline"
			style="text-align: center;text-transform: capitalize;">
			Bạn Đã Đăng Ký Hiến Máu Thành Công<br>
		</h1>
		<div class="notification" width="100%" align="center" border="0" cellpadding="0"
			cellspacing="0">

			<div class="notification__info">
				<p>Xin cảm ơn chân thành vì tấm lòng và nghĩa cữ cao đẹp của Ông/Bà. Từ những hành động cao quý đó đã tiếp thêm nguồn sống cho rất nhiều người. Chắp cánh ước mơ cho những thế hệ tương lai.</p>
				<p><em>Một giọt máu cho đi, một cuộc đời nhận lại</em></p>
				<p class="mt-2" style="color: firebrick;"><strong>Chúng tôi sẽ xem xét yêu cầu của bạn và phản hồi trong thời gian sớm nhất, xin cảm ơn !!!</strong></p>
			</div>
			
		</div>
 	</div>
</div>
@endsection