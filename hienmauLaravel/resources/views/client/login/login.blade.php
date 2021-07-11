@extends('welcome')
@section('content')
<div class="signin_form pt-3 d-flex">
 	<div class="col-md-5 signin_form--image d-flex align-items-center justify-content-center">
 		<img src="{{asset('assets/client/image/quy_trinh.PNG')}}">
 	</div>
 	<div class="col-md-7 sign_form--info">
 		<h1 class="article-title wow animate__fadeInUp" data-wow-duration="2s" itemprop="headline"
			style="text-align: center;text-transform: capitalize;">
			Đăng Nhập tài Khoản <br>
		</h1>
		<div class="login" width="100%" align="center" border="0" cellpadding="0"
			cellspacing="0">
			<form action="{{URL::to('login-system')}}" method="POST">
				{{csrf_field()}}
				<div class="signin__info">
					<?php
                        $message=Session::get('error_login');
                        if($message)
                        {
                            echo '<span class="text-danger font-italic" style="margin-left:150px;">'.$message.'</span>';
                            Session::put('error_login',null);
                        }
                    ?>
					<div align="center" class="signin__info signin__info--userlname d-flex bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
						<label class="col-md-3 moudle__info--title text-left d-flex">Tên Đăng Nhập &nbsp; <p class="text-danger">(*)</p></label>
						<input type="text" 
							class="form-control required display-inline-block" 
							value="" 
							name="users_name"
							required
							placeholder="Mời nhập tên đăng nhập">

					</div>
					<div align="center" class="signin__info signin__info--password d-flex bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
						<label class="col-md-3 moudle__info--title text-left d-flex">Mật Khẩu &nbsp;<p class="text-danger">(*)</p></label>
						<input type="password" 
							class="form-control required display-inline-block" 
							value="" 
							name="users_password"
							required
							placeholder="Mời nhập mật khẩu">

					</div>
				</div>
				<div class="form-group row form-group--center wow animate__fadeInUp" data-wow-duration="2s" style="margin: 0">
					<div class="col-lg-9 col-md-9 offset-md-3 form-group pl-0 pr-0">
						<button type="submit" class="btn btn-danger d-flex align-items-center justify-content-center" style="width: 100%; background:#FDD835; border: none; height: 45px; border-radius: 45px;"  href="#">Đăng Nhập</button>
						<div class="d-flex justify-content-between">
							<a href="{{URL::to('/sign-up')}}">Đăng ký tài khoản </a>
							<a href="#">Bạn quên mật khẩu ?</a>
						</div>
						
					</div>
					

				</div>
			</form>
		</div>
 	</div>
		
</div>
@endsection