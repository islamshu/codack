<tr>
    <td>{{ $key + 1 }}</td>
    <td> {{ @$item->store->title }}</td>
    <td> {{ $item->code }}</td>
    <td>{{ @$item->famous->name }} </td>
    <td>{{ $item->discount_percentage }}</td>
    @if(auth()->user()->hasRole('Admin'))

    <td> {{ $item->benefit_percentage }}</td>
    <td> {{ $item->system_percentage }}</td>
    <td>{{ $item->famous_percentage }} </td>
    @else
    <td>{{ $item->famous_percentage }} </td>
     @endif  

    <td>

        <button class="btn btn-info" data-toggle="modal"
        data-target="#myModal4" onclick="make('{{ $item->id }}')"><i
            class="fa fa-edit"></i></button>
        <form style="display: inline"
            action="{{ route('codes.destroy', $item->id) }}" method="post">
            @method('delete') @csrf
            <button type="submit" class="btn btn-danger"><i
                    class="fa fa-trash"></i></button>
        </form>
    </td>



</tr>