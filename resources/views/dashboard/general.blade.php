@extends('layouts.backend_new')
@section('content')
<div class="row">

  <div class="col-2 p-0 me-auto flex-column flex-center justify-content-between p-4">
    <h2>الإعدادات العامة</h2>

  </div>

 

</div>

<div class="inner-content w-50">
  @include('dashboard.parts._error')
  @include('dashboard.parts._success')
  <form class="form" method="POST" action="{{ route('generalinfo.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="input-item">
      <label for="">اسم النظام بالعربية </label>
      <input type="text" value="{{ get_general_value('title_ar') }}" id="userinput1" class="form-control border-primary" placeholder="@lang('system name in arabic') " name="general[title_ar]">
    </div>

    <div class="input-item">
      <label for="">اسم النظام بالانجليزية</label>
      <input type="text" value="{{ get_general_value('title_en') }}" id="userinput1" class="form-control border-primary" placeholder="@lang('system name in arabic') " name="general[title_en]">
    </div>

    <div class="input-item">
      <label for="file">ايقونة للنظام</label>

      <label class="custom-file-upload d-block form-control p-0" style="height: 46px; direction: ltr">
        <input type="file" name="general_file[header_logo]" />
        <span class="border h-100 upload-img">رفع صورة
          <img src="{{asset('new_dash/images/icons/upload.png')}}" alt="" class="me-1" /></span>
        <img src="{{asset('new_dash/images/icons/img.png')}}" alt="" class="me-1 ms-2" width="20" />
      </label>
    </div>

    <div class="input-item">
      <label for="file">بانر للنظام</label>

      <label class="custom-file-upload d-block form-control p-0" style="height: 46px; direction: ltr">
        <input type="file" name="general_file[icon]" />
        <span class="border h-100 upload-img">رفع صورة
          <img src="{{asset('new_dash/images/icons/upload.png')}}" alt="" class="me-1" /></span>
        <img src="{{asset('new_dash/images/icons/img.png')}}" alt="" class="me-1 ms-2" width="20" />
      </label>
    </div>

    <div class="input-item">
      <label for="">أقل مبلغ يمكن تحويله من المحفظة</label>
      <input type="number"  value="{{ get_general_value('min_wallet') }}" class="form-control border-primary" name="general[min_wallet]">
    </div>
    <div class="col-2 p-0 ms-auto flex-column flex-center justify-content-between p-4">
    </div>
    <button style="width:50% !important" class="btn btn-primary  btn-lg w-100" type="submit"> <img src="{{asset('new_dash/images/icons/famousLight.png')}}" alt="" class="me-1 text-white" />
      حفظ 
    </button>
    </div>
  
  </form>
</div>
@endsection
