@extends('layouts.backend_new')
@section('content')
  
<div class="row">

    <div class="col-2">
      <h2>المتاجر</h2>
    </div>
    <div class="col-2 p-0 ms-auto flex-column flex-center justify-content-between p-4">
      <a class="btn btn-primary btn-lg w-100 add" data-bs-toggle="modal" data-bs-target="#addStore">
        <img src="{{asset('new_dash/images/icons/add-vendor.png')}}" alt="" class="me-1" />
        اضافة متجر
      </a>

    </div>


  </div>
  <div class="filters mt-3">
    <form action="">
      <div class="d-flex">
       
        <div class="flex-basis-20 pe-3 d-flex flex-column">
          <label class="flex-fill" for="">المتجر</label>
          <div class="input-group input-group-lg flex-fill">
            
            <select name="store_id" id="" class="form-control" aria-label="Default select example">

              <option value="">@lang('اختر المتجر')</option>
              @foreach (App\Models\Stores::get() as $item)
                  <option value="{{ $item->id }}" @if(@$request->store_id == $item->id) selected @endif>
                      {{ $item->title }}</option>
              @endforeach
          </select>
          </div>
        </div>
        <div class="flex-basis-20 pe-3 d-flex flex-column">
          <label class="flex-fill" for="">حالة الاكواد</label>
          <div class="input-group input-group-lg flex-fill">
            <select name="status" class="form-control" id="">
              <option value="" >الكل</option>
              <option value="1" @if(@$request->status == 1) selected @endif>فعالة</option>
              <option value="0"@if(@$request->status == 0 && $request->status!= null ) selected @endif>غير فعالة</option>

          </select>
          </div>
        </div>

        <div class="flex-basis-20 align-items-end d-flex">
          <span class="p-2 border rounded-3">
            <button type="submit" class="btn"><img src="{{asset('new_dash/images/icons/filters.png')}}" alt="" /></button>
            
          </span>
        </div>
      </div>
    </form>
  </div>
  <div class="content mt-5">
    <div class="border-top border-secondary">
        <table id="example" class="display compact" style="width:100%" id="storestable">
            <thead>
                <tr>
                    <th class="text-right">#</th>
                    <th class="text-right">شعار المتجر</th>
                    <th class="text-right">أسم المتجر</th>
                    <th class="text-right" > اكواد  الفغالة</th>
                    <th class="text-right"> اكواد  المنتهية</th>
                    @if(auth()->user()->hasRole('Admin'))

                    <th class="text-right" >اضيفت بواسطة</th>
                    @endif
                    <th class="text-right">الاجراءات</th>
        
                </tr>
            </thead>
            @include('dashboard.parts._error')
            @include('dashboard.parts._success')
            <tbody id="stores" >
                @foreach ($stores as $key => $item)
                    <tr>
                         <td class="text-right">{{ $key + 1 }}</td>
                         <td class="text-right"><img src="{{ asset('uploads/'.$item->image) }}" width="50" height="30" alt=""> </td>
                         <td class="text-right">{{ $item->title }} </td>
                         <td class="text-right">{{ App\Models\Code::where('store_id',$item->id)->where('status',1)->count() }} </td>
                         <td class="text-right">{{ App\Models\Code::where('store_id',$item->id)->where('status',0)->count() }}</td>
                        @if(auth()->user()->hasRole('Admin'))

                         <td class="text-right">{{ @$item->user->hasRole('Admin') ?'الادارة' : @$item->user->name }}</td>
                        @endif
                         <td class="text-right">
                            @if(auth()->user()->hasRole('Admin'))

                            <button class="btn btn-inf" data-toggle="modal" data-target="#myModal4"
                            onclick="make('{{ $item->id }}')"><img src="{{asset('new_dash/images/icons/edit.png')}}" class="pointer"
                            alt=""></button>
                            <form style="display: inline" action="{{ route('stores.destroy',$item->id) }}" method="post">
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
        
            </tfoot>
        </table>
    </div>
    
  </div>
  <div class="modal fade" id="addStore" tabindex="-1" aria-labelledby="addStoreLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addStoreLabel">
            <img src="{{asset('new_dash/images/icons/vendors.png')}}" alt="" class="me-1"> إضافة متجر
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="form-errors" class="text-center"></div>

            <form id="sendmemessage">
                @csrf
                <div class="input-item">
                    <label for="">اسم المتجر بالعربي <span class="text-danger">*</span></label>
                    <input type="text" name="title_ar" required class="form-control"
                        value="{{ old('title_ar') }}" id="title_ar">
                </div>
            
                <div class="input-item">
                    <label for="">اسم المتجر بالانجليزي<span class="text-danger">*</span></label>
                    <input type="text" name="title_en" required class="form-control"
                        value="{{ old('title_en') }}" id="title_en">
                </div>
            
                <div class="input-item">
                    <label for="">رابط الربط للمتجر (API)<span class="text-danger">*</span> </label>
                    <input type="text" name="api_link" value="{{ old('api_link') }}" class="form-control"
                        id="api_link">
                </div>
            
            
              <div class="input-item">
                <label for="">  فائدة استخدام الكود   </label><span class="text-danger">*</span>
                <input type="number" name="benift" value="{{ old('benift') }}" class="form-control"
                id="benift"> 
                     <img src="{{ asset('new_dash/images/icons/percentage.png') }}" alt="" class="me-1  percentage-img">
  
              </div>
            
                <div class="input-item">
                    <label for="">رقم السجل التجاري</label>
                    <input type="number" name="commercial_register" value="{{ old('commercial_register') }}"
                        class="form-control" id="commercial_register">
                </div>
            
                <div class="input-item">
                    <label for="">الموقع الالكتروني</label>
                    <input type="text" name="website" value="{{ old('website') }}" class="form-control"
                        id="website">
                </div>
            
            
                <div class="input-item">
                    <label for="">رابط تطبيق الاندرويد</label>
                    <input type="text" name="android" value="{{ old('android') }}" class="form-control"
                        id="android">
                    <img src="{{ asset('new_dash/images/icons/android.png') }}" alt=""
                        class="me-1 android-img">
                </div>
            
                <div class="input-item">
                    <label for="">رابط تطبيق الآيفون</label>
                    <input type="text" name="ios" value="{{ old('ios') }}" class="form-control"
                        id="ios">
                    <img src="{{ asset('new_dash/images/icons/apple.png') }}" alt=""
                        class="me-1 apple-img">
                </div>
            
                <div class="input-item">
                    <label for="file">صورة الشعار<span class="text-danger">*</span></label>
            
                    <label class="custom-file-upload d-block form-control p-0"
                        style="height:46px; direction: ltr;">
                        <input type="file" id="imagestore" required name="image" />
                        <span class="border h-100 upload-img">رفع صورة <img
                                src="{{ asset('new_dash/images/icons/upload.png') }}" alt=""
                                class="me-1"></span> <img src="{{ asset('new_dash/images/icons/img.png') }}"
                            alt="" class="me-1 ms-2 " width="20">
                    </label>
                </div>
            
                <div class="input-item">
                    <button class="btn text-end add-store">+ اضافة متجر</button>
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
                url: "{{ route('stores.store') }}",
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
            // $("#updateStore").show();
            $('#updateStore').modal('show');
            // $('#staticBackdrop').modal();

            $.ajax({
                type: 'post',
                url: "{{ route('get_form_stores') }}",
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
