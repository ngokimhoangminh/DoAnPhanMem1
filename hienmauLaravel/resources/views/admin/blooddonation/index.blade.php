@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông Tin Đợt Hiến Máu
    </div>
    <div class="table-responsive ">
      <?php
        $message=Session::get('message');
        if($message)
        {
          echo '
          <div class="toast" style="width:100%; background:azure; border-radius:4px;">
              <span class="text-success " style=" height:34px; background:azure; border-radius:4px; padding:5px;">'.$message.'</span>
          </div>
          ';
          Session::put('message',null);
        }
      ?>
       <form role="form" action="{{URL::to('save-blooddonation')}}" method="POST">
        {{csrf_field()}}
          <table class="table">
              <tr>
                <td>
                   <label for="exampleInputEmail1">Đợt Hiến Máu</label>
                   <input type="text" name="blood_donation_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
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
                   <label for="exampleInputEmail1">Thời Gian</label>
                   <input type="time" name="blood_donation_time" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
                </td>
                <td>
                  <label for="exampleInputEmail1">Địa Điểm</label>
                  <input type="text" name="blood_donation_place" class="form-control" id="exampleInputEmail1" placeholder="Địa điểm">
                </td>
              </tr>
              <tr>
                <td>
                   <label for="exampleInputEmail1">Đối Tượng</label>
                   <input type="text" name="blood_object" class="form-control" id="exampleInputEmail1" placeholder="Đối tượng">
                </td>
                <td>
                  <label for="exampleInputEmail1">Ngày Tổ Chức</label>
                  <input type="date" name="blood_start_date" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
                </td>
              </tr>
              <tr>
                <td>
                  <label for="exampleInputEmail1">Ngày Kết Thúc Đăng Ký</label>
                  <input type="date" name="blood_finish_date" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee">
                </td>
                <td><label for="exampleInputEmail1">Lưu Ý</label>
                  <textarea style="resize:none" rows="5" class="form-control" id="exampleInputPassword1" placeholder="Lưu ý" name="blood_note"></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="exampleInputPassword1">Trạng thái</label>
                  <select name="blood_status" class="form-control input-sm m-bot15 employee_status">
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
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th class="text-center">Đợt Hiến Máu</th>
            <th class="text-center" style="width:165px;">Bệnh Viện</th>
            <th class="text-center">Thời Gian</th>
            <th class="text-center">Địa Điểm</th>
            <th class="text-center">Đối Tượng</th>
            <th class="text-center">Ngày Tổ Chức</th>
            <th class="text-center">Ngày Kết Thúc</th>
            <th class="text-center">Lưu Ý</th>
            <th class="text-center">Trạng Thái</th>
            <th class="text-center" style="width:115px!important;">Hành Động</th>
          </tr>
        </thead>
        <div>
        <tbody>
          @foreach ($result_blood as $key => $bl_value)
          <tr id="row_{{$bl_value->blood_donation_id}}">
            {{csrf_field()}}
            <td>{{$bl_value->blood_donation_name}}</td>
            <td>{{$bl_value->hospital_name}}</td>
            <td>{{date('H:i', strtotime($bl_value->blood_donation_time))}}</td>
            <td>{{$bl_value->blood_donation_place}}</td>
            <td>{{$bl_value->blood_object}}</td>
            <td>{{date('d-m-Y', strtotime($bl_value->blood_start_date))}}</td>
            <td>{{date('d-m-Y', strtotime($bl_value->blood_finish_date))}}</td>
            <td>{{$bl_value->blood_note}}</td>
            <td><span class="text-ellipsis">
                @if($bl_value->blood_status==1)
                  <a href="{{URL::to('/unactive_status_blood/'.$bl_value->blood_donation_id)}}" style="text-decoration: none;" ><i class="fa fa-thumbs-up"></i> Hiển Thị</a>
                @else
                 <a href="{{URL::to('/active_status_blood/'.$bl_value->blood_donation_id)}}" style="text-decoration: none;"><i class="fa fa-thumbs-down"></i> Ẩn</a>
                @endif
            </span></td>
            <td>
              <a href="{{URL::to('/update-blood-donation/'.$bl_value->blood_donation_id)}}" class="active styling-edit btn btn-success" ui-toggle-class><i class="fa fa-pencil-square-o text-success text-active" style="color:#fff;" ></i></a>
             <input type="hidden" name="blood_donation_id" value="{{$bl_value->blood_donation_id}}" class="form-control blood_donation_id" id="exampleInputEmail1"  placeholder="Enter Brand">
              <a onclick="deleteBlood({{$bl_value->blood_donation_id}})"  class="active styling-edit btn btn-danger" ui-toggle-class>
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
       {{--  <span>{!! $result_blood->render() !!}</span> --}}
      </div>
    </footer>
  </div>
</div>
<script type="text/javascript">
  function deleteBlood(id)
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
                url:"{{URL('/delete-blood_donation')}}",
                method:"POST",
                data:{blood_donation_id:id,_token:_token},
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