@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Danh Mục Tin Tức
                </header>
                <div class="panel-body">
                   @foreach($value_news as $key => $value_updates)
                    <div class="position-center">
                        <form role="form">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Danh Mục</label>
                                <input type="text" name="category_news_name"  value="{{$value_updates->category_news_name}}" class="form-control category_news_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" name="category_news_slug"  value="{{$value_updates->category_news_slug}}" class="form-control category_news_slug">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-size: 14px;font-family: initial;">Mô tả</label>
                                <textarea style="resize:none" rows="5" class="form-control category_news_des"  placeholder="Thông tin thương hiệu" name="category_news_des">{{$value_updates->category_news_des}}</textarea>
                            </div>
                             <div class="form-group">
                              <label for="exampleInputPassword1">Trạng thái</label>
                                <select name="category_news_status" class="form-control input-sm m-bot15 category_news_status">
                                    @if($value_updates->category_news_status==1)
                                      <option value="1" selected>Hiện</option>
                                      <option value="0">Ẩn</option>
                                    @else
                                      <option value="1" >Hiện</option>
                                      <option value="0" selected>Ẩn</option>
                                    @endif
                                </select>
                               </div>
                            <button type="submit" class="btn btn-info update_employee" onclick="edit({{$value_updates->category_news_id}})" name="update_employee">Cập nhật</button>
                        </form>
                    </div>
                @endforeach
                </div>
            </section>

    </div>
   
</div>
<script type="text/javascript">
    function edit(category_news_id)
    {
        var category_news_name=$('.category_news_name').val();
        var category_news_slug=$('.category_news_slug').val();
        var category_news_des=$('.category_news_des').val();
        var category_news_status=$('.category_news_status').val();
    $.ajax({
        url:"{{URL('/edit-category-news')}}",
        method:"POST",
        data:
        {
          "_token": "{{ csrf_token() }}",
          "category_news_id":category_news_id,
          "category_news_name":category_news_name,
          "category_news_slug":category_news_slug,
          "category_news_des":category_news_des,
          "category_news_status":category_news_status
        },
        success:function(data)
        {
          $.niceToast.success('<strong>Thông báo</strong>: Cập nhật thành công');
          setTimeout(
          () => {
              window.location.href="/list-category-news";
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