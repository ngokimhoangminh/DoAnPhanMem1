@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Thông Tin Hiến Máu Thực Tế
                </header>
                <div class="panel-body">
                   @foreach($blood_actual as $key => $value_update)
                    <div class="position-center">
                        <form role="form">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Đợt Hiến Máu</label>
                                <input type="text" name="blood_donation_name" disabled value="{{$value_update['blood_name']}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Họ Và Tên</label>
                                <input type="text" name="users_fullname" disabled value="{{$value_update['users_fullname']}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-size: 14px;font-family: initial;">Nhóm Máu</label>
                                <input type="text" value="{{$value_update['blood_actual_group']}}" class="form-control blood_actual_group" placeholder="Enter Employee">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Đơn Vị Máu</label>
                                <input type="text" value="{{$value_update['blood_actual_unit']}}" name="blood_actual_unit" class="form-control blood_actual_unit">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tình Trạng Sức Khỏe</label>
                                <input type="text" name="blood_actual_health" value="{{$value_update['blood_actual_health']}}" class="form-control blood_actual_health">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tình Huống Phát Sinh</label>
                                <input type="text" name="blood_actual_situations" value="{{$value_update['blood_actual_situations']}}" class="form-control blood_actual_situations">
                            </div>
                            <button type="submit" class="btn btn-info update_employee" onclick="edit({{$value_update['blood_actual_id']}})" name="update_employee">Cập nhật</button>
                        </form>
                    </div>
                @endforeach
                </div>
            </section>

    </div>
   
</div>
<script type="text/javascript">
    function edit(blood_actual_id)
    {
        var blood_actual_group=$('.blood_actual_group').val();
        var blood_actual_unit=$('.blood_actual_unit').val();
        var blood_actual_health=$('.blood_actual_health').val();
        var blood_actual_situations=$('.blood_actual_situations').val();
    $.ajax({
        url:"{{URL('/edit-blood-actual')}}",
        method:"POST",
        data:
        {
          "_token": "{{ csrf_token() }}",
          "blood_actual_id":blood_actual_id,
          "blood_actual_group":blood_actual_group,
          "blood_actual_unit":blood_actual_unit,
          "blood_actual_health":blood_actual_health,
          "blood_actual_situations":blood_actual_situations,
        },
        success:function(data)
        {
          $.niceToast.success('<strong>Thông báo</strong>: Cập nhật thành công');
          setTimeout(
          () => {
              window.location.href="/list-blood-actual";
          },
          2 * 1000
          );
        },error:function(data)
        {
          $.niceToast.error('<strong>Thông báo</strong>: Thất bại, thử lại');
        }
    });
    }
</script>
@endsection