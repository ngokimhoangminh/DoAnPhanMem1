@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh Mục Tin Tức
    </div>
    <div class="table-responsive float-right" style="padding: 15px 40px 0px 0px;">
       <button type="submit" class="btn btn-info" name="add_employee" data-toggle="modal" data-target="#exampleModal">Thêm</button>
       <!--Thêm-->
       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 500px!important">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục tin tức</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px;font-family: initial;">Tên Danh Mục</label>
                    <input type="text" name="category_news_name" onkeyup="ConvertSlug()" id="slug" required class="form-control category_news_name" placeholder="Enter Employee">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px;font-family: initial;">Slug</label>
                    <input type="text" name="category_news_slug" id="convetslug" required class="form-control category_news_slug" placeholder="Enter Employee">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="font-size: 14px;font-family: initial;">Mô tả</label>
                    <textarea style="resize:none" rows="5" class="form-control category_news_des"  placeholder="Thông tin thương hiệu" name="category_news_des"></textarea>
                </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Trạng thái</label>
                  <select name="category_news_status" class="form-control input-sm m-bot15 category_news_status">
                      <option value="1">Hiện</option>
                      <option value="0">Ẩn</option>
                  </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
              <button type="button" class="btn btn-primary" onclick="save()" data-dismiss="modal">Lưu</button>
            </div>
          </div>
        </div>
      </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>STT</th>
            <th>Danh Mục</th>
            <th>Slug</th>
            <th style="width:145px;">Mô Tả</th>
            <th>Trạng Thái</th>
            <th style="width:130px;">Hành Động</th>
          </tr>
        </thead>
        <div>
        <tbody>
          @foreach($categorynews as $key => $value)
          <tr id="row_{{$value->category_news_id}}">
            <td>{{$key + 1}}</td>
            <td>{{$value->category_news_name}}</td>
            <td>{{$value->category_news_slug}}</td>
            <td>{{$value->category_news_des}}</td>
            <td>
              @if($value->category_news_status==1)
                  <a href="" style="text-decoration: none;" ><i class="fa fa-thumbs-up"></i> Hiển Thị</a>
                @else
                 <a href="" style="text-decoration: none;"><i class="fa fa-thumbs-down"></i> Ẩn</a>
                @endif
            </td>
            <td>
             <a href="{{URL::to('/update-category-news/'.$value->category_news_id)}}" class="active styling-edit btn btn-success"><i class="fa fa-pencil-square-o text-success text-active" style="color:#fff;" ></i></a>
             <input type="hidden" name="employee_id" value="" class="form-control blood_actual_id">
              <a onclick="deleteCategoryNews({{$value->category_news_id}})"  class="active styling-edit btn btn-danger" ui-toggle-class>
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
  function save()
  {
    var category_news_name=$('.category_news_name').val();
    var category_news_slug=$('.category_news_slug').val();
    var category_news_des=$('.category_news_des').val();
    var category_news_status=$('.category_news_status').val();
    $.ajax({
        url:"{{URL('/save-category-news')}}",
        method:"POST",
        data:
        {
          "_token": "{{ csrf_token() }}",
          "category_news_name":category_news_name,
          "category_news_slug":category_news_slug,
          "category_news_des":category_news_des,
          "category_news_status":category_news_status
        },
        success:function(data)
        {
          $.niceToast.success('<strong>Thông báo</strong>: Thêm danh mục tin tức thành công');
          setTimeout(
          () => {
              window.location.href="/list-category-news";
          },
          2 * 1000
          );
        },error:function(data)
        {
          $.niceToast.error('<strong>Thông báo</strong>: Thất bại, Bạn chưa nhập thông tin');
        }
    });
  }
  function deleteCategoryNews(id)
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
                url:"{{URL('/delete-category-news')}}",
                method:"POST",
                data:{
                  "_token": "{{ csrf_token() }}",
                  category_news_id:id,
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
<script type="text/javascript">
  function removeVietnameseTones(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"); 
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
    str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o"); 
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
    str = str.replace(/đ/g,"d");
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    str = str.replace(/Đ/g, "D");
    // Some system encode vietnamese combining accent as individual utf-8 characters
    // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
    str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
    // Remove extra spaces
    // Bỏ các khoảng trắng liền nhau
    str = str.replace(/ + /g," ");
    str = str.trim();
    // Remove punctuations
    // Bỏ dấu câu, kí tự đặc biệt
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
    return str;
}
  function ConvertSlug()
  {
      var name=document.getElementById("slug").value;

      var name_remove=removeVietnameseTones(name);
      var name_toloscae=name_remove.toLowerCase();
      var data=name_toloscae.split(" ");
      var slug="";
      for (var i = 0; i < data.length; i++){
        slug+=data[i]+"-";
        document.getElementById("convetslug").value=slug;
      }   
  }
</script>
@endsection