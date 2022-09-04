@extends('layouts.backend')
@section('content')
    <div class="content-wrapper">
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">طلب تحويل </h4>
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


                                        <div class="row">

                                         
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">  اسم المشهور   :</label>
                                                <input type="text" readonly  class="form-control" value="{{@$order->famous->name }}" readonly id="email">
                                            </div>
                                        </div>
                                    
                                   
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">  قيمة التحويل    :</label>
                                                <input type="number" readonly class="form-control" required value="{{@$order->amount }}" readonly id="email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">   حالة الطلب    :</label>
                                                <select id="change_status" name="status" @if($order->status == 1 ) disabled style="background:#1eef1e" @else style="background:#ffa437"  @endif class="form-control">
                                                    <option value="2" @if($order->status == 2) selected @endif>معلق</option>
                                                    <option value="1"  @if($order->status == 1) selected @endif>مقبول</option>
                                                </select>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-6" id="btnn" style="display: none">
                                            <form action="{{ route('status_ok_order') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                <input type="hidden" name="code_id" value="{{ $order->code_id }}">
                                                <input type="hidden" name="amount" value="{{$order->amount }}">

                                        <button   class="btn btn-info confirm-back"  type="submit" >تأكيد موافقة التحويل  </i></button>
                                    </form>   
                                    </div>
                                    </div>

                                  
                                
                                
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

    </div>
 
@endsection 
@section('script')
    <script>
         $('#change_status').change(function() {
            if($(this).val() == 1){
                $('#btnn').css({display: "block"});
                $('#change_status').css({background: "#1eef1e"});
            }else{
                $('#btnn').css({display: "none"});
                $('#change_status').css({background: "#ffa437"});

            }
        });
        $('.confirm-back').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `هل متأكد من الموافقة على التحويل  ؟`,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
        
    </script>
@endsection
