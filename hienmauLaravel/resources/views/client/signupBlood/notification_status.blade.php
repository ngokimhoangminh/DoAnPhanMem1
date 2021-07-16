@extends('welcome')
@section('content')
<div class="signin_form pt-3 d-flex">
 	<div class="col-md-5 signin_form--image d-flex align-items-center justify-content-center">
 		<img src="{{asset('assets/client/image/loiich.jpg')}}">
 	</div>
 	<div class="col-md-7 sign_form--info d-flex flex-column justify-content-center">
 		<?php
 			$customer_name=Session::get('customer_name');
 		?>
 		<h1 class="article-title wow animate__fadeInUp" data-wow-duration="2s" itemprop="headline"
			style="text-align: center;text-transform: capitalize;">
			Trung Tâm Hiến Máu Nhân Đạo - Đà Nẵng<br>
		</h1>
		<div class="notification" width="100%" align="center" border="0" cellpadding="0"
			cellspacing="0">
			@foreach($data as $key => $value_notification)
				<div class="notification__info pb-2">
					<div class="notification__info-item d-flex mt-3">
						<div class="notification__info_title pr-3 font-weight-bold d-flex align-items-center">
							<img src="{{asset('assets/client/image/user.png')}}" style="width: 24px;" class="pr-2" alt="">Họ Và Tên:
						</div>
						<div class="notification__info_title">
							{{$value_notification['name']}}
						</div>
					</div>
					<div class="notification__info-item d-flex mt-1">
						<div class="notification__info_title pr-3 font-weight-bold d-flex align-items-center">
							<img src="{{asset('assets/client/image/blood.png')}}" class="pr-2" alt="" style="width: 24px;">Đợt Hiến Máu:
						</div>
						<div class="notification__info_title">
							{{$value_notification['blood']}}
						</div>
					</div>
					<div class="notification__info-item d-flex mt-1">
						<div class="notification__info_title pr-3 font-weight-bold d-flex align-items-center">
							<img src="{{asset('assets/client/image/time.png')}}" class="pr-2" alt="" style="width: 24px;">Thời Gian:
						</div>
						<div class="notification__info_title">
							{{$value_notification['time']}}
						</div>
						@if($value_notification['blood_status']==0)
							<div class="" style="position: absolute; right: 0px;">
							<button class="btn btn-danger" onclick="deleteBlood({{$key}})">Xóa</button>
						</div>
						@else
							<div class="" style="position: absolute; right: 0px;">
								<button class="btn btn-danger" disabled>Xóa</button>
							</div>
						@endif
						
					</div>
					<div class="notification__info-item d-flex mt-1">
						<div class="notification__info_title pr-3 font-weight-bold d-flex align-items-center">
							<img src="{{asset('assets/client/image/transit.png')}}" style="width: 24px;" class="pr-2" alt="">Trình trạng:
						</div>
						<div class="notification__info_title">
							{{$value_notification['status']}}
						</div>
					</div>
					<div class="notification__info-item d-flex mt-1">
						<div class="notification__info_title pr-3 font-weight-bold d-flex align-items-center">
							<img src="{{asset('assets/client/image/note.png')}}" style="width: 24px;" class="pr-2" alt="">Ghi chú:
						</div>
						<div class="notification__info_title">
							{{$value_notification['note']}}
						</div>
					</div>
					<div class="notification__info_border mt-3">
						<div style="border:1px solid; width: 60%;" ></div>
					</div>
				</div>
			@endforeach
		</div>
 	</div>
</div>
<script type="text/javascript">
	function deleteBlood(signup_blood_id) {
		Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa không',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Hủy',
        }).then((result) => {
            if (result.value) {
              $.ajax({
                url:"{{URL('/delete-signup-blood')}}",
                method:"POST",
                data:{
                  "_token": "{{ csrf_token() }}",
                  "signup_blood_id":signup_blood_id,
                },
                success:function(data)
		        {
		          $.niceToast.success('<strong>Thông báo</strong>: Xóa đợt hiến máu thành công');
		          setTimeout(
		          () => {
		              window.location.href="/notification";
		          },
		          2 * 1000
		          );
		        },error:function(data)
		        {
		          $.niceToast.error('<strong>Thông báo</strong>: Thất bại');
		        }

            });
            }
        })
	}
	$.niceToast.setup({
      position: "top-right",
      timeout: 2000,
    });    
       
</script>
@endsection