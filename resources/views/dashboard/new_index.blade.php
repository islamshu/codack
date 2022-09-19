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

  </head>
  <body>
    <div class="container-fluid">
      <div class="row flex-nowrap">
        <div id="sidebar-wrap" class="col-auto col-md-3 col-xl-2 px-0 flex-column d-flex">
          <div id="logo-wrap" class="flex-basis-20 flex-center w-100">
            <a href="/" class="d-flex align-items-center m-auto">
              <span class="fs-5 d-none d-sm-inline">
                <img src="{{asset('new_dash/images/logo.png')}}" alt="" />
              </span>
            </a>
          </div>
          <div id="navigation-wrap" class="flex-basis-80 w-100">
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="main-nav">
              <li class="nav-item active ps-4 pe-3">
                <a href="#" class="nav-link align-middle px-0">
                  <img src="{{asset('new_dash/images/icons/nav-icons/home.png')}}" class="nav-icon me-2" alt="" />
                  <span class="ms-1 d-none d-sm-inline"> الرئيسية </span>
                </a>
              </li>
              <li class="nav-item ps-4 pe-3">
                <a href="#" class="nav-link align-middle px-0">
                  <img src="{{asset('new_dash/images/icons/nav-icons/vendors.png')}}" class="nav-icon me-2" alt="" />
                  <span class="ms-1 d-none d-sm-inline"> المتاجر </span>
                </a>
              </li>
              <li class="nav-item ps-4 pe-3">
                <a href="#" class="nav-link align-middle px-0">
                  <img src="{{asset('new_dash/images/icons/nav-icons/famous.png')}}" class="nav-icon me-2" alt="" />
                  <span class="ms-1 d-none d-sm-inline"> المشاهير </span>
                </a>
              </li>
              <li class="nav-item ps-4 pe-3 has-children">
                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link align-middle px-0">
                  <img src="{{asset('new_dash/images/icons/nav-icons/bank-accounts.png')}}" class="nav-icon me-2" alt="" />
                  <span class="ms-1 d-none d-sm-inline"> الحسابات البنكية</span>
                </a>
                <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#main-nav">
                  <li class="w-100">
                    <a href="#" class="nav-link align-middle px-0">
                      <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                      <span class="ms-1 d-none d-sm-inline"> أكواد الخصم </span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link align-middle px-0">
                      <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                      <span class="ms-1 d-none d-sm-inline"> أكواد الخصم </span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item ps-4 pe-3">
                <a href="#" class="nav-link align-middle px-0">
                  <img src="{{asset('new_dash/images/icons/nav-icons/wallet.png')}}" class="nav-icon me-2" alt="" />
                  <span class="ms-1 d-none d-sm-inline"> المحفظة </span>
                </a>
              </li>
              <li class="nav-item ps-4 pe-3">
                <a href="#" class="nav-link align-middle px-0">
                  <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                  <span class="ms-1 d-none d-sm-inline"> أكواد الخصم </span>
                </a>
              </li>

              <li class="nav-item ps-4 pe-3 has-children">
                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link align-middle px-0">
                  <img src="{{asset('new_dash/images/icons/nav-icons/settings.png')}}" class="nav-icon me-2" alt="" />
                  <span class="ms-1 d-none d-sm-inline">الإعدادات</span>
                </a>
                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#main-nav">
                  <li class="w-100">
                    <a href="#" class="nav-link align-middle px-0">
                      <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                      <span class="ms-1 d-none d-sm-inline"> أكواد الخصم </span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link align-middle px-0">
                      <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                      <span class="ms-1 d-none d-sm-inline"> أكواد الخصم </span>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <div class="col pb-3 px-0">
          <div id="content-header" class="primary-background px-4 py-3">
            <div class="row flex-nowrap">
              <div class="col-6 text-start">
                <a href="" class="mx-2"><img src="{{asset('new_dash/images/icons/nav-back.png')}}" alt="" /></a>
                <a href="" class="mx-2"><img src="{{asset('new_dash/images/icons/full-screen.png')}}" alt="" /></a>
                <a href="" class="mx-2"><img src="{{asset('new_dash/images/icons/refresh.png')}}" alt="" /></a>
              </div>
              <div class="col-6 text-end">
                <a href="" class="mx-2"><img src="{{asset('new_dash/images/icons/account.png')}}" alt="" /></a>
                <a href="" class="mx-2"><img src="{{asset('new_dash/images/icons/notifications.png')}}" alt="" /></a>
              </div>
            </div>
          </div>
          <div id="page-content" class="container-fluid mt-5">
            <div class="row">
              <div class="col-2 p-0">
                <div class="card-background w-100 h-100 p-4 ps-5 zoom">
                  <h1>{{ App\Models\Stores::count() }}</h1>
                  <div class="mb-2">
                    <img src="{{asset('new_dash/images/icons/vendors.png')}}" alt="" class="me-1" />
                    <span>إجمالي المتاجر</span>
                  </div>
                </div>
              </div>
              <div class="col-2 p-0">
                <div class="card-background w-100 h-100 p-4 ps-5 zoom">
                  <h1>{{ App\Models\Famous::count() }}</h1>
                  <div class="mb-2">
                    <img src="{{asset('new_dash/images/icons/account.png')}}" alt="" class="me-1" />
                    <span>اجمالي عدد المشاهير</span>
                </div>
                </div>
              </div>
              <div class="col-2 p-0">
                <div class="card-background w-100 h-100 p-4 ps-5 zoom">
                  <h1>{{ App\Models\Code::count() }}</h1>
                  <div class="mb-2">
                    <img src="{{asset('new_dash/images/icons/inactive-coupons.png')}}" alt="" class="me-1" />
                    <span>اجمالي اكواد الخصم </span>
                </div>
                </div>
              </div>
              <div class="col-2 p-0">
                <div class="card-background w-100 h-100 p-4 ps-5 zoom">
                  <h1>{{ active_code_count() }}</h1>
                  <div class="mb-2">
                    <img src="{{asset('new_dash/images/icons/discount-coupons.png')}}" alt="" class="me-1" />
                    <span>  اكواد  الفعالة</span>
                </div>
                </div>
              </div>
              <div class="col-2 p-0">
                <div class="card-background w-100 h-100 p-4 ps-5 zoom">
                  <h1>{{ deactive_code_count() }}</h1>
                  <div class="mb-2">
                    <img src="{{asset('new_dash/images/icons/discount-coupons.png')}}" alt="" class="me-1" />
                    <span>  اكواد  الغير فعالة</span>
                </div>
                </div>
              </div>

              <div class="col-2 p-0 flex-column flex-center justify-content-between p-4">
                <a class="btn btn-primary btn-lg w-100">
                  <img src="{{asset('new_dash/images/icons/add-vendor.png')}}" alt="" class="me-1" />
                  اضافة متجر
                </a>
                <a class="btn btn-secondary btn-lg w-100">
                  <img src="{{asset('new_dash/images/icons/famous-addon.png')}}" alt="" class="me-1" />
                  اضافة مشهوره
                </a>
              </div>
            </div>
            <div class="filters mt-3">
              <form action="">
                <div class="d-flex">
                  {{-- <div class="flex-basis-20 pe-3 d-flex flex-column">
                    <label class="flex-fill" for="">البحث</label>
                    <div class="inner-addon input-group input-group-lg flex-fill">
                      <img src="{{asset('new_dash/images/icons/search.png')}}" class="icon" />
                      <input type="text" class="form-control" />
                    </div>
                  </div> --}}
                  <div class="flex-basis-20 pe-3 d-flex flex-column">
                    <label class="flex-fill" for="">المتجر</label>
                    <div class="input-group input-group-lg flex-fill">
                        <select name="store_id" required class="form-control" id="select_store">
                            <option value="" selected disabled>اختر المتجر</option>

                            @foreach (App\Models\Stores::get() as $item)
                                <option value="{{ $item->id }}">{{ $item->title }} </option>
                            @endforeach

                        </select>
                    </div>
                  </div>
                  <div class="flex-basis-20 pe-3 d-flex flex-column">
                    <label class="flex-fill" for="">المشهور</label>
                    <div class="input-group input-group-lg flex-fill">
                        @if (auth()->user()->hasRole('Admin'))
                        <select name="famous_id" required class="form-control">
                            <option value="" selected disabled>اختر المشهور </option>

                            @foreach (App\Models\Famous::get() as $item)
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
                  <div class="flex-basis-20 pe-3 d-flex flex-column">
                    <label class="flex-fill flex-grow-0" for="">نسبة كود الخصم</label>
                    <div id="slider-outer-div" class="flex-fill rounded-3">
                      <div id="slider-max-label" class="slider-label"></div>
                      <div id="slider-min-label" class="slider-label"></div>
                      <div id="between-handlers"></div>
                      <div id="slider-div">
                        <div class="slider-start">1%</div>
                        <div>
                          <input id="ex2" type="text" data-slider-min="1" data-slider-max="100" data-slider-value="[50,75]" data-slider-tooltip="hide" />
                        </div>
                        <div class="slider-end">100%</div>
                      </div>
                    </div>
                  </div>
                  <div class="flex-basis-20 align-items-end d-flex">
                    <span class="p-2 border rounded-3">
                        <button type="submit"><img src="{{asset('new_dash/images/icons/filters.png')}}" alt="" /> </button>
                      
                    </span>
                  </div>
                </div>
              </form>
            </div>
            <div class="content mt-5">
              <div class="border-top border-secondary">
                
                <table id="example" class="row-border" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col"> اسم المتجر</th>
                            <th scope="col"> اسم كود الخصم </th>
                            <th scope="col">اسم المشهور</th>
                            <th scope="col">نسبة كود الخصم</th>
                            <th scope="col">فايدة اسخدام الكود</th>
                            <th scope="col">نسبة كودك</th>
                            <th scope="col">نسبة المشهور</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach (App\Models\Code::orderBy('id','desc')->get() as $item)
                            <tr style="text-align: center">
                                <td>{{ $item->store->title }} </td>
                                <td>{{ @$item->code  }}</td>
                                <td>{{ @$item->famous->name }}</td>
                                <td>{{ @$item->discount_percentage }} %</td>
                                <td>{{ @$item->store->benift }} %</td>
                                <td>{{ @$item->system_percentage }} %</td>
                                <td>{{ @$item->famous_percentage }} %</td>
                            </tr> 
                            @endforeach
                       
                       
                      
                        


                    </tbody>
                    <tr>
                        <td style="font-size: 30px;text-align: center;">
                            <a title="اضف جديد" data-toggle="modal" class="btn btn-success" data-target="#myModal3">اضف جديد</a></td>
                        <td></td> 
                        <td></td> 
                        <td></td> 
                        <td></td> 
                        <td></td> 
                        <td></td> 
                    </tr>
                </table>
              </div>
           
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="{{asset('new_dash/lib/jquery/jquery-3.6.1.min.js')}}"></script>
    <script src="{{asset('new_dash/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('new_dash/lib/bootstrap-slider/bootstrap-slider.min.js')}}"></script>

    <script src="{{asset('new_dash/all/js/scripts.js')}}"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
    $('table').DataTable();
} );
    </script>
  </body>
</html>
