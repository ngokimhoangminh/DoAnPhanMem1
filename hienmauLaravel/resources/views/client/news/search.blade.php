@extends('welcome')
@section('content')
<div class="content">
    <div class="container-fluid" style="background: #F5F6F7;">
      <div class="row content-main" style="padding: 0 28px 28px 28px;">
        <div class="col-md-9 pl-0" >
        
	      <div class="news-content">
	      	@foreach($news as $key => $value)
	    	<div class="news-role-item mt-2 pr-1 d-flex" style="background: #fff;">
	            <img src="{{asset('assets/admin/uploads/news/'.$value->news_image)}}" width= "266px" height=" 128px" alt="" class="content-review__item-img" style="height: 100%;" />
	            <div class="content-review__item-introduce pt-3">
	              <h2 class="content-review__item-title" style="font-size: 21px;">
	              	<a href="{{URL::to('/bai-viet/'.$value->news_slug)}}" class="content-review__link">
	                	{{$value->news_title}}
	            	</a>
	              </h2>
	              <div class="content__date mt-1">
	                <img src="{{asset('assets/client/image/icon_calendar.png')}}" alt="" style="margin-bottom: -4px;">
	                <span>{{date('d-m-Y', strtotime($value->news_date))}}</span>
	              </div>
	              <div class="news-des mt-2">
	              	<span style="color: #8e8c8c;">{!!$value->news_desc!!}</span>
	              </div>
	            </div>
	      	</div>
	      	@endforeach
	      </div>
	      
        </div>
        <div class="col-md-3">
          <div class="content-review" style="padding-left: 0px;">
            <b style="font-size: 24px;">ĐỌC NHIỀU NHẤT</b>
            <div class="content-review-content mt-2" style="background: #fff; padding: 15px;">
            	<div class="content-review-item" style="
            				border-bottom: 1px solid #c5bebe;
            				padding-bottom: 10px;"	>
    				<a href="" style="color: #000;">
    					<b>Người bệnh từ vùng dịch muốn vào Hà Nội khám, chữa bệnh phải có giấy xét nghiệm Sars-CoV-2 âm tính trong vòng 72 giờ</b>
    				</a>
            	</div>
            </div>
            <div class="content-review-content mt-2" style="background: #fff; padding: 15px;">
            	<div class="content-review-item" style="
            				border-bottom: 1px solid #c5bebe;
            				padding-bottom: 10px;"	>
            		<a href="" style="color: #000;">
            			<b>Những điều cần biết về vi rút viêm gan B</b>
            		</a>
            	</div>
            </div>
            <div class="content-review-content mt-2" style="background: #fff; padding: 15px;">
            	<div class="content-review-item" style="
            				border-bottom: 1px solid #c5bebe;
            				padding-bottom: 10px;"	>
            		<a href="" style="color: #000;">
            			<b>6 chính sách mới về BHYT tạo điều kiện thuận lợi cho người dân</b>
            		</a>
            	</div>
            </div>
            <div class="content-review-content mt-2" style="background: #fff; padding: 15px;">
            	<div class="content-review-item" style="
            				border-bottom: 1px solid #c5bebe;
            				padding-bottom: 10px;"	>
            		<a href="" style="color: #000;">
            			<b>U lympho không Hodgkin (ung thư hạch): Nguyên nhân, triệu chứng và điều trị</b>
            		</a>
            	</div>
            </div>
            <div class="content-review-content mt-2" style="background: #fff; padding: 15px;">
            	<div class="content-review-item" style="
            				border-bottom: 1px solid #c5bebe;
            				padding-bottom: 10px;"	>
            		<a href="" style="color: #000;">
            			<b>Giấc mơ có thật về ngôi nhà và những đứa trẻ của cô gái vượt ung thư</b>
            		</a>
            	</div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection