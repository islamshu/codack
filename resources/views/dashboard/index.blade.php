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
                                <div class="align-self-center">
                                    <i class="fa fa-building   text-white font-large-2 float-right"></i>
                                </div>
                                <div class="media-body text-white text-right">
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
                                <div class="align-self-center">
                                    <i class="fa fa-user text-white font-large-2 float-right"></i>
                                </div>
                                <div class="media-body text-white text-right">
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
                                <div class="align-self-center">
                                    <i class="fa fa-eercast text-white font-large-2 float-right"></i>
                                </div>
                                <div class="media-body text-white text-right">
                                    <h3 class="text-white">156</h3>
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
                                <div class="align-self-center">
                                    <i class="fa fa-play text-white font-large-2 float-right"></i>
                                </div>
                                <div class="media-body text-white text-right">
                                    <h3 class="text-white">100</h3>
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
                                <div class="align-self-center">
                                    <i class="fa fa-pause text-white font-large-2 float-right"></i>
                                </div>
                                <div class="media-body text-white text-right">
                                    <h3 class="text-white">56</h3>
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
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                            <option value="">اختر دولة</option>
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
                                            <input type="number" name="phone" required class="form-control form-control-lg input-lg"
                                                id="iconLeft3">
                                            <div class="form-control-position phoneicon" style="margin-top: 7px;">
                                                <h5>+</h5>
        
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email"> البريد الاكتروني : <span class="required">*</span></label>
                                        <input type="text" name="email" required class="form-control"
                                            value="{{ old('email') }}" id="email">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email"> رقم الرخصة المهنية : <span class="required">*</span></label>
                                        <input type="number" name="professional_license_number" required class="form-control"
                                            value="{{ old('professional_license_number') }}" id="professional_license_number">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email"> هل انت ممثل عن المشهور ام المشهور نفسه : <span
                                                class="required">*</span></label>
                                        <select name="is_famous" required class="form-control">
                                            <option value="">اختر </option>
                                            <option value="1">المشهور نفسه</option>
                                            <option value="2">ممثل عن المشهور </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="email"> مجال المشهور : <span class="required">*</span></label>
                                        <select name="famoustype_id" required id="is_famous" class="form-control">
                                            <option value="">اختر </option>
                                            @foreach (App\Models\FamousType::get() as $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach
        
                                        </select>
                                    </div>
                                    <div class="col-md-2 mt-2 col-sm-2 form-group ">
                                        <button type="button" class="btn btn-info" id="addscope"> <i class="fa fa-plus"></i></button>
        
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email"> فئة المتابعين : <span class="required">*</span></label>
                                        <select name="follower_type" required  id="follower_type" class="form-control">
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
        
        
                                            
        
                                        <div id="extra">
        
        
        
        
        
                                        </div>
                                            <div>
                                            <button type="button" name="add"
                                            class="btn btn-success add_row for-more mt-2">اضف المزيد من حسابات السوشل ميديا</button>
                                        </div>
        
        
        
        
        
        
        
        
                                <button class="btn btn-info mt-5" type="submit">اضافة </i></button>
                            </form>
        
                        </div>
        
        
        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
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
                                        class="img-thumbnail image-preview" alt="">
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
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
                               
                                <tr>
                                    <td>متجر قيس</td>
                                    <td>QQQ</td>
                                    <td>محمود </td>
                                    <td>50%</td>
                                    <td>25%</td>
                                    <td>-50%</td>
                                    <td>-50%</td>
                                </tr>
                                <tr>
                                    <td>متجر اناس </td>
                                    <td>AAA</td>
                                    <td>ايهاب </td>
                                    <td>50%</td>
                                    <td>25%</td>
                                    <td>-50%</td>
                                    <td>-50%</td>
                                </tr>
                              
                                


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

                                    <form action="">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email"> المتجر :</label>
                                                    <select name="" class="form-control" id="">
                                                    <option value="">متجر قيس</option>
                                                    <option value="">متجر اناس</option>
                                                    <option value="">متجر فور ايفر</option>
                                
                                                </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email"> المشهور :</label>
                                                    <select name="" class="form-control" id="">
                                                    <option value="">محمود </option>
                                                    <option value="">ايهاب </option>
                                                    <option value="">خالد  </option>
                                                    <option value="">محمد  </option>
                                                    <option value="">سالم  </option>
                                
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email"> اسم كود الخصم  :</label>
                                                    <input type="text" class="form-control" id="email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email"> نسبة كود الخصم :</label>
                                                    <!-- <input type="text" class="form-control percentage" value="%" id="email"> -->
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input step="5" max="100" min="5" type="number" class="form-control form-control-lg input-lg" id="iconLeft2" placeholder="">
                                                        <div class="form-control-position">
                                                            %
                                                        </div>

                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email"> فايدة استخدام الكود     :</label>
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input step="5" max="100" min="5" type="number" class="form-control form-control-lg input-lg" id="iconLeft2" placeholder="">
                                                        <div class="form-control-position">
                                                            %
                                                        </div>

                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email"> نسبة كودك  :</label>
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input step="5" max="100" min="5" type="number" class="form-control form-control-lg input-lg" id="iconLeft2" placeholder="">
                                                        <div class="form-control-position">
                                                            %
                                                        </div>

                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email"> نسبة المشهور     :</label>
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input step="5" max="100" min="5" type="number" class="form-control form-control-lg input-lg" id="iconLeft2" placeholder="">
                                                        <div class="form-control-position">
                                                            %
                                                        </div>

                                                    </fieldset>
                                                </div>
                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-default">اضافة</button>
                                    </form>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                                </div>

                            </div>
                        </div>
                    </div>

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
                    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
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
                                <div class="align-self-center">
                                    <i class="icon-wallet text-white font-large-2 float-right"></i>
                                </div>
                                <div class="media-body text-white text-right">
                                    <h3 class="text-white">2500</h3>
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
                                <div class="align-self-center">
                                    <i class="icon-check text-white font-large-2 float-right"></i>
                                </div>
                                <div class="media-body text-white text-right">
                                    <h3 class="text-white">500</h3>
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
                                <div class="align-self-center">
                                    <i class="icon-compass text-white font-large-2 float-right"></i>
                                </div>
                                <div class="media-body text-white text-right">
                                    <h3 class="text-white">500</h3>
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
                    </div>   <form >

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
                                        <input type="number" max="100" min="5" name="phone"  class="form-control form-control-lg input-lg"
                                            id="iconLeft3">
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
                                        <input type="number" max="100" min="5" name="phone"  class="form-control form-control-lg input-lg"
                                            id="iconLeft3">
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
                                        <td>1 </td>
                                        <td>متجر قيس</td>
                                        <td>islam shu </td>
                                        <td>QQQ</td>
                                        <td>2500 </td>
                                        <td>500</td>
                                        <td>500</td>
                                        <td>1500</td>
                                        <td>
                                            
                                            <a data-toggle="modal" data-target="#myModal20" class="btn btn-info"><i class="fa fa-cog" aria-hidden="true"></i>
                                                
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
<div class="modal" id="myModal20">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">طلب تحويل مالي </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body ">
                <form id="send_bank">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"> قيمة التحويل    :</label>
                                <input type="number" value="1500" readonly min="1000" class="form-control" name="amount">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">  اسم البنك  :</label>
                                <input type="text" class="form-control" value="{{@ auth('famous')->user()->bank->bank_name }}" required name="bank_name" id="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"> رقم الحساب       :</label>
                                <input type="number" class="form-control" required value="{{@ auth('famous')->user()->bank->account_nubmer }}" name="account_number" id="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">   الاسم بالبنك  :</label>
                                <input type="text" class="form-control" required value="{{@ auth('famous')->user()->bank->account_name }}" name="account_name" id="email">
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-default">ارسال</button>
                </form>

            </div>


            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
            </div>

        </div>
    </div>

</div>

@endif
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
                    // var table = $('#stores').DataTable();

                
                    swal(
                        '',
                       data['message'],
                        'success'
                    );
                    location.reload(true);



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
                    let code = '<h5>' + data.code + '</h5>';
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>اسم المنصة :</label>
                                <select name="addmore[` + i + `][name_socal]" class="form-control">
                                    <option value="">اختر المنصة</option>
                                    @foreach (App\Models\SoicalType::get() as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>

                            </div>
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
                            <button type="button" class="remove_button btn btn-danger " title="Remove field"><i class="fa fa-trash"></i></button>
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
       

    </script>
    
@endsection