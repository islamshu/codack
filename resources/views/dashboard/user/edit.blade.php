@extends('layouts.backend_new')
@section('content')
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-colored-form-control">تعديل بياناتي  </h4>
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
                                        <div class="input-item">
                                            <label for="file">صورة المشهور  <span class="text-danger">*</span></label>
                                    
                                            <label class="custom-file-upload d-block form-control p-0"
                                                style="height:46px; direction: ltr;">
                                                <input type="file" id="imageedit"  name="icon" />
                                                <span class="border h-100 upload-img">رفع صورة <img
                                                        src="{{ asset('new_dash/images/icons/upload.png') }}" alt=""
                                                        class="me-1"></span> <img src="{{ asset('uploads/'.$famous->image) }}"
                                                    alt="" class="me-1 ms-2 " width="20">
                                            </label>
                                        </div>
                                        
                                        <div class="input-item">
                                            <label for=""> اسم المشهور<span class="text-danger">*</span></label>
                                            <input type="text" name="name" required class="form-control"
                                            value="{{ $famous->name }}" id="name">   
                                              </div>
                                              <div class="input-item">
                                                <label for="">الدولة<span class="text-danger">*</span></label>
                                                <div class="inner-input">
                                                  <select name="country_id" id="country_id" class="form-control">
                                                      <option value="" selected disabled>اختر دولة</option>
                                                      @foreach ($countries as $item)
                                                          <option value="{{ $item->id }}" @if($famous->country_id == $item->id) selected @endif>{{ $item->title }}</option>
                                                      @endforeach
                                                  </select>
                                  
                                                  <button class="stop" type="button"  style="width:50%" id="addcountry" ><img
                                                      src="{{asset('new_dash/images/icons/doc.png')}}" alt="" class="me-2">اضف دولة </button>
                                  
                                  
                                                </div>
                                              </div>
                                        
                                              <div class="input-item">
                                                <label for="">رقم التواصل</label>
                                                <input type="text" value="{{ $famous->phone }}"  required class="form-control form-control-lg input-lg"
                                                id="iconLeft3"  name="phone" maxlength="10" onkeypress=" return isNumber(event)" minlength="10">
                                              </div>
                                     
                                      
                                        <div class="input-item">
                                            <label for="">البريد الالكتروني<span class="text-danger">*</span></label>
                                            <input type="email" name="email" required class="form-control"
                                            value="{{ $famous->email }}" id="email">
                                          </div>
                                          <div class="input-item">
                                            <label for="">رقم الرخصة المهنية<span class="text-danger">*</span></label>
                                            <input type="text" name="professional_license_number" required class="form-control"
                                            value="{{ $famous->professional_license_number }}" id="professional_license_number">
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
                                        
                                        <div class="input-item">
                                            <label for="email"> اسم ممثل المشهور   : <span class="required">*</span></label>
                                            <input type="text" name="name_actor"  class="form-control"
                                                value="{{$famous->name_actor }}" id="name_actor">
                                          </div>   
                                          <div class="input-item" >
                                            <label for="email"> رقم ممثل المشهور   : <span class="required">*</span></label>
                                            <input type="number" value="{{ $famous->phone_actor }}" name="phone_actor"  class="form-control">
                    
                                          </div> 
                                    </div>
                                    <div class="row">
                                        <div class="input-item">
                                            <label for="">مجال المشهور<span class="text-danger">*</span></label>
                                            <div class="inner-input">
                                              <select required class="selectpicker form-control" id="is_famousselect" name="famoustype_id[]"
                                                           multiple="multiple">
                                                          <option value="" disabled> اختر المجال</option>
                          
                                                          @foreach ($typs as $item)
                                                          <option value="{{ $item->id }}" @if(in_array( $item->id, json_decode($famous->famoustype_id)) ) selected @endif>{{ $item->title }}</option>
                                                          @endforeach
                                                      </select>
                              
                                              <button class="stop" type="button" id="addscope"  style="width:50%"><img
                                                  src="{{asset('new_dash/images/icons/doc.png')}}" class="me-2" alt="">أضف مجال</button>
                              
                              
                                            </div>
                                          </div>
                                          <div class="input-item">
                                            <label for="">عدد المتابعين<span class="text-danger">*</span></label>
                                            <input type="number" name="followers_number"  class="form-control"
                                                              value="{{ $famous->followers_number }}" id="followers_number">
                                          </div>
                                                            
                                        <div class="input-item">
                                            <label for="">عدد المشاهدات<span class="text-danger">*</span></label>
                                            <input type="number" name="views_number"  class="form-control"
                                                            value="{{ $famous->views_number }}" id="views_number">
                                        </div>
      
                                        <div class="input-item">
                                            <label for="">فئة المتابعين<span class="text-danger">*</span></label>
                                            <select name="follower_type[]"  class="selectpicker form-control text-right" required  id="follower_type"  multiple="multiple">
                                                <option value="" disabled>اختر </option>
                                                <option value="male" @if(in_array( 'male', json_decode($famous->follower_type)) ) selected @endif>رجال</option>
                                                <option value="femail" @if(in_array( 'femail', json_decode($famous->follower_type)) ) selected @endif>نساء </option>
                                                <option value="children" @if(in_array( 'children', json_decode($famous->follower_type)) ) selected @endif> أطفال</option>
                          
                                          </select>
                                          </div>
                                      
                                            <div class="input-item">
                                                <label for="">Instagram</label>
                                                <input type="text" name="instagram" value="{{$famous->instagram  }}" placeholder="www.instagram.com"
                                                class="form-control position-relative" dir="auto" id="instagram">                    <img src="{{asset('new_dash/images/icons/insta.png')}}" alt="" class="me-1 apple-img">
                                            </div>
                                
                                            <div class="input-item">
                                                <label for="">Tiktok</label>
                                                <input type="text"name="tiktok" value="{{$famous->tiktok  }}" dir="auto" placeholder="www.tiktok.com" class="form-control position-relative"
                                                id="tiktok">
                                                <img src="{{asset('new_dash/images/icons/tiktok.png')}}" alt="" class="me-1 apple-img">
                                            </div>
                                            <div class="input-item">
                                                <label for="">Snapchat</label>
                                                <input type="text" name="snapchat" value="{{$famous->snapchat  }}" dir="auto" placeholder="www.snapchat.com" class="form-control position-relative"
                                                                    id="snapchat">
                                                <img src="{{asset('new_dash/images/icons/snapchat.png')}}" alt="" class="me-1 apple-img">
                                            </div>
                                    
                                    @if($famous->soicals != null)
                                    @foreach ($famous->soicals as $key=> $item)
                                    @php
                                        $so = App\Models\SoicalType::find($item->social_title);
                                    @endphp
                                        <div class="input-item">
                                                <div class="form-group">
                                            <label for="email"> <img src="{{ asset('uploads/'.$so->icon) }}" width="50" height="50" alt=""></label>
                                            <button class="btn btn-danger  remove_buttonb" type="button" style="margin-right: 67%;
                                                margin-bottom: 17px;" >حذف</button>
                                            <input type="text" name="addmore[{{ $key }}][{{ $so->id }}]"  value="{{ $item->social_url }}"
                                                class="form-control" id="instagram">
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    </div>
            
            
                                    <div class="input-item">
                                        <label for="">أضف منصة أخرى<span class="text-danger">*</span></label>
                                        <div class="inner-input">
                                          <select id="get_soical_media" class="form-control sosialselect">
                                              <option value="">اختر المنصة</option>
                                              @foreach ($soicals as $item)
                                              <option value="{{ $item->id }}">{{ $item->title }}</option>
                                              @endforeach
                                          </select>
                          
                                          <button class="add_sss"  style="width:50%" type="button" ><img  src="{{asset('new_dash/images/icons/doc.png')}}" class="me-2" alt="">أضف منصة</button>
                          
                          
                                        </div>
                                    </div>
                                      
                                    <div id="soical_item" class="">





                                    </div>
                                        
                                             
            
            
            
                                    
            
                                    <div class="row">
                                        <div class="input-item">
                                            <button class="btn text-end add-store" style="background: black;color:white"> تعديل</button>
                                        </div>
                                    </div>
            
                                    
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
    <div class="modal fade" id="addCountry" tabindex="-1" aria-labelledby="addCountrylabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addCountrylabel">
                <img src="{{asset('new_dash/images/icons/doc.png')}}" alt="" class="me-1"> أضف دولة
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal"
                data-bs-target="#addFamous"></button></button>
            </div>
            <div class="modal-body">
                <form id="addcountryform">
                    @csrf
                <div class="input-item">
                  <label for="">اسم الدولة<span class="text-danger">*</span></label>
                  <input type="text" name="title_en" autocomplete="off" data-country-id="0" class="form-control" id="country"
                  placeholder="اضف الدولة  ">    
                  <div id="full_data"></div>
                </div>
                <div class="col-md-3" id="country_info"></div>

    
                <div class="input-item">
                  <button class="btn text-end add-store">+ إضافة دولة</button>
                </div>
    
              </form>
            </div>
    
          </div>
        </div>
      </div>
      <div class="modal fade" id="addPlatform" tabindex="-1" aria-labelledby="addPlatformLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addPlatformLabel">
                <img src="{{asset('new_dash/images/icons/famous.png')}}" alt="" class="me-1"> إضافة مجال
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal"
                data-bs-target="#addFamous"></button></button>
            </div>
            <div class="modal-body">
                <form id="addfamoustpye">
                    @csrf
                    <div class="input-item">
                        <label for="">اسم المجال بالعربي <span class="text-danger">*</span></label>
                        <input type="text" name="title_ar" required class="form-control"
                            value="{{ old('title_ar') }}" id="title_ar">
                    </div>
                
                    <div class="input-item">
                        <label for="">اسم المجال بالانجليزي<span class="text-danger">*</span></label>
                        <input type="text" name="title_en" required class="form-control"
                            value="{{ old('title_en') }}" id="title_en">
                    </div>
                
                
                    <div class="input-item">
                        <button type="submit" class="btn text-end add-store">+ اضافة مجال</button>
                    </div>
                
                </form>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                    <div id="form-errors" class="text-center"></div>
                    <div id="success" class="text-center"></div>
                    <form id="sendsocail">
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



                <!-- Modal footer -->
               

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
                let form =` <div class="input-item">
                                <label for="email"> <img src="{{ asset('uploads/') }}` + icon + `" width="50" height="50" alt=""></label>
                                <button class="btn btn-danger  remove_button" style="margin-right: 67%;
                                    margin-bottom: 17px;" >حذف</button>
                                <input type="text" name="` + nameinput + `" 
                                    class="form-control" id="instagram">
                            
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
         $('#addscope').click(function() {
            $('#addFamous').modal('hide');
            $('#addPlatform').modal('show');

        });
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
            $('#addFamous').modal('hide');
            $('#addCountry').modal('show');
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
                            <button type="button" class="remove_button btn btn-danger  " title="Remove field"><i class="fa fa-trash"></i></button>
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
            $('#addFamous').modal('hide');
            $('#myModalsocail').modal('show');
    });
    </script>
     <script>
        function autocomplete(inp, arr, fullarr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function (e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        
                        b = document.createElement("a");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' data-country-id=" + i + " value='" + arr[i] + "'>";
                        b.innerHTML += "<br>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function (e) {
                            // $('#country').data('country-id', 200);
    
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            inp.dataset.countryId = this.getElementsByTagName("input")[0].dataset
                                .countryId;
    
                            var txt = document.getElementById("full_data");
                            txt.innerHTML = '';
                            var country_info = document.getElementById("country_info");
                            country_info.innerHTML = '';
    
    
                            txt.innerHTML += "<input type='hidden' name='flag' value='" + fullarr[inp
                                .dataset.countryId].flag + "'>";
                            txt.innerHTML += "<input type='hidden' name='alpha2Code' value='" + fullarr[
                                inp.dataset.countryId].alpha2Code + "'>";
                            txt.innerHTML += "<input type='hidden' name='alpha3Code' value='" + fullarr[
                                inp.dataset.countryId].alpha3Code + "'>";
                            txt.innerHTML += "<input type='hidden' name='code' value='" +
                                fullarr[inp.dataset.countryId].callingCodes[0] + "'>";
                            txt.innerHTML += "<input type='hidden' name='title_ar' value='" + fullarr[
                                inp.dataset.countryId].nativeName + "'>";
                            txt.innerHTML += "<input type='hidden' name='lat' value='" + parseFloat(
                                fullarr[inp.dataset.countryId].latlng[0]) + "'>";
                            txt.innerHTML += "<input type='hidden' name='lng' value='" + fullarr[inp
                                .dataset.countryId].latlng[1] + "'>";
                            txt.innerHTML += "<input type='hidden' name='name' value='" + fullarr[inp
                                .dataset.countryId].name + "'>";
    
                            country_info.innerHTML += `
                    <div class="card">
                        <div class="header">
                          <h2>Country Info</h2>
                        </div>
                        <div class="body text-center">
                            <div class="circle">
                                <img style="max-width: 150px;" src="` + fullarr[inp.dataset.countryId].flag + `" alt="">
                            </div>
                            <h6 class="mt-3 mb-0">` + fullarr[inp.dataset.countryId].name + ` | ` + fullarr[inp.dataset
                                .countryId].nativeName + `</h6>
                            <div>country code ` + fullarr[inp.dataset.countryId].alpha2Code + `</div>
                            <div>phone code ` + fullarr[inp.dataset.countryId].callingCodes[0] + `</div>
                            <div>lat ` + (fullarr[inp.dataset.countryId].latlng[0]) + `</div>
                            <div>lat ` + fullarr[inp.dataset.countryId].latlng[1] + `</div>
                        </div>
                    </div>`;
    
    
                            inp.parentNode.insertBefore(txt, inp.nextSibling);
    
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function (e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });
    
            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }
    
            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }
    
            function closeeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function (e) {
                closeeAllLists(e.target);
            });
        }
    
    </script>
    
    <script type="text/javascript">
        $(document).ready(function () {
    
            var allData = null;
    
            $.ajax({
                'type': "GET",
                'dataType': 'json',
                'async': false,
                'url': "https://restcountries.com/v2/all",
                'success': function (data) {
                    allData = data;
                }
            });
            console.log(allData);
            countries = [];
            $.each(allData, function (i) {
                countries[i] = allData[i].nativeName;
            });
    
            // /*An array containing all the country names in the world:*/
            // var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
    
            // /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
            autocomplete(document.getElementById("country"), countries, allData);
    
            $('body form').on('submit', function () {
    
            });
            var msg = "{{Session::get('success_msg')}}";
            var exist = "{{Session::has('success_msg')}}";
            if (exist) {
                alertify.success(msg);
            }
        });
       
    
    </script>
@endsection

