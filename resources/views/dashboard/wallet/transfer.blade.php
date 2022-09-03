<div class="modal-body ">
    <form @if($error == 'success') id="send_bank" @endif>
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email"> قيمة التحويل    :</label>
                    <input type="number" value="{{ $total }}" readonly min="1000" class="form-control" name="amount">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">  اسم البنك  :</label>
                    <input type="text" class="form-control" value="{{@ auth()->user()->famous->bank->bank_name }}" required name="bank_name" id="email">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email"> رقم الحساب       :</label>
                    <input type="number" class="form-control" required value="{{@ auth()->user()->famous->bank->account_nubmer }}" name="account_number" id="email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">   الاسم بالبنك  :</label>
                    <input type="text" class="form-control" required value="{{@ auth()->user()->famous->bank->account_name }}" name="account_name" id="email">
                </div>
            </div>
        </div>


        <button @if($error == 'success') type="submit"  @else type="button" @endif id="{{ $error }}" class="btn btn-info">ارسال</button>
    </form>

</div>
<script>
    $(document).on('click', '#error', function(e) {
        var price = {{ get_general_value('min_wallet') }};
        swal(
            'خطأ!',
            'لا يمكن سحب مبلغ اقل من ' + price + '  ريال',
            'error'
        )
    });
     $('#send_bank').on('submit', function(e) {
            e.preventDefault();
            var frm = $('#send_bank');
            var formData = new FormData(frm[0]);

            var data = $(this).serialize();

            $.ajax({
                url: "{{ route('send_bank_data') }}",
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {

                    swal(data['message'], {
                    buttons: false,
                    timer: 3000,
                    icon: "success"
                });
                setTimeout(function() {
                    window.location.reload();
                }, 3000);



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