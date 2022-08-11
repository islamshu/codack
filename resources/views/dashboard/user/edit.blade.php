@extends('layouts.backend')
@section('content')
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-colored-form-control">تعديل بياناتي   </h4>
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
    
                             
                                <form method="post" action="{{ route('update_my_profile') }}" enctype="multipart/form-data">
                                    @csrf 
            
            
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
                                                <input type="text" value="{{ $famous->phone }}"  name="phone" maxlength="10" onkeypress=" return isNumber(event)" minlength="10" required class="form-control form-control-lg input-lg"
                                                    id="iconLeft3">
                                                <div class="form-control-position phoneicon" style="margin-top: 7px;">
                                                    <h5>{{ @$famous->country->code }}</h5>
            
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
                                    </div>
            
            
                                    @if ($famous->soicals != null)
                                        <div id="partent">
                                            @foreach ($famous->soicals as $key => $item)
                                            <span class="test">
                                                <div class="card-body" >
                                                    <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>اسم المنصة :</label>
                                                            <select name="addmore[{{ $key }}][name_socal]" class="form-control">
                                                                <option value="">اختر المنصة</option>
                                                                @foreach ($soicals as $itemm)
                                                                <option value="{{ $itemm->id }}" @if($item->social_title == $itemm->id ) selected @endif>{{ $itemm->title }}</option>
                                                                @endforeach
                                                            </select>
                            
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>الرابط :</label>
                                                            <input type="text"
                                                                class="form-control "
                                                                id="url" name="addmore[{{ $key }}][url]" value="{{ $item->social_url }}" required />
                            
                                                        </div>
                                                    </div>
                                                  
                                                    
                                                </div>
                            
                            
                            
                                                </div>
                                                <div class="col-md-2">
                                                        <button type="button" class="remove_button btn btn-danger " title="Remove field"><i class="fa fa-trash"></i></button>
                                                </div>
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                            <div id="extra">
            
            
            
            
            
                                            </div>
                                        
                                                <div>
                                                <button type="button" name="add"
                                                class="btn btn-success add_row for-more mt-2">اضف المزيد من حسابات السوشل ميديا</button>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>اسم المنصة :</label>
                                <select name="addmore[` + i + `][name_socal]" class="form-control">
                                    <option value="">اختر المنصة</option>
                                    @foreach ($soicals as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>

                            </div>
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
    </script>
@endsection

