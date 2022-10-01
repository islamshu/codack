@extends('layouts.backend')
@section('content')
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تاريخ الاضافة على العمليات </h4>
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

                               
                                <table class="table table-striped table-bordered zero-configuration" id="storestable">



                                    <br>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> كود الخصم </th>
                                            <th> القيمة المضافة</th>
                                            <th>اسم المشهور</th>
                                            <th>البريد الاكتروني لمن قام بالتعديل</th>
                                            <th> تاريخ الاضافة </th>
                                          



                                        </tr>
                                    </thead>
                                    <tbody id="stores">
                                        @foreach ($codes as $key => $item)
                                            <tr>
                                                @php
                                                    $code =@App\Models\Code::find($item->code_id);
                                                @endphp
                                                <td>{{ $key + 1 }}</td>
                                                <td> {{$code->code }}</td>
                                                <td> {{$item->amount }}</td>
                                                <td>{{ @$code->famous->name }}</td>
                                                <td>{{ @$item->user->email }}</td>

                                                <td>{{ $item->created_at }}</td>

                                             
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    </div>
  
@endsection