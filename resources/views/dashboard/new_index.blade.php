@extends('layout.dashboard')
<div id="page-content" class="container-fluid mt-5">

</div>

<script src="{{ asset('new_dash/lib/jquery/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('new_dash/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('new_dash/lib/bootstrap-slider/bootstrap-slider.min.js') }}"></script>

<script src="{{ asset('new_dash/all/js/scripts.js') }}"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('table').DataTable();
    });
</script>
</body>

</html>
