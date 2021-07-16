@extends('welcome')
@section('content')
<div class="sigUpBlood_form pt-3 d-flex">
 	<div class="col-md-12 sign_form--info">
 		<h1 class="article-title wow animate__fadeInUp" data-wow-duration="2s" itemprop="headline"
			style="text-align: center;text-transform: capitalize;">
			Lịch Sử Hiến Máu<br>
		</h1>
		<div class="blood_info">
			
			<div class="blood_info--detail d-flex justify-content-between">
				<table class="blood_info-table">
					<thead>
						<tr>
							<th></th>
							<th>Ngày Tháng</th>
							<th>Nhóm Máu</th>
							<th>Đơn Vị Máu</th>
							<th>Địa Điểm</th>
						</tr>
					</thead>
					<tbody>
						@foreach($history_blood as $key => $value)
						<tr>
							<td><h3>{{$value['blood_name']}}</h3><span></span></td>
							<td>{{date('d-m-Y', strtotime($value['blood_actual_date']))}}</td>
							<td>{{$value['blood_group']}}</td>
							<td>{{$value['blood_unit']}} ml</td>
							<td>{{$value['blood_donation_place']}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			
			
		</div>
 	</div>
</div>
@endsection