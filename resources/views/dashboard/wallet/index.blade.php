@extends('layouts.backend_new')
@section('content')
    <div class="row">

        <div class="col-2 p-0 me-auto flex-column flex-center justify-content-between p-4">
            <h2>المحفظة</h2>

        </div>

        <!-- <div class="col-2 p-0 ms-auto flex-column flex-center justify-content-between p-4">
                      <a class="btn btn-primary  btn-lg w-100" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                        <img src="{{ asset('new_dash/images/icons/famousLight.png') }}" alt="" class="me-1 text-white" />
                        اضافة مشهور
                      </a>

                    </div> -->


    </div>
    <div class="filters mt-3">
        <form action="">
            <div class="d-flex">

                <div class="flex-basis-20 pe-3 d-flex flex-column">
                    <label class="flex-fill" for="">المتجر</label>
                    <div class="input-group input-group-lg flex-fill">
                        <select name="store_id" id="" class="form-control">

                            <option value="">@lang('اختر المتجر')</option>
                            @foreach (App\Models\Stores::get() as $item)
                                <option value="{{ $item->id }}" @if($request->store_id == $item->id) selected @endif>
                                    {{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                {{-- <div class="flex-basis-20 pe-3 d-flex flex-column">
                    <label class="flex-fill flex-grow-0" for="">المشهور</label>
                    <div id="slider-outer-div" class="flex-fill rounded-3">
                        <div id="slider-max-label" class="slider-label"></div>
                        <div id="slider-min-label" class="slider-label"></div>
                        <div id="between-handlers"></div>
                        <div id="slider-div">
                            <div class="slider-start">1%</div>
                            <div>
                                <input id="ex2" type="text" data-slider-min="1" data-slider-max="100"
                                    data-slider-value="[50,75]" data-slider-tooltip="hide" />
                            </div>
                            <div class="slider-end">100%</div>
                        </div>
                    </div>
                </div> --}}

                <div class="flex-basis-20 align-items-end d-flex">
                    <span class="p-2 border rounded-3">
                        <button type="submit" class="btn"> <img src="{{ asset('new_dash/images/icons/filters.png') }}" alt="" /></button>
                       
                    </span>
                </div>



            </div>
        </form>
    </div>
    <div class="content mt-5">
        <div class="border-top border-secondary">
            <table id="example" class="display compact" style="width:100%" id="storestable">


                <br>
                <thead>
                    <tr>
                        <th class="text-right">#</th>
                        <th class="text-right">صورة المتجر </th>

                        <th class="text-right">اسم المتجر </th>
                        @if (auth()->user()->hasRole('Admin'))
                            <th class="text-right">اسم المشهور</th>
                        @endif
                        <th class="text-right">اجمالي التحويل </th>
                        <th class="text-right">الكود</th>

                        <th class="text-right">الاجراءات</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($codes as $key => $item)
                        <tr>
                            <td class="text-right">{{ $key + 1 }} </td>
                            <td class="text-right"><img src="{{ asset('uploads/'.@$item->store->image) }}" width="80" height="50" alt=""> </td>

                            <td class="text-right">{{ @$item->store->title }} </td>
                            @if (auth()->user()->hasRole('Admin'))
                                <td class="text-right">{{ @$item->famous->name }} </td>
                            @endif

                            <td class="text-right">{{ get_total_mount_code($item->id) }} </td>
                            <td class="text-right">{{ @$item->code }}</td>

                            <td class="text-right">
                                {{-- <a data-toggle="modal" data-target="#myModal3" class="btn btn-info"><i
                                    class="fa fa-eye" aria-hidden="true"></i>

                            </a> --}}

                                <button class="btn" data-toggle="modal" data-target="#myModal3"
                                    onclick="get_info('{{ $item->id }}')"> <img
                                        src="{{ asset('new_dash/images/icons/view.png') }}" alt=""></button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>

    </div>


    <div class="modal fade" id="dataOrder" tabindex="-1" aria-labelledby="dataOrderLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataOrderLabel">
                        <img src="{{ asset('new_dash/images/icons/famous.png') }}" alt="" class="me-1"> بيانات
                        الطلب

                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></button>
                </div>
                <div class="modal-body" id="company_edit" style="max-height: 500px;overflow: auto">
                 

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).on('click', '#error', function(e) {
            var price = {{ get_general_value('min_wallet') }};
            swal(
                'خطأ!',
                'لا يمكن سحب مبلغ اقل من ' + price + '  ريال',
                'error'
            )
        });

        function get_info(id) {


            $("#dataOrder").modal('show');

            // $('#staticBackdrop').modal();
            $('.c-preloader').show();

            $.ajax({
                type: 'post',
                url: "{{ route('get_wallet_order') }}",
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
