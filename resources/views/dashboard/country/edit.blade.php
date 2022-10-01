<div class="modal-body ">
    <div id="form-errors" class="text-center"></div>
    <div id="success" class="text-center"></div>
    <form id="edit_form">
        @csrf

      <div class="row">
        <div class="input-item">
            <label for="file"> علم الدولة <span class="text-danger">*</span></label>
    
            <label class="custom-file-upload d-block form-control p-0"
                style="height:46px; direction: ltr;">
                <input type="file" id="imageedit"  name="icon" />
                <span class="border h-100 upload-img">رفع صورة <img
                        src="{{ asset('new_dash/images/icons/upload.png') }}" alt=""
                        class="me-1"></span> <img src="{{ asset('uploads/'.$country->flag) }}"
                    alt="" class="me-1 ms-2 " width="20">
            </label>
        </div>
    </div>
        <div class="input-item">
            <label for="">اسم الدولة بالعربي <span class="text-danger">*</span></label>
            <input type="text" name="title_ar" required class="form-control"
                value="{{ $country->getTranslation('title', 'ar') }}" id="title_ar">
        </div>
        <div class="input-item">
            <label for="">اسم الدولة بالانجليزية <span class="text-danger">*</span></label>
            <input type="text" name="title_en" required class="form-control"
                value="{{ $country->getTranslation('title', 'en') }}" id="title_en">
        </div>
        <div class="input-item">
            <label for="">رمز الدولة   <span class="text-danger">*</span></label>
            <input type="text" name="code" required class="form-control"
                value="{{ $country->code }}" id="code">
        </div>
        


        <div class="input-item">
            <button class="btn text-end add-store">+ تعديل الدولة</button>
        </div>
        </form>

</div>

<script>
    $(".image").change(function() {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.image-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }

    });
    $('#edit_form').on('submit', function(e) {
        var frm = $('#edit_form');
        var token = "{{ csrf_token() }}";

        var formData = new FormData(frm[0]);
        formData.append('file', $('#imageedit')[0].files[0]);

        var data = $(this).serialize();
        e.preventDefault();

        var data = $(this).serialize();
        $.ajax({
            url: "{{ route('update_country', $country->id) }}",
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
