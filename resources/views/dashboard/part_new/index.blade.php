@extends('layouts.backend_new')
@section('content')
    <div class="row">
        <div class="col-2 p-0">
            <div class="card-background w-100 h-100 p-4 ps-5 zoom">
                <h1>{{ App\Models\Stores::count() }}</h1>
                <div class="mb-2">
                    <img src="{{ asset('new_dash/images/icons/vendors.png') }}" alt="" class="me-1" />
                    <span>إجمالي المتاجر</span>
                </div>
            </div>
        </div>
        <div class="col-2 p-0">
            <div class="card-background w-100 h-100 p-4 ps-5 zoom">
                <h1>{{ App\Models\Famous::count() }}</h1>
                <div class="mb-2">
                    <img src="{{ asset('new_dash/images/icons/account.png') }}" alt="" class="me-1" />
                    <span>اجمالي عدد المشاهير</span>
                </div>
            </div>
        </div>
        <div class="col-2 p-0">
            <div class="card-background w-100 h-100 p-4 ps-5 zoom">
                <h1>{{ App\Models\Code::count() }}</h1>
                <div class="mb-2">
                    <img src="{{ asset('new_dash/images/icons/inactive-coupons.png') }}" alt="" class="me-1" />
                    <span>اجمالي اكواد الخصم </span>
                </div>
            </div>
        </div>
        <div class="col-2 p-0">
            <div class="card-background w-100 h-100 p-4 ps-5 zoom">
                <h1>{{ active_code_count() }}</h1>
                <div class="mb-2">
                    <img src="{{ asset('new_dash/images/icons/discount-coupons.png') }}" alt="" class="me-1" />
                    <span> اكواد الفعالة</span>
                </div>
            </div>
        </div>
        <div class="col-2 p-0">
            <div class="card-background w-100 h-100 p-4 ps-5 zoom">
                <h1>{{ deactive_code_count() }}</h1>
                <div class="mb-2">
                    <img src="{{ asset('new_dash/images/icons/discount-coupons.png') }}" alt="" class="me-1" />
                    <span> اكواد الغير فعالة</span>
                </div>
            </div>
        </div>

        <div class="col-2 p-0 flex-column flex-center justify-content-between p-4">
            <a class="btn btn-primary btn-lg w-100 add" data-bs-toggle="modal" data-bs-target="#addStore">
                <img src="{{ asset('new_dash/images/icons/add-vendor.png') }}" alt="" class="me-1" />
                اضافة متجر
            </a>
            <a class="btn btn-secondary btn-lg w-100" data-bs-toggle="modal" data-bs-target="#addFamous">
                <img src="{{ asset('new_dash/images/icons/famous-addon.png') }}" alt="" class="me-1" />
                اضافة مشهور
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
                            <input type="hidden" name="famous_id" value="{{ auth()->user()->famous->id }}" readonly
                                class="form-control" id="email">
                            <input type="text" class="form-control" readonly value="{{ auth()->user()->famous->name }}"
                                id="">
                        @endif
                    </div>
                </div>

                <div class="flex-basis-20 align-items-end d-flex">
                    <span class="p-2 border rounded-3">
                        <button type="submit"><img src="{{ asset('new_dash/images/icons/filters.png') }}"
                                alt="" /> </button>

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
                    @foreach (App\Models\Code::orderBy('id', 'desc')->get() as $item)
                        <tr style="text-align: center">
                            <td>{{ $item->store->title }} </td>
                            <td>{{ @$item->code }}</td>
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
                        <a title="اضف جديد" data-toggle="modal" class="btn btn-success" data-target="#myModal3">اضف جديد</a>
                    </td>
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
    <div class="modal fade" id="addStore" tabindex="-1" aria-labelledby="addStoreLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStoreLabel">
                        <img src="{{ asset('new_dash/images/icons/vendors.png') }}" alt="" class="me-1"> إضافة
                        متجر
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="storeform">
                        @csrf
                        <div class="input-item">
                            <label for="">اسم المتجر بالعربي <span class="text-danger">*</span></label>
                            <input type="text" name="title_ar" required class="form-control"
                                value="{{ old('title_ar') }}" id="title_ar">
                        </div>

                        <div class="input-item">
                            <label for="">اسم المتجر بالانجليزي<span class="text-danger">*</span></label>
                            <input type="text" name="title_en" required class="form-control"
                                value="{{ old('title_en') }}" id="title_en">
                        </div>

                        <div class="input-item">
                            <label for="">رابط الربط للمتجر (API)<span class="text-danger">*</span> </label>
                            <input type="text" name="api_link" value="{{ old('api_link') }}" class="form-control"
                                id="api_link">
                        </div>

                        <div class="input-item">
                            <label for="">
                                فائدة استخدام الكود :</label><span class="text-danger">*</span>
                            <input type="text" name="benift" value="{{ old('benift') }}" class="form-control"
                                id="benift">
                        </div>

                        <div class="input-item">
                            <label for="">رقم السجل التجاري</label>
                            <input type="number" name="commercial_register" value="{{ old('commercial_register') }}"
                                class="form-control" id="commercial_register">
                        </div>

                        <div class="input-item">
                            <label for="">الموقع الالكتروني</label>
                            <input type="text" name="website" value="{{ old('website') }}" class="form-control"
                                id="website">
                        </div>


                        <div class="input-item">
                            <label for="">رابط تطبيق الاندرويد</label>
                            <input type="text" name="android" value="{{ old('android') }}" class="form-control"
                                id="android">
                            <img src="{{ asset('new_dash/images/icons/android.png') }}" alt=""
                                class="me-1 android-img">
                        </div>

                        <div class="input-item">
                            <label for="">رابط تطبيق الآيفون</label>
                            <input type="text" name="ios" value="{{ old('ios') }}" class="form-control"
                                id="ios">
                            <img src="{{ asset('new_dash/images/icons/apple.png') }}" alt=""
                                class="me-1 apple-img">
                        </div>

                        <div class="input-item">
                            <label for="file">صورة الشعار<span class="text-danger">*</span></label>

                            <label class="custom-file-upload d-block form-control p-0"
                                style="height:46px; direction: ltr;">
                                <input type="file" id="imagestore" required name="image" />
                                <span class="border h-100 upload-img">رفع صورة <img
                                        src="{{ asset('new_dash/images/icons/upload.png') }}" alt=""
                                        class="me-1"></span> <img src="{{ asset('new_dash/images/icons/img.png') }}"
                                    alt="" class="me-1 ms-2 " width="20">
                            </label>
                        </div>

                        <div class="input-item">
                            <button class="btn text-end add-store">+ اضافة متجر</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="addFamous" tabindex="-1" aria-labelledby="addFamousLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFamousLabel">
                        <img src="{{ asset('new_dash/images/icons/famous.png') }}" alt="" class="me-1"> إضافة
                        مشهور
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="input-item">
                            <label for=""> اسم المشهور<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="" id=""
                                placeholder="أحمد اندرويد">
                        </div>

                        <div class="input-item">
                            <label for="file">صورة المشهور<span class="text-danger">*</span></label>

                            <label class="custom-file-upload d-block form-control p-0"
                                style="height:46px; direction: ltr;">
                                <input type="file" />
                                <span class="border h-100 upload-img">رفع صورة <img
                                        src="{{ asset('new_dash/images/icons/upload.png') }}" alt=""
                                        class="me-1"></span> <img src="{{ asset('new_dash/images/icons/img.png') }}"
                                    alt="" class="me-1 ms-2 " width="20">
                            </label>
                        </div>

                        <div class="input-item">
                            <label for="">الدولة<span class="text-danger">*</span></label>
                            <div class="inner-input">
                                <select name="" id="" class="form-select">
                                    <option value="" selected>السعودية</option>
                                    <option value="">قطر</option>
                                    <option value="">الامارات</option>
                                </select>

                                <button class="stop" data-bs-dismiss="modal" data-bs-toggle="modal"
                                    data-bs-target="#addCountry"><img src="{{ asset('new_dash/images/icons/doc.png') }}"
                                        alt="" class="me-2">اضف دولة </button>


                            </div>
                        </div>


                        <div class="input-item">
                            <label for="">رقم التواصل</label>
                            <input type="number" class="form-control" name="" id=""
                                placeholder="58922325322">
                        </div>

                        <div class="input-item">
                            <label for="">البريد الالكتروني<span class="text-danger">*</span></label>
                            <input type="text" class="form-control position-relative" name="" id=""
                                placeholder="AhemdAnroid@gmail.com" dir="auto">
                        </div>

                        <div class="input-item">
                            <label for="">رقم الرخصة المهنية<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="" id=""
                                placeholder="58922325322">
                        </div>


                        <div class="input-item">
                            <label for="">هل أنت ممثل عن المشهور أم المشهور نفسه<span
                                    class="text-danger">*</span></label>
                            <select name="" id="" class="form-select">
                                <option value="" selected>المشهور نفسه</option>
                                <option value="">2</option>
                                <option value="">3</option>
                            </select>
                        </div>



                        <div class="input-item">
                            <label for="">عدد المتابعين<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="" id=""
                                placeholder="152,588">
                        </div>



                        <div class="input-item">
                            <label for="">مجال المشهور<span class="text-danger">*</span></label>
                            <div class="inner-input">
                                <select name="" id="" class="form-select">
                                    <option value="" selected>الملابس والموضة</option>
                                    <option value="">option</option>
                                    <option value="">option</option>
                                </select>

                                <button class="stop" data-bs-dismiss="modal" data-bs-toggle="modal"
                                    data-bs-target="#addField"><img src="{{ asset('new_dash/images/icons/doc.png') }}"
                                        class="me-2" alt="">أضف مجال</button>


                            </div>
                        </div>


                        <div class="input-item">
                            <label for="">فئة المتابعين<span class="text-danger">*</span></label>
                            <select name="" id="" class="form-select">
                                <option value="" selected>النساء فئة العمرية 25-35</option>
                                <option value="">النساء فئة العمرية 25-35</option>
                                <option value="">النساء فئة العمرية 25-35</option>
                            </select>
                        </div>


                        <div class="input-item">
                            <label for="">عدد المشاهدات<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="" id=""
                                placeholder="150,000">
                        </div>



                        <div class="input-item">
                            <label for="">instagram</label>
                            <input type="text" class="form-control position-relative" name="" id=""
                                placeholder="@Alarbia_SA" dir="auto">
                            <img src="{{ asset('new_dash/images/icons/insta.png') }}" alt=""
                                class="me-1 apple-img">
                        </div>

                        <div class="input-item">
                            <label for="">Tiktok</label>
                            <input type="text" class="form-control position-relative" name="" id=""
                                placeholder="@Alarbia" dir="auto">
                            <img src="{{ asset('new_dash/images/icons/tiktok.png') }}" alt=""
                                class="me-1 apple-img">
                        </div>



                        <div class="input-item">
                            <label for="">أضف منصة أخرى<span class="text-danger">*</span></label>
                            <div class="inner-input">
                                <select name="" id="" class="form-select">
                                    <option value="" selected>اليوتيوب</option>
                                    <option value="">اليوتيوب</option>
                                    <option value="">اليوتيوب</option>
                                </select>

                                <button class="stop" data-bs-dismiss="modal" data-bs-toggle="modal"
                                    data-bs-target="#addPlatform"><img src="{{ asset('new_dash/images/icons/doc.png') }}"
                                        class="me-2" alt="">أضف منصة</button>


                            </div>
                        </div>



                        <div class="input-item">
                            <label for="">Snapchat</label>
                            <input type="text" class="form-control position-relative" name="" id=""
                                placeholder="@Alarbia" dir="auto">
                            <img src="{{ asset('new_dash/images/icons/snapchat.png') }}" alt=""
                                class="me-1 apple-img">
                        </div>



                        <div class="input-item">
                            <button class="btn text-end add-store">+ اضافة مشهور</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#storeform').on('submit', function(e) {
            e.preventDefault();
            var frm = $('#storeform');
            var formData = new FormData(frm[0]);
            formData.append('file', $('#imagestore')[0].files[0]);

            var data = $(this).serialize();

            $.ajax({
                url: "{{ route('stores.store') }}",
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    // var table = $('#stores').DataTable();




                    document.getElementById("storeform").reset();
                    $('#storesmodal').modal('hide')
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
    </script>
@endsection
