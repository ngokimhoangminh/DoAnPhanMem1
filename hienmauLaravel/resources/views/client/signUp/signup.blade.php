@extends('welcome')
@section('content')
<div class="signin_form pt-3 d-flex">
 	<div class="col-md-5 signin_form--image d-flex align-items-center justify-content-center">
 		<img src="{{asset('assets/client/image/blood_event.PNG')}}">
 	</div>
 	<div class="col-md-7 sign_form--info">
 		<h1 class="article-title wow animate__fadeInUp" data-wow-duration="2s" itemprop="headline"
			style="text-align: center;text-transform: capitalize;">
			Đăng Ký Tài Khoản <br>
		</h1>
		<div class="login" width="100%" align="center" border="0" cellpadding="0"
			cellspacing="0">
			<form action="{{URL::to('save-sign-up')}}" method="POST">
				{{csrf_field()}}
				<div class="signin__info">
					<div align="center" class="signin__info signin__info--fullname d-flex bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
						<label class="col-md-3 moudle__info--title text-left d-flex">Họ Tên&nbsp;<p class="text-danger">(*)</p></label>
						<input type="text" 
							class="form-control required display-inline-block" 
							value="" 
							required
							placeholder="Nhập họ và tên của bạn" 
							name="users_fullname">

					</div>
					<div align="center" class="signin__info signin__info--userlname d-flex bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
						<label class="col-md-3 moudle__info--title text-left d-flex">Tên Đăng Nhập&nbsp;<p class="text-danger">(*)</p></label>
						<input 
							type="text" 
							class="form-control required display-inline-block" 
							value="" 
							required
							placeholder="Nhập tên đăng nhập" 
							name="users_name">
							

					</div>
					<?php
                        $message=Session::get('error_name');
                        if($message)
                        {
                            echo '<span class="text-danger font-italic" style="margin-left:150px;">'.$message.'</span>';
                            Session::put('error_name',null);
                        }
                    ?>
					<div align="center" class="signin__info signin__info--blood d-flex bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
						<label class="col-md-3 moudle__info--title text-left d-flex">Nhóm Máu</label>
						<input type="text" 
							class="form-control display-inline-block" 
							value="" 
							placeholder="Nhập nhóm máu"
							name="users_blood">

					</div>
					<div align="center" class="signin__info signin__info--email d-flex bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
						<label class="col-md-3 moudle__info--title text-left">Email</label>
						<input 
							type="email" 
							class="form-control display-inline-block" 
							value="" 
							placeholder="Nhập Email"
							name="users_email">

					</div>
					<div align="center" class="signin__info signin__info--phone d-flex bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
						<label class="col-md-3 moudle__info--title text-left d-flex">Số Điện Thoại&nbsp;<p class="text-danger">(*)</p></label>
						<input 
							type="number" 
							class="form-control required display-inline-block" 
							value="" 
							required
							placeholder="Nhập số điện thoại"
							name="users_phone">

					</div>
					<?php
                        $message_phone=Session::get('error_phone');
                        if($message_phone)
                        {
                            echo '<span class="text-danger font-italic" style="margin-left:150px;">'.$message_phone.'</span>';
                            Session::put('error_phone',null);
                        }
                    ?>
					<div align="center" class="signin__info signin__info--cmnd d-flex bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
						<label class="col-md-3 moudle__info--title text-left d-flex">CMND&nbsp;<p class="text-danger">(*)</p></label>
						<input type="number" 
							class="form-control required display-inline-block" required value="" placeholder="Nhập số chứng minh nhân dân"
							name="users_cmnd">

					</div>
					<div align="center" class="signin__info signin__info--password d-flex bg-module-middle wow animate__fadeInUp" data-wow-duration="2s" style="position: relative;">
						<label class="col-md-3 moudle__info--title text-left d-flex">Mật Khẩu&nbsp;<p class="text-danger">(*)</p></label>
						<input type="password" 
							class="form-control required display-inline-block" 
							value="" 
							id="pwd"
							required
							placeholder="Mật khẩu từ 6 đến 32 kí tự"
							name="users_password"
							>
						<button type="button" onclick="showHide()" id="eye" style="position: absolute;outline: none; background: none; top: 10px; right:11px;">
            				<img src="{{asset('assets/client/image/eye.png')}}" alt="eye"/>
         				</button>	
					</div>
					<div align="center" class="signin__info signin__info--date d-flex bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
						<label class="col-md-3 moudle__info--title text-left d-flex">Giới Tính&nbsp;<p class="text-danger">(*)</p></label>
						<div class="pretty p-default p-round p-thick mr-5">
						  	<label class="blood_info--check">Nam
								<input type="radio" name="users_gender" value="0" required id="0">
								<span class="checkmark"></span>
							</label>
						</div>
						<div class="pretty p-default p-round p-thick">
						  	<label class="blood_info--check">Nữ
								<input type="radio" name="users_gender" value="1" required id="1">
								<span class="checkmark"></span>
							</label>
						</div>

					</div>
					<div align="center" class="signin__info signin__info--date d-flex bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
						<label class="col-md-3 moudle__info--title text-left d-flex">Ngày Sinh&nbsp;<p class="text-danger">(*)</p></label>
						<input 
							type="date" 
							required
							class="form-control required display-inline-block" 
							name="users_date"
							value="">

					</div>
					<div align="center" class="signin__info signin__info--school d-flex bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
						<label class="col-md-3 moudle__info--title text-left">Trường Học</label>
						<input type="text" 
								class="form-control display-inline-block" 
								value="" 
								placeholder="Tên trường học"
								name="users_scholl">

					</div>
					<div align="center" class="signin__info signin__info--school d-flex bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
						<label class="col-md-3 moudle__info--title text-left">Nghề Nghiệp</label>
						<input type="text" 
								class="form-control display-inline-block" 
								value="" 
								placeholder="Nhập nghề nghiệp"
								name="users_jog">
					</div>
					<div align="center" class="signin__info signin__info--school d-flex bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
						<label class="col-md-3 moudle__info--title text-left">Nơi Làm Việc</label>
						<input type="text" 
								class="form-control display-inline-block" 
								value="" 
								placeholder="Nhập nơi làm việc"
								name="users_workplace">

					</div>
					<div align="center" class="signin__info signin__info--school d-flex bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
						<label class="col-md-3 moudle__info--title text-left d-flex">Nơi Ở&nbsp;<p class="text-danger">(*)</p></label>
						<input type="text" 
								class="form-control display-inline-block" 
								value="" 
								placeholder="Nhập nơi ở hiện tại"
								name="users_address">

					</div>
				</div>
				<div class="form-group row form-group--center wow animate__fadeInUp" data-wow-duration="2s" style="margin: 0">

					<div align="center" class="signin__info col-md-9 offset-md-3 bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
						<div class="pretty p-default p-round p-thick mr-3 d-flex align-items-center">
						  <input type="checkbox" name="gender" onclick="EnableDisable()" class="mr-3" />
						  <div class="state">
						    <label>Bạn cam kết những thông vừa nhập la chính xác</label>
						  </div>
						</div>
					</div>
					<div class="col-lg-9 col-md-9 offset-md-3 form-group pl-0 pr-0">
						<button type="submit" id="buttonSingup" disabled class="btn btn-danger d-flex align-items-center justify-content-center" style="width: 100%; background:#FDD835; border: none; height: 45px;border-radius: 45px;" href="#">Tạo Tài Khoản</button>
						<a href="{{URL::to('/login')}}">Đăng Nhập</a>
					</div>
				</div>
			</form>
		</div>
 	</div>
		
</div>
<script type="text/javascript">
var x=true;
function showHide()
{
	if(x)
	{
		document.getElementById("pwd").type="text";
		x=false;
	}else
	{
		document.getElementById("pwd").type="password";
		x=true;
	}
 } 
var y=true;
function EnableDisable()
{
	if(y)
	{
		document.getElementById("buttonSingup").disabled = false;
		y=false;
	}else
	{
		document.getElementById("buttonSingup").disabled = true;
		y=true;
	}
}
</script>
@endsection