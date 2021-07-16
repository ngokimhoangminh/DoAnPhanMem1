@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Thông Tin bệnh Viện
                </header>
                <?php
                    $message=Session::get('message');
                    if($message)
                    {
                      echo '<span class="text-success " style="width:100%; height:34px; background:azure; border-radius:4px;">'.$message.'</span>';
                      Session::put('message',null);
                    }
                ?>
                <div class="panel-body">
                   @foreach($update_hospital as $key => $update_value)
                    <div class="position-center">
                        <form role="form" action="#">
                            {{csrf_field()}}
                        <input type="hidden" name="hospital_id" value="{{$update_value->hospital_id}}" class="form-control hospital_id" id="exampleInputEmail1"  placeholder="Enter Brand">
                         <div class="form-group">
                            <label for="exampleInputEmail1">Tên Bệnh Viện</label>
                            <input type="text" name="hospital_name" value="{{$update_value->hospital_name}}" class="form-control hospital_name" id="exampleInputEmail1" placeholder="Enter Brand">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Địa Chỉ</label>
                            <textarea style="resize:none" rows="5"  class="form-control hospital_address" id="exampleInputPassword1" placeholder="Thông tin thương hiệu" name="hospital_address">{{$update_value->hospital_address}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" value="{{$update_value->hospital_email}}" name="hospital_email" class="form-control hospital_email" id="exampleInputEmail1" placeholder="Enter Brand">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số Điện Thoại</label>
                            <input type="text" name="hospital_phone" value="{{$update_value->hospital_phone}}" class="form-control hospital_phone" id="exampleInputEmail1" placeholder="Enter Brand">
                        </div>
                        <button type="button" class="btn btn-info update_hospital" name="update_brand_product">Cập nhật</button>
                    </form>
                    </div>
                @endforeach
                </div>
            </section>

    </div>
   
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.update_hospital').click(function()
        {
            var hospital_id=$('.hospital_id').val();
            var hospital_name=$('.hospital_name').val();
            var hospital_address=$('.hospital_address').val();
            var hospital_email=$('.hospital_email').val();
            var hospital_phone=$('.hospital_phone').val();
            var _token=$('input[name="_token"]').val();
            $.ajax({
                url:"{{URL('/edit-hospital')}}",
                method:"POST",
                data:{hospital_id:hospital_id,hospital_name:hospital_name,hospital_address:hospital_address,hospital_email:hospital_email,hospital_phone:hospital_phone,_token:_token},
                success:function(data)
                {
                   window.location.href="/list-hospital";
                }
            });
        });
    });
</script>
@endsection