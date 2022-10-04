@extends('layouts.backend_new')
@section('content')
    <div class="row">

        <div class="col-2">
            <h2>العمليات</h2>
        </div>
        <!-- <div class="col-2 p-0 ms-auto flex-column flex-center justify-content-between p-4">
            <a class="btn btn-primary btn-lg w-100 add" data-bs-toggle="modal"
                data-bs-target="#addStore">
                <img src="{{ asset('new_dash/images/icons/add-vendor.png') }}" alt="" class="me-1" />
                اضافة متجر
            </a>

        </div> -->


    </div>
    
    <div class="content mt-5">
        <div class="border-top border-secondary">
            <table id="example" class="display compact" style="width:100%" id="storestable">


                <br>
                <thead>
                    <tr>
                        <th class="text-right">#</th>
                        <th class="text-right"> كود الخصم </th>
                        <th class="text-right">  القيمة المضافة على الايرادات</th>
                        <th class="text-right">  القيمة المضافة على العمليات</th>

                        <th class="text-right">اسم المشهور</th>
                        <th class="text-right">البريد الاكتروني لمن قام بالتعديل</th>
                        <th class="text-right"> تاريخ الاضافة </th>
                    </tr>
                </thead>
                <tbody id="stores">
                    @foreach ($codes as $key => $item)
                    <tr>
                        @php
                            $code =@App\Models\Code::find($item->code_id);
                        @endphp
                        <td class="text-right">{{ $key + 1 }}</td>
                        <td class="text-right"> {{@$code->code }}</td>
                        <td class="text-right"> {{@$item->amount }}</td>
                        <td class="text-right"> {{@$item->amount_total }}</td>

                        <td class="text-right">{{ @$code->famous->name }}</td>
                        <td class="text-right">{{ @$item->user->email }}</td>

                        <td class="text-right">{{ @$item->created_at }}</td>
                        </tr>
                    @endforeach
    
                </tbody>
    
            </table>
        </div>
        
    </div>
@endsection
