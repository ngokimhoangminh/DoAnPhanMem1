@extends('welcome')
@section('content')
<div class="container-fluid">
              <div class="row">
                <div class="col">
                  <h2 class="content-title">SỰ KIỆN HIẾN MÁU</h2>
                </div>
              </div>
              <div class="row content-main">
                <div class="col-md-12 p-0">
                  <div class="content-review">
                    @foreach($news as $key => $value)
                    <div class="content-review__item col-md-6">
                      <a href="{{URL::to('/bai-viet/'.$value->news_slug)}}" class="content-review__link">
                        <div class="col-md-5">
                          <img src="{{asset('assets/admin/uploads/news/'.$value->news_image)}}" style="width: 250px;height: 148px;"  alt="" class="content-review__item-img">
                        </div>
                        
                        <div class="content-review__item-introduce col-md-7" style="margin-left:0px;">
                          <h2 class="content-review__item-title">
                            {{$value->news_title}}
                          </h2>
                          <div class="content__date">
                            <img src="{{asset('assets/client/image/icon_calendar.png')}}" alt="" style="margin-bottom: -4px;">
                            <span>{{$value->news_date}}</span>
                          </div>
                        </div>
                      </a>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <span>{!! $news->render() !!}</span>
</div>
@endsection