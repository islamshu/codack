@extends('layouts.backend_new')
@section('content')
    <div class="row">

        <div class="col-2 p-0 me-auto flex-column flex-center justify-content-start p-4">
            <h2 class="">طلبات التحويل</h2>

        </div>


    </div>
    <div class="filters mt-3">
        <form action="">
            <div class="d-flex">

                <div class="flex-basis-20 pe-3 d-flex flex-column">
                    <label class="flex-fill" for="">المشاهير</label>
                    <div class="input-group input-group-lg flex-fill">
                        <select class="form-select" name="famous_id" aria-label="Default select example">
                            <option selected value="">اختر المشهور</option>
                           @foreach (App\Models\Famous::get() as $item)
                               <option value="{{ $item->id }}" @if($request->famous_id == $item->id ) selected @endif>{{ $item->name }}</option>
                           @endforeach
                        </select>
                    </div>
                </div>


                <div class="flex-basis-20 align-items-end d-flex">
                    <span class="p-2 border rounded-3">
                        <button type="submit"><img src="{{ asset('new_dash/images/icons/filters.png') }}" alt="" /></button>
                        
                    </span>
                </div>
            </div>
        </form>
    </div>
    <div class="content mt-5">
        <div class="border-top border-secondary">
            <table id="example" class="display compact" style="width:100%" id="storestable">


                <br>
                <thead>
                    <tr>
                        <th class="text-right">#</th>
                        <th class="text-right">صورة المشهور   </th>

                        <th class="text-right">اسم المشهور   </th>
                        <th class="text-right">قيمة التحويل  </th>
                        <th class="text-right">الحالة</th>
                        <th class="text-right">التاريخ</th>
                        <th class="text-right">معاينة</th>

                        <th class="text-right">الاجراءات</th>

                    </tr>
                </thead>
                <tbody id="stores">
                    @foreach ($changes as $key => $item)
                        <tr>
                            <td class="text-right">{{ $key + 1 }}</td>
                            <td><img src="{{ asset('uploads/'.@$item->famous->image) }}" width="80" height="50" alt=""> </td>

                            <td class="text-right">{{ @$item->famous->name }} </td>
                            <td class="text-right">{{ $item->amount }} </td>
                            <td class="text-right"> 
                                   <button type="button" class="btn btn-sm btn-outline-{{ get_account_status_color($item->status) }} round">{{  get_account_status($item->status) }} </button>
                            </td>
                            <td class="text-right">{{ $item->created_at->format('Y-m-d') }}</td>
                            <td  class="text-right">
                                @if($item->status ==1)
                            
                                <a href="{{ asset('uploads/'.$item->image) }}" target="_blank">
                                   معاينة الحوالة
                                  </a>
                                  @else
                                  _ 

                            @endif
                            </td>

                            <td ><button class="btn btn-inf" data-toggle="modal" data-target="#myModal4"
                            onclick="make('{{ $item->id }}')"><img src="{{asset('new_dash/images/icons/view.png')}}" class="pointer"
                            alt=""></button>
                            </td>

                           
                        </tr>
                    @endforeach
    
                </tbody>
    
            </table>
        </div>

    </div>
    <div class="modal fade" id="transRequst" tabindex="-1" aria-labelledby="transRequstLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="transRequstLabel">
                <img src="./assets/images/icons/doc.png" alt="" class="me-1"> طلب تحويل
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></button>
            </div>
            <div class="modal-body" id="edit_order">
            
            </div>
    
          </div>
        </div>
      </div>
@endsection
@section('script')
    <script>
        $('#sendmemessage').on('submit', function(e) {
            e.preventDefault();
            var frm = $('#sendmemessage');
            var formData = new FormData(frm[0]);
            formData.append('file', $('#imagestore')[0].files[0]);

            var data = $(this).serialize();

            $.ajax({
                url: "{{ route('soical.store') }}",
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    // var table = $('#stores').DataTable();

                    var t = $('#storestable').DataTable();
                    const tr = $(data);
                    t.row.add(tr).draw(false);


                    document.getElementById("sendmemessage").reset();
                    $('#myModal').modal('hide')
                    swal(
                        '',
                        ' تم الاضافة بنجاح ',
                        'success'
                    )


                },
                error: function(data) {
                    var errors = data.responseJSON;
                    var errors = data.responseJSON;
                    errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors.errors, function(k, v) {
                        errorsHtml += '<li>' + v + '</li>';
                    });
                    errorsHtml += '</ul></di>';
                    $('#form-errors').html(errorsHtml);
                },
            });
        });


        function make(id) {
            $("#transRequst").modal('show');

            // $('#staticBackdrop').modal();
            $('.c-preloader').show();

            $.ajax({
                type: 'post',
                url: "{{ route('get_form_order') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                beforeSend: function() {},
                success: function(data) {
                    $('#edit_order').html(data);


                }
            });

        }
    </script>
@endsection
