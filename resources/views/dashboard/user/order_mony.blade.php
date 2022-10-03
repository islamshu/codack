@extends('layouts.backend_new')
@section('css')
    <style>
        .imageshow{
    width:50px;
    height:50px;
}

.imageshow:hover{
    width:1000px;
    height:700px;
}
</style>
@endsection
@section('content')
<div class="row">

    <div class="col-2 p-0 me-auto flex-column flex-center justify-content-start p-4">
      <h2 class="">طلبات التحويل</h2>

    </div>


  </div>

  <div class="content mt-5">
    <div class="border-top border-secondary">
        @include('dashboard.parts._error')
        @include('dashboard.parts._success')

        <br>
       

        <table class="table table-striped table-bordered zero-configuration" id="example">


            <br>
            <thead>
                <tr>
                    <th>#</th>
                    <th>قيمة التحويل     </th>
                    <th>الحالة</th>
                    <th> التاريخ  </th>
                    <th>الاجراءات</th>

                </tr>
            </thead>
            <tbody id="stores">
                @foreach ($changes as $key => $item)
                    <tr>
                         <td class="text-right">{{ $key + 1 }}</td>
                        <td class="text-right">{{ $item->amount }}</td>
                         <td class="text-right"><button type="button" class="btn btn-sm btn-outline-{{ get_account_status_color($item->status) }} round">{{  get_account_status($item->status) }} </button>
                         
                        </td>
                         <td class="text-right">{{ $item->created_at->format('Y-m-d') }}</td>
                         <td class="text-right">
                            @if($item->status ==1)
                        
                            <a href="{{ asset('uploads/'.$item->image) }}" target="_blank">
                               معاينة الحوالة
                              </a>
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
