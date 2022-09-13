@extends('layouts.backend')
@section('content')
@if(auth()->user()->hasRole('Admin'))

<div class="content-body">
    <section id="minimal-statistics-bg">

        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="radies card bg-secondary">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center" style="margin-right:10%">
                                    <i class="fa fa-building   text-white font-large-2 float-right"></i>
                                </div>
                                <div class="media-body text-white text-right" style="margin-left: 33px;">
                                    <h3 class="text-white">{{ App\Models\Stores::count() }}</h3>
                                    <span> اجمالي المتاجر   </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="radies card bg-info">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center" style="margin-right:10%">
                                    <i class="fa fa-user text-white font-large-2 float-right"></i>
                                </div>
                                <div class="media-body text-white text-right" style="margin-left: 33px;">
                                    <h3 class="text-white">{{ App\Models\Famous::count() }}</h3>
                                    <span>اجمالي عدد المشاهير</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="radies card bg-danger">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center" style="margin-right:10%">
                                    <i class="fa fa-eercast text-white font-large-2 float-right"></i>
                                </div>
                                <div class="media-body text-white text-right" style="margin-left: 33px;">
                                    <h3 class="text-white">{{ App\Models\Code::count() }}</h3>
                                    <span>اجمالي اكواد الخصم </span>
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
                                    <i class="fa fa-play text-white font-large-2 float-right"></i>
                                </div>
                                <div class="media-body text-white text-right" style="margin-left: 33px;">
                                    <h3 class="text-white">{{ active_code_count() }}</h3>
                                    <span>  اكواد  الفعالة</span>
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
                                    <i class="fa fa-pause text-white font-large-2 float-right"></i>
                                </div>
                                <div class="media-body text-white text-right" style="margin-left: 33px;">
                                    <h3 class="text-white">{{ deactive_code_count() }}</h3>
                                    <span>  اكواد  الغير فعالة</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <a data-toggle="modal" data-target="#storesmodal">

                            <div class="media d-flex">
                                    <h3 class="success">اضف متجر</h3>
                                
                                <div>
                                    <i class="icon-user-follow success font-large-2 float-right"></i>
                                </div>
                            </div>
                        </a>

                        </div>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <a data-toggle="modal" data-target="#myModal">

                            <div class="media d-flex">
                                    <h3 class="info"> اضف مشهور</h3>
                                
                                <div>
                                    <i class="icon-user-follow info font-large-2 float-right"></i>
                                </div>
                            </div>
                        </a>

                        </div>
                    </div>
                </div>
            </div>
         
            
            <div class="modal" id="myModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
        
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title"> اضف مشهور </h4>
                            <button type="button" class="close closemodal" data-dismiss="modal">&times;</button>
                        </div>
        
                        <!-- Modal body -->
                        <div class="modal-body ">
                            <div id="form-errors" class="text-center"></div>
                            <div id="success" class="text-center"></div>
                           
                            <form id="sendmemessage">
                                @csrf
        
        
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label for="image"> صورة المشهور : <span class="required">*</span></label>
                                        <input type="file" name="image" required class="form-control"
                                            value="{{ old('image') }}" id="image">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label for="email"> اسم المشهور : <span class="required">*</span></label>
                                        <input type="text" name="name" required class="form-control"
                                            value="{{ old('name') }}" id="name">
                                    </div>
                                    <div class=" form-group col-md-4 col-sm-4">
                                        <label for="email"> الدولة : <span class="required">*</span></label>
                                        <select name="country_id" id="country_id" class="form-control">
                                            <option value="" selected disabled>اختر دولة</option>
                                            @foreach (App\Models\Country::get() as $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach
                                        </select>
        
                                    </div>
                                    <div class="col-md-2 mt-2 col-sm-2 form-group ">
                                        <button type="button" class="btn btn-info" id="addcountry"> <i class="fa fa-plus"></i></button>
        
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label for="email"> رقم الهاتف :</label>
                                        <fieldset class="form-group position-relative">
                                            <input type="text" maxlength="10" onkeypress=" return isNumber(event)" minlength="10" name="phone" required class="form-control form-control-lg input-lg"
                                                id="iconLeft3">
                                            <div class="form-control-position phoneicon" style="margin-top: 4px;width: 65px;display: flex">
                                                +
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email"> البريد الاكتروني : <span class="required">*</span></label>
                                        <input type="email" name="email" required class="form-control"
                                            value="{{ old('email') }}" id="email">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email"> رقم الرخصة المهنية : <span class="required">*</span></label>
                                        <input type="text" name="professional_license_number" required class="form-control"
                                            value="{{ old('professional_license_number') }}" id="professional_license_number">
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="email"> هل انت ممثل عن المشهور ام المشهور نفسه : <span
                                                class="required">*</span></label>
                                        <select name="is_famous" id="select_is_famous" required class="form-control">
                                            <option value="">اختر </option>
                                            <option value="1">المشهور نفسه</option>
                                            <option value="2">ممثل عن المشهور </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row is_famous_show "style="display: none">
                                    
                                    <div class="form-group col-md-6">
                                        <label for="email"> اسم ممثل المشهور   : <span class="required">*</span></label>
                                        <input type="text" name="name_actor"  class="form-control"
                                            value="{{ old('name_actor') }}" id="name_actor">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email"> رقم ممثل المشهور   : <span class="required">*</span></label>
                                        <input type="number" name="phone_actor"  class="form-control"
                                            value="{{ old('phone_actor') }}" id="phone_actor">
                                    </div>
                                </div>
                                <div class="row">
        
                                    <div class="form-group col-md-5">
                                        <label for="email"> مجال المشهور : <span class="required">*</span></label>
                                        <br>
                                        <select required class="select2-rtl form-control" id="is_famous" name="famoustype_id[]"
                                        id="select2-rtl-multi" multiple="multiple">
                                        <option value="" disabled> اختر المجال</option>
        
                                        @foreach (App\Models\FamousType::get() as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                     
                                    </div>
                                    <div class="col-md-1 mt-2 col-sm-1 form-group ">
                                        <button type="button" class="btn btn-info" id="addscope"> <i class="fa fa-plus"></i></button>
        
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email"> عدد المتابعين   : <span class="required">*</span></label>
                                        <input type="number" name="followers_number"  class="form-control"
                                            value="{{ old('followers_number') }}" id="followers_number">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email"> عدد المشاهدات   : <span class="required">*</span></label>
                                        <input type="number" name="views_number"  class="form-control"
                                            value="{{ old('views_number') }}" id="views_number">
                                    </div>
        
                                    
                                    <div class="form-group col-md-6">
                                        <label for="email"> فئة المتابعين : <span class="required">*</span></label>
                                        <select name="follower_type[]" class="select2-rtl form-control" required  id="follower_type" id="select2-rtl-multi" multiple="multiple">
                                            <option value="">اختر </option>
                                            <option value="male">رجال</option>
                                            <option value="femail">نساء </option>
                                            <option value="children"> أطفال</option>
        
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email"> <img src="https://cdn.iconscout.com/icon/free/png-256/tiktok-2270636-1891163.png" width="50" height="50" alt=""></label>
                                            <input type="text"name="tiktok" placeholder="www.tiktok.com" class="form-control"
                                                id="tiktok">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email"> <i class="fa fa-instagram fa-3x" style="color:orangered" aria-hidden="true"></i></label>
                                            <input type="text" name="instagram" placeholder="www.instagram.com"
                                                class="form-control" id="instagram">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email"> <i class="fa fa-snapchat fa-3x" style="color:yellow"></i></label>
                                            <input type="text" name="snapchat" placeholder="www.snapchat.com" class="form-control"
                                                id="snapchat">
                                        </div>
                                    </div>
                                </div>
        
        
                                            
        
                                       
                                
                                <h4 class="form-section"><i class="la la-add"></i>اضف المزيد من حسابات السوشل ميديا  </h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>اسم المنصة :</label>
                                            <select id="get_soical_media" class="form-control sosialselect">
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
                                </div>
                                    <div id="soical_item" class="row">





                                    </div>
                                   
                                <h4 class="form-section"><i class="la la-add"></i>  </h4>
        
        
        
        
        
        
        
                                <button class="btn btn-info mt-5" type="submit">اضافة </i></button>
                            </form>
        
                        </div>
        
        
        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger delete-confirm closemodal" data-dismiss="modal">اغلاق</button>
                        </div>
        
                    </div>
                </div>
              
        
            </div>
            <div class="modal" id="myModalcountry">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
        
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title"> اضف دولة </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
        
                        <!-- Modal body -->
                        <div class="modal-body ">
                            <div id="form-errors" class="text-center"></div>
                            <div id="success" class="text-center"></div>
                            <form id="addcountryform">
                                @csrf
        
                                <div class="form-group">
                                    <label data-error="wrong" data-success="right" for="form3">علم الدولة <span
                                            class="required">*</span></label>
                                    <input type="file" id="imagestore" required name="flag" class="form-control image">
                                </div>
                                <div class="form-group">
                                    <img src="{{ asset('uploads/product_images/default.png') }}" style="width: 100px"
                                        class="img-thumbnail image-preview" alt=">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="email"> اسم الدولة بالعربية : <span class="required">*</span></label>
                                        <input type="text" name="title_ar" required class="form-control"
                                            value="{{ old('title_ar') }}" id="title_ar">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email"> اسم الدولة بالانجليزية: <span class="required">*</span></label>
                                        <input type="text" name="title_en" required class="form-control"
                                            value="{{ old('title_en') }}" id="title_en">
                                    </div>
        
                                    
                                    <div class="form-group col-md-6">
                                        <label for="commercial_register">رمز الدولة  : <span class="required">*</span></label>
                                        <input type="text" name="code" required value="{{ old('code') }}" class="form-control"
                                            id="website">
                                    </div>
        
        
                                    
                                </div>
        
        
                                <button class="btn btn-info" type="submit">اضافة </i></button>
                            </form>
        
                        </div>
        
        
        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger delete-confirm" data-dismiss="modal">اغلاق</button>
                        </div>
        
                    </div>
                </div>
        
            </div>
            <div class="modal" id="myModalscope">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
        
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title"> اضف مجال جديد </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
        
                        <!-- Modal body -->
                        <div class="modal-body ">
                            <div id="form-errors" class="text-center"></div>
                            <div id="success" class="text-center"></div>
                            <form id="addfamoustpye">
                                @csrf
        
                                
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="email"> اسم المجال بالعربية : <span class="required">*</span></label>
                                        <input type="text" name="title_ar" required class="form-control"
                                            value="{{ old('title_ar') }}" id="title_ar">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email"> اسم المجال بالانجليزية: <span class="required">*</span></label>
                                        <input type="text" name="title_en" required class="form-control"
                                            value="{{ old('title_en') }}" id="title_en">
                                    </div>
        
                                    
                                   
        
        
                                    
                                </div>
        
        
                                <button class="btn btn-info" type="submit">اضافة </i></button>
                            </form>
        
                        </div>
        
        
        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger delete-confirm" data-dismiss="modal">اغلاق</button>
                        </div>
        
                    </div>
                </div>
        
            </div>
            <div class="modal" id="storesmodal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
            
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title"> اضف متجر </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body ">
                            <div id="form-errors" class="text-center"></div>
                            <div id="success" class="text-center"></div>
                            
                            <form id="storeform">
                                @csrf
                                
                                <div class="form-group">
                                    <label data-error="wrong" data-success="right"
                                        for="form3">شعار المتجر <span class="required">*</span></label>
                                    <input type="file" id="imagestore" required name="image"
                                        class="form-control image">
                                </div>
                                <div class="form-group">
                                    <img src="{{ asset('uploads/product_images/default.png') }}"
                                        style="width: 100px" class="img-thumbnail image-preview"
                                        alt="">
                                </div>
                               <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="email">  اسم المتجر بالعربية: <span class="required">*</span></label>
                                    <input type="text" name="title_ar" required class="form-control" value="{{ old('title_ar') }}"
                                        id="title_ar">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">  اسم المتجر بالانجليزية: <span class="required">*</span></label>
                                    <input type="text" name="title_en" required class="form-control" value="{{ old('title_en') }}"
                                        id="title_en">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="commercial_register">رابط الربط للمتجر (API)    :<span class="required">*</span></label>
                                    <input type="text"  name="api_link"
                                        value="{{ old('api_link') }}" class="form-control" id="api_link">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="benift">   فائدة استخدام الكود    :<span class="required">*</span></label>
                                    <input type="text"  name="benift"
                                        value="{{ old('benift') }}" class="form-control" id="benift">
                                </div>
                           
                                <div class="form-group col-md-6">
                                    <label for="commercial_register">رقم السجل التجاري:</label>
                                    <input type="number"  name="commercial_register"
                                        value="{{ old('commercial_register') }}" class="form-control" id="commercial_register">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="commercial_register">الموقع الاكتروني  :</label>
                                    <input type="text"  name="website"
                                        value="{{ old('website') }}" class="form-control" id="website">
                                </div>
                                
        
                                <div class="form-group col-md-6">
                                    <label for="commercial_register">رابط تطبيق الاندرويد   :</label>
                                    <input type="text"  name="android"
                                        value="{{ old('android') }}" class="form-control" id="android">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="commercial_register">رابط تطبيق الايفون   :</label>
                                    <input type="text"  name="ios"
                                        value="{{ old('ios') }}" class="form-control" id="ios">
                                </div>
                                </div>
        
        
                                <button class="btn btn-info" type="submit">اضافة </i></button>
                            </form>

            
                        </div>
            
            
            
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger delete-confirm" data-dismiss="modal">اغلاق</button>
                        </div>
            
                    </div>
                </div>
            
            </div>
            <div class="modal" id="myModalsocail">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
            
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title"> اضف جديد </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="modal-body ">
                            <div id="form-errors" class="text-center"></div>
                            <div id="success" class="text-center"></div>
                            <form id="sendsocail">
                                @csrf
            
                                <div class="form-group">
                                    <label data-error="wrong" data-success="right" for="form3">ايقونة المنصة  (30*30) <span
                                            class="required">*</span></label>
                                    <input type="file" id="imagestore" required name="icon" class="form-control image">
                                </div>
                                <div class="form-group">
                                    <img src="{{ asset('uploads/product_images/default.png') }}" style="width: 100px"
                                        class="img-thumbnail image-preview" alt="">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="email"> اسم المنصة بالعربية : <span class="required">*</span></label>
                                        <input type="text" name="title_ar" required class="form-control"
                                            value="{{ old('title_ar') }}" id="title_ar">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email"> اسم المنصة بالانجليزية: <span class="required">*</span></label>
                                        <input type="text" name="title_en" required class="form-control"
                                            value="{{ old('title_en') }}" id="title_en">
                                    </div>
            
                                    
                                  
            
            
                                    
                                </div>
            
            
                                <button class="btn btn-info" type="submit">اضافة </i></button>
                            </form>
            
                        </div>
            
            
            
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger delete-confirm" data-dismiss="modal">اغلاق</button>
                        </div>
            
                    </div>
                </div>
            
            </div>
        </div>



    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-content collapse show">

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
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
                                    <tr>
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
                    <div class="modal" id="myModal3">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title"> اضافة كود خصم</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body ">

                                    <div class="modal-body ">
                                        <form id="sendform">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email"> المتجر :</label>
                                                        <select name="store_id" required class="form-control" id="select_store">
                                                            <option value="" selected disabled>اختر المتجر</option>
                    
                                                            @foreach (App\Models\Stores::get() as $item)
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
                                                        <label for="email"> ايراد كودك :</label>
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
                                                        <label for="email"> ايراد المشهور :</label>
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
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger delete-confirm" data-dismiss="modal">اغلاق</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    


</div>
@endif
@if(auth()->user()->hasRole('Famous'))
<div class="content-body">
    <section id="configuration">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="radies card bg-info">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center" style="margin-right:10%">
                                    <i class="icon-wallet text-white font-large-2 float-right"></i>
                                </div>
                                <div class="media-body text-white text-right" style="margin-left: 33px;">
                                    <h3 class="text-white">{{ App\Models\Code::where('famous_id',auth()->user()->famous->id)->sum('total_famous') }}</h3>
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
                                    <h3 class="text-white">{{ App\Models\Code::where('famous_id',auth()->user()->famous->id)->sum('total_trans') }}</h3>
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
                                    <h3 class="text-white">{{ App\Models\Code::where('famous_id',auth()->user()->famous->id)->sum('total_pending') }}</h3>
                                    <span>   المبالغ المعلقة    </span>
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
                     <form style="margin-right: 4%" >

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="userinput2">@lang('المتجر')</label>
                                    <select name="nationality_id" id="" class="form-control">

                                        <option value=">@lang('اختر المتجر')</option>
                                        @foreach (App\Models\Stores::get() as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-3">
                                        
                                <label for="userinput2">المبلغ المعلق </label>

                                <div class="min-max-slider" data-legendnum="2" style="direction: ltr">
                                    <label for="min">من</label>
                                    <input id="min" class="min" name="min" type="range" step="1" min="0" max="15000" />
                                    <label for="max">الى</label>
                                    <input id="max" class="max" name="max" type="range" step="1" min="0" max="15000" />
                                </div>
                        </div>
                        <div class="col-md-3">
                                        
                            <label for="userinput2">المبلغ المتبقي </label>

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
                                        <th>اسم المتجر  </th>
                                        <th>اسم المشهور </th>
                                        <th>الكود</th>
                                        <th>الاجمالي</th>
                                        <th>ما تم تحويله</th>
                                        <th>المبلغ المعلق</th>
                                        <th>المتبقي </th>
                                        <th>الاجراءات</th>

                                    </tr>
                                </thead>
                                <tbody >
                                    <tr>
                                        @foreach (App\Models\Code::where('famous_id',auth()->user()->famous->id)->orderby('id','desc')->get() as $key=> $item)
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>{{ @$item->store->title }}</td>
                                            <td>{{ @$item->famous->name }}</td>
                                            <td>{{ $item->code }}</td>
                                            <td>{{ get_total_famous_code_api($item->id) }} </td>
                                            <td>{{ $item->total_trans }}</td>
                                            <td>{{  $item->total_pending }}</td>
                                            <td>{{ get_total_famous_code_api($item->id) - $item->total_trans  }}</td>
                                            <td>
                                                <button class="btn btn-info" data-toggle="modal" data-target="#myModal20"
                                                        onclick="get_wallet('{{ $item->id }}')"><i
                                                            class="fa fa-eye"></i></button>
                                                {{-- <a data-toggle="modal"    onclick="make('{{ $item->id }}')" data-target="#myModal20" class="btn btn-info"><i class="fa fa-cog" aria-hidden="true"></i> --}}
                                                    
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
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
<div class="modal" id="myModal20">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">طلب تحويل مالي </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
           
            <div  class="modal-body " id="company_edit"> 
                <div class="c-preloader text-center p-3">
                    <i class="las la-spinner la-spin la-3x"></i>
                </div>
            </div>


            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger delete-confirm" data-dismiss="modal">اغلاق</button>
            </div>

        </div>
    </div>

</div>



@endif
@endsection
@section('script')
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
                let form =` <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"> <img src="{{ asset('uploads/') }}` + icon + `" width="50" height="50" alt=""></label>
                                <button class="btn btn-danger delete-confirm remove_button" style="margin-right: 67%;
                                    margin-bottom: 17px;" ><i class="fa fa-trash "></i></button>
                                <input type="text" required name="` + nameinput + `" 
                                    class="form-control" id="instagram">
                            </div>
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
                    $(this).parent('div').parent('div').remove();

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
                    $('#myModal').modal('show');


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

                    $('#is_famous').append('<option value="' + data.id +
                        '">' + data.title + '</option>');
                        $('#myModalscope').modal('hide');
                     
                    swal(
                        '',
                        ' تم الاضافة بنجاح ',
                        'success'
                    );
                    $('#myModal').modal('show');



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
        $('#send_bank').on('submit', function(e) {
            e.preventDefault();
            var frm = $('#send_bank');
            var formData = new FormData(frm[0]);

            var data = $(this).serialize();

            $.ajax({
                url: "{{ route('send_bank_data') }}",
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {

                    swal(data['message'], {
                    buttons: false,
                    timer: 3000,
                    icon: "success"
                });
                setTimeout(function() {
                    window.location.reload();
                }, 3000);



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
            formData.append('file', $('#imagestore')[0].files[0]);

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
                        $('#myModalcountry').modal('hide');
                     
                    swal(
                        '',
                        ' تم الاضافة بنجاح ',
                        'success'
                    );
                    $('#myModal').modal('show');



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

        $('#addcountry').click(function() {
            $('#myModal').modal('hide');
            $('#myModalcountry').modal('show');

        });
        $('#addscope').click(function() {
            $('#myModal').modal('hide');
            $('#myModalscope').modal('show');

        });


        
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
        $('.closemodal').click(function() {
            document.getElementById("sendmemessage").reset();
        });
        $(document).on("click",".add_sss",function(){
            $('#myModal').modal('hide')

            $('#myModalsocail').modal('show')
    });
    function get_wallet(id) {


            $("#myModal20").show();

            // $('#staticBackdrop').modal();
            $('.c-preloader').show();

            $.ajax({
                type: 'post',
                url: "{{ route('get_waalet_transfare') }}",
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
        $('#select_store').change(function() {
            $("#codechange").val('');
            $("#start_at").val('');
            $("#end_at").val('');
            $('#penifet_new').val('');
            $('#benefit').val('');

            $("#discount_code").val('');

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