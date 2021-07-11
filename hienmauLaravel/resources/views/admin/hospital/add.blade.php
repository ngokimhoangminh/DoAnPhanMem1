@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Bệnh Viện
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="#">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Bệnh Viện</label>
                            <input type="text" name="hospital_name" class="form-control hospital_name" id="exampleInputEmail1" placeholder="Enter Brand">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Địa Chỉ</label>
                            <textarea style="resize:none" rows="5" class="form-control hospital_address" id="exampleInputPassword1" placeholder="Thông tin thương hiệu" name="hospital_address"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name="hospital_email" class="form-control hospital_email" id="exampleInputEmail1" placeholder="Enter Brand">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số Điện Thoại</label>
                            <input type="text" name="hospital_phone" class="form-control hospital_phone" id="exampleInputEmail1" placeholder="Enter Brand">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái</label>
                            <select name="hospital_status" class="form-control input-sm m-bot15 hospital_status">
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                                
                            </select>
                        </div>
                        
                        <button type="button" class="btn btn-info add_hospital" name="">Thêm</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
   
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.add_hospital').click(function()
        {
            var hospital_name=$('.hospital_name').val();
            var hospital_address=$('.hospital_address').val();
            var hospital_email=$('.hospital_email').val();
            var hospital_phone=$('.hospital_phone').val();
            var hospital_status=$('.hospital_status').val();
            var _token=$('input[name="_token"]').val();
            $.ajax({
                url:"{{URL('/save-hospital')}}",
                method:"POST",
                data:{hospital_name:hospital_name,hospital_address:hospital_address,hospital_email:hospital_email,hospital_phone:hospital_phone,hospital_status:hospital_status, _token:_token},
                success:function(data)
                {
                   window.location.href="/list-hospital";
                }
            });
        });
    });
</script>
@endsection
