    <div class="clear-fix"></div>

    <label for="" class="d-block fs-6 fw-bold">بيانات البنك الحالية</label>

    <div class="input-item">
      <label for="">اسم البنك الحالي :<span class="text-danger">*</span></label>
      <input type="text" class="form-control" value="{{@ $change->famous->bank->bank_name }}" readonly id="email">
    </div>


    <div class="input-item">
      <label for="">رقم الحساب الحالي :<span class="text-danger">*</span></label>
      <input type="number" class="form-control" required value="{{@ $change->famous->bank->account_name }}" readonly id="email">
    </div>


    <div class="input-item">
      <label for="">الاسم بالبنك الحالي :<span class="text-danger">*</span></label>
      <input type="text" class="form-control" required value="{{@ $change->famous->bank->account_nubmer }}" readonly id="email">
    </div>


    <div class="clear-fix"></div>


    <label class="d-block fs-6 fw-bold mt-3 mt-2">تغير البيانات الحالية</label>
    <form action="{{ route('update_back_info_by_admin') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $change->id }}">

        <input type="hidden" name="famous_id" value="{{ $change->famous_id }}">
    <div class="input-item">
      <label for="">اسم البنك الجديد :<span class="text-danger">*</span></label>
      <input type="text" class="form-control" value="{{$change->bank_name}}" name="bank_name" >

    </div>


    <div class="input-item">
      <label for="">رقم الحساب الجديد :<span class="text-danger">*</span></label>
      <input type="number" class="form-control" required  value="{{$change->account_number}}" name="account_name" >    </div>


    <div class="input-item">
      <label for=""> الاسم بالبنك الجديد    :<span class="text-danger">*</span></label>
      <input type="text" class="form-control" required value="{{$change->account_name}}" name="account_number">
    </div>

    <div class="clear-fix"></div>



    <div class="input-item">
      <button  type="submit" class="btn text-end add-store">تعديل</button>
    </div>

  </form>