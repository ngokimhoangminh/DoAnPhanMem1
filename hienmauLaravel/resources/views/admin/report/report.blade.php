@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <button class="btn btn-danger d-flex align-items-center" id="btnPdf" onclick="ExportWord('page-content', 'Danh sách hiến máu');"><img src="{{asset('assets/admin/images/pdf.png')}}">Xuất PDF</button>
    <div class="" id="page-content">
        <div class="panel-heading" style="height: 90px;">
          <span style="color:crimson;">BÁO CÁO DANH SÁCH THAM GIA HIẾN MÁU</span>
          <div class="d-flex justify-content-between">
            <div class="blood-name col-md-6" style="text-align: left; font-size: 14px;">
                Đợt hiến máu: {{$blood_name}}
            </div>
            <div class="curren-time col-md-6" style="text-align: right;font-size: 14px;">
               <p id="hnv"></p>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-bordered b-t b-light mt-2" id="myTable">
            <thead>
              <tr>
                <th rowspan="2" style="width: 20px;">STT</th>
                <th rowspan="2">Họ Tên</th>
                <th rowspan="2">Địa Chỉ</th>
                <th rowspan="2">Số Điện Thoại</th>
                <th colspan="2">Thông Tin</th>
                <th rowspan="2">Tình Trạng</th>
              </tr>
              <tr>
                <th>Nhóm Máu</th>
                <th>Đơn Vị Máu</th>
              </tr>
                
            </thead>
            <tbody>
              @foreach($dataReport as $key => $value)
              <tr>
                <td>{{$key +1}}</td>
                <td>{{$value['users_fullname']}}</td>
                <td>{{$value['users_address']}}</td>
                <td>{{$value['users_phone']}}</td>
                <td>{{$value['blood_group']}}</td>
                <td>{{$value['blood_actual_unit']}}&nbsp;ml</td>
                <td>{{$value['blood_actual_health']}}<span class="text-ellipsis"></span></td>
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
</div>
<script>
    $('#btnPdf').click(function () {
    domtoimage.toPng(document.getElementById('page-content'))
        .then(function (blob) {
            var pdf = new jsPDF('1', 'pt', [$('#page-content').width(), $('#page-content').height()]);

            pdf.addImage(blob, 'PNG', 15, 15, $('#page-content').width(), $('#page-content').height());
            pdf.save("Danh sách hiến máu.pdf");

            that.options.api.optionsChanged();
        });
    });
    var today = new Date();
    var date ='Đà Nẵng, '+'Ngày '+today.getDate()+' Tháng '+(today.getMonth()+1)+' Năm '+today.getFullYear();
    document.getElementById("hnv").innerHTML=date;
</script>
@endsection