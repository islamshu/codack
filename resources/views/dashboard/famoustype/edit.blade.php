<div class="modal-body ">
    <div id="form-errors" class="text-center"></div>
    <div id="success" class="text-center"></div>
    <form id="edit_form">
        @csrf

        <div class="row">
            <div class="form-group col-md-6">
                <label for="email"> اسم المجال بالعربية: <span class="required">*</span></label>
                <input type="text" name="title_ar" required class="form-control"
                    value="{{ $famous->getTranslation('title', 'ar') }}" id="title_ar">
            </div>
            <div class="form-group col-md-6">
                <label for="email"> اسم المجال بالانجليزية: <span class="required">*</span></label>
                <input type="text" name="title_en" required class="form-control"
                    value="{{ $famous->getTranslation('title', 'en') }}" id="title_en">
            </div>

           
         
        </div>


        <button class="btn btn-info" type="submit">تعديل </i></button>
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

        var data = $(this).serialize();
        e.preventDefault();

        $.ajax({
            url: "{{ route('update_famoustype', $famous->id) }}",
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
