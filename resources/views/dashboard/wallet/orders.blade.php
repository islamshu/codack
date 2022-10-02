<table id="example" class="display compact" style="width:100%" id="storestable">
    <thead>
        <tr>
            <th>#</th>
            <th>المتجر</th>
            <th style="  width: 31% !important">المشهور</th>
            <th style="width: 1% !important">المبلغ</th>
            <th style="width: 1% !important">الخصم من الكود</th>
            <th>التاريخ </th>
        </tr>
    </thead>
    <tbody >
        @foreach ($orders as $key => $item)
        <tr>
            <th scope="row">{{ $key + 1 }}</th>
            <td>{{ @$store }} </td>
            <td>{{ @$famous }} </td>
            <td>
                {{ $item['total_amount'] }}
            </td>
            <td>
                {{ $item['discount'] }}
    
            </td>
    
    
            <td>{{ date('Y-m-d', strtotime($item['date'])) }}</td>
        </tr>
    @endforeach



    </tbody>
</table>

@if (get_lang() == 'ar')
<script>
    $('table').DataTable({
        "initComplete": function(settings, json) {
            $("table").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
        },
        "language": {
            "sProcessing": "جارٍ التحميل...",
            "sLengthMenu": "أظهر _MENU_ مدخلات",
            "sZeroRecords": "لم يعثر على أية سجلات",
            "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخلات",
            "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
            "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
            "sInfoPostFix": "",
            "sSearch": "ابحث:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "الأول",
                "sPrevious": "السابق",
                "sNext": "التالي",
                "sLast": "الأخير"
            }
        }
    });
  
</script>
@endif
