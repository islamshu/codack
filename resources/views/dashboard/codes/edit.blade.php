
<div class="modal-body ">
    <div id="form-errors" class="text-center"></div>
    <div id="success" class="text-center"></div>
<form id="sendformd">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email"> المتجر :</label>
                <select name="store_id" required class="form-control" id="">
                    <option value="" selected disabled>احتر المتجر</option>

               @foreach ($stores as $item)
               <option value="{{ $item->id }}" @if($item->id == $code->store_id)  selected @endif>{{ $item->title }} </option>
               @endforeach
               
            </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email"> المشهور :</label>
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
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email"> اسم كود الخصم  :</label>
                <input type="text" required name="code" value="{{ $code->code }}"  class="form-control" id="email">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email"> نسبة كود الخصم :</label>
                <fieldset class="form-group position-relative">
                    <input type="number" name="discount_percentage" value="{{ $code->discount_percentage }}" required class="form-control form-control-lg input-lg"
                        id="iconLeft3">
                    <div class="form-control-position phoneicon" style="margin-top: -3px;display: flex">
                        %
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email"> فايدة استخدام الكود     :</label>
                <fieldset class="form-group position-relative">
                    <input type="number" name="benefit_percentage" value="{{ $code->benefit_percentage }}" required class="form-control form-control-lg input-lg"
                        id="iconLeft3">
                    <div class="form-control-position phoneicon" style="margin-top: -3px;display: flex">
                        %
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email"> نسبة كودك  :</label>
                <fieldset class="form-group position-relative">

                    <input type="number" name="system_percentage"  value="{{ $code->system_percentage }}"required class="form-control form-control-lg input-lg"
                        id="iconLeft3">
                    <div class="form-control-position phoneicon" style="margin-top: -3px;display: flex">
                        %
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email"> نسبة المشهور     :</label>
                <fieldset class="form-group position-relative">

                    <input type="number" name="famous_percentage" value="{{ $code->famous_percentage }}" required class="form-control form-control-lg input-lg"
                        id="iconLeft3">
                    <div class="form-control-position phoneicon" style="margin-top: -3px;display: flex">
                        %
                    </div>
                </fieldset>
            </div>
        </div>

    </div>

    <button type="submit" class="btn btn-default">تعديل</button>
</form>
</div>
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