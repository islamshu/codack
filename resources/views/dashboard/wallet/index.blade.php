@extends('layouts.backend')
@section('content')
    <div class="content-wrapper">
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    @if(auth()->user()->hasRole('Famous'))
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="radies card bg-info">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center" style="margin-right:10%">
                                            <i class="icon-wallet text-white font-large-2 float-right"></i>
                                        </div>
                                        <div class="media-body text-white text-right" style="margin-left: 33px;">
                                            <h3 class="text-white">{{ App\Models\Code::where('famous_id',auth()->user()->famous->id)->sum('total_famous')  }}</h3>
                                            <span> اجمالي المحفظة   </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="radies card bg-success">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center" style="margin-right:10%">
                                            <i class="icon-check text-white font-large-2 float-right"></i>
                                        </div>
                                        <div class="media-body text-white text-right" style="margin-left: 33px;">
                                            <h3 class="text-white">0</h3>
                                            <span>  ما تم تحويله   </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="radies card bg-warning">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center" style="margin-right:10%">
                                            <i class="icon-compass text-white font-large-2 float-right"></i>
                                        </div>
                                        <div class="media-body text-white text-right" style="margin-left: 33px;">
                                            <h3 class="text-white">0</h3>
                                            <span>   المبالغ المعلقة    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card bg-info">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="icon-wallet text-white font-large-2 float-right"></i>
                                        </div>
                                        <div class="media-body text-white text-right">
                                            <h3 class="text-white">2500</h3>
                                            <span> اجمالي المحفظة </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card bg-success">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="icon-check text-white font-large-2 float-right"></i>
                                        </div>
                                        <div class="media-body text-white text-right">
                                            <h3 class="text-white">500</h3>
                                            <span> اجمالي ما تم تحويله </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card bg-warning">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="icon-compass text-white font-large-2 float-right"></i>
                                        </div>
                                        <div class="media-body text-white text-right">
                                            <h3 class="text-white">500</h3>
                                            <span> اجمالي المبالغ المعلقة </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    @endif
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">الاجمالي</h4>
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
                            <form>

                                <div class="row" style="margin-right: 2%">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="userinput2">@lang('المتجر')</label>
                                            <select name="nationality_id" id="" class="form-control">

                                                <option value="">@lang('اختر المتجر')</option>
                                                @foreach (App\Models\Stores::get() as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                       <label for="userinput2">قيمة التحويل </label>

                                                <div class="min-max-slider" data-legendnum="2" style="direction: ltr">
                                                    <label for="min">من</label>
                                                    <input id="min" class="min" name="min" type="range" step="1" min="0" max="15000" />
                                                    <label for="max">الى</label>
                                                    <input id="max" class="max" name="max" type="range" step="1" min="0" max="15000" />
                                                </div>
                                    </div>
                                   
                                    <div class="col-md-3 mt-1 pt-1">
                                        <button type="submit" class="btn btn-info"><i class="fa fa-filter"
                                                aria-hidden="true"></i></button>
                                    </div>

                                </div>
                            </form>

                            <div class="card-content collapse show">

                                <div class="card-body card-dashboard">
                                    @include('dashboard.parts._error')
                                    @include('dashboard.parts._success')

                                    <br>


                                    <table class="table table-striped table-bordered zero-configuration" id="storestable">


                                        <br>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>اسم المتجر </th>
                                                @if(auth()->user()->hasRole('Admin'))
                                                <th>اسم المشهور</th>
                                                @endif 
                                                <th>اجمالي التحويل </th>
                                                <th>الكود</th>

                                                <th>الاجراءات</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($codes as $key=> $item)
                                                
                                            <tr>
                                                <td>{{ $key +1 }} </td>
                                                <td>{{ @$item->store->title }} </td>
                                                @if(auth()->user()->hasRole('Admin'))
                                                <td>{{ @$item->famous->name }} </td>
                                                @endif

                                                <td>{{ get_total_mount_code($item->id) }} </td>
                                                <td>{{ @$item->code }}</td>

                                                <td>
                                                    {{-- <a data-toggle="modal" data-target="#myModal3" class="btn btn-info"><i
                                                            class="fa fa-eye" aria-hidden="true"></i>

                                                    </a> --}}
                                                    <button class="btn btn-info" data-toggle="modal" data-target="#myModal3"
                                                        onclick="get_info('{{ $item->id }}')"><i
                                                            class="fa fa-eye"></i></button>
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
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">بينات الطلب   </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="max-height: 500px;overflow: auto" >
                    <table class="table">
                        <thead>
                          <tr>
                            <th >#</th>
                            <th  >المتجر</th>
                            <th style="  width: 31% !important" >المشهور</th>
                            <th  style="width: 1% !important">المبلغ</th>
                            <th  style="width: 1% !important">الخصم من الكود</th>
                            <th >التاريخ </th>
                          </tr>
                        </thead>
                        <tbody id="company_edit">
                            
                         
                       
                          
                        </tbody>
                      </table>

                </div>


                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger delete-confirm" data-dismiss="modal">اغلاق</button>
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


            $("#myModal13").show();

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
