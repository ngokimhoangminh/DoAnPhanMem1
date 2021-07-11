@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh Sách Bệnh Viện
    </div>
    <div class="table-responsive">
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
      <table class="table table-striped b-t b-light" d="myTable">
        <thead>
          <tr>
            <th>Tên Bệnh Viện</th>
            <th>Địa Chỉ</th>
            <th>Email</th>
            <th>Số Điện Thoại</th>
            <th>Trạng Thái</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($list_hospital as $key => $hospital)
          <tr id="row_{{$hospital->hospital_id}}">
            {{csrf_field()}}
            <td>{{$hospital->hospital_name}}</td>
            <td>{{$hospital->hospital_address}}</td>
            <td>{{$hospital->hospital_email}}</td>
            <td>{{$hospital->hospital_phone}}</td>
            <td><span class="text-ellipsis">
                @if($hospital->hospital_status==1)
                  <a href="{{URL::to('/unactive_status_hospital/'.$hospital->hospital_id)}}" style="text-decoration: none;" ><i class="fa fa-thumbs-up"></i> Hiển Thị</a>
                @else
                 <a href="{{URL::to('/active_status_hospital/'.$hospital->hospital_id)}}" style="text-decoration: none;"><i class="fa fa-thumbs-down"></i> Ẩn</a>
                @endif
            </span></td>
            <td><span class="text-ellipsis"></span></td>
            <td>
              <a href="{{URL::to('/update-hospital/'.$hospital->hospital_id)}}" class="active styling-edit btn btn-success" ui-toggle-class><i class="fa fa-pencil-square-o text-success text-active" style="color:#fff;" ></i></a>
             <input type="hidden" name="hospital_id" value="{{$hospital->hospital_id}}" class="form-control hospital_id" id="exampleInputEmail1"  placeholder="Enter Brand">
              <a onclick="deleteHospital({{$hospital->hospital_id}})"  class="active styling-edit btn btn-danger" ui-toggle-class>
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
        {{-- <span>{!! $list_hospital->render() !!}</span> --}}
      </div>
    </footer>
  </div>
</div>
<script type="text/javascript">
  function deleteHospital(id)
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
                url:"{{URL('/delete-hospital')}}",
                method:"POST",
                data:{hospital_id:id,_token:_token},
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