@extends('welcome')
@section('content')
<div class="content">
    <div class="container-fluid">
    	<div class="blood-schedule">
    		<h2>LỊCH HIẾN MÁU</h2>
    		@foreach($blood_donation as $key => $value)
    		<div class="blood-schedule-item mt-2 pt-3 pb-3" style="background: #F5F6F7;">
    			<div class="d-flex justify-content-around">
    				<div class="blood-schdule-title">
    				<img src="{{asset('assets/client/image/blood.png')}}" class="pr-2" alt="" style="width: 24px;">
    				<b>Đợt hiến máu:</b> {{$value->blood_donation_name}}
    				</div>
	    			<div class="blood-time">
	    			<img src="{{asset('assets/client/image/time.png')}}" class="pr-2" alt="" style="width: 24px;"><b>Thời gian:</b> {{date('h:i', strtotime($value->blood_donation_time))}} --- {{date('d-m-Y', strtotime($value->blood_start_date))}}
	    			</div>
    			</div>
    			<div class="d-flex justify-content-around">
    				<div class="blood-schdule-title">
    					<img src="{{asset('assets/client/image/transit.png')}}" style="width: 24px;" class="pr-2" alt=""><b>Địa điểm:</b> {{$value->blood_donation_place}}
    				</div>
	    			<div class="blood-time">
	    				<img src="{{asset('assets/client/image/user.png')}}" style="width: 24px;" class="pr-2" alt="">
	    				<b>Đối tượng:</b> {{$value->blood_object}}
	    			</div>
    			</div>
    			<div class="" style="text-align: center;">
    				<a href="{{URL::to('sign-up-blood/'.$value->blood_donation_id)}}" class="btn btn-primary" style="border-radius: 20px; padding: 6px 25px;">Đăng Ký</a>
    			</div>
    		</div>
    		@endforeach
    	</div>
    </div>
</div>
@endsection