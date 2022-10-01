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
            <div  id="btnn" style="display: none">
             <form action="{{ route('status_ok_order') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden"  name="order_id" value="{{ $order->id }}">
                    <input type="hidden" name="code_id" value="{{ $order->code_id }}">
                    <input type="hidden" name="amount" value="{{$order->amount }}">
                    <div class="input-item">
                        <label for="file">ارفق صورة التحويل <span class="text-danger">*</span></label>
                
                        <label class="custom-file-upload d-block form-control p-0" style="height:46px; direction: ltr;">
                            <input type="file" id="fileupload" required  name="image" />
                            <span class="border h-100 upload-img">رفع صورة <img src="{{ asset('new_dash/images/icons/upload.png') }}"
                                    alt="" class="me-1"></span>
                        </label>
                    </div>
                    
    
                    <div class="input-item">
                        <button class="btn text-end add-store"> تأكيد موافقة التحويل</button>
                    </div>
        </form>   
        </div>
        </div>

      
    
    
        
    </div>
</div>
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
            var file = document.getElementById("fileupload");
            var imageupload =1;
            if(file.files.length == 0 ){
                var imageupload =0;
            }
            event.preventDefault();

            if(imageupload == 0 ){
                swal({
                    title: `يجب ارفاق صورة التحويل`,
                    icon: "error",
                })
                event.preventDefault();

            }else{
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
            }
            

            
        });
        
    </script>
