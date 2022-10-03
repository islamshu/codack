<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kodack</title>
    <link rel="stylesheet" href="{{ asset('new_dash/lib/bootstrap/css/bootstrap.rtl.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('new_dash/lib/bootstrap-slider/bootstrap-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('new_dash/all/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('new_dash/ar/css/styles.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"
        integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .text-right {
            text-align: right !important;
            padding-right: 2% !important;
        }
        .text-rightt {
            text-align: right !important;
        }
        .setwidth{
          width: 25px !important;
        }
       

        td span {
            display: inline-block;
            width: 35px;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            @include('dashboard.part_new.aside')

            <div class="col pb-3 px-0" style="overflow: auto">

                @include('dashboard.part_new.nav')
                <div id="page-content" class="container-fluid mt-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('new_dash/lib/jquery/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('new_dash/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('new_dash/lib/bootstrap-slider/bootstrap-slider.min.js') }}"></script>

    <script src="{{ asset('new_dash/all/js/scripts.js') }}"></script>
    <script src="{{ asset('new_dash/ar/js/bootstrap-select.min.js') }}"></script>


    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        $('.delete-confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `هل متأكد من حذف العنصر ؟`,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
        $('select.selectpicker').selectpicker();
    </script>

    @yield('script')
    @if (get_lang() == 'ar')
        <script>
            $('#example').DataTable({

                "initComplete": function(settings, json) {
                    $("#example").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
                },
                "language": {
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخلات",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    }
                }
            });
        </script>
    @endif

</body>

</html>
