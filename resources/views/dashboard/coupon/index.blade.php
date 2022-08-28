@extends('layouts.backend')
@section('content')
    <div class="content-wrapper">
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">الكبونات</h4>
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
                                {{-- <form style="margin-right:4%" >

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="userinput2">@lang('المتجر')</label>
                                                <select name="store_id" id="" class="form-control">

                                                    <option value="">@lang('اختر المتجر')</option>
                                                    @foreach (App\Models\Stores::get() as $item)
                                                        <option value="{{ $item->id }}" @if (@$request->store_id == $item->id) selected @endif>
                                                            {{ $item->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                        
                                            <label for="userinput2">حالة الاكواد  </label>

                                            <select name="status" class="form-control" id="">
                                                <option value="" >الكل</option>
                                                <option value="1" @if (@$request->status == 1) selected @endif>فعالة</option>
                                                <option value="0"@if (@$request->status == 0) selected @endif>غير فعالة</option>

                                            </select>
                                    </div>
                                        <div class="col-md-3 mt-1 pt-1">
                                            <button type="submit" class="btn btn-info"><i class="fa fa-filter"
                                                    aria-hidden="true"></i></button>
                                        </div>

                                    </div>
                                </form> --}}
                                <div class="card-body card-dashboard">
                                    @include('dashboard.parts._error')
                                    @include('dashboard.parts._success')

                                    <br>
                                    <a data-toggle="modal" data-target="#myModal" class="btn btn-info mb-2 ">
                                        انشاء كوبون جديد
                                    </a>

                                    <table class="table table-striped table-bordered zero-configuration" id="storestable">


                                        <br>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الكود</th>
                                                <th>نسبة الخصم </th>
                                                <th>عدد الاستخدامات </th>
                                                <th>الحالة</th>
                                                <th>الاجراءات</th>

                                            </tr>
                                        </thead>
                                        <tbody id="stores">
                                            @foreach ($coupons as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->code }} </td>
                                                    <td>{{ $item->discount }} </td>
                                                    <td>{{ $item->use_count }} </td>
                                                    <td>
                                                    <input type="checkbox" data-id="{{ $item->id }}" name="status" class="js-switch" {{ $item->status == 1 ? 'checked' : '' }}>
                                                    </td>
                                                    <td>

                                                        <button class="btn btn-info" data-toggle="modal"
                                                            data-target="#myModal4" onclick="make('{{ $item->id }}')"><i
                                                                class="fa fa-edit"></i></button>
                                                        <form style="display: inline"
                                                            action="{{ route('copouns.destroy', $item->id) }}" method="post">
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
                        تعديل بيانات الكوبون</h5>

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
                    <h4 class="modal-title"> اضف كوبون </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                    <div id="form-errors" class="text-center"></div>
                    <div id="success" class="text-center"></div>
                    <form id="sendmemessage">
                        @csrf

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email">طريقة انشاء الكود <span class="required">*</span></label>
                                <select name="code_typing" required id="generate_type" class="form-control">
                                    <option value="" selected disabled>اختر طريقة الانشاء</option>
                                    <option value="1">يدوي</option>
                                    <option value="2">تلقائي</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" id="code_typing" style="display: none">
                                <label for="email"> الكود  : <span class="required"></span></label>
                                <input type="text" name="code"   class="form-control"
                                    value="{{ old('code') }}" id="code">
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="commercial_register">قيمة الخصم  :</label>
                                <input type="text" required name="discount"
                                    value="{{ old('discount') }}" class="form-control"
                                    id="discount">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="commercial_register">  نسبة ام ثابت:</label>
                                <select name="type" required class="form-control">
                                    <option value="" selected disabled>نسبة ام ثابت  </option>
                                    <option value="amount">ثابت</option>
                                    <option value="percentage">نسبة</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="commercial_register">  محدود ام غير محدود  :</label>
                                <select name="is_unlimit" id="is_unlimit" required class="form-control">
                                    <option value="" selected disabled>محدود ام غير محدود     </option>
                                    <option value="0">محدود</option>
                                    <option value="1">غير محدود</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" id="number_useing" style="display: none">
                                <label for="email"> عدد مرات استخدام الكود  : <span class="required"></span></label>
                                <input type="number" name="num_use"  class="form-control"
                                    value="{{ old('num_use') }}" id="num_use">
                            </div>
                        </div>
                        <div class="row">


                            
                            <div class="form-group col-md-6">
                                <label for="commercial_register">يبدأ في   :</label>
                                <input type="date" name="start_at" required value="{{ old('start_at') }}" class="form-control"
                                    id="start_at">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="commercial_register">ينتهي في   :</label>
                                <input type="date" name="end_at" required value="{{ old('end_at') }}" class="form-control"
                                    id="end_at">
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
        $( document ).ready(function() {
            $("#generate_type").change(function() {
               var type = $(this).val();
               if(type == 1){
                $("#code_typing").css({display: "block"});
                $("#code").attr("required", true);
               }else{
                $("#code_typing").css({display: "none"});
                $("#code").attr("required", false);
               }
            });
            $("#is_unlimit").change(function() {
               var linit = $(this).val();
               if( linit == 0){
                $("#number_useing").css({display: "block"});
                $("#num_use").attr("required", true);
               }else{
                $("#number_useing").css({display: "none"});
                $("#num_use").attr("required", false);
               }
            });
            $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let compId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('copoun.update.status') }}',
            data: {'status': status, 'copoun_id': compId},
            success: function (data) {
                console.log(data.message);
            }
        });
    });
        });
        $('#sendmemessage').on('submit', function(e) {
            e.preventDefault();
            var frm = $('#sendmemessage');
            var formData = new FormData(frm[0]);

            var data = $(this).serialize();

            $.ajax({
                url: "{{ route('copouns.store') }}",
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
                url: "{{ route('get_form_copoun') }}",
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
