@foreach ($orders as $key =>$item)
<tr>
    <th scope="row">{{ $key +1 }}</th>
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