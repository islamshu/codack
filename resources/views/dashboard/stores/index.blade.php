@extends('layouts.backend')
@section('content')
    <div class="content-wrapper">
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">المتاجر</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-content collapse show">
                                <form style="margin-right:4%" >

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="userinput2">@lang('المتجر')</label>
                                                <select name="store_id" id="" class="form-control">

                                                    <option value="">@lang('اختر المتجر')</option>
                                                    @foreach (App\Models\Stores::get() as $item)
                                                        <option value="{{ $item->id }}" @if(@$request->store_id == $item->id) selected @endif>
                                                            {{ $item->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                        
                                            <label for="userinput2">حالة الاكواد  </label>

                                            <select name="status" class="form-control" id="">
                                                <option value="" >الكل</option>
                                                <option value="1" @if(@$request->status == 1) selected @endif>فعالة</option>
                                                <option value="0"@if(@$request->status == 0) selected @endif>غير فعالة</option>

                                            </select>
                                    </div>
                                        <div class="col-md-3 mt-1 pt-1">
                                            <button type="submit" class="btn btn-info"><i class="fa fa-filter"
                                                    aria-hidden="true"></i></button>
                                        </div>

                                    </div>
                                </form>
                                <div class="card-body card-dashboard">
                                    @include('dashboard.parts._error')
                                    @include('dashboard.parts._success')

                                    <br>
                                    <a data-toggle="modal" data-target="#myModal" class="btn btn-info mb-2 ">
                                        انشاء متجر جديد
                                    </a>

                                    <table class="table table-striped table-bordered zero-configuration" id="storestable" >
                                    

                                        <br>
                                        <thead >
                                            <tr>
                                                <th>#</th>
                                                <th>شعار المتجر</th>
                                                <th>أسم المتجر</th>
                                                <th > اكواد  الفغالة</th>
                                                <th> اكواد  المنتهية</th>
                                                <th >اضيفت بواسطة</th>
                                                <th>الاجراءات</th>
                                    
                                            </tr>
                                        </thead>
                                        <tbody id="stores" >
                                            @foreach ($stores as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td><img src="{{ asset('uploads/'.$item->image) }}" width="50" height="30" alt=""> </td>
                                                    <td>{{ $item->title }} </td>
                                                    <td>{{ App\Models\Code::where('store_id',$item->id)->where('status',1)->count() }} </td>
                                                    <td>{{ App\Models\Code::where('store_id',$item->id)->where('status',0)->count() }}</td>
                                                    <td>{{ @$item->user->hasRole('Admin') ?'الادارة' : @$item->user->name }}</td>
                                                    <td>
                                                        @if(auth()->user()->hasRole('Admin'))

                                                        <button class="btn btn-info" data-toggle="modal" data-target="#myModal4"
                                                        onclick="make('{{ $item->id }}')"><i class="fa fa-edit"></i></button>
                                                        <form style="display: inline" action="{{ route('stores.destroy',$item->id) }}" method="post">
                                                            @method('delete') @csrf
                                                            <button type="submit"  class="btn btn-danger"><i
                                                                    class="fa fa-trash"></i></button>
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
                        </div>
                    </div>
                </div>
            </section>

        </div>

    </div>
    <div class="modal fase " id="myModal4" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="staticBackdropLabel">
                    تعديل بيانات المتجر</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="company_edit">
                <div class="c-preloader text-center p-3">
                    <i class="las la-spinner la-spin la-3x"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"> اضف متجر </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                    <div id="form-errors" class="text-center"></div>
                    <div id="success" class="text-center"></div>
                    <form id="sendmemessage">
                        @csrf
                        
                        <div class="form-group">
                            <label data-error="wrong" data-success="right"
                                for="form3">شعار المتجر <span class="required">*</span></label>
                            <input type="file" id="imagestore" required name="image"
                                class="form-control image">
                        </div>
                        <div class="form-group">
                            <img src="{{ asset('uploads/product_images/default.png') }}"
                                style="width: 100px" class="img-thumbnail image-preview"
                                alt="">
                        </div>
                       <div class="row">
                        <div class="form-group col-md-6">
                            <label for="email">  اسم المتجر بالعربية: <span class="required">*</span></label>
                            <input type="text" name="title_ar" required class="form-control" value="{{ old('title_ar') }}"
                                id="title_ar">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">  اسم المتجر بالانجليزية: <span class="required">*</span></label>
                            <input type="text" name="title_en" required class="form-control" value="{{ old('title_en') }}"
                                id="title_en">
                        </div>
                   
                        <div class="form-group col-md-6">
                            <label for="commercial_register">رقم السجل التجاري:</label>
                            <input type="number"  name="commercial_register"
                                value="{{ old('commercial_register') }}" class="form-control" id="commercial_register">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="commercial_register">الموقع الاكتروني  :</label>
                            <input type="text"  name="website"
                                value="{{ old('website') }}" class="form-control" id="website">
                        </div>
                        

                        <div class="form-group col-md-6">
                            <label for="commercial_register">رابط تطبيق الاندرويد   :</label>
                            <input type="text"  name="android"
                                value="{{ old('android') }}" class="form-control" id="android">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="commercial_register">رابط تطبيق الايفون   :</label>
                            <input type="text"  name="ios"
                                value="{{ old('ios') }}" class="form-control" id="ios">
                        </div>
                        </div>


                        <button class="btn btn-info" type="submit">اضافة </i></button>
                    </form>

                </div>



                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
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
            $("#myModal4").show();

            // $('#staticBackdrop').modal();
            $('.c-preloader').show();

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
