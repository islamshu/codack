<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
        content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>تسجيل الدخول
    </title>
    <link rel="apple-touch-icon" href="{{ asset('backend/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/images/ico/favicon.ico') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/icheck/custom.css') }}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/custom-rtl.css') }}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/css-rtl/core/menu/menu-types/vertical-content-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/pages/login-register.css') }}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/style-rtl.css') }}">
    <!-- END Custom CSS-->
</head>

<body class="vertical-layout vertical-content-menu 1-column   menu-expanded blank-page blank-page" data-open="click"
    data-menu="vertical-content-menu" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <div class="p-1">
                                            <img src="{{ asset('backend/images/logo/logo-dark.png') }}"
                                                alt="branding logo">
                                        </div>
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                        <span>محفظة كودك</span>
                                    </h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        @include('dashboard.parts._error')
                                        @include('dashboard.parts._success')
                                        <div id="form-errors" class="text-center"></div>
                                        <div id="form-success" class="text-center"></div>

                                        <form class="form-horizontal form-simple" id="send_phone">
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                                <input type="text" class="form-control form-control-lg input-lg"
                                                    name="phone"  id="user-name" placeholder="ادخل رقم الهاتف"
                                                    required>
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <br>


                                            <button type="submit" class="btn btn-info btn-lg btn-block"><i
                                                    class="ft-unlock"></i> ارسال رمز التحقق </button>
                                        </form>
                                        <form class="form-horizontal form-simple" id="check_otp" style="display: none">
                                            @csrf
                                            <div id="new_coulum"></div>
                                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                                <input type="number" class="form-control form-control-lg input-lg"
                                                    name="otp" id="user-name" placeholder="ادخل رمز التحقق"
                                                    required>
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <br>


                                            <button type="submit" class="btn btn-info btn-lg btn-block"><i
                                                    class="ft-unlock"></i> تحقق </button>
                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('backend/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('backend/vendors/js/ui/headroom.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript">
    </script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="{{ asset('backend/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/core/app.js') }}" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('backend/js/scripts/forms/form-login-register.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    <script>
        $('#send_phone').on('submit', function(e) {
            e.preventDefault();
            var frm = $('#send_phone');
            var formData = new FormData(frm[0]);

            var data = $(this).serialize();

            $.ajax({
                url: "{{ route('famous_login_post') }}",
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    


                    // var table = $('#stores').DataTable();
                    if (data['status'] == true) {
                        $("#send_phone").css("display", "none");
                        $("#check_otp").css("display", "block");
                        $('#form-errors').css("display", "none");
                        $("<input>").attr({
                            name: "phone",
                            id: "hiddenId",
                            type: "hidden",
                            value: data['phone']
                        }).appendTo("#new_coulum");

                        successHtml = '<div class="alert alert-success"><ul>';
                        successHtml += '<li>' + data['message'] + '</li>';

                        successHtml += '</ul></di>';
                        $('#form-success').html(successHtml);
                        
                        $('#form-success').css("display", "block");
                     
                    } else if (data['status'] == false) {

                       
                        errorsHtml = '<div class="alert alert-danger"><ul>';
                        errorsHtml += '<li> لم يتطابق رقم الهاتف مع سجلاتنا</li>';

                        errorsHtml += '</ul></di>';
                        $('#form-errors').html(errorsHtml);
                    }


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
        $('#check_otp').on('submit', function(e) {
            e.preventDefault();
            var frm = $('#check_otp');
            var formData = new FormData(frm[0]);

            var data = $(this).serialize();

            $.ajax({
                url: "{{ route('check_otp') }}",
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {

                    // var table = $('#stores').DataTable();
                    if (data['status'] == true) {
                        window.location.href = data['redirecturl'];

                    } else if (data['status'] == false) {
                        $('#form-errors').css("display", "block");
                        $('#form-success').css("display", "none");
                        errorsHtml = '<div class="alert alert-danger"><ul>';
                        errorsHtml += '<li> لم يتطابق رقم الهاتف مع سجلاتنا</li>';

                        errorsHtml += '</ul></di>';
                        $('#form-errors').html(errorsHtml);
                    }


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
        
    </script>

</body>

</html>
