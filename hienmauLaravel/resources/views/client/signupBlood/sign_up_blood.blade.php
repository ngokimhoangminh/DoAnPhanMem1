@extends('welcome')
@section('content')
<div class="sigUpBlood_form pt-3 d-flex">
 	<div class="col-md-12 sign_form--info">
 		<h1 class="article-title wow animate__fadeInUp" data-wow-duration="2s" itemprop="headline"
			style="text-align: center;text-transform: capitalize;">
			Đăng Ký Hiến Máu<br>
		</h1>
		<div class="blood_info">
			<form action="{{URL::to('save-sign-up-blood')}}" method="POST">
				{{csrf_field()}}
				@foreach($datas as $key => $value)
				<div align="center" class="signin__info blood_info--name  d-flex bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
					<label class="col-md-3 moudle__info--title moudel__info--title-label text-left d-flex">Đợt Hiến Máu&nbsp;</label>
					<div class="col-md-9 pr-0">
						<input type="hidden" name="blood_donation_id" value="{{$value['id']}}" class="form-control">
						<input type="text" name="blood_donation_anme" value="{{$value['name']}}" class="form-control">
						<?php
	                        $message=Session::get('error_blood');
	                        if($message)
	                        {
	                            echo '<span class="text-danger font-italic" style="margin-left:150px;">'.$message.'</span>';
	                            Session::put('error_blood',null);
	                        }
                    	?>
					</div>
					
				</div>
				<div id="blodd_info">
					<div class="blood_info--detail d-flex justify-content-between">
						<div align="center" class="col-md-6 signin__info signin__info--blood d-flex bg-module-middle wow animate__fadeInUp pl-0" data-wow-duration="2s">
							<label class="col-md-3 text-left pl-0 d-flex align-items-center">Địa Điểm</label>
							<input type="text" 
								class="form-control display-inline-block" value="{{$value['place']}}" placeholder="">
						</div>
						<div align="center" class="col-md-5 signin__info signin__info--blood d-flex bg-module-middle wow animate__fadeInUp pr-0" data-wow-duration="2s">
							<label class="col-md-3 text-left d-flex align-items-center">Đối Tượng</label>
							<input type="text" 
								class="form-control display-inline-block" value="{{$value['object']}}" placeholder="">
						</div>
					</div>
					<div class="blood_info--detail d-flex justify-content-between">
						<div align="center" class="col-md-6 signin__info signin__info--blood d-flex bg-module-middle wow animate__fadeInUp pl-0" data-wow-duration="2s">
							<label class="col-md-3 text-left pl-0 d-flex align-items-center">Bệnh Viện</label>
							<input type="text" 
								class="form-control display-inline-block" value="{{$value['hospital']}}" placeholder="">
						</div>
						<div align="center" class="col-md-5 signin__info signin__info--blood d-flex bg-module-middle wow animate__fadeInUp pr-0" data-wow-duration="2s">
							<label class="col-md-3 text-left d-flex align-items-center">Thời Gian</label>
							<input type="text" 
								class="form-control display-inline-block" value="{{$value['time']}}" placeholder="">
						</div>
					</div>
				</div>
				@endforeach
				<div class="blood_info--notification mt-3 text-center">
					<h2>Quý vị vui lòng trả lời những câu hỏi dưới đây </h2>
					<p>Để đảm bảo an toàn sức khỏe cho quý vị và người bệnh nhận máu, xin quý vị trả lời 
					trung thực và chính xác. Nếu có bất cứ nghi ngờ nào về nguy cơ mắc bệnh lây
					truyền, <strong>XIN QUÝ VỊ HÃY KHÔNG HIẾN MÁU!!</strong></p>
				</div>
				<div class="blood_info--signup mt-3">
				<div class="d-flex justify-content-center">
					<div class="col-md-4 form-group d-flex pr-3 align-items-center">
						<label class="col-md-4">Cân Nặng</label>
						<input type="number" class="form-control" required name="signup_blood_weight">
					</div>
					<div class="col-md-4 form-group d-flex align-items-center">
						<label class="col-md-4">Chiều Cao</label>
						<input type="number" class="form-control" required name="signup_blood_height">
					</div>
				</div>			
					<table class="table">
						<tbody>
							<tr style="background: #CBC2C2">
								<td></td>
								<td></td>
								<td class="text-center"><strong>Có</strong></td>
								<td class="text-center"><strong>Không</strong></td>
							</tr>
							<tr>
								<td class="d-flex justify-content-center"><p class="blood_info--number d-flex justify-content-center align-items-center">1</p></td>
								<td><strong>Trước đây quý vị đã từng hiến máu chưa</strong></td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" required name="landauhienmau" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" required name="landauhienmau" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<!--Muc 2-->
							<tr>
								<td class="d-flex justify-content-center"><p class="blood_info--number d-flex justify-content-center align-items-center">2</p></td>
								<td><strong>Qúy vị từng mắc các bệnh như:</strong> Tâm thần kinh, hô hấp, vàng da/viêm gan, tim mạch, huyết áp thấp/cao, bệnh thận, ho kéo dài, bệnh máu, lao, ung thư, Helmophilia, v.v?</td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" required name="tungmaccacbenh" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" required name="tungmaccacbenh" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<!--Muc 3-->
							<tr>
								<td class="d-flex justify-content-center"><p class="blood_info--number d-flex justify-content-center align-items-center">3</p></td>
								<td><strong>Trong vòng 6 tháng gần đây, quý vị có:</strong></td>
								<td>
								</td>
								<td>
								</td>
							</tr>
							<tr>
								<td class="d-flex justify-content-center">
									*
								</td>
								<td>Sút gân >= 4 kg không rõ nguyên nhân ?</td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" required name="sutcan" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" required name="sutcan" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<tr>
								<td class="d-flex justify-content-center">
									*
								</td>
								<td>Nổi hạch kéo dài ?</td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" required name="noihach" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" required name="noihach" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<tr>
								<td class="d-flex justify-content-center">
									*
								</td>
								<td>Phẩu thuật ?</td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" required name="phauthuat" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" required name="phauthuat" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<tr>
								<td class="d-flex justify-content-center">
									*
								</td>
								<td>Xăm mình, xỏ lỗ qua da (tai, mũi...), châm cứu ?</td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" required name="xamminh" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" required name="xamminh" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<tr>
								<td class="d-flex justify-content-center">
									*
								</td>
								<td>Được truyền máu, chế phẩm máu</td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" required name="duoctruyenmau" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" required name="duoctruyenmau" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<tr>
								<td class="d-flex justify-content-center">
									*
								</td>
								<td>Sử dụng ma túy, tiêm chích...?</td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" required name="matuy" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" required name="matuy" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<tr>
								<td class="d-flex justify-content-center">
									*
								</td>
								<td>Quan hệ tình dục với người nhiễm hoặc người có nguy cơ lây nhiễm HIV, viêm gan ?</td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" required name="quanhe" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" required name="quanhe" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<tr>
								<td class="d-flex justify-content-center">
									*
								</td>
								<td>Quan hệ tình dục với người cùng giới?</td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" required name="quanhecunggioi" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" required name="quanhecunggioi" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<tr>
								<td class="d-flex justify-content-center">
									*
								</td>
								<td>Tiêm vắc xin phòng bệnh ? Loại vắc xin.............</td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" required name="vacxin" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" required name="vacxin" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<tr>
								<td class="d-flex justify-content-center">
									*
								</td>
								<td>Sống trong vùng có dịch lưu hành (sốt xuất huyết, sốt rét, bò điên, Ebola, Zika, Covid 19)..?</td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" required name="songtrongvungdich" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" required name="songtrongvungdich" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<!--Muc 4-->
							<tr>
								<td class="d-flex justify-content-center"><p class="blood_info--number d-flex justify-content-center align-items-center">4</p></td>
								<td><strong>Trong vòng 1 tuần gần đây, Quý vị có:</strong></td>
								<td>
								</td>
								<td>
								</td>
							</tr>
							<tr>
								<td class="d-flex justify-content-center">
									*
								</td>
								<td>Bị cúm, ho, nhức đầu, sốt....?</td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" required name="bicum" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" required name="bicum" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<tr>
								<td class="d-flex justify-content-center">
									*
								</td>
								<td>Dùng thuốc kháng sinh, ASPIRIN, CORTICOID....?</td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" required name="khangsinh" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" required name="khangsinh" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<tr>
								<td class="d-flex justify-content-center">
									*
								</td>
								<td>Đến khám sức khỏe làm xét ngiệm, chữa răng ?</td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" required name="chuarang" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" required name="chuarang" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<!--Muc 5-->
							<tr>
								<td class="d-flex justify-content-center"><p class="blood_info--number d-flex justify-content-center align-items-center">5</p></td>
								<td><strong>Quí vị hiện là đối tượng tàn tật hoặc hưởng trợ cấp tàn tật hoặc nạn nhân chất độc màu da cam không ?</strong></td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" required name="tantat" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" required name="tantat" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<!--Muc 6-->
							<tr>
								<td class="d-flex justify-content-center"><p class="blood_info--number d-flex justify-content-center align-items-center">6</p></td>
								<td><strong>Câu hỏi dành cho phụ nữ:</strong></td>
								<td>
								</td>
								<td>
								</td>
							</tr>
							<tr>
								<td class="d-flex justify-content-center">
									*
								</td>
								<td>Chị hiện đang nuôi con dưới 12 tháng tuổi/ đang trong kỳ kinh nguyệt ?</td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" name="kinhnguyet" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" name="kinhnguyet" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
							<tr>
								<td class="d-flex justify-content-center">
									*
								</td>
								<td>Chị đã từng có có thai hoặc sinh con chưa</td>
								<td style="padding-left: 32px;">
									<label class="blood_info--check">
									  <input type="radio" name="sinhcon" value="1">
									  <span class="checkmark"></span>
									</label>
								</td>
								<td style="padding-left: 30px;">
									<label class="blood_info--check">
									  <input type="radio" name="sinhcon" value="0">
									  <span class="checkmark"></span>
									</label>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="blood_info--camket">
						<p>&nbsp;&nbsp;&nbsp;Tôi đã đọc, hiểu rõ, trả lời trung thực và cam kết chịu trách nhiệm về các thông tin cá nhân và các câu hỏi dành cho người hiến máu. Nếu phát hiện thấy nguy cơ mắc bệnh của bản thân, tôi sẽ liên hệ ngay với cơ sở tiếp nhận máu để đảm bảo an toàn cho người nhận máu của tôi.</p>
						<p>&nbsp;&nbsp;&nbsp;Tôi đồng ý việc đơn vị máu của tôi được xét nghiệm sàng lọc giang mai, viêm gan B, viêm gan C và HIV theo quy định hiện hành, mong muốn có thể xảy ra khi tham gia hiến máu.</p>
					</div>
					<div class="form-group row form-group--center wow animate__fadeInUp" data-wow-duration="2s" style="margin: 0">

						<div align="center" class="signin__info col-md-12 bg-module-middle wow animate__fadeInUp" data-wow-duration="2s">
							<div class="pretty p-default p-round p-thick mr-3 d-flex align-items-center">
							  <input type="checkbox" name="gender" class="mr-3" onclick="EnableDisable()" />
							  <div class="state">
							    <label>Tôi cam kết những thông tin trên hoàn toàn đúng sự thật</label>
							  </div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 form-group pl-0 pr-0">
							<button type="submit" id="buttonDangKy" disabled class="btn btn-danger d-flex align-items-center justify-content-center" style="width: 100%; background:#FDD835; border: none; height: 45px;border-radius: 45px;" href="#">Đăng Ký</button>
						</div>
					</div>
				</div>
			</form>
		</div>
 	</div>
</div>
<script type="text/javascript">
var y=true;
function EnableDisable()
{
	if(y)
	{
		document.getElementById("buttonDangKy").disabled = false;
		y=false;
	}else
	{
		document.getElementById("buttonDangKy").disabled = true;
		y=true;
	}
}
</script>
@endsection