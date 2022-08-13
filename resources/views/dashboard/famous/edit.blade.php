@extends('layouts.backend')
@section('content')
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-colored-form-control">تعديل بيانات المشهور  </h4>
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
                            <div class="card-body">
                                @include('dashboard.parts._error')
                                @include('dashboard.parts._success')
    
                                <form method="post" action="{{ route('famous.update',$famous->id) }}" enctype="multipart/form-data">
                                    @csrf @method('put')
            
            
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-6">
                                            <label for="image"> صورة المشهور : <span class="required">*</span></label>
                                            <input type="file" name="image"  class="form-control image" 
                                                value="{{ old('image') }}" id="image">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6">
                                            <img src="{{ asset('uploads/'.$famous->image) }}"
                                            style="width: 100px" class="img-thumbnail image-preview"
                                            alt="">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6">
                                            <label for="email"> اسم المشهور : <span class="required">*</span></label>
                                            <input type="text" name="name" required class="form-control"
                                                value="{{ $famous->name }}" id="name">
                                        </div>
                                        <div class=" form-group col-md-4 col-sm-4">
                                            <label for="email"> الدولة : <span class="required">*</span></label>
                                            <select name="country_id" id="country_id" class="form-control">
                                                <option value="" disabled>اختر دولة</option>
                                                @foreach ($countries as $item)
                                                    <option value="{{ $item->id }}" @if($famous->country_id == $item->id) selected @endif>{{ $item->title }}</option>
                                                @endforeach
                                            </select>
            
                                        </div>
                                        <div class="col-md-2 mt-2 col-sm-2 form-group ">
                                            <button type="button" class="btn btn-info" id="addcountry"> <i class="fa fa-plus"></i></button>
            
                                        </div>
                                        <div class="form-group  col-md-6">
                                            <label for="email"> رقم الهاتف :</label>
                                            <fieldset class="form-group position-relative">
                                                <input type="text" value="{{ $famous->phone }}"  required class="form-control form-control-lg input-lg"
                                                    id="iconLeft3"  name="phone" maxlength="10" onkeypress=" return isNumber(event)" minlength="10">
                                                <div class="form-control-position phoneicon" style="margin-top: 4px;width: 65px;display: flex">
                                                    <h5>{{ @$famous->country->code }}<img src="{{ asset('uploads/'.$famous->country->flag) }}" width="30" height="20" alt="" style="margin-top: 4px;"></h5>

            
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email"> البريد الاكتروني : <span class="required">*</span></label>
                                            <input type="email" name="email" required class="form-control"
                                                value="{{ $famous->email }}" id="email">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email"> رقم الرخصة المهنية : <span class="required">*</span></label>
                                            <input type="number" name="professional_license_number" required class="form-control"
                                                value="{{$famous->professional_license_number }}" id="professional_license_number">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email"> هل انت ممثل عن المشهور ام المشهور نفسه : <span
                                                    class="required">*</span></label>
                                            <select name="is_famous" id="select_is_famous" required class="form-control">
                                                <option value="">اختر </option>
                                                <option value="1" @if($famous->is_famous == 1 ) selected @endif>المشهور نفسه</option>
                                                <option value="2" @if($famous->is_famous == 2 ) selected @endif>ممثل عن المشهور </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row is_famous_show " @if($famous->is_famous == 1) style="display: none" @else style="display: -webkit-box" @endif >
                                        
                                        <div class="form-group col-md-6">
                                            <label for="email"> اسم ممثل المشهور   : <span class="required">*</span></label>
                                            <input type="text" name="name_actor"  @if($famous->is_famous == 2) required @endif class="form-control"
                                                value="{{ $famous->name_actor }}" id="name_actor">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email"> رقم ممثل المشهور   : <span class="required">*</span></label>
                                            <input type="number" name="phone_actor" @if($famous->is_famous == 2) required @endif  class="form-control"
                                                value="{{ $famous->phone_actor }}" id="phone_actor">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="email"> مجال المشهور : <span class="required">*</span></label>
                                            <select required class="select2-rtl form-control" id="is_famous" name="famoustype_id[]" id="select2-rtl-multi" multiple="multiple">
                                                <option value="">اختر </option>
                                                @foreach ($typs as $item)
                                                    <option value="{{ $item->id }}" @if(in_array( $item->id, json_decode($famous->famoustype_id)) ) selected @endif>{{ $item->title }}</option>
                                                @endforeach
            
                                            </select>
                                        </div>
                                    
                                        <div class="col-md-2 mt-2 col-sm-2 form-group ">
                                            <button type="button" class="btn btn-info" id="addscope"> <i class="fa fa-plus"></i></button>
            
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email"> عدد المتابعين   : <span class="required">*</span></label>
                                            <input type="number" name="followers_number"  class="form-control"
                                                value="{{ $famous->followers_number }}" id="followers_number">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email"> عدد المشاهدات   : <span class="required">*</span></label>
                                            <input type="number" name="views_number"  class="form-control"
                                                value="{{ $famous->views_number }}" id="views_number">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email"> فئة المتابعين : <span class="required">*</span></label>
                                            <select name="follower_type[]" class="select2-rtl form-control" required  id="follower_type" id="select2-rtl-multi" multiple="multiple">
                                                <option value="">اختر </option>
                                                <option value="male" @if(in_array( 'male', json_decode($famous->follower_type)) ) selected @endif>رجال</option>
                                                <option value="femail" @if(in_array( 'femail', json_decode($famous->follower_type)) ) selected @endif>نساء </option>
                                                <option value="children" @if(in_array( 'children', json_decode($famous->follower_type)) ) selected @endif> أطفال</option>
            
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email"> <img src="https://cdn.iconscout.com/icon/free/png-256/tiktok-2270636-1891163.png" width="50" height="50" alt=""></label>
                                                <input type="text"name="tiktok" value="{{$famous->tiktok  }}" placeholder="www.tiktok.com" class="form-control"
                                                    id="tiktok">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email"> <i class="fa fa-instagram fa-3x" style="color:orangered" aria-hidden="true"></i></label>
                                                <input type="text" value="{{$famous->instagram  }}" name="instagram" placeholder="www.instagram.com"
                                                    class="form-control" id="instagram">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email"> <i class="fa fa-snapchat fa-3x" style="color:yellow"></i></label>
                                                <input type="text" value="{{$famous->snapchat  }}" name="snapchat" placeholder="www.snapchat.com" class="form-control"
                                                    id="snapchat">
                                            </div>
                                        </div>
                                    
                                    @if($famous->soicals != null)
                                    @foreach ($famous->soicals as $key=> $item)
                                    @php
                                        $so = App\Models\SoicalType::find($item->social_title);
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email"> <img src="{{ asset('uploads/'.$so->icon) }}" width="50" height="50" alt=""></label>
                                            <button class="btn btn-danger remove_buttonb" type="button" style="margin-right: 67%;
                                                margin-bottom: 17px;" ><i class="fa fa-trash "></i></button>
                                            <input type="text" name="addmore[{{ $key }}][{{ $so->id }}]"  value="{{ $item->social_url }}"
                                                class="form-control" id="instagram">
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    </div>
            
            
                                    <h4 class="form-section"><i class="la la-add"></i>اضف المزيد من حسابات السوشل ميديا  </h4>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>اسم المنصة :</label>
                                                <select id="get_soical_media" class="form-control sosialselect">
                                                    <option value="">اختر المنصة</option>
                                                    @foreach ($soicals as $item)
                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                    @endforeach
                                                </select>
                
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2 col-sm-2 form-group ">
                                            <button type="button" class="btn btn-info add_sss" > <i class="fa fa-plus"></i></button>
                                    </div>
                                    </div>
                                    <div id="soical_item" class="row">





                                    </div>
                                        
                                             
            
            
            
            
            
            
            
            
                                    <button class="btn btn-info mt-5" type="submit">تعديل </i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </div>
    </section>

    </div>
    <div class="modal" id="myModalcountry">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"> اضف دولة </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                    <div id="form-errors" class="text-center"></div>
                    <div id="success" class="text-center"></div>
                    <form id="addcountryform">
                        @csrf

                        <div class="form-group">
                            <label data-error="wrong" data-success="right" for="form3">علم الدولة <span
                                    class="required">*</span></label>
                            <input type="file" id="imagestore" required name="flag" class="form-control image">
                        </div>
                        <div class="form-group">
                            <img src="{{ asset('uploads/product_images/default.png') }}" style="width: 100px"
                                class="img-thumbnail image-preview" alt="">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email"> اسم الدولة بالعربية : <span class="required">*</span></label>
                                <input type="text" name="title_ar" required class="form-control"
                                    value="{{ old('title_ar') }}" id="title_ar">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email"> اسم الدولة بالانجليزية: <span class="required">*</span></label>
                                <input type="text" name="title_en" required class="form-control"
                                    value="{{ old('title_en') }}" id="title_en">
                            </div>

                            
                            <div class="form-group col-md-6">
                                <label for="commercial_register">رمز الدولة  : <span class="required">*</span></label>
                                <input type="text" name="code" required value="{{ old('code') }}" class="form-control"
                                    id="website">
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
    <div class="modal" id="myModalsocail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"> اضف جديد </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
    
                <!-- Modal body -->
                <div class="modal-body ">
                    <div id="form-errors" class="text-center"></div>
                    <div id="success" class="text-center"></div>
                    <form id="sendsocail">
                        @csrf
    
                        <div class="form-group">
                            <label data-error="wrong" data-success="right" for="form3">ايقونة المنصة  (30*30) <span
                                    class="required">*</span></label>
                            <input type="file" id="imagestore" required name="icon" class="form-control image">
                        </div>
                        <div class="form-group">
                            <img src="{{ asset('uploads/product_images/default.png') }}" style="width: 100px"
                                class="img-thumbnail image-preview" alt="">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email"> اسم المنصة بالعربية : <span class="required">*</span></label>
                                <input type="text" name="title_ar" required class="form-control"
                                    value="{{ old('title_ar') }}" id="title_ar">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email"> اسم المنصة بالانجليزية: <span class="required">*</span></label>
                                <input type="text" name="title_en" required class="form-control"
                                    value="{{ old('title_en') }}" id="title_en">
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
    <div class="modal" id="myModalscope">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"> اضف مجال جديد </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                    <div id="form-errors" class="text-center"></div>
                    <div id="success" class="text-center"></div>
                    <form id="addfamoustpye">
                        @csrf

                        
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email"> اسم المجال بالعربية : <span class="required">*</span></label>
                                <input type="text" name="title_ar" required class="form-control"
                                    value="{{ old('title_ar') }}" id="title_ar">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email"> اسم المجال بالانجليزية: <span class="required">*</span></label>
                                <input type="text" name="title_en" required class="form-control"
                                    value="{{ old('title_en') }}" id="title_en">
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
    $('.remove_buttonb').click(function(){
        $(this).parent('div').parent('div').remove();
    });
    $( document ).ready(function() {
        var q = "{{ $famous->soicals->count() }}";
        $('#get_soical_media').change(function() {
        
        addRoaw($(this).val());
    
    
    
        function addRoaw(id) {
         
            $.ajax({
            url: "{{ route('get_soucal_info') }}",
            type: "get",
            data: {
                id: id,
            },
    
            success: function(data) {
             
                var icon =   '/'+data['icon']; 
                var title = data['id'];
                var nameinput = 'addmore['+q+']['+title+']';
                let form =` <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"> <img src="{{ asset('uploads/') }}` + icon + `" width="50" height="50" alt=""></label>
                                <button class="btn btn-danger remove_button" style="margin-right: 67%;
                                    margin-bottom: 17px;" ><i class="fa fa-trash "></i></button>
                                <input type="text" name="` + nameinput + `" 
                                    class="form-control" id="instagram">
                            </div>
                        </div>` ;
                q++;       
                $('#soical_item').append(form);
                
              
 
                console.log(form);               
    
    
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
        var wrapperd = $('#soical_item');
                $(wrapperd).on('click', '.remove_button', function(e) {
                    e.preventDefault();
                    $(this).parent('div').parent('div').remove();

                });
               
                
            
    
    
    
          
         
    
            // $(wrapper1).on('click', '.remove_button_old', function (e) {
            //     alert('d');
            //         e.preventDefault();
            // $(this).parent('span').remove();
    
            // });
        }
        var wrapper1 = $('#partent');
        $(wrapper1).on('click', '.remove_button_old', function(e) {
            e.preventDefault();
            $(this).parent('span').remove();
        });
    
    });
});
</script>
    <script>
          $('#addfamoustpye').on('submit', function(e) {
            e.preventDefault();
            var frm = $('#addfamoustpye');
            var formData = new FormData(frm[0]);

            var data = $(this).serialize();

            $.ajax({
                url: "{{ route('store_scope_for_famous') }}",
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    // var table = $('#stores').DataTable();

                    $('#is_famous').append('<option value="' + data.id +
                        '">' + data.title + '</option>');
                        $('#myModalscope').modal('hide');
                     
                    swal(
                        '',
                        ' تم الاضافة بنجاح ',
                        'success'
                    );
                    $('#myModal').modal('show');



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
         $('#addcountryform').on('submit', function(e) {
            e.preventDefault();
            var frm = $('#addcountryform');
            var formData = new FormData(frm[0]);
            formData.append('file', $('#imagestore')[0].files[0]);

            var data = $(this).serialize();

            $.ajax({
                url: "{{ route('store_country_for_famous') }}",
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    // var table = $('#stores').DataTable();

                    $('#country_id').append('<option value="' + data.id +
                        '">' + data.title + '</option>');
                        $('#myModalcountry').modal('hide');
                     
                    swal(
                        '',
                        ' تم الاضافة بنجاح ',
                        'success'
                    );
                    $('#myModal').modal('show');



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
        $('#sendmemessage').on('submit', function(e) {
            e.preventDefault();
            var frm = $('#sendmemessage');
            var formData = new FormData(frm[0]);

            var data = $(this).serialize();

            $.ajax({
                url: "{{ route('famous.store') }}",
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

        $('#addcountry').click(function() {
            $('#myModal').modal('hide');
            $('#myModalcountry').modal('show');

        });
        $('#addscope').click(function() {
            $('#myModal').modal('hide');
            $('#myModalscope').modal('show');

        });


        
         $('#country_id').change(function() {
            $.ajax({
                url: "{{ route('get_country_code') }}",
                type: "get",
                data: {
                    id: $(this).val(),
                },

                success: function(data) {
                    // var table = $('#stores').DataTable();
                    let img ="{{ asset('uploads/') }}" + '/'+ data.flag;
                    let image = '  <img src="'+img+'" width="30" height="20" alt="" style="margin-top: 4px;">';
                  

                    let code = '<h5>' + data.code + image + '</h5>';
                    // $("#phone").val(code);
                    $(".phoneicon").empty();
                    $(".phoneicon").append(code);


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
                url: "{{ route('get_form_famoustype') }}",
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
      <script type="text/javascript">
        $(document).ready(function() {
            var i = {{ $famous->soicals->count() }} -1;
            $('.add_row').on('click', function() {
                addRow();
            });

            function addRow() {
                ++i;
                const sum = i + 1;



                let form = `
                    <span class="test">
                    <div class="card-body" >
                        <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>اسم المنصة :</label>
                                <select name="addmore[` + i + `][name_socal]" class="form-control sosialselect">
                                    <option value="">اختر المنصة</option>
                                    @foreach (App\Models\SoicalType::get() as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-2 mt-2 col-sm-2 form-group ">
                                <button type="button" class="btn btn-info add_sss" > <i class="fa fa-plus"></i></button>
                        </div>
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>الرابط :</label>
                                <input type="text"
                                    class="form-control "
                                    id="url" name="addmore[` + i + `][url]" required />

                            </div>
                        </div>
                      
                        
                    </div>



                    </div>
                    <div class="col-md-2">
                            <button type="button" class="remove_button btn btn-danger " title="Remove field"><i class="fa fa-trash"></i></button>
                    </div>
                    </span>
                    `;
                $('#extra').append(form);
                var wrapper = $('#extra');
                $(wrapper).on('click', '.remove_button', function(e) {
                    e.preventDefault();
                    $(this).parent('div').parent('span').remove();

                });

                // $(wrapper1).on('click', '.remove_button_old', function (e) {
                //     alert('d');
                //         e.preventDefault();
                // $(this).parent('span').remove();

                // });
            }
            var wrapper1 = $('#partent');

        $(wrapper1).on('click', '.remove_button', function (e) {
                e.preventDefault();
                $(this).parent('div').parent('span').remove();

        });
           
        });
        $('#select_is_famous').change(function() {
            let selval = $('#select_is_famous').val();
           if(selval== 2){
            $('.is_famous_show').css({display: '-webkit-box'});
            $('#name_actor').prop('required', true);   
            $('#phone_actor').prop('required', true);   

           }else{
            $('.is_famous_show').css({display: 'none'});
            $('#name_actor').prop('required', false);   
            $('#phone_actor').prop('required', false);   
           }
        });
        $('#sendsocail').on('submit', function(e) {
            e.preventDefault();
            var frm = $('#sendsocail');
            var formData = new FormData(frm[0]);
            formData.append('file', $('#imagestore')[0].files[0]);

            var data = $(this).serialize();

            $.ajax({
                url: "{{ route('store_socail_for_famous') }}",
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    // var table = $('#stores').DataTable();

                    


                    document.getElementById("sendsocail").reset();
                    $('.sosialselect').append('<option value="' + data.id +
                        '">' + data.title + '</option>');
                        $('#myModalsocail').modal('hide');
                     
                    swal(
                        '',
                        ' تم الاضافة بنجاح ',
                        'success'
                    );
                    $('#myModal').modal('show');


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
        $(document).on("click",".add_sss",function(){
            $('#myModal').modal('hide')

            $('#myModalsocail').modal('show')
    });
    </script>
@endsection

