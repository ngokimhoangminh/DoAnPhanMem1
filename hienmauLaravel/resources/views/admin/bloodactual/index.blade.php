@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh Sách Hiến Máu Thực Tế
    </div>
    <div class="table-responsive float-right" style="padding: 15px 40px 0px 0px;">
       <button type="submit" class="btn btn-info" name="add_employee" data-toggle="modal" data-target="#exampleModal">Thêm</button>
       <!--Thêm-->
       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 500px!important">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Thêm thông tin hiến máu thực tế</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px;font-family: initial;">Đợt Hiến Máu</label>
                    <select class="form-control blood_donation_id" name="blood_donation_id" required onchange="filterUser(this)">
                      <option value="" class="font-italic">--Chọn đợt hiến máu--</option>
                      @foreach($blood_donations as $key => $value_bl)
                        <option value="{{$value_bl['blood_donation_id']}}">{{$value_bl['blood_donation_name']}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px;font-family: initial;">Họ Tên</label>
                    <select class="form-control signup_blood_id" required name="signup_blood_id" id="user_list">

                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px;font-family: initial;">Nhóm Máu</label>
                    <input type="text" name="blood_actual_group" required class="form-control blood_actual_group" placeholder="Enter Employee">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px;font-family: initial;">Đơn Vị Máu</label>
                    <input type="number" name="blood_actual_unit" required class="form-control blood_actual_unit" placeholder="Enter Employee">
                </div>
            
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px;font-family: initial;">Tình Trạng Sức Khỏe</label>
                    <input type="text" name="blood_actual_health" required class="form-control blood_actual_health"  placeholder="Enter Employee">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px;font-family: initial;">Tình Huống Phát Sinh</label>
                    <textarea class="form-control blood_actual_situations" ></textarea> 
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
              <button type="button" class="btn btn-primary" onclick="save()" data-dismiss="modal">Lưu</button>
            </div>
          </div>
        </div>
      </div>
     
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>STT</th>
            <th>Họ Và Tên</th>
            <th>Nhóm Máu</th>
            <th style="width:145px;">Đợt Hiến Máu</th>
            <th>Ngày Hiến Máu</th>
            <th>Đơn Vị Máu</th>
            <th>Sức Khỏe</th>
            <th>Tình Huống Phát Sinh</th>
            <th style="width:130px;">Hành Động</th>
          </tr>
        </thead>
        <div>
        <tbody>
          @foreach($blood_actual as $key => $value)
          <tr id="row_{{$value['blood_actual_id']}}">
            <td>{{$key + 1}}</td>
            <td>{{$value['users_fullname']}}</td>
            <td>{{$value['blood_actual_group']}}</td>
            <td>{{$value['blood_name']}}</td>
            <td>{{date('d-m-Y', strtotime($value['blood_actual_date']))}}</td>
            <td>{{$value['blood_actual_unit']}}&nbsp;ml</td>
            <td>{{$value['blood_actual_health']}}</td>
            <td>{{$value['blood_actual_situations']}}</td>
            <td>
             <a href="{{URL::to('/update-blood-actual/'.$value['blood_actual_id'])}}" class="active styling-edit btn btn-success" ui-toggle-class><i class="fa fa-pencil-square-o text-success text-active" style="color:#fff;" ></i></a>
             <input type="hidden" name="employee_id" value="{{$value['blood_actual_id']}}" class="form-control blood_actual_id">
              <a onclick="deleteBloodActual({{$value['blood_actual_id']}})"  class="active styling-edit btn btn-danger" ui-toggle-class>
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
  $(document).ready(function() {
      $('.select2').select2();
  });



  function filterUser(obj)
  {
      value=obj.value;
      $.ajax({
                url:"{{URL('/filter-user')}}",
                method:"POST",
                data:{
                  "_token": "{{ csrf_token() }}",
                  "blood_id":value
                },
                success:function(response)
                {
                    html=``;
                    response['response'].forEach(el => {
                        html+=`<option value="${el['signup_blood_id']}">${el['fullname']}</option>`;
                        
                    });
                    document.getElementById('user_list').innerHTML = html;
                    
                },
                error: function (response) {
                
                }
        });
  }
  function save()
  {
    var signup_blood_id=$('.signup_blood_id').val();
    var blood_actual_group=$('.blood_actual_group').val();
    var blood_actual_unit=$('.blood_actual_unit').val();
    var blood_actual_health=$('.blood_actual_health').val();
    var blood_actual_situations=$('.blood_actual_situations').val();
    var blood_donation_id=$('.blood_donation_id').val();
    $.ajax({
        url:"{{URL('/save-blood-actual')}}",
        method:"POST",
        data:
        {
          "_token": "{{ csrf_token() }}",
          "signup_blood_id":signup_blood_id,
          "blood_actual_group":blood_actual_group,
          "blood_actual_unit":blood_actual_unit,
          "blood_actual_health":blood_actual_health,
          "blood_actual_situations":blood_actual_situations,
          "blood_donation_id":blood_donation_id
        },
        success:function(data)
        {
          $.niceToast.success('<strong>Thông báo</strong>: Thêm thông tin thành công');
          setTimeout(
          () => {
              window.location.href="/list-blood-actual";
          },
          2 * 1000
          );
        },error:function(data)
        {
          $.niceToast.error('<strong>Thông báo</strong>: Thất bại, Bạn chưa nhập thông tin');
        }
    });
  }
  function deleteBloodActual(id)
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
              var _token=$('input[name="_token"]').val();
              $.ajax({
                url:"{{URL('/delete-blood-actual')}}",
                method:"POST",
                data:{
                  "_token": "{{ csrf_token() }}",
                  blood_actual_id:id,
                },
                success:function(data)
                {
                   $.niceToast.success('<strong>Thông báo</strong>:Đã xóa thành công');
                    $("#row_" + id).remove();
                }
            });
            }
        })
  }
             
</script>
@endsection