@extends('layouts.backend_new')
@section('content')
  
<div class="row">

    <div class="col-2">
      <h2>منصات السوشل ميديا</h2>
    </div>
    <div class="col-2 p-0 ms-auto flex-column flex-center justify-content-between p-4">
      <a class="btn btn-primary btn-lg w-100 add" data-bs-toggle="modal" data-bs-target="#addStore">
        <img src="{{asset('new_dash/images/icons/add-vendor.png')}}" alt="" class="me-1" />
        اضافة منصة
      </a>

    </div>


  </div>
  
  <div class="content mt-5">
    <div class="border-top border-secondary">
        @include('dashboard.parts._error')
        @include('dashboard.parts._success')
        <table id="example" class="display compact" style="width:100%" id="storestable">


            <br>
            <thead>
                <tr>
                    <th class="text-right">#</th>
                    <th class="text-right">ايقونة التطبيق  </th>
                    <th class="text-right">الاسم  </th>
                    <th class="text-right">الاجراءات</th>

                </tr>
            </thead>
            <tbody id="stores">
                @foreach ($soicals as $key => $item)
                    <tr>
                        <td class="text-right">{{ $key + 1 }}</td>
                        <td class="text-right"><img src="{{ asset('uploads/' . $item->icon) }}" width="30"
                                height="30" alt=""> </td>
                        <td class="text-right">{{ $item->title }} </td>

                        <td class="text-right">
                            @if(auth()->user()->hasRole('Admin'))
                            <button class="btn btn-inf" data-toggle="modal" data-target="#myModal4"
                            onclick="make('{{ $item->id }}')"><img src="{{asset('new_dash/images/icons/edit.png')}}" class="pointer"
                            alt=""></button>
                            <form style="display: inline" action="{{ route('soical.destroy',$item->id) }}" method="post">
                                @method('delete') @csrf
                                <button type="submit"  class="btn  delete-confirm"><img src="{{asset('new_dash/images/icons/delete.png')}}" class="pointer"
                                    alt=""></button>
                            </form>
                            @else 
                            _
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>
    
  </div>
  <div class="modal fade" id="addStore" tabindex="-1" aria-labelledby="addStoreLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addStoreLabel">
            <img src="{{asset('new_dash/images/icons/vendors.png')}}" alt="" class="me-1"> إضافة منصة
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="form-errors" class="text-center"></div>
            <div id="form-errors" class="text-center"></div>
            <div id="success" class="text-center"></div>
            <form id="sendmemessage">
                @csrf
                <div class="input-item">
                    <label for="">اسم المنصة بالعربي <span class="text-danger">*</span></label>
                    <input type="text" name="title_ar" required class="form-control"
                        value="{{ old('title_ar') }}" id="title_ar">
                </div>
            
                <div class="input-item">
                    <label for="">اسم المنصة بالانجليزي<span class="text-danger">*</span></label>
                    <input type="text" name="title_en" required class="form-control"
                        value="{{ old('title_en') }}" id="title_en">
                </div>
            
                
                <div class="input-item">
                    <label for="file">أيفونة المنصة <span class="text-danger">*</span></label>
            
                    <label class="custom-file-upload d-block form-control p-0"
                        style="height:46px; direction: ltr;">
                        <input type="file" id="imagestore" required name="icon" />
                        <span class="border h-100 upload-img">رفع صورة <img
                                src="{{ asset('new_dash/images/icons/upload.png') }}" alt=""
                                class="me-1"></span> <img src="{{ asset('new_dash/images/icons/img.png') }}"
                            alt="" class="me-1 ms-2 " width="20">
                    </label>
                </div>
            
                <div class="input-item">
                    <button class="btn text-end add-store">+ اضافة منصة</button>
                </div>
            
            </form>
        </div>

      </div>
    </div>
  </div>



  <div class="modal fade" id="updateStore" class="modal-open" tabindex="-1" aria-labelledby="updateStoreLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateStoreLabel">
            <img src="{{asset('new_dash/images/icons/vendors.png')}}" alt="" class="me-1"> تعديل متجر
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="company_edit">
          
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
                        setTimeout(function() {
                    window.location.reload();
                }, 1000);


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
            // $("#updateStore").show();
            $('#updateStore').modal('show');
            // $('#staticBackdrop').modal();

            $.ajax({
                type: 'post',
                url: "{{ route('get_form_soical') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                beforeSend: function() {},
                success: function(data) {
                    $('#company_edit').html(data);


                }
            });

        }
      
    </script>
@endsection
