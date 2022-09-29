<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kodack</title>
    <link rel="stylesheet" href="{{asset('new_dash/lib/bootstrap/css/bootstrap.rtl.min.css')}}" />
    <link rel="stylesheet" href="{{asset('new_dash/lib/bootstrap-slider/bootstrap-slider.css')}}" />
    <link rel="stylesheet" href="{{asset('new_dash/all/css/styles.css')}}" />
    <link rel="stylesheet" href="{{asset('new_dash/ar/css/styles.css')}}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <style>
      .text-right{
        text-align: right !important
      }
    </style>

  </head>
  <body>
    <div class="container-fluid">
      <div class="row flex-nowrap">
        @include('dashboard.part_new.aside')

        <div class="col pb-3 px-0">
         
          @include('dashboard.part_new.nav')
          <div id="page-content" class="container-fluid mt-5">
            @yield('content')
          </div>
        </div>
      </div>
    </div>

    <script src="{{asset('new_dash/lib/jquery/jquery-3.6.1.min.js')}}"></script>
    <script src="{{asset('new_dash/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('new_dash/lib/bootstrap-slider/bootstrap-slider.min.js')}}"></script>

    <script src="{{asset('new_dash/all/js/scripts.js')}}"></script>
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
    </script>
    <script>
        $(document).ready( function () {
    $('table').DataTable();
} );
    </script>
    @yield('script')
  </body>
</html>
