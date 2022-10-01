
<div class="modal-body ">
    <div id="form-errors" class="text-center"></div>
    <div id="success" class="text-center"></div>
<form id="add_encome_ajax">
    @csrf
    <input type="hidden" name="code_id" value="{{ $code }}" id="">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email"> القيمة المراد اضافتها على العمليات :</label>
               <input type="number" required min="0" class="form-control" name="amount_title" id="">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email"> القيمة المراد اضافتها على الايرادات :</label>
               <input type="number" required min="0" class="form-control" name="amount" id="">
            </div>
        </div>
       
       
    </div>
   

    <button type="submit" id="add_code_edit" class="btn btn-info">اضافة</button>
</form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
     $('#add_encome_ajax').on('submit', function(e) {
        e.preventDefault();
           
        var frm = $('#add_encome_ajax');
        var token = "{{ csrf_token() }}";


        var data = $(this).serialize();
        e.preventDefault();
        $.ajax({
                type: 'post',
                url: "{{ route('store_income') }}",
                data: data,
                beforeSend: function() {},
                success: function(data) {
                    swal(
                    '',
                    'تم الاضافة بنجاح ',
                    'success'
                )
                setTimeout(function() {
         window.location.reload();
      }, 2000);

                }
            });
       
   
    });
</script>
