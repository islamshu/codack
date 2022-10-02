@extends('layouts.backend_new')
@section('content')
@if(auth()->user()->hasRole('Admin'))
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
    
    <div class="content mt-5">
        <div class="border-top border-secondary">

            <table id="example" class="row-border" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-right"> اسم المتجر</th>
                        <th class="text-right"> اسم كود الخصم </th>
                        <th class="text-right">اسم المشهور</th>
                        <th class="text-right">نسبة كود الخصم</th>
                        <th class="text-right">فايدة اسخدام الكود</th>
                        <th class="text-right">نسبة كودك</th>
                        <th class="text-right">نسبة المشهور</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\Code::orderBy('id', 'desc')->get() as $item)
                        <tr style="text-align: center">
                            <td class="text-right">{{ $item->store->title }} </td>
                            <td class="text-right">{{ @$item->code }}</td>
                            <td class="text-right">{{ @$item->famous->name }}</td>
                            <td class="text-right">{{ @$item->discount_percentage }} %</td>
                            <td class="text-right">{{ @$item->store->benift }} %</td>
                            <td class="text-right">{{ @$item->system_percentage }} %</td>
                            <td class="text-right">{{ @$item->famous_percentage }} %</td>
                        </tr>
                    @endforeach






                </tbody>
                <tr>
                    <td style="font-size: 30px;text-align: center;">
                        <a title="اضف جديد" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDisCode">اضف جديد</a>
                    </td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                </tr>
            </table>
        </div>

    </div>
    </div>
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
    
                    @foreach (App\Models\Stores::get() as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->title }}</option>
                
                    @endforeach
    
                </select>
                </div>
    
    
    
                <div class="input-item">
                  <label for="">المشهور</label>
                  @if (auth()->user()->hasRole('Admin'))
                  
    
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
    <div class="modal" id="myModalsocail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"> اضف جديد </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                    <div id="form-errors" class="text-center"></div>
                    <div id="success" class="text-center"></div>
                    <form id="sendsocail">
                        @csrf

                        <div class="input-item">
                            <label for="">اسم المنصة بالعربي <span class="text-danger">*</span></label>
                            <input type="text" name="title_ar" required class="form-control"
                                value="{{ old('title_ar') }}" id="title_ar">
                        </div>
                    
                        <div class="input-item">
                            <label for="">اسم المنصة بالانجليزي<span class="text-danger">*</span></label>
                            <input type="text" name="title_en" required class="form-control"
                                value="{{ old('title_en') }}" id="title_en">
                        </div>
                    
                        
                        <div class="input-item">
                            <label for="file">أيفونة المنصة <span class="text-danger">*</span></label>
                    
                            <label class="custom-file-upload d-block form-control p-0"
                                style="height:46px; direction: ltr;">
                                <input type="file" id="imagestore" required name="icon" />
                                <span class="border h-100 upload-img">رفع صورة <img
                                        src="{{ asset('new_dash/images/icons/upload.png') }}" alt=""
                                        class="me-1"></span> <img src="{{ asset('new_dash/images/icons/img.png') }}"
                                    alt="" class="me-1 ms-2 " width="20">
                            </label>
                        </div>



                        <div class="input-item">
                            <button class="btn text-end add-store">+ اضافة منصة</button>
                        </div>
                                        </form>

                </div>



                <!-- Modal footer -->
               

            </div>
        </div>

    </div>
    <div class="modal fade" id="addFamous" tabindex="-1" aria-labelledby="addFamousLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addFamousLabel">
                <img src="{{asset('new_dash/images/icons/famous.png')}}" alt="" class="me-1"> إضافة مشهور
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="form-errors" class="text-center"></div>
                <div id="success" class="text-center"></div>
                <form id="sendmemessage">
                    @csrf
                <div class="input-item">
                  <label for=""> اسم المشهور<span class="text-danger">*</span></label>
                  <input type="text" name="name" required class="form-control"
                  value="{{ old('name') }}" id="name">   
                    </div>
    
                <div class="input-item">
                  <label for="file">صورة المشهور<span class="text-danger">*</span></label>
    
                  <label class="custom-file-upload d-block form-control p-0" style="height:46px; direction: ltr;">
                    <input type="file" type="file" name="image" required class="form-control"
                    value="{{ old('image') }}" id="image" />
                    <span class="border h-100 upload-img">رفع صورة <img src="{{asset('new_dash/images/icons/upload.png')}}" alt=""
                        class="me-1"></span> <img src="{{asset('new_dash/images/icons/img.png')}}" alt="" class="me-1 ms-2 " width="20">
                  </label>
                </div>
    
                <div class="input-item">
                  <label for="">الدولة<span class="text-danger">*</span></label>
                  <div class="inner-input">
                    <select name="country_id" id="country_id" class="form-control">
                        <option value="" selected disabled>اختر دولة</option>
                        @foreach (App\Models\Country::get() as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                    </select>
    
                    <button class="stop" type="button"  style="width:50%" id="addcountry" ><img
                        src="{{asset('new_dash/images/icons/doc.png')}}" alt="" class="me-2">اضف دولة </button>
    
    
                  </div>
                </div>
    
    
                <div class="input-item">
                  <label for="">رقم التواصل</label>
                  <input type="text" maxlength="10" onkeypress=" return isNumber(event)" minlength="10" name="phone" required class="form-control form-control-lg input-lg"
                  id="iconLeft3">
                </div>
    
                <div class="input-item">
                  <label for="">البريد الالكتروني<span class="text-danger">*</span></label>
                  <input type="email" name="email" required class="form-control"
                  value="{{ old('email') }}" id="email">
                </div>
    
                <div class="input-item">
                  <label for="">رقم الرخصة المهنية<span class="text-danger">*</span></label>
                  <input type="text" name="professional_license_number" required class="form-control"
                  value="{{ old('professional_license_number') }}" id="professional_license_number">
                </div>
    
    
                <div class="input-item">
                  <label for="">هل أنت ممثل عن المشهور أم المشهور نفسه<span class="text-danger">*</span></label>
                  <select name="is_famous" id="select_is_famous" required class="form-control">
                    <option value="">اختر </option>
                    <option value="1">المشهور نفسه</option>
                    <option value="2">ممثل عن المشهور </option>
                </select>
                </div>
                <div class="row is_famous_show "style="display: none">
                    <div class="input-item">
                        <label for="email"> اسم ممثل المشهور   : <span class="required">*</span></label>
                        <input type="text" name="name_actor"  class="form-control"
                            value="{{ old('name_actor') }}" id="name_actor">
                      </div>   
                      <div class="input-item" style="margin-top: 8px">
                        <label for="email"> رقم ممثل المشهور   : <span class="required">*</span></label>
                        <input type="number" name="phone_actor"  class="form-control">

                      </div>  
                   
                </div>
    
    
    
                <div class="input-item">
                  <label for="">عدد المتابعين<span class="text-danger">*</span></label>
                  <input type="number" name="followers_number"  class="form-control"
                                    value="{{ old('followers_number') }}" id="followers_number">
                </div>
    
    
    
                <div class="input-item">
                  <label for="">مجال المشهور<span class="text-danger">*</span></label>
                  <div class="inner-input">
                    <select required class="selectpicker form-control" id="is_famousselect" name="famoustype_id[]"
                                 multiple="multiple">
                                <option value="" disabled> اختر المجال</option>

                                @foreach (App\Models\FamousType::get() as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
    
                    <button class="stop" type="button" id="addscope"  style="width:50%"><img
                        src="{{asset('new_dash/images/icons/doc.png')}}" class="me-2" alt="">أضف مجال</button>
    
    
                  </div>
                </div>
    
    
                <div class="input-item">
                  <label for="">فئة المتابعين<span class="text-danger">*</span></label>
                  <select name="follower_type[]" class="selectpicker form-control" required  id="follower_type"  multiple="multiple">
                    <option value="" disabled>اختر </option>
                    <option value="male">رجال</option>
                    <option value="femail">نساء </option>
                    <option value="children"> أطفال</option>

                </select>
                </div>
    
    
                <div class="input-item">
                  <label for="">عدد المشاهدات<span class="text-danger">*</span></label>
                  <input type="number" name="views_number"  class="form-control"
                                    value="{{ old('views_number') }}" id="views_number">
                </div>
    
    
    
                <div class="input-item">
                    <label for="">Instagram</label>
                    <input type="text" name="instagram" placeholder="www.instagram.com"
                    class="form-control position-relative" dir="auto" id="instagram">                    <img src="{{asset('new_dash/images/icons/insta.png')}}" alt="" class="me-1 apple-img">
                  </div>
    
                <div class="input-item">
                    <label for="">Tiktok</label>
                    <input type="text"name="tiktok" dir="auto" placeholder="www.tiktok.com" class="form-control position-relative"
                    id="tiktok">
                    <img src="{{asset('new_dash/images/icons/tiktok.png')}}" alt="" class="me-1 apple-img">
                  </div>
                <div class="input-item">
                    <label for="">Snapchat</label>
                    <input type="text" name="snapchat" dir="auto" placeholder="www.snapchat.com" class="form-control position-relative"
                                        id="snapchat">
                    <img src="{{asset('new_dash/images/icons/snapchat.png')}}" alt="" class="me-1 apple-img">
                  </div>

                
    
    
    
                <div class="input-item">
                  <label for="">أضف منصة أخرى<span class="text-danger">*</span></label>
                  <div class="inner-input">
                    <select id="get_soical_media" class="form-control sosialselect">
                        <option value="">اختر المنصة</option>
                        @foreach (App\Models\SoicalType::get() as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
    
                    <button class="add_sss"  style="width:50%" type="button" ><img  src="{{asset('new_dash/images/icons/doc.png')}}" class="me-2" alt="">أضف منصة</button>
    
    
                  </div>
                </div>
                <div class="input-item" style="visibility: hidden">
                    <label for="">Tiktok</label>
                    <input >
                    <img src="{{asset('new_dash/images/icons/tiktok.png')}}" alt="" class="me-1 apple-img">
                  </div>
                  <div class="input-item" style="visibility: hidden">
                    <label for="">Tiktok</label>
                    <img src="{{asset('new_dash/images/icons/tiktok.png')}}" alt="" class="me-1 apple-img">
                  </div>
                
                <div id="soical_item" >





                </div>
    
    
    
               
    
    
    
                <div class="input-item">
                  <button class="btn text-end add-store">+ اضافة مشهور</button>
                </div>
    
              </form>
            </div>
    
          </div>
        </div>
      </div>
      <div class="modal fade" id="addCountry" tabindex="-1" aria-labelledby="addCountrylabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addCountrylabel">
                <img src="{{asset('new_dash/images/icons/doc.png')}}" alt="" class="me-1"> أضف دولة
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal"
                data-bs-target="#addFamous"></button></button>
            </div>
            <div class="modal-body">
                <form id="addcountryform">
                    @csrf
                <div class="input-item">
                  <label for="">اسم الدولة<span class="text-danger">*</span></label>
                  <input type="text" name="title_en" autocomplete="off" data-country-id="0" class="form-control" id="country"
                  placeholder="اضف الدولة  ">    
                  <div id="full_data"></div>
                </div>
                <div class="col-md-3" id="country_info"></div>

    
                <div class="input-item">
                  <button class="btn text-end add-store">+ إضافة دولة</button>
                </div>
    
              </form>
            </div>
    
          </div>
        </div>
      </div>
      <div class="modal fade" id="addPlatform" tabindex="-1" aria-labelledby="addPlatformLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addPlatformLabel">
                <img src="{{asset('new_dash/images/icons/famous.png')}}" alt="" class="me-1"> إضافة مجال
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal"
                data-bs-target="#addFamous"></button></button>
            </div>
            <div class="modal-body">
                <form id="addfamoustpye">
                    @csrf
                    <div class="input-item">
                        <label for="">اسم المجال بالعربي <span class="text-danger">*</span></label>
                        <input type="text" name="title_ar" required class="form-control"
                            value="{{ old('title_ar') }}" id="title_ar">
                    </div>
                
                    <div class="input-item">
                        <label for="">اسم المجال بالانجليزي<span class="text-danger">*</span></label>
                        <input type="text" name="title_en" required class="form-control"
                            value="{{ old('title_en') }}" id="title_en">
                    </div>
                
                
                    <div class="input-item">
                        <button type="submit" class="btn text-end add-store">+ اضافة مجال</button>
                    </div>
                
                </form>
            </div>
    
          </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-2 p-0">
            <div class="card-background w-150 h-100 p-4 ps-5 zoom">
                <h2>{{ App\Models\Code::where('famous_id',auth()->user()->famous->id)->sum('total_famous') }}</h2>
                <div class="mb-2">
                    <img src="{{ asset('new_dash/images/icons/vendors.png') }}" alt="" class="me-1" />
                    <span>إجمالي المحفظة</span>
                </div>
            </div>
        </div>
        <div class="col-2 p-0">
            <div class="card-background w-100 h-100 p-4 ps-5 zoom">
                <h2>{{ App\Models\Code::where('famous_id',auth()->user()->famous->id)->sum('total_trans') }}</h1>
                <div class="mb-2">
                    <img src="{{ asset('new_dash/images/icons/account.png') }}" alt="" class="me-1" />
                    <span> ما تم تحويله </span>
                </div>
            </div>
        </div>
        <div class="col-2 p-0">
            <div class="card-background w-100 h-100 p-4 ps-5 zoom">
                <h2>{{ App\Models\Code::where('famous_id',auth()->user()->famous->id)->sum('total_pending') }}</h1>
                <div class="mb-2">
                    <img src="{{ asset('new_dash/images/icons/inactive-coupons.png') }}" alt="" class="me-1" />
                    <span>المبالغ المعلقة   </span>
                </div>
            </div>
        </div>
       

    </div>
    <div class="content mt-5">
        <div class="border-top border-secondary">

          
            <table   style="width:100%" id="example">


                <br>
                <thead>
                    <tr>
                        <th class="text-right">#</th>
                        <th class="text-right">اسم المتجر  </th>
                        <th class="text-right">اسم المشهور </th>
                        <th class="text-right">الكود</th>
                        <th class="text-right">الاجمالي</th>
                        <th class="text-right">ما تم تحويله</th>
                        <th class="text-right">المبلغ المعلق</th>
                        <th class="text-right">المتبقي </th>
                        <th class="text-right">الاجراءات</th>

                    </tr>
                </thead>
                <tbody >
                        @foreach (App\Models\Code::where('famous_id',auth()->user()->famous->id)->orderby('id','desc')->get() as $key=> $item)
                        <tr>
                            <td class="text-right">{{ $key }}</td>
                            <td class="text-right">{{ @$item->store->title }}</td>
                            <td class="text-right">{{ @$item->famous->name }}</td>
                            <td class="text-right">{{ $item->code }}</td>
                            <td class="text-right">{{ get_total_famous_code_api($item->id) }} </td>
                            <td class="text-right">{{ $item->total_trans }}</td>
                            <td class="text-right">{{  $item->total_pending }}</td>
                            <td class="text-right">{{ number_format(get_total_famous_code_api($item->id) - $item->total_trans - $item->total_pending, 3)  }}</td>
                            <td class="text-right">
                                <button class="btn " data-toggle="modal" data-target="#myModal20"
                                        onclick="get_wallet('{{ $item->id }}')"> <img src="{{ asset('new_dash/images/icons/view.png') }}" class="pointer w-20" alt="" /></button>
                                {{-- <a data-toggle="modal"    onclick="make('{{ $item->id }}')" data-target="#myModal20" class="btn btn-info"><i class="fa fa-cog" aria-hidden="true"></i> --}}
                                    
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    

                </tbody>

            </table>
        </div>

    </div>
    

    @endif
   
    <div class="modal fade" id="get_info" tabindex="-1" aria-labelledby="addPlatformLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPlatformLabel">
                        <img src="{{asset('new_dash/images/icons/famous.png')}}" alt="" class="me-1"> طلب تحويل مالي
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#addFamous"></button></button>
                </div>
                <div class="modal-body" id="company_edit_eddd">
                    
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
    <script>
        $( document ).ready(function() {
            var q = 0;
            $('#get_soical_media').change(function() {
            
            addRoaw($(this).val());
        
        
        
            function addRoaw(id) {
             
                $.ajax({
                url: "{{ route('get_soucal_info') }}",
                type: "get",
                data: {
                    id: id,
                },
        
                success: function(data) {
                 
                    var icon =   '/'+data['icon']; 
                    var title = data['id'];
                    var nameinput = 'addmore['+q+']['+title+']';
                    let form =`
                     <div class="input-item" style="    margin-top: 16px  !important;">
                        <button class="btn btn-danger  remove_button" style="margin-right: 67%;
                                    margin-bottom: 17px;" >حذف</button>
                        <input type="text" class="form-control position-relative" name="` + nameinput + `" id="" dir="auto">
                        <img style="position: absolute;right: 13px;top: 64%;width: 24px;" src="{{ asset('uploads/') }}` + icon + `" alt="" >
                      </div>` ;
                        
    
                            
                    q++;       
                    $('#soical_item').append(form);
                    
                  
     
                    console.log(form);               
        
        
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
            var wrapperd = $('#soical_item');
                    $(wrapperd).on('click', '.remove_button', function(e) {
                        e.preventDefault();
                        $(this).parent('div').remove();
    
                    });
                
        
        
        
              
             
        
                // $(wrapper1).on('click', '.remove_button_old', function (e) {
                //     alert('d');
                //         e.preventDefault();
                // $(this).parent('span').remove();
        
                // });
            }
            var wrapper1 = $('#partent');
            $(wrapper1).on('click', '.remove_button_old', function(e) {
                e.preventDefault();
                $(this).parent('span').remove();
            });
        
        });
    });
    </script>
        <script>
              $('#addfamoustpye').on('submit', function(e) {
                e.preventDefault();
                var frm = $('#addfamoustpye');
                var formData = new FormData(frm[0]);
    
                var data = $(this).serialize();
    
                $.ajax({
                    url: "{{ route('store_scope_for_famous') }}",
                    type: "post",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // var table = $('#stores').DataTable();
                        $('#is_famousselect').append('<option value="' + data.id +
                            '">' + data.title + '</option>');
                            $('#addPlatform').modal('hide');
                         
                        swal(
                            '',
                            ' تم الاضافة بنجاح ',
                            'success'
                        );
                        $('#addFamous').modal('show');
    
    
    
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
             $('#addcountryform').on('submit', function(e) {
                e.preventDefault();
                var frm = $('#addcountryform');
                var formData = new FormData(frm[0]);
    
                var data = $(this).serialize();
    
                $.ajax({
                    url: "{{ route('store_country_for_famous') }}",
                    type: "post",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // var table = $('#stores').DataTable();
    
                        $('#country_id').append('<option value="' + data.id +
                            '">' + data.title + '</option>');
                            $('#addCountry').modal('hide');
                         
                        swal(
                            '',
                            ' تم الاضافة بنجاح ',
                            'success'
                        );
                        $('#addFamous').modal('show');
    
    
    
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
    
            $('#sendsocail').on('submit', function(e) {
                e.preventDefault();
                var frm = $('#sendsocail');
                var formData = new FormData(frm[0]);
                formData.append('file', $('#imagestore')[0].files[0]);
    
                var data = $(this).serialize();
    
                $.ajax({
                    url: "{{ route('store_socail_for_famous') }}",
                    type: "post",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // var table = $('#stores').DataTable();
    
                        
    
    
                        document.getElementById("sendsocail").reset();
                        $('.sosialselect').append('<option value="' + data.id +
                            '">' + data.title + '</option>');
                            $('#myModalsocail').modal('hide');
                         
                        swal(
                            '',
                            ' تم الاضافة بنجاح ',
                            'success'
                        );
                        $('#addFamous').modal('show');
    
    
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
       
            
            $('#sendmemessage').on('submit', function(e) {
                e.preventDefault();
                var frm = $('#sendmemessage');
                var formData = new FormData(frm[0]);
    
                var data = $(this).serialize();
    
                $.ajax({
                    url: "{{ route('famous.store') }}",
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
                        $('#addFamous').modal('hide')
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
    
            $('#addcountry').click(function() {
                $('#addFamous').modal('hide');
                $('#addCountry').modal('show');
            });
            
            $('#addscope').click(function() {
                $('#addFamous').modal('hide');
                $('#addPlatform').modal('show');
    
            });
    
            // $('.closee').click(function() {
            //          $('#addFamous').modal('show');
            // });
    
            
            $('#country_id').change(function() {
                $.ajax({
                    url: "{{ route('get_country_code') }}",
                    type: "get",
                    data: {
                        id: $(this).val(),
                    },
    
                    success: function(data) {
                        // var table = $('#stores').DataTable();
                        let img ="{{ asset('uploads/') }}" + '/'+ data.flag;
                        let image = '  <img src="'+img+'" width="30" height="20" alt="" style="margin-top: 4px;">';
                      
    
                        let code = '<h5>' + data.code + image + '</h5>';
                        // $("#phone").val(code);
                        $(".phoneicon").empty();
                        $(".phoneicon").append(code);
    
    
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
            $('#select_is_famous').change(function() {
                let selval = $('#select_is_famous').val();
               if(selval== 2){
                $('.is_famous_show').css({display: '-webkit-box'});
                $('#name_actor').prop('required', true);   
                $('#phone_actor').prop('required', true);   
    
               }else{
                $('.is_famous_show').css({display: 'none'});
                $('#name_actor').prop('required', false);   
                $('#phone_actor').prop('required', false);   
               }
            });
            
            $('.closemodal').click(function() {
                document.getElementById("sendmemessage").reset();
            });
            
    
            function make(id) {
                $("#myModal4").show();
    
                // $('#staticBackdrop').modal();
                $('.c-preloader').show();
    
                $.ajax({
                    type: 'post',
                    url: "{{ route('get_form_famoustype') }}",
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
          <script type="text/javascript">
            $(document).ready(function() {
                var i = -1;
                $('.add_row').on('click', function() {
                    addRow();
                });
    
                function addRow() {
                    ++i;
                    const sum = i + 1;
    
    
    
                    let form = `
                        <span class="test">
                        <div class="card-body" >
                            <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>اسم المنصة :</label>
                                    <select name="addmore[` + i + `][name_socal]" class="form-control sosialselect">
                                        <option value="">اختر المنصة</option>
                                        @foreach (App\Models\SoicalType::get() as $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endforeach
                                    </select>
    
                                </div>
                            </div>
                            <div class="col-md-2 mt-2 col-sm-2 form-group ">
                                    <button type="button" class="btn btn-info add_sss" > <i class="fa fa-plus"></i></button>
                            </div>
                           
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الرابط :</label>
                                    <input type="text"
                                        class="form-control "
                                        id="url" name="addmore[` + i + `][url]" required />
    
                                </div>
                            </div>
                          
                            
                        </div>
    
    
    
                        </div>
                        <div class="col-md-2">
                                <button type="button" class="remove_button btn btn-danger delete-confirm " title="Remove field"><i class="fa fa-trash"></i></button>
                        </div>
                        </span>
                        `;
                    $('#extra').append(form);
                    var wrapper = $('#extra');
                    $(wrapper).on('click', '.remove_button', function(e) {
                        e.preventDefault();
                        $(this).parent('div').parent('span').remove();
    
                    });
    
                    // $(wrapper1).on('click', '.remove_button_old', function (e) {
                    //     alert('d');
                    //         e.preventDefault();
                    // $(this).parent('span').remove();
    
                    // });
                }
                var wrapper1 = $('#partent');
                $(wrapper1).on('click', '.remove_button_old', function(e) {
                    e.preventDefault();
                    $(this).parent('span').remove();
                });
            });
            
            $(document).on("click",".add_sss",function(){
                $('#addFamous').modal('hide');
                $('#myModalsocail').modal('show');
        });
        </script>
       <script>
        function autocomplete(inp, arr, fullarr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function (e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        
                        b = document.createElement("a");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' data-country-id=" + i + " value='" + arr[i] + "'>";
                        b.innerHTML += "<br>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function (e) {
                            // $('#country').data('country-id', 200);
    
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            inp.dataset.countryId = this.getElementsByTagName("input")[0].dataset
                                .countryId;
    
                            var txt = document.getElementById("full_data");
                            txt.innerHTML = '';
                            var country_info = document.getElementById("country_info");
                            country_info.innerHTML = '';
    
    
                            txt.innerHTML += "<input type='hidden' name='flag' value='" + fullarr[inp
                                .dataset.countryId].flag + "'>";
                            txt.innerHTML += "<input type='hidden' name='alpha2Code' value='" + fullarr[
                                inp.dataset.countryId].alpha2Code + "'>";
                            txt.innerHTML += "<input type='hidden' name='alpha3Code' value='" + fullarr[
                                inp.dataset.countryId].alpha3Code + "'>";
                            txt.innerHTML += "<input type='hidden' name='code' value='" +
                                fullarr[inp.dataset.countryId].callingCodes[0] + "'>";
                            txt.innerHTML += "<input type='hidden' name='title_ar' value='" + fullarr[
                                inp.dataset.countryId].nativeName + "'>";
                            txt.innerHTML += "<input type='hidden' name='lat' value='" + parseFloat(
                                fullarr[inp.dataset.countryId].latlng[0]) + "'>";
                            txt.innerHTML += "<input type='hidden' name='lng' value='" + fullarr[inp
                                .dataset.countryId].latlng[1] + "'>";
                            txt.innerHTML += "<input type='hidden' name='name' value='" + fullarr[inp
                                .dataset.countryId].name + "'>";
    
                            country_info.innerHTML += `
                    <div class="card">
                        <div class="header">
                          <h2>Country Info</h2>
                        </div>
                        <div class="body text-center">
                            <div class="circle">
                                <img style="max-width: 150px;" src="` + fullarr[inp.dataset.countryId].flag + `" alt="">
                            </div>
                            <h6 class="mt-3 mb-0">` + fullarr[inp.dataset.countryId].name + ` | ` + fullarr[inp.dataset
                                .countryId].nativeName + `</h6>
                            <div>country code ` + fullarr[inp.dataset.countryId].alpha2Code + `</div>
                            <div>phone code ` + fullarr[inp.dataset.countryId].callingCodes[0] + `</div>
                            <div>lat ` + (fullarr[inp.dataset.countryId].latlng[0]) + `</div>
                            <div>lat ` + fullarr[inp.dataset.countryId].latlng[1] + `</div>
                        </div>
                    </div>`;
    
    
                            inp.parentNode.insertBefore(txt, inp.nextSibling);
    
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function (e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });
    
            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }
    
            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }
    
            function closeeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function (e) {
                closeeAllLists(e.target);
            });
        }
    
    </script>
    
    <script type="text/javascript">
        $(document).ready(function () {
    
            var allData = null;
    
            $.ajax({
                'type': "GET",
                'dataType': 'json',
                'async': false,
                'url': "https://restcountries.com/v2/all",
                'success': function (data) {
                    allData = data;
                }
            });
            console.log(allData);
            countries = [];
            $.each(allData, function (i) {
                countries[i] = allData[i].nativeName;
            });
    
            // /*An array containing all the country names in the world:*/
            // var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
    
            // /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
            autocomplete(document.getElementById("country"), countries, allData);
    
            $('body form').on('submit', function () {
    
            });
            var msg = "{{Session::get('success_msg')}}";
            var exist = "{{Session::has('success_msg')}}";
            if (exist) {
                alertify.success(msg);
            }
        });
       
    
    </script>
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
            function get_wallet(id) {


                $("#get_info").modal('show');

                // $('#staticBackdrop').modal();
                $('.c-preloader').show();

                $.ajax({
                    type: 'get',
                    url: "{{ route('get_waalet_transfare') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': id
                    },
                    beforeSend: function() {},
                    success: function(data) {
                        $('#company_edit_eddd').html(data);


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
