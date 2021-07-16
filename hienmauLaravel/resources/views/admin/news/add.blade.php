@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Tin Tức
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('save-news')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Danh Mục Tin Tức</label>
                              <select name="category_news_id" class="select2 ">
                                @foreach($categorynews as $key => $value)
                                  <option value="{{$value->category_news_id}}">{{$value->category_news_name}}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Bài Viết</label>
                            <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn nhập ít nhất 5 kí tự" onkeyup="ConvertSlug()" id="slug" name="news_title" class="form-control news_title" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Slug</label>
                            <input type="text" name="news_slug" id="convetslug" class="form-control news_slug"  placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tóm Tắt Bài Viết</label>
                            <textarea style="resize:none" rows="5" required="" class="form-control news_desc" id="ckeditor1"   name="news_desc"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nội Dung Bài Viết</label>
                            <textarea style="resize:none" rows="5" required="" class="form-control news_content" id="ckeditor2"  name="news_content"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Meta Từ Khóa</label>
                            <textarea style="resize:none" rows="4" required="" class="form-control news_meta_keysword"   name="news_meta_keysword"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Meta Nội Dung</label>
                            <textarea style="resize:none" rows="4" required="" class="form-control news_meta_des"   name="news_meta_des"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hình Ảnh</label>
                            <input type="file" name="news_image" class="form-control news_image"  >
                            
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái</label>
                            <select name="news_status" class="form-control input-sm m-bot15 news_status">
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info add_hospital" name="">Thêm</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
   
</div>
<script type="text/javascript">
    $(document).ready(function() {
      $('.select2').select2();
  });
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
