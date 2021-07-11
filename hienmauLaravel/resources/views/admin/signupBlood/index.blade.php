@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh Sách Đăng Ký Hiến Máu
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="myTable" class="myTables">
        <thead>
          <tr>
            <th>Ghi Chú</th>
            <th>Đợt Hiến Máu</th>
            <th>Họ Và Tên</th>
            <th>Cân Nặng</th>
            <th>Chiều Cao</th>
            <th>Trạng Thái</th>
            <th>Duyệt</th>
            <th>Thông Tin</th>
            <th class="text-center">Hành Động</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($list_signup_blood as $key => $value)
          <tr id="row_{{$value->signup_blood_id}}">
            {{csrf_field()}}
            <td>
              {{$value->signup_blood_note}}
                
                <br/><textarea class="form-control reply_comment" id="reply_comment{{$value->signup_blood_id}}" name="comment_reply" rows="5"></textarea>
                <br/><button class="btn btn-default btn-xs btn_reply_comment" onclick="Reply({{$value->signup_blood_id}})">Phản hồi</button>
            </td>
            <td>{{$value->blood_donation_name}}</td>
            <td>{{$value->users_fullname}}</td>
            <td>{{$value->signup_blood_weight}}&nbsp;kg</td>
            <td>{{$value->signup_blood_height}}&nbsp;cm</td>           
            <td>
                @if($value->signup_blood_status==0)
                 Chưa Duyệt
                @else
                  Đã Duyệt
                @endif
              </span>
            </td>
            <td>
              <span class="text-ellipsis">
                @if($value->signup_blood_status==0)
                  <button type="submit" onclick="active({{$value->signup_blood_id}})" class="btn btn-primary btn-xs" >Duyệt</button>
                @else
                  <button type="submit" disabled class="btn btn-primary btn-xs" >Duyệt</button>
                @endif
              </span>
            </td>
            <td><button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="showData({{$value->signup_blood_id}})">Xem chi tiết</button>
            </td>

            <td class="text-center">
              @if($value->signup_blood_status==0)
                <button onclick="deleteSignupBlood({{$value->signup_blood_id}})"  class="active styling-edit btn btn-danger" ui-toggle-class>
                <i class="fa fa-times text-danger text" style="color:#fff;"></i>
                </button>
              @endif
            
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" id="modal-header">
              
            </div>
            <div class="modal-body">
                <div class="modal-info d-flex justify-content-center" id="modal_content">
                    
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="panel-footer">
      <div class="row">
{{--         <span>{!! $list_signup_blood->render() !!}</span> --}}
      </div>
    </footer>
  </div>
</div>
<script type="text/javascript">
  function showData(signId)
  {
    event.preventDefault();
     $.ajax({
                url:"{{URL('/show-data')}}",
                method:"POST",
                data:{
                  "_token": "{{ csrf_token() }}",
                  "signup_blood_id":signId
                },
                success:function(response)
                {
                    html=``;
                    htmlContent=``
                     for (const [key, value] of Object.entries(response['response'])) {
                        html+=`
                        <table>
                          <tr style="background: #CBC2C2">
                            <td></td>
                            <td style="width: 650px"></td>
                            <td></td>
                            <td class="text-center pr-2"><strong>Kết Quả</strong></td>
                          </tr>
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1"><p class="blood_info--number d-flex justify-content-center align-items-center">1</p></td>
                            <td><strong>Trước đây quý vị đã từng hiến máu chưa</strong></td>
                            <td></td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                                  ${response['response'][key]['landau']}
                              </label>
                            </td>
                          </tr>
                          <!--Muc 2-->
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1"><p class="blood_info--number d-flex justify-content-center align-items-center">2</p></td>
                            <td><strong>Qúy vị từng mắc các bệnh như:</strong> Tâm thần kinh, hô hấp, vàng da/viêm gan, tim mạch, huyết áp thấp/cao, bệnh thận, ho kéo dài, bệnh máu, lao, ung thư, Helmophilia, v.v?</td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                              ${response['response'][key]['macbenh']}
                              </label>
                            </td>
                          </tr>
                          <!--Muc 3-->
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1"><p class="blood_info--number d-flex justify-content-center align-items-center">3</p></td>
                            <td><strong>Trong vòng 6 tháng gần đây, quý vị có:</strong></td>
                            <td>
                            </td>
                            <td>
                            </td>
                          </tr>
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1">
                              *
                            </td>
                            <td>Sút gân >= 4 kg không rõ nguyên nhân ?</td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                                ${response['response'][key]['sutcan']}
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1">
                              *
                            </td>
                            <td>Nổi hạch kéo dài ?</td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                              ${response['response'][key]['noihach']}
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1">
                              *
                            </td>
                            <td>Phẩu thuật ?</td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                              ${response['response'][key]['phauthuat']}
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1">
                              *
                            </td>
                            <td>Xăm mình, xỏ lỗ qua da (tai, mũi...), châm cứu ?</td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                              ${response['response'][key]['xamminh']}
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td class="d-flex justify-content-center  mt-1 mr-1">
                              *
                            </td>
                            <td>Được truyền máu, chế phẩm máu</td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                              ${response['response'][key]['duoctruyenmau']}
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1">
                              *
                            </td>
                            <td>Sử dụng ma túy, tiêm chích...?</td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                              ${response['response'][key]['matuy']}
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1">
                              *
                            </td>
                            <td>Quan hệ tình dục với người nhiễm hoặc người có nguy cơ lây nhiễm HIV, viêm gan ?</td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                              ${response['response'][key]['quanhe']}
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1">
                              *
                            </td>
                            <td>Quan hệ tình dục với người cùng giới?</td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                              ${response['response'][key]['cunggioi']}
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1">
                              *
                            </td>
                            <td>Tiêm vắc xin phòng bệnh ? Loại vắc xin.............</td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                              ${response['response'][key]['vacxin']}
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1">
                              *
                            </td>
                            <td>Sống trong vùng có dịch lưu hành (sốt xuất huyết, sốt rét, bò điên, Ebola, Zika, Covid 19)..?</td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                                ${response['response'][key]['vungdich']}
                              </label>
                            </td>
                          </tr>
                          <!--Muc 4-->
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1"><p class="blood_info--number d-flex justify-content-center align-items-center">4</p></td>
                            <td><strong>Trong vòng 1 tuần gần đây, Quý vị có:</strong></td>
                            <td>
                            </td>
                            <td>
                            </td>
                          </tr>
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-">
                              *
                            </td>
                            <td>Bị cúm, ho, nhức đầu, sốt....?</td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                              ${response['response'][key]['bicum']}
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1">
                              *
                            </td>
                            <td>Dùng thuốc kháng sinh, ASPIRIN, CORTICOID....?</td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                              ${response['response'][key]['khangsinh']}
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1">
                              *
                            </td>
                            <td>Đến khám sức khỏe làm xét ngiệm, chữa răng ?</td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                              ${response['response'][key]['chuarang']}
                              </label>
                            </td>
                          </tr>
                          <!--Muc 5-->
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1"><p class="blood_info--number d-flex justify-content-center align-items-center">5</p></td>
                            <td><strong>Quí vị hiện là đối tượng tàn tật hoặc hưởng trợ cấp tàn tật hoặc nạn nhân chất độc màu da cam không ?</strong></td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                              ${response['response'][key]['tantat']}
                              </label>
                            </td>
                          </tr>
                          <!--Muc 6-->
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1"><p class="blood_info--number d-flex justify-content-center align-items-center">6</p></td>
                            <td><strong>Câu hỏi dành cho phụ nữ:</strong></td>
                            <td>
                            </td>
                            <td>
                            </td>
                          </tr>
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1">
                              *
                            </td>
                            <td>Chị hiện đang nuôi con dưới 12 tháng tuổi/ đang trong kỳ kinh nguyệt ?</td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                              ${response['response'][key]['kinhnguyet']}
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td class="d-flex justify-content-center mt-1 mr-1">
                              *
                            </td>
                            <td>Chị đã từng có có thai hoặc sinh con chưa</td>
                            <td>
                            </td>
                            <td style="text-align: center;">
                              <label class="blood_info--result text-danger font-weight-bold">
                                ${response['response'][key]['sinhcon']}
                              </label>
                            </td>
                          </tr>
                      </table>`;
                        
                    };
                    document.getElementById('modal_content').innerHTML = html;
                    
                    for (const [keys, values] of Object.entries(response['responses'])) {
                        htmlContent+=`<h5 class="modal-title" id="exampleModalLabel">Thông Tin Đăng Ký Hiến Máu: ${response['responses'][keys]['fullname']} - Nhóm máu:${response['responses'][keys]['users_blood']}</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button> `;
                    }
                    document.getElementById('modal-header').innerHTML = htmlContent;
                    
                },
                error: function (response) {
                
                }
        });;
  }
  function deleteSignupBlood(id)
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
                url:"{{URL('/delete-signup-blood')}}",
                method:"POST",
                data:{
                  "_token": "{{ csrf_token() }}",
                  "signup_blood_id":id,
                },
                success:function(data)
            {
              $.niceToast.success('<strong>Thông báo</strong>: Xóa đăng ký hiến máu thành công');
              setTimeout(
              () => {
                  window.location.href="/list-signUpblood";
              },
              2 * 1000
              );
            },error:function(data)
            {
              $.niceToast.error('<strong>Thông báo</strong>: Thất bại');
            }

            });
            }
        })
  }
  function active(signId)
  {
      Swal.fire({
            title: 'Bạn có chắc chắn muốn duyệt không',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Hủy',
        }).then((result) => {
            if (result.value) {
              $.ajax({
              url:"{{URL('/active-signup-blood')}}",
              method:"POST",
              data:{
                "_token": "{{ csrf_token() }}",
                "signup_blood_id":signId
              },
              success:function(data)
              {
                $.niceToast.success('<strong>Thông báo</strong>: Duyệt thành công');
                setTimeout(
                () => {
                    window.location.href="/list-signUpblood";
                },
                2 * 1000
                );
              }
            });
            }
        })
      
  }
    function Reply(signId)
    {
      var sign_note=$('#reply_comment'+signId).val();
      $.ajax({
                url:"{{URL('/reply-note-signup-blood')}}",
               method:"POST",
                data:{
                  "_token": "{{ csrf_token() }}",
                  "sign_note":sign_note,
                  "signup_blood_id":signId
                },
                success:function(data)
                {
                  $.niceToast.success('<strong>Thông báo</strong>: Phản hồi thành công');
                  setTimeout(
                  () => {
                      window.location.href="/list-signUpblood";
                  },
                  2 * 1000
                  );
                },error:function(data)
                {
                  $.niceToast.error('<strong>Thông báo</strong>: Thất bại, Bạn chưa nhập phản hồi');
                }
              });
    }
    $.niceToast.setup({
      position: "top-right",
      timeout: 2000,
    });    
       
</script>
@endsection