<tr>
    <td>{{ $key + 1 }}</td>
    <td> {{ @$item->store->title }}</td>
    
    {{-- <td> {{ get_total_code($item->id) }}</td> --}}
    <td>{{ $item->code }}</td>
    <td>{{ @$item->famous->name }} </td>
    <td>{{ $item->discount_percentage }}</td>
    @if(auth()->user()->hasRole('Admin'))

    <td> {{ $item->benefit_percentage }}</td>
    <td> 
        {{ get_total_system_code_api($item->id) }}
        </td>
    <td>
        {{ get_total_famous_code_api($item->id) }}
    </td>
    @else
    <td>
        {{ get_total_famous_code_api($item->id) }}
    </td>
     @endif  
     <td> {{ get_total_code($item->id) }}</td>
     <td> {{ get_total_mount_code($item->id) }}</td>


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