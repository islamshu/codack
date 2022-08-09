@extends('layouts.backend')

@section('content')
    <div class="content-wrapper">
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">المشاهير </h4>
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
                                <form >

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="userinput2">@lang('المتجر')</label>
                                                <select name="nationality_id" id="" class="form-control">

                                                    <option value="">@lang('اختر المتجر')</option>
                                                    @foreach ($stores as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="userinput2">نسبة خصم التاجر (من)</label>
                                                <fieldset class="form-group position-relative">
                                                    <input type="number" max="100" min="5" name="phone"  class="form-control form-control-lg input-lg"
                                                        id="iconLeft3">
                                                    <div class="form-control-position phoneicon" style="margin-top: 7px;">
                                                        <h5>%</h5>
                
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="userinput2">نسبة خصم التاجر (الى)</label>
                                                <fieldset class="form-group position-relative">
                                                    <input type="number" max="100" min="5" name="phone"  class="form-control form-control-lg input-lg"
                                                        id="iconLeft3">
                                                    <div class="form-control-position phoneicon" style="margin-top: 7px;">
                                                        <h5>%</h5>
                
                                                    </div>
                                                </fieldset>
                                            </div>
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
                                        اضافة مشهور
                                    </a>

                                    <table class="table table-striped table-bordered zero-configuration" id="storestable">


                                        <br>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>صورة المشهور </th>
                                                <th>اسم المشهور </th>                                           
                                                <th>الدولة</th>
                                                <th>رقم الهاتف</th>
                                                <th>الاجراءات</th>

                                            </tr>
                                        </thead>
                                        <tbody id="stores">
                                            @foreach ($famous as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td><img src="{{ asset('uploads/'.$item->image) }}" width="80" height="80" alt=""> </td>

                                                    <td>{{ $item->name }} </td>
                                                    <td>{{ $item->country->title }} </td>
                                                    <td>{{ $item->phone }} </td>

                                                    <td>
                                                        <a href="{{ route('famous.edit', $item->id) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                        <form style="display: inline"
                                                            action="{{ route('famous.destroy', $item->id) }}"
                                                            method="post">
                                                            @method('delete') @csrf
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
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
                        تعديل بيانات المجال</h5>

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
                    <button type="button" class="btn btn-light closee" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"> اضف مشهور </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                    <div id="form-errors" class="text-center"></div>
                    <div id="success" class="text-center"></div>
                    <form id="sendmemessage">
                        @csrf


                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="image"> صورة المشهور : <span class="required">*</span></label>
                                <input type="file" name="image" required class="form-control"
                                    value="{{ old('image') }}" id="image">
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="email"> اسم المشهور : <span class="required">*</span></label>
                                <input type="text" name="name" required class="form-control"
                                    value="{{ old('name') }}" id="name">
                            </div>
                            <div class=" form-group col-md-4 col-sm-4">
                                <label for="email"> الدولة : <span class="required">*</span></label>
                                <select name="country_id" id="country_id" class="form-control">
                                    <option value="">اختر دولة</option>
                                    @foreach ($countries as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-2 mt-2 col-sm-2 form-group ">
                                <button type="button" class="btn btn-info" id="addcountry"> <i class="fa fa-plus"></i></button>

                            </div>
                            <div class="form-group  col-md-6">
                                <label for="email"> رقم الهاتف :</label>
                                <fieldset class="form-group position-relative">
                                    <input type="number" name="phone" required class="form-control form-control-lg input-lg"
                                        id="iconLeft3">
                                    <div class="form-control-position phoneicon" style="margin-top: 7px;">
                                        <h5>+</h5>

                                    </div>
                                </fieldset>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email"> البريد الاكتروني : <span class="required">*</span></label>
                                <input type="text" name="email" required class="form-control"
                                    value="{{ old('email') }}" id="email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email"> رقم الرخصة المهنية : <span class="required">*</span></label>
                                <input type="text" name="professional_license_number" required class="form-control"
                                    value="{{ old('professional_license_number') }}" id="professional_license_number">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email"> هل انت ممثل عن المشهور ام المشهور نفسه : <span
                                        class="required">*</span></label>
                                <select name="is_famous" required class="form-control">
                                    <option value="">اختر </option>
                                    <option value="1">المشهور نفسه</option>
                                    <option value="2">ممثل عن المشهور </option>
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="email"> مجال المشهور : <span class="required">*</span></label>
                                <br>
                                <select required class="select2-rtl form-control" id="is_famous" name="famoustype_id[]"
                                id="select2-rtl-multi" multiple="multiple">
                                <option value="" disabled> اختر المجال</option>

                                @foreach ($typs as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                             
                            </div>
                            <div class="col-md-1 mt-2 col-sm-1 form-group ">
                                <button type="button" class="btn btn-info" id="addscope"> <i class="fa fa-plus"></i></button>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="email"> فئة المتابعين : <span class="required">*</span></label>
                                <select name="follower_type[]" class="select2-rtl form-control" required  id="follower_type" id="select2-rtl-multi" multiple="multiple">
                                    <option value="">اختر </option>
                                    <option value="male">رجال</option>
                                    <option value="femail">نساء </option>
                                    <option value="children"> أطفال</option>

                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> <img src="https://cdn.iconscout.com/icon/free/png-256/tiktok-2270636-1891163.png" width="50" height="50" alt=""></label>
                                    <input type="text"name="tiktok" placeholder="www.tiktok.com" class="form-control"
                                        id="tiktok">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> <i class="fa fa-instagram fa-3x" style="color:orangered" aria-hidden="true"></i></label>
                                    <input type="text" name="instagram" placeholder="www.instagram.com"
                                        class="form-control" id="instagram">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> <i class="fa fa-snapchat fa-3x" style="color:yellow"></i></label>
                                    <input type="text" name="snapchat" placeholder="www.snapchat.com" class="form-control"
                                        id="snapchat">
                                </div>
                            </div>
                        </div>


                                    

                                <div id="extra">





                                </div>
                                    <div>
                                    <button type="button" name="add"
                                    class="btn btn-success add_row for-more mt-2">اضف المزيد من حسابات السوشل ميديا</button>
                                </div>








                        <button class="btn btn-info mt-5" type="submit">اضافة </i></button>
                    </form>

                </div>



                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                </div>

            </div>
        </div>
      

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
                    <div id="form-success" class="text-center"></div>
                    <form id="addcountryform">
                        @csrf

                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>اسم الدولة  </label>
                                    <input type="text" name="title_en" autocomplete="off" data-country-id="0" class="form-control" id="country"
                                    placeholder="اضف الدولة  ">                                            </div>
                                 <div id="full_data"></div>

                                
                            </div>
                            <br>
                            <div class="col-md-3" id="country_info"></div>

                            <br>
         
                            
                        </div>
                       

                        <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i>اضافة
                    </button>
                     
                    </form>

                </div>



                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger closee" data-dismiss="modal">اغلاق</button>
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
                    <button type="button" class="btn btn-danger closee" data-dismiss="modal">اغلاق</button>
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

        // $('.closee').click(function() {
        //          $('#myModal').modal('show');
        // });

        
        $('#country_id').change(function() {
            $.ajax({
                url: "{{ route('get_country_code') }}",
                type: "get",
                data: {
                    id: $(this).val(),
                },

                success: function(data) {
                    // var table = $('#stores').DataTable();
                    let code = '<h5>' + data.code + '</h5>';
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
            var i = -1;
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

