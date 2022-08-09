@extends('layouts.backend')
@section('content')
    <div class="content-wrapper">
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">بيانات البنك</h4>
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

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    @include('dashboard.parts._error')
                                    @include('dashboard.parts._success')

                                    <br>
                                    
                                    <div class="form-body">

                                    <h4 class="form-section"><i class="la la-add"></i>بيانات البنك الحالية   </h4>

                                        <div class="row">

                                         
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">  اسم البنك الحالي  :</label>
                                                <input type="text" class="form-control" value="{{@ auth('famous')->user()->bank->bank_name }}" readonly id="email">
                                            </div>
                                        </div>
                                    
                                   
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email"> رقم الحساب الحالي       :</label>
                                                <input type="number" class="form-control" required value="{{@ auth('famous')->user()->bank->account_nubmer }}" readonly id="email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">   الاسم بالبنك الحالي  :</label>
                                                <input type="text" class="form-control" required value="{{@ auth('famous')->user()->bank->account_name }}" readonly id="email">
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="form-section"><i class="la la-add"></i>تغير البيانات الحالية     </h4>
                                    <form action="{{ route('update_back_info') }}" method="post">
                                        @csrf
                                        <div class="row">
    
                                             
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">  اسم البنك الجديد  :</label>
                                                    <input type="text" class="form-control" required value="{{old('bank_name')}}" name="bank_name" >
                                                </div>
                                            </div>
                                        
                                       
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email"> رقم الحساب الجديد       :</label>
                                                    <input type="number" class="form-control" required value="{{old('account_name')}}" name="account_name" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">   الاسم بالبنك الجديد  :</label>
                                                    <input type="text" class="form-control" required value="{{old('account_number')}}" name="account_number">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-info" type="submit">تعديل </i></button>
    
                                    </form>
                                
                                
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

    </div>
 
@endsection
