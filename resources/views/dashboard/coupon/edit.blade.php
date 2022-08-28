<div class="modal-body ">
    <div id="form-errors" class="text-center"></div>
    <div id="success" class="text-center"></div>
    <form id="edit_form">
        @csrf

        <div class="row">

            <div class="form-group col-md-6">
                <label for="commercial_register">قيمة الخصم  :</label>
                <input type="text" required name="discount"
                    value="{{ $copoun->discount }}" class="form-control"
                    id="discount">
            </div>
            <div class="form-group col-md-6">
                <label for="commercial_register">  نسبة ام ثابت:</label>
                <select name="type" required class="form-control">
                    <option value=""  disabled>نسبة ام ثابت  </option>
                    <option value="amount" @if($copoun->type == 'amount') selected @endif>ثابت</option>
                    <option value="percentage" @if($copoun->type == 'percentage') selected @endif>نسبة</option>
                </select>
            </div>
            
        </div>
        <div class="row">

            <div class="form-group col-md-6">
                <label for="commercial_register">  محدود ام غير محدود  :</label>
                <select name="is_unlimit" id="is_unlimit" required class="form-control">
                    <option value=""  disabled>محدود ام غير محدود     </option>
                    <option value="0" @if($copoun->is_unlimit == 0) selected @endif>محدود</option>
                    <option value="1" @if($copoun->is_unlimit == 1) selected @endif>غير محدود</option>
                </select>
            </div>
            <div class="form-group col-md-6" id="number_useing" @if($copoun->is_unlimit == 1) style="display:none" @endif>
                <label for="email"> عدد مرات استخدام الكود  : <span class="required"></span></label>
                <input type="number" name="num_use"  class="form-control"
                    value="{{ $copoun->num_use }}" id="num_use">
            </div>
        </div>
        <div class="row">


            
            <div class="form-group col-md-6">
                <label for="commercial_register">يبدأ في   :</label>
                <input type="date" name="start_at" required value="{{ $copoun->start_at }}" class="form-control"
                    id="start_at">
            </div>
            <div class="form-group col-md-6">
                <label for="commercial_register">ينتهي في   :</label>
                <input type="date" name="end_at" required value="{{ $copoun->end_at }}" class="form-control"
                    id="end_at">
            </div>
        </div>


        <button class="btn btn-info" type="submit">تعديل </i></button>
    </form>

</div>
<script>
   $("#generate_type").change(function() {
               var type = $(this).val();
               if(type == 1){
                $("#code_typing").css({display: "block"});
                $("#code").attr("required", true);
               }else{
                $("#code_typing").css({display: "none"});
                $("#code").attr("required", false);
               }
            });
            $("#is_unlimit").change(function() {
               var linit = $(this).val();
               if( linit == 0){
                $("#number_useing").css({display: "block"});
                $("#num_use").attr("required", true);
               }else{
                $("#number_useing").css({display: "none"});
                $("#num_use").attr("required", false);
               }
            });


    $('#edit_form').on('submit', function(e) {
        var frm = $('#edit_form');
        var token = "{{ csrf_token() }}";

        var formData = new FormData(frm[0]);

        var data = $(this).serialize();
        e.preventDefault();

        var data = $(this).serialize();
        $.ajax({
            url: "{{ route('update_copoun', $copoun->id) }}",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,

            success: function(data) {

                swal("تم التعديل بنجاح", {
                    buttons: false,
                    timer: 2000,
                    icon: "success"
                });
                setTimeout(function() {
                    window.location.reload();
                }, 1000);






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
