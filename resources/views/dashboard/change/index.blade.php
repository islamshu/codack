@extends('layouts.backend_new')
@section('content')
<div class="row">

    <div class="col-3 p-0 me-auto flex-column flex-center justify-content-start p-4">
      <h2 class="">طلبات التغير لبيانات البنك</h2>

    </div>

  </div>
  <div class="filters mt-3">
    <form action="">
      <div class="d-flex">
        <div class="flex-basis-20 pe-3 d-flex flex-column">
          <label class="flex-fill" for="">البحث</label>
          <div class="inner-addon input-group input-group-lg flex-fill">
            <img src="{{asset('new_dash/images/icons/search.png')}}" class="icon" />
            <input type="text" class="form-control" />
          </div>
        </div>
        <div class="flex-basis-20 pe-3 d-flex flex-column">
          <label class="flex-fill" for="">المشاهير</label>
          <div class="input-group input-group-lg flex-fill">
            <select class="form-select" aria-label="Default select example">
              <option selected>الكل</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
        </div>
        <div class="flex-basis-20 pe-3 d-flex flex-column">
          <label class="flex-fill" for="">الحالة</label>
          <div class="input-group input-group-lg flex-fill">
            <select class="form-select" aria-label="Default select example">
              <option selected>الكل</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
        </div>

        <div class="flex-basis-20 align-items-end d-flex">
          <span class="p-2 border rounded-3">
            <img src="{{asset('new_dash/images/icons/filters.png')}}" alt="" />
          </span>
        </div>
      </div>
    </form>
  </div>
  <div class="content mt-5">
    <div class="border-top border-secondary">
        @include('dashboard.parts._error')
        @include('dashboard.parts._success')
        <table id="example" class="display compact" style="width:100%" id="storestable">


            <br>
            <thead>
                <tr>
                    <th class="text-right">#</th>
                    <th class="text-right">صورة المشهور   </th>
                    <th class="text-right">اسم المشهور   </th>
                    <th class="text-right">الحالة</th>

                    <th class="text-right">الاجراءات</th>

                </tr>
            </thead>
            <tbody id="stores">
                @foreach ($changes as $key => $item)
                    <tr>
                        <td class="text-right">{{ $key + 1 }}</td>
                        <td class="text-right"><img src="{{ asset('uploads/'.$item->famous->image) }}" width="80" height="50" alt=""> </td>
                        <td class="text-right">{{ $item->famous->name}}</td>
                        <td class="text-right"><button type="button" class="btn btn-sm btn-outline-{{ get_account_status_color($item->status) }} round">{{  get_account_status($item->status) }} </button></td>
</td>

                        <td class="text-right">
                            @if(auth()->user()->hasRole('Admin'))
                            <button class="btn btn-inf" data-toggle="modal" data-target="#myModal4"
                            onclick="make('{{ $item->id }}')"><img src="{{asset('new_dash/images/icons/edit.png')}}" class="pointer"
                            alt=""></button>
                            <form style="display: inline" action="{{ route('changes.destroy',$item->id) }}" method="post">
                                @method('delete') @csrf
                                <button type="submit"  class="btn  delete-confirm"><img src="{{asset('new_dash/images/icons/delete.png')}}" class="pointer"
                                    alt=""></button>
                            </form>
                            @else 
                            _
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>
    
  </div>
  <div class="modal fade" id="updateDataBank" tabindex="-1" aria-labelledby="updateDataBankLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateDataBankLabel">
            <img src="./assets/images/icons/famous.png" alt="" class="me-1"> تعديل بيانات البنك
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></button>
        </div>
        <div class="modal-body" id="company_edit">
        
        </div>

      </div>
    </div>
  </div>

    
@endsection
@section('script')
  <script>
     function make(id) {
            $("#updateDataBank").modal('show');

            // $('#staticBackdrop').modal();
            $('.c-preloader').show();

            $.ajax({
                type: 'post',
                url: "{{ route('get_form_change') }}",
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
@endsection
