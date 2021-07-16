@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Thông Tin Nhân Viên
                </header>
                <div class="panel-body">
                   @foreach($result_emp as $key => $value_unpdate)
                    <div class="position-center">
                        <form role="form"  action="{{URL::to('edit-employee/'.$value_unpdate->employee_id)}}" method="POST">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Nhân Viên</label>
                            <input type="text" name="employee_name" value="{{$value_unpdate->employee_name}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Bệnh Viện</label>
                              <select name="hospital_id" class="form-control input-sm m-bot15">
                                @foreach ($result_hospital as $key => $value_hos)
                                    @if($value_hos->hospital_id==$value_unpdate->hospital_id)
                                        <option selected value="{{$value_hos->hospital_id}}">{{$value_hos->hospital_name}} </option>
                                    @else
                                        <option value="{{$value_hos->hospital_id}}">{{$value_hos->hospital_name}} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chức Vụ</label>
                            <input type="text" value="{{$value_unpdate->employee_title}}" name="employee_title" class="form-control hospital_email" id="exampleInputEmail1" placeholder="Enter Brand">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Khoa</label>
                            <input type="text" name="employee_department" value="{{$value_unpdate->employee_department}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số Điện Thoại</label>
                            <input type="text" name="employee_phone" value="{{$value_unpdate->employee_phone}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name="employee_email" value="{{$value_unpdate->employee_email}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
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