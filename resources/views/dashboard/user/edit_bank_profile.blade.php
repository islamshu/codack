@extends('layouts.backend_new')
@section('content')
  
<div class="row">

    <div class="col-2 p-0 me-auto flex-column flex-center justify-content-between p-4">
      <h2>الإعدادات العامة</h2>

    </div>

    {{-- <div class="col-2 p-0 ms-auto flex-column flex-center justify-content-between p-4">
      <a class="btn btn-primary  btn-lg w-100" data-bs-toggle="modal" data-bs-target="#exampleModal2">
        <img src="{{asset('new_dash/images/icons/famousLight.png')}}" alt="" class="me-1 text-white" />
        حفظ التغيير
      </a>

    </div> --}}


  </div>
  @include('dashboard.parts._error')
  @include('dashboard.parts._success')
  <div class="inner-content w-50">
        <div class="clear-fix"></div>

        <label for="" class="d-block fs-6 fw-bold">بيانات البنك الحالية</label>

        <div class="input-item">
          <label for="">اسم البنك الحالي :<span class="text-danger">*</span></label>
          <input type="text" class="form-control" value="{{@ auth()->user()->famous->bank->bank_name }}" readonly id="email">
        </div>


        <div class="input-item">
          <label for="">رقم الحساب الحالي :<span class="text-danger">*</span></label>
          <input type="number" class="form-control" required value="{{@ auth()->user()->famous->bank->account_nubmer }}" readonly id="email">
        </div>


        <div class="input-item">
          <label for="">الاسم بالبنك الحالي :<span class="text-danger">*</span></label>
          <input type="text" class="form-control" required value="{{@ auth()->user()->famous->bank->account_name }}" readonly id="email">
        </div>


        <div class="clear-fix"></div>


        <label class="d-block fs-6 fw-bold mt-3 mt-2">تغير البيانات الحالية</label>
        <form action="{{ route('update_back_info') }}" method="post">
            @csrf
        <div class="input-item">
          <label for="">اسم البنك الجديد :<span class="text-danger">*</span></label>
          <input type="text" class="form-control" required value="{{old('bank_name')}}" name="bank_name" >
        </div>


        <div class="input-item">
          <label for="">رقم الحساب الجديد :<span class="text-danger">*</span></label>
          <input type="number" class="form-control"  required value="{{old('account_number')}}" name="account_number" >
        </div>


        <div class="input-item">
          <label for="">اسم صاحب الحساب :<span class="text-danger">*</span></label>
          <input type="text" class="form-control" required value="{{old('account_name')}}" name="account_name">
        </div>

        <div class="clear-fix"></div>


        <div class="input-item">
          <button type="submit" class="btn btn-primary"><img src="{{asset('new_dash/images/icons/famousLight.png')}}" alt="" class="me-1 text-white" /> تغير</button>
        </div> 

      </form>
  </div>
 
@endsection
