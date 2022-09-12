@extends('layouts.backend')
@section('content')
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اكواد الخصم</h4>
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
                            <div class="card-body card-dashboard">
                                @include('dashboard.parts._error')
                                @include('dashboard.parts._success')

                                <a data-toggle="modal" data-target="#myModal3" class="btn btn-info mb-2 ">
                                    اضف كود خصم
                                </a>

                                <table class="table table-striped table-bordered zero-configuration" id="storestable">



                                    <br>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> اسم المتجر</th>
                                            <th> اسم كود الخصم </th>
                                            <th>اسم المشهور</th>
                                            <th>نسبة كود الخصم</th>
                                            @if (auth()->user()->hasRole('Admin'))
                                                <th>فايدة اسخدام الكود</th>
                                                <th>نسبة كودك</th>
                                                <th>نسبة المشهور</th>
                                            @else
                                                <th>نسبة المشهور</th>
                                            @endif
                                            <th>عدد العمليات </th>
                                            <th>اجمالي الايرادات </th>


                                            <th>الاجراءات</th>

                                        </tr>
                                    </thead>
                                    <tbody id="stores">
                                        @foreach ($codes as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td> {{ @$item->store->title }}</td>

                                                {{-- <td> {{ get_total_code($item->id) }}</td> --}}
                                                <td>{{ $item->code }}</td>
                                                <td>{{ @$item->famous->name }} </td>
                                                <td>{{ $item->discount_percentage }}</td>
                                                @if (auth()->user()->hasRole('Admin'))
                                                    <td> {{ get_total_benefit($item->id) }}</td>
                                                    <td>
                                                        {{ get_total_system_code_api($item->id) }}
                                                    </td>
                                                    <td>
                                                        {{ get_total_famous_code_api($item->id) }}
                                                    </td>
                                                @else
                                                    <td>
                                                        {{ get_total_famous_code_api($item->id) }}
                                                    </td>
                                                @endif
                                                <td> {{ get_total_code($item->id) }}</td>
                                                <td> {{ get_total_mount_code($item->id) }}</td>


                                                <td>


                                                    <button class="btn btn-info" data-toggle="modal" data-target="#myModal4"
                                                        onclick="make('{{ $item->id }}')"><i
                                                            class="fa fa-edit"></i></button>
                                                    <form style="display: inline"
                                                        action="{{ route('codes.destroy', $item->id) }}" method="post">
                                                        @method('delete') @csrf
                                                        <button type="submit" class="btn btn-danger delete-confirm"><i
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
    <div class="modal" id="myModal3">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">اضافة كود خصم </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                    <form id="sendform">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> المتجر :</label>
                                    <select name="store_id" required class="form-control" id="select_store">
                                        <option value="" selected disabled>اختر المتجر</option>

                                        @foreach ($stores as $item)
                                            <option value="{{ $item->id }}">{{ $item->title }} </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> المشهور :</label>
                                    @if (auth()->user()->hasRole('Admin'))
                                        <select name="famous_id" required class="form-control">
                                            <option value="" selected disabled>اختر المشهور </option>

                                            @foreach ($famous as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="hidden" name="famous_id" value="{{ auth()->user()->famous->id }}"
                                            readonly class="form-control" id="email">
                                        <input type="text" class="form-control" readonly
                                            value="{{ auth()->user()->famous->name }}" id="">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> اسم كود الخصم :</label>
                                    <input type="text" required name="code" class="form-control" id="codechange">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> نسبة كود الخصم :</label>
                                    <fieldset class="form-group position-relative">
                                        <input type="text" name="discount_percentage" required
                                            class="form-control form-control-lg input-lg" value="" readonly id="discount_code">
                                        <div class="form-control-position phoneicon" style="margin-top: -3px;display: flex">
                                            %
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                      <input type="hidden" id="benefit" name="benefit_percentage" >
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"> فائدة استخدام الكود  :</label>
                                <fieldset class="form-group position-relative">

                                    <input type="number" max="100" min="0" readonly
                                        class="form-control form-control-lg input-lg" id="penifet_new">
                                    <div class="form-control-position phoneicon"
                                        style="margin-top: -3px;display: flex">
                                        ريال
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                      </div>
                        <div class="row">

                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> نسبة كودك :</label>
                                    <fieldset class="form-group position-relative">

                                        <input type="number" max="100" min="0" readonly name="system_percentage" required
                                            class="form-control form-control-lg input-lg" id="system_percentage">
                                        <div class="form-control-position phoneicon"
                                            style="margin-top: -3px;display: flex">
                                            %
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                     
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> نسبة المشهور :</label>
                                    <fieldset class="form-group position-relative">

                                        <input type="number" max="100" min="0"  name="famous_percentage" required
                                            class="form-control form-control-lg input-lg" id="famous_percentage">
                                        <div class="form-control-position phoneicon"
                                            style="margin-top: -3px;display: flex">
                                            %
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> تاريخ البداية  :</label>
                                    <fieldset class="form-group position-relative">

                                        <input type="date" readonly name="start_at" required
                                            class="form-control form-control-lg input-lg" id="start_at">
                                        
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> تاريخ النهاية  :</label>
                                    <fieldset class="form-group position-relative">

                                        <input type="date" readonly name="end_at" required
                                            class="form-control form-control-lg input-lg" id="end_at">
                                        
                                    </fieldset>
                                </div>
                            </div>

                        </div>

                        <button type="submit" disabled id="add_code" class="btn btn-info">اضافة</button>
                    </form>

                </div>


                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger delete-confirm" data-dismiss="modal">اغلاق</button>
                </div>

            </div>
        </div>

    </div>
    <div class="modal fase " id="myModal4" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="staticBackdropLabel">
                        تعديل بيانات كود الخصم  </h5>

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
@endsection
@section('script')
    <script>
        $('#famous_percentage').change(function(){
            var numb_code = 100- $(this).val();
            $('#system_percentage').val(numb_code);
        });
        $('#sendform').on('submit', function(e) {
            e.preventDefault();

            var frm = $('#sendform');
            var formData = new FormData(frm[0]);

            var data = $(this).serialize();

            $.ajax({
                url: "{{ route('codes.store') }}",
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    // var table = $('#stores').DataTable();

                    var t = $('#storestable').DataTable();
                    const tr = $(data);
                    t.row.add(tr).draw(false);


                    document.getElementById("sendform").reset();
                    $('#myModal3').modal('hide')
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
                url: "{{ route('get_form_code') }}",
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
    <script>
        $(document).ready(function() {
            $(".percentage").on('input', function() {
                $(this).val(function(i, v) {
                    return v.replace('%', '') + '%';
                });
            });

        });
    </script>

    <script>
        $('#select_store').change(function() {
            $("#codechange").val('');
            $("#start_at").val('');
            $("#end_at").val('');

            $("#discount_code").val('');
            $('#penifet_new').val('');
            $('#benefit').val('');

            $('#add_code').attr("disabled", true);


        });
        $("#codechange").change(function() {
            var store = $('#select_store').val();
            if (store == null) {
                $("#codechange").val('');
                swal(
                    '',
                    ' يرجى اختيار المتجر اولا   ',
                    'error'
                )
            }
            var code = $("#codechange").val();
            $.ajax({
                url: "{{ route('check_code') }}",
                type: "get",
                data: {
                    store: store,
                    code: code
                },

                success: function(data) {
                    if (data.status == 'false') {
                        swal(
                            '',
                            data.message,
                            'error'
                        )
                    } else if (data.status == 'true') {
                        swal(
                            '',
                            data.message,
                            'success'
                        );
                        $('#add_code').attr("disabled", false);
                        $('#discount_code').val(data.discount);
                        $('#start_at').val(data.start_at);
                        $('#end_at').val(data.end_at);
                        $('#benefit').val(data.beneif);
                        $('#penifet_new').val(data.benift_new)

                    }


                },
                error: function(data) {

                },
            });
        });
    </script>
@endsection
