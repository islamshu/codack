@extends('layouts.backend')
@section('content')
    <div class="content-wrapper">
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
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
                    </div>
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

                                <div class="row">
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
                                        <div class="form-group">
                                            <label for="userinput2">نسبة خصم التاجر (من)</label>
                                            <fieldset class="form-group position-relative">
                                                <input type="number" max="100" min="5" name="phone"
                                                    class="form-control form-control-lg input-lg" id="iconLeft3">
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
                                                <input type="number" max="100" min="5" name="phone"
                                                    class="form-control form-control-lg input-lg" id="iconLeft3">
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
                                            <tr>
                                                <td>1 </td>
                                                <td>متجر قيس</td>
                                                @if(auth()->user()->hasRole('Admin'))
                                                <td>islam </td>
                                                @endif
                                                <td>1300 </td>
                                                <td>QQQ</td>

                                                <td>
                                                    <a data-toggle="modal" data-target="#myModal3" class="btn btn-info"><i
                                                            class="fa fa-eye" aria-hidden="true"></i>

                                                    </a>
                                                </td>
                                            </tr>

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
                    <h4 class="modal-title">بينات الطلب   </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">المبلغ</th>
                            <th scope="col">المتجر</th>
                            <th scope="col">المشهور</th>
                            <th scope="col">تاريخ الطلب</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>1000</td>
                            <td>متجر قيس</td>
                            <td>islam </td>

                            <td>09-08-2022</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>300</td>
                            <td>متجر قيس</td>
                            <td>islam </td>
                            <td>07-08-2022</td>
                          </tr>
                          
                        </tbody>
                      </table>

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
        $(document).on('click', '#error', function(e) {
            var price = {{ get_general_value('min_wallet') }};
            swal(
                'خطأ!',
                'لا يمكن سحب مبلغ اقل من ' + price + '  ريال',
                'error'
            )
        });
    </script>
@endsection
