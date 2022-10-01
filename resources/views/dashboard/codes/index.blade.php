@extends('layouts.backend_new')
@section('content')
<div class="row">
    <div class="col-2 p-0 me-auto flex-column flex-center justify-content-between p-4">
      <h2>اكواد الخصم</h2>
    </div>
    <div class="col-2 p-0 ms-auto flex-column flex-center justify-content-between p-4">
      <a class="btn btn-primary btn-lg w-100 add" data-bs-toggle="modal" data-bs-target="#addDisCode">
        <img src="{{asset('new_dash/images/icons/add-vendor.png')}}" alt="" class="me-1" />
        اضافة كود
      </a>
    </div>
  </div>
  <div class="filters mt-3">
    <form action="">
      <div class="d-flex">
     
        <div class="flex-basis-20 pe-3 d-flex flex-column">
          <label class="flex-fill" for="">المتجر</label>
          <div class="input-group input-group-lg flex-fill">
            <select class="form-select" aria-label="Default select example">
              <option selected>الكل</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
        </div>
        <div class="flex-basis-20 pe-3 d-flex flex-column">
          <label class="flex-fill" for="">المشهور</label>
          <div class="input-group input-group-lg flex-fill">
            <select class="form-select" aria-label="Default select example">
              <option selected>الكل</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
        </div>

        <div class="flex-basis-20 align-items-end d-flex">
          <span class="p-2 border rounded-3">
            <img src="{{asset('new_dash/images/icons/filters.png')}}" alt="" />
          </span>
        </div>
      </div>
    </form>
  </div>
  <div class="content mt-5" >
    <div class="border-top border-secondary" >
        <table id="examplee" class="display_nowrap" style="width:100%">



            <br>
            <thead>
                <tr>
                    <th class="text-right">#</th>
                    <th class="text-right"> اسم المتجر</th>
                    <th class="text-right"> اسم كود الخصم </th>
                    <th class="text-right">نسبة كود الخصم</th>
                    <th class="text-right">اسم المشهور</th>
                    <th class="text-right">عدد العمليات </th>
                    <th class="text-right">اجمالي الايرادات </th>


                    @if (auth()->user()->hasRole('Admin'))
                        <th class="text-right">فايدة اسخدام الكود</th>
                        <th class="text-right">الفايدة من المبيعات  </th>

                        <th class="text-right">ايراد كودك</th>
                        <th class="text-right">ايراد المشهور</th>
                    @else
                        <th class="text-right">ايراد المشهور</th>
                    @endif


                    <th class="text-right">الاجراءات</th>

                </tr>
            </thead>
            <tbody id="stores">
                @foreach ($codes as $key => $item)
                    <tr>
                        <td class="text-right">{{ $key + 1 }}</td>
                        <td class="text-right"> {{ @$item->store->title }}</td>

                        {{-- <td class="text-right"> {{ get_total_code($item->id) }}</td> --}}
                        <td class="text-right">{{ $item->code }}</td>
                        <td class="text-right">{{ $item->discount_percentage }}</td>

                        <td class="text-right">{{ @$item->famous->name }} </td>
                        <td class="text-right"> {{ get_total_code($item->id)}}  &nbsp; &nbsp;
                            @if (auth()->user()->hasRole('Admin'))

                            <button class="btn "  data-toggle="modal" data-target="#myModal6"
                            onclick="add_income('{{ $item->id }}')"><img src="{{asset('new_dash/images/icons/plus.png')}}" data-bs-toggle="modal" data-bs-target="#addValue" class="w-25 ms-2 pointer" alt="" /></button>
                            @endif
                        </td>
                        <td class="text-right"> {{ get_total_mount_code($item->id) }} &nbsp; 
                            @if (auth()->user()->hasRole('Admin'))
                            <button class="btn "  data-toggle="modal" data-target="#myModal6"
                            onclick="add_income('{{ $item->id }}')"><img src="{{asset('new_dash/images/icons/plus.png')}}" data-bs-toggle="modal" data-bs-target="#addValue" class="w-25 ms-2 pointer" alt="" /></button>
                            @endif
                        </td>

                        @if (auth()->user()->hasRole('Admin'))
                            <td class="text-right"> {{ get_total_benefit($item->id) }} ريال</td>
                            <td class="text-right"> {{$item->benefit_percentage}}%</td>

                            <td class="text-right">
                                {{ get_total_system_code_api($item->id) }}
                            </td>
                            <td class="text-right">
                                {{ get_total_famous_code_api($item->id) }}
                            </td>
                        @else
                            <td class="text-right">
                                {{ get_total_famous_code_api($item->id) }}
                            </td>
                        @endif


                        <td class="text-right">


                            <button class="btn btn-inf" data-toggle="modal" data-target="#myModal4"
                            onclick="make('{{ $item->id }}')"><img src="{{asset('new_dash/images/icons/edit.png')}}" class="pointer"
                            alt=""></button>
                            <form style="display: inline" action="{{ route('codes.destroy',$item->id) }}" method="post">
                                @method('delete') @csrf
                                <button type="submit"  class="btn  delete-confirm"><img src="{{asset('new_dash/images/icons/delete.png')}}" class="pointer"
                                    alt=""></button>
                            </form>
                        </td>



                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>
    
  </div>
  <div class="modal fade" id="addDisCode" tabindex="-1" aria-labelledby="addDisCodeLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addDisCodeLabel">
            <img src="./assets/images/icons/code.png" alt="" class="me-1"> إضافة كود خصم
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="sendform">
                @csrf


            <input type="hidden" id="benefit" name="benefit_percentage" >

            <div class="input-item">
              <label for="">المتجر</label>
              <select name="store_id" required class="form-control" id="select_store">
                <option value="" selected disabled>اختر المتجر</option>

                @foreach ($stores as $item)
                    <option value="{{ $item->id }}">{{ $item->title }} </option>
                @endforeach

            </select>
            </div>



            <div class="input-item">
              <label for="">المشهور</label>
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



            <div class="input-item">
              <label for="">اسم كود الخصم</label>
              <input type="text" required name="code" class="form-control" id="codechange">
            </div>



            <div class="input-item">
              <label for="">نسبة كود الخصم</label>
              <input type="text" name="discount_percentage" required
              class="form-control form-control-lg input-lg" value="" readonly id="discount_code">
            </div>



            <div class="input-item">
              <label for="">فايدة استخدام الكود</label>
              <input type="number" max="100" min="0" readonly
                                        class="form-control form-control-lg input-lg" id="penifet_new">
            </div>



            <div class="input-item">
              <label for="">نسبة المشهور</label>
              <input type="number" max="100" min="0"  name="famous_percentage" required
              class="form-control form-control-lg input-lg" id="famous_percentage">
            </div>

            <div class="input-item">
              <label for="">نسبة كودك</label>
              <input type="number" max="100" min="0"  name="system_percentage" required
                                            class="form-control form-control-lg input-lg" id="system_percentage">
            </div>

            <div class="input-item">
              <label for="date">تاريخ بداية الكود</label>

              <div class="inner-input d-block form-control p-0 date" style="height:46px; direction: ltr;">
                <input type="date" readonly name="start_at" required
                class="form-control form-control-lg input-lg" id="start_at">
                <!-- <span class="border h-100 upload-img"> <img src="./assets/images/icons/date.png" alt="" class="me-1"></span> -->
              </div>
            </div>

            <div class="input-item">
              <label for="date">تاريخ نهاية الكود</label>

              <div class="inner-input d-block form-control p-0 date" style="height:46px; direction: ltr;">
                <input type="date" readonly name="end_at" required
                class="form-control form-control-lg input-lg" id="end_at">
                <!-- <span class="border h-100 upload-img"> <img src="./assets/images/icons/date.png" alt="" class="me-1"></span> -->
              </div>
            </div>








            <div class="input-item">
              <button type="submit"  class="btn text-end add-store">+ إضافة كود خصم</button>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>
  <div class="modal fade" id="updateDisCode" tabindex="-1" aria-labelledby="updateDisCodeLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateDisCodeLabel">
            <img src="./assets/images/icons/code.png" alt="" class="me-1"> تعديل كود خصم
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="company_edit_code">
          
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
                        <i class="fa fa-spinner fa-spin fa-3x"></i>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fase " id="myModal5" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="staticBackdropLabel">
                        اضافة قيم للعمليات </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="company_edit_total">
                    <div class="c-preloader text-center p-3">
                        <i class="fa fa-spinner fa-spin fa-3x"></i>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fase " id="myModal6" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="staticBackdropLabel">
                        اضافة قيم للايرادات </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="company_edit_income">
                    <div class="c-preloader text-center p-3">
                        <i class="fa fa-spinner fa-spin fa-3x"></i>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addValue" tabindex="-1" aria-labelledby="addValueLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addValueLabel">
                <img src="{{asset('new_dash/images/icons/doc.png')}}" alt="" class="me-1"> اضافة قيم للايرادات
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="addValue_edit">
              
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
        $('#system_percentage').change(function(){
            var numb_code = 100- $(this).val();
            $('#famous_percentage').val(numb_code);
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
                    setTimeout(function() {
                    window.location.reload();
                }, 1000);



                },
                error: function(data) {
                    
                    swal(
                        '',
                        'لا يمكن اضافة كود تم اضافته مسبقا لنفس المشهور على نفس المتجر',
                        'error'
                    )
                },
            });
        });


        function make(id) {
            $("#updateDisCode").modal('show');

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
                    $('#company_edit_code').html(data);


                }
            });

        }
        
        function add_income(id){
            $("#addValue").modal('show');

// $('#staticBackdrop').modal();
            $('.c-preloader').show();

            $.ajax({
                type: 'post',
                url: "{{ route('get_form_income') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                beforeSend: function() {},
                success: function(data) {
                    $('#addValue_edit').html(data);


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
    <script>
        $(document).ready(function () {
            $('#examplee').DataTable({
                scrollX: true,
            });
        });
    </script>
@endsection
