@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh Sách Nhân Viên
    </div>
    <div class="table-responsive ">
       <?php
        $message=Session::get('message');
        if($message)
        {
          echo '
          <div class="toast" style="width:100%; background:azure; border-radius:4px; opacity:1;">
              <span class="text-success " style=" height:34px; background:azure; border-radius:4px; padding:5px;">'.$message.'</span>
          </div>
          ';
          Session::put('message',null);
        }
      ?>
       <form role="form" action="{{URL::to('save-employee')}}" method="POST">
        {{csrf_field()}}
          <table class="table">
              <tr>
                <td>
                   <label for="exampleInputEmail1">Tên Nhân Viên</label>
                   <input type="text" name="employee_name" required="" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
                </td>
                <td>
                  <label for="exampleInputEmail1">Bệnh Viện</label>
                  <select name="hospital_id" class="form-control">
                    @foreach ($result_hospital as $key => $value_hos)
                      <option value="{{$value_hos->hospital_id}}">{{$value_hos->hospital_name}} </option>
                    @endforeach
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                   <label for="exampleInputEmail1">Chức Vụ</label>
                   <input type="text" name="employee_title" required="" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
                </td>
                <td>
                  <label for="exampleInputEmail1">Khoa</label>
                  <input type="text" name="employee_department" required="" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
                </td>
              </tr>
              <tr>
                <td>
                   <label for="exampleInputEmail1">Số Điện Thoại</label>
                   <input type="text" name="employee_phone" required="" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
                </td>
                <td>
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" name="employee_email" required="" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
                </td>
              </tr>
              <tr>
                <td>
                  <label for="exampleInputPassword1">Trạng thái</label>
                  <select name="employee_status" class="form-control input-sm m-bot15 employee_status">
                      <option value="1">Hiện</option>
                      <option value="0">Ẩn</option>
                      
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <button type="submit" class="btn btn-info" name="add_employee">Thêm</button>
                </td>
              </tr>
          </table>
        </form>
    </div>
    <div class="table-responsive">
      <?php
        $message=Session::get('message');
        if($message)
        {
          echo '<span class="text-success " style="width:100%; height:34px; background:azure; border-radius:4px;">'.$message.'</span>';
          Session::put('message',null);
        }
      ?>
      <table class="table table-striped table-bordered b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên Nhân Viên</th>
            <th style="width:145px;">Bệnh Viện</th>
            <th>Chức Vụ</th>
            <th>Khoa</th>
            <th>Số Điện Thoại</th>
            <th>Email</th>
            <th>Trạng Thái</th>
            <th style="width:130px;">Hành Động</th>
          </tr>
        </thead>
        <div>
        <tbody>
          @foreach ($result_employee as $key => $em_value)
          <tr id="row_{{$em_value->employee_id}}">
            {{csrf_field()}}
            <td>{{$key +1}}</td>
            <td>{{$em_value->employee_name}}</td>
            <td>{{$em_value->hospital_name}}</td>
            <td>{{$em_value->employee_title}}</td>
            <td>{{$em_value->employee_department}}</td>
            <td>{{$em_value->employee_phone}}</td>
            <td>{{$em_value->employee_email}}</td>
            <td><span class="text-ellipsis">
                @if($em_value->employee_status==1)
                  <a href="{{URL::to('/unactive_status_employee/'.$em_value->employee_id)}}" style="text-decoration: none;" ><i class="fa fa-thumbs-up"></i> Hiển Thị</a>
                @else
                 <a href="{{URL::to('/active_status_employee/'.$em_value->employee_id)}}" style="text-decoration: none;"><i class="fa fa-thumbs-down"></i> Ẩn</a>
                @endif
            </span></td>
            <td>
              <a href="{{URL::to('/update-employee/'.$em_value->employee_id)}}" class="active styling-edit btn btn-success" ui-toggle-class><i class="fa fa-pencil-square-o text-success text-active" style="color:#fff;" ></i></a>
             <input type="hidden" name="employee_id" value="{{$em_value->employee_id}}" class="form-control employee_id" id="exampleInputEmail1"  placeholder="Enter Brand">
              <a onclick="deleteEmployee({{$em_value->employee_id}})"  class="active styling-edit btn btn-danger" ui-toggle-class>
                <i class="fa fa-times text-danger text" style="color:#fff;"></i>
              </a>
            </td>
          </tr>
          @endforeach 
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        {{-- <span>{!! $result_employee->render() !!}</span> --}}
      </div>
    </footer>
  </div>
</div>
<script type="text/javascript">
  function deleteEmployee(id)
  {
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
              var hospital_id=$('.hospital_id').val();
              var _token=$('input[name="_token"]').val();
              $.ajax({
                url:"{{URL('/delete-employee')}}",
                method:"POST",
                data:{employee_id:id,_token:_token},
                success:function(data)
                {
                   Swal.fire(
                            'Thành Công!',
                            'Bạn đã xóa thành công',
                            'success'
                        );
                    $("#row_" + id).remove();
                }
            });
            }
        })
  }
             
</script>
@endsection