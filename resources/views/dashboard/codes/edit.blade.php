
<div class="modal-body ">
    <div id="form-errors" class="text-center"></div>
    <div id="success" class="text-center"></div>
    <form id="sendformd">
        @csrf



        <div class="input-item">
          <label for="">المتجر</label>
          <select name="store_id" required class="form-control" id="select_store_edit">
            <option value="" selected disabled>احتر المتجر</option>

       @foreach ($stores as $item)
       <option value="{{ $item->id }}" @if($item->id == $code->store_id)  selected @endif>{{ $item->title }} </option>
       @endforeach
       
    </select>
        </div>



        <div class="input-item">
          <label for="">المشهور</label>
          @if(auth()->user()->hasRole('Admin'))
          <select name="famous_id" required class="form-control" id="">
              @foreach ($famous as $item)
              <option value="{{ $item->id }}" @if($item->id == $code->famous_id) selected @endif>{{ $item->name }} </option>
              @endforeach
      </select>
      @else
      <input type="hidden" name="famous_id" value="{{ auth()->user()->famous->id }}" readonly  class="form-control" id="email">
      <input type="text"  class="form-control" readonly value="{{ auth()->user()->famous->name }}"  id="">
      @endif
        </div>



        <div class="input-item">
          <label for="">اسم كود الخصم</label>
          <input type="text" required name="code" value="{{ $code->code }}" class="form-control" id="codechange_edit">
        </div>



        <div class="input-item">
          <label for="">نسبة كود الخصم</label>
          <input type="text" name="discount_percentage" readonly value="{{ $code->discount_percentage }}" required class="form-control form-control-lg input-lg"
          id="discount_code_edit">        </div>

          <input type="hidden" id="benefit_edit" value="{{ $code->discount_percentage}}" name="benefit_percentage">


        <div class="input-item">
          <label for="">فايدة استخدام الكود</label>
          <input type="number" max="100" min="0" readonly
                        class="form-control form-control-lg input-lg" value="{{ get_total_benefit($code->id) }}" id="penifet_new_edit">
        </div>



        <div class="input-item">
          <label for="">نسبة المشهور</label>
          <input type="text" name="famous_percentage" @if(auth()->user()->hasRole('Famous')) readonly @endif max="100" min="0" value="{{ $code->famous_percentage }}" required class="form-control form-control-lg input-lg"
          id="famous_percentage_edit">
        </div>

        <div class="input-item">
          <label for="">نسبة كودك</label>
          <input type="text" name="system_percentage" max="100" min="0" @if(auth()->user()->hasRole('Famous')) readonly @endif   value="{{ $code->system_percentage }}"required class="form-control form-control-lg input-lg"
          id="system_percentage_edit">
        </div>

        <div class="input-item">
          <label for="date">تاريخ بداية الكود</label>

          <div class="inner-input d-block form-control p-0 date" style="height:46px; direction: ltr;">
            <input type="date" readonly name="start_at" value="{{ $code->start_at }}" required
            class="form-control form-control-lg input-lg" id="start_at_edit">
                        <!-- <span class="border h-100 upload-img"> <img src="./assets/images/icons/date.png" alt="" class="me-1"></span> -->
          </div>
        </div>

        <div class="input-item">
          <label for="date">تاريخ نهاية الكود</label>

          <div class="inner-input d-block form-control p-0 date" style="height:46px; direction: ltr;">
            <input type="date" readonly name="end_at" value="{{ $code->end_at }}" required
            class="form-control form-control-lg input-lg" id="end_at_edit">            <!-- <span class="border h-100 upload-img"> <img src="./assets/images/icons/date.png" alt="" class="me-1"></span> -->
          </div>
        </div>








        <div class="input-item">
          <button type="submit" id="add_code_edit" class="btn text-end add-store">تعديل</button>
        </div>

      </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
     $('#sendformd').on('submit', function(e) {
        e.preventDefault();
           
        var frm = $('#sendformd');
        var token = "{{ csrf_token() }}";

        var formData = new FormData(frm[0]);

        var data = $(this).serialize();
        e.preventDefault();

        var data = $(this).serialize();
        $.ajax({
            url: "{{ route('update_code', $code->id) }}",
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
                swal(
                        '',
                        'لا يمكن اضافة كود تم اضافته مسبقا لنفس المشهور على نفس المتجر',
                        'error'
                    )
            },
        });
    });
    $('#famous_percentage_edit').change(function(){
            var numb_code = 100- $(this).val();
            $('#system_percentage_edit').val(numb_code);
        });
        $('#system_percentage_edit').change(function(){
            var numb_code = 100- $(this).val();
            $('#famous_percentage_edit').val(numb_code);
        });
        $('#system_percentage').change(function(){
            var numb_code = 100- $(this).val();
            $('#famous_percentage').val(numb_code);
        });
    $('#select_store_edit').change(function() {
        $("#codechange_edit").val('');
        $("#start_at_edit").val('');
        $("#end_at_edit").val('');
        $("#discount_code_edit").val('');
        $('penifet_new_edit').val('');
        $('benefit_edit').val('');

        $('#add_code_edit').attr("disabled", true);
    });
    $("#codechange_edit").change(function() {
        var store = $('#select_store_edit').val();
        if (store == null) {
            $("#codechange_edit").val('');
            swal(
                '',
                ' يرجى اختيار المتجر اولا   ',
                'error'
            )
        }
        var code = $("#codechange_edit").val();
        $.ajax({
            url: "{{ route('check_code') }}",
            type: "get",
            data: {
                store: store,
                code: code
            },
            success: function(data) {
                if (data.status == 'false') {
                    swal(
                        '',
                        data.message,
                        'error'
                    );
                    $('#add_code_edit').attr("disabled", true);
                    $("#codechange_edit").val('');
                    $("#start_at_edit").val('');
                    $("#end_at_edit").val('');
                    $("#discount_code_edit").val('');
                    $('penifet_new_edit').val();
                    $('benefit_edit').val();

                } else if (data.status == 'true') {
                    swal(
                        '',
                        data.message,
                        'success'
                    );
                    $('#add_code_edit').attr("disabled", false);
                    $('#discount_code_edit').val(data.discount);
                    $('#start_at_edit').val(data.start_at);
                    $('#end_at_edit').val(data.end_at);
                    $('#benefit_edit').val(data.beneif);
                    $("#discount_code_edit").val(data.benift_new);


                }


            },
            error: function(data) {

            },
        });
    });
</script>
