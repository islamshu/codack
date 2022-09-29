<div class="modal-body ">
    <div id="form-errors" class="text-center"></div>
    <div id="success" class="text-center"></div>
    <form id="edit_form">
        @csrf <div class="input-item">
            <label for="">اسم المتجر بالعربي <span class="text-danger">*</span></label>
            <input type="text" name="title_ar" required class="form-control"
                value="{{ $store->getTranslation('title', 'ar') }}" id="title_ar">
        </div>
    
        <div class="input-item">
            <label for="">اسم المتجر بالانجليزي<span class="text-danger">*</span></label>
            <input type="text" name="title_en" required class="form-control"
                value="{{ $store->getTranslation('title', 'en') }}" id="title_en">
        </div>
    
        <div class="input-item">
            <label for="">رابط الربط للمتجر (API) </label>
            <input type="text" name="api_link" value="{{ $store->api_link }}" class="form-control" id="api_link">
        </div>
    
        <div class="input-item">
            <label for="">
                فائدة استخدام الكود :</label>
            <input type="number" name="benift" value="{{ $store->benift }}" class="form-control" id="benift">
        </div>
    
        <div class="input-item">
            <label for="">رقم السجل التجاري</label>
            <input type="number" name="commercial_register" value="{{ $store->commercial_register }}" class="form-control"
                id="commercial_register">
        </div>
    
        <div class="input-item">
            <label for="">الموقع الالكتروني</label>
            <input type="text" name="website" value="{{ $store->website }}" class="form-control" id="website">
        </div>
    
    
        <div class="input-item">
            <label for="">رابط تطبيق الاندرويد</label>
            <input type="text" name="android" value="{{ $store->android }}" class="form-control" id="android">
    
            <img src="{{ asset('new_dash/images/icons/android.png') }}" alt="" class="me-1 android-img">
        </div>
    
        <div class="input-item">
            <label for="">رابط تطبيق الآيفون</label>
            <input type="text" name="ios" value="{{ $store->ios }}" class="form-control" id="ios">
            <img src="{{ asset('new_dash/images/icons/apple.png') }}" alt="" class="me-1 apple-img">
        </div>
    
        <div class="input-item">
            <label for="file">صورة الشعار<span class="text-danger">*</span></label>
    
            <label class="custom-file-upload d-block form-control p-0" style="height:46px; direction: ltr;">
                <input type="file" id="imageedit"  name="image" />
                <span class="border h-100 upload-img">رفع صورة <img src="{{ asset('new_dash/images/icons/upload.png') }}"
                        alt="" class="me-1"></span> <img src="{{ asset('uploads/'.$store->image) }}"
                    alt="" class="me-1 ms-2 " width="20">
            </label>
        </div>
        <br>
    
        <div class="input-item">
            <button class="btn text-end add-store"> تعديل</button>
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
            url: "{{ route('update_stores', $store->id) }}",
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
