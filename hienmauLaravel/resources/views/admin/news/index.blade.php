@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh Sách Tin Tức
    </div>
    
    <div class="table-responsive">
      
      <a href="{{URL::to('/add-news')}}" type="submit" class="btn btn-info" name="add_employee">Thêm</a>
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
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>STT</th>
            <th>Danh Mục</th>
            <th>Tin Tức</th>
            <th>Slug</th>
            <th style="width:120px;">Mô Tả</th>
            <th>KeyWords</th>
            <th>Trạng Thái</th>
            <th style="width:140px;">Hình Ảnh</th>
            <th style="width:100px;">Hành Động</th>
          </tr>
        </thead>
        <tbody>
          @foreach($list_news as $key => $value)
          <tr id="row_{{$value->news_id}}">
            <td>{{$key + 1}}</td>
            <td>{{$value->category_news->category_news_name}}</td>
            <td>{{$value->news_title}}</td>
            <td>{{$value->news_slug}}</td>
            <td>{!!$value->news_desc!!}</td>
            <td>{{$value->news_meta_keysword}}</td>
            <td><span class="text-ellipsis">
                @if($value->news_meta_status==1)
                  <a href="" style="text-decoration: none;" ><i class="fa fa-thumbs-up"></i> Hiển Thị</a>
                @else
                 <a href="" style="text-decoration: none;"><i class="fa fa-thumbs-down"></i> Ẩn</a>
                @endif
            </span></td>
            <td><img src="{{asset('assets/admin/uploads/news/'.$value->news_image)}}" class="w-50"></span></td>
            <td>
              <a href="{{URL::to('/update-news/'.$value->news_id)}}" class="active styling-edit btn btn-success" ui-toggle-class><i class="fa fa-pencil-square-o text-success text-active" style="color:#fff;" ></i></a>
              <a onclick="deleteNews({{$value->news_id}})"  class="active styling-edit btn btn-danger" ui-toggle-class>
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
  function deleteNews(id)
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
              $.ajax({
                url:"{{URL('/delete-news')}}",
                method:"POST",
                data:{
                  "_token": "{{ csrf_token() }}",
                  "news_id":id
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