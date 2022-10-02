<table id="example" class="display compact" style="width:100%" >
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


