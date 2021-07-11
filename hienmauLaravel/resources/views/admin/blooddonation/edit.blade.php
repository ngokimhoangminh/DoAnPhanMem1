@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Đợt Hiến Máu
                </header>
                <div class="panel-body">
                   @foreach($result_blood as $key => $value_update)
                    <div class="position-center">
                        <form role="form"  action="{{URL::to('edit-blood-donation/'.$value_update->blood_donation_id)}}" method="POST">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Đợt Hiến Máu</label>
                            <input type="text" name="blood_donation_name" value="{{$value_update->blood_donation_name}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Bệnh Viện</label>
                              <select name="hospital_id" class="form-control input-sm m-bot15">
                                @foreach ($result_hospital as $key => $value_hos)
                                    @if($value_hos->hospital_id==$value_update->hospital_id)
                                        <option selected value="{{$value_hos->hospital_id}}">{{$value_hos->hospital_name}} </option>
                                    @else
                                        <option value="{{$value_hos->hospital_id}}">{{$value_hos->hospital_name}} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thời Gian</label>
                            
                            <input type="time" value="{{date('H:i', strtotime($value_update->blood_donation_time))}}" name="blood_donation_time" class="form-control hospital_email" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa Điểm</label>
                            <input type="text" name="blood_donation_place" value="{{$value_update->blood_donation_place}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Đối Tượng</label>
                            <input type="text" name="blood_object" value="{{$value_update->blood_object}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ngày Tổ Chức</label>
                            <input type="date" name="blood_start_date" value="{{$value_update->blood_start_date}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ngày Kết Thúc Đăng Ký</label>
                            <input type="date" name="blood_finish_date" value="{{$value_update->blood_finish_date}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Lưu Ý</label>
                            <input type="text" name="blood_note" value="{{$value_update->blood_note}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
                        </div>
                        <button type="submit" class="btn btn-info update_employee" name="update_employee">Cập nhật</button>
                    </form>
                    </div>
                @endforeach
                </div>
            </section>

    </div>
   
</div>
<script type="text/javascript">
</script>
@endsection