<tr>
     <td class="text-right">{{ $key + 1 }}</td>
     <td class="text-right"> {{ @$item->store->title }}</td>
    
    {{--  <td class="text-right"> {{ get_total_code($item->id) }}</td> --}}
     <td class="text-right">{{ $item->code }}</td>
     <td class="text-right">{{ @$item->famous->name }} </td>
     <td class="text-right">{{ $item->discount_percentage }}</td>
    @if(auth()->user()->hasRole('Admin'))

     <td class="text-right"> {{ $item->benefit_percentage }}</td>
     <td class="text-right"> 
        {{ get_total_system_code_api($item->id) }}
        </td>
     <td class="text-right">
        {{ get_total_famous_code_api($item->id) }}
    </td>
    @else
     <td class="text-right">
        {{ get_total_famous_code_api($item->id) }}
    </td>
     @endif  
      <td class="text-right"> {{ get_total_code($item->id) }}</td>
      <td class="text-right"> {{ get_total_mount_code($item->id) }}</td>


     <td class="text-right">


        <button class="btn btn-info" data-toggle="modal"
        data-target="#myModal4" onclick="make('{{ $item->id }}')"><i
            class="fa fa-edit"></i></button>
        <form style="display: inline"
            action="{{ route('codes.destroy', $item->id) }}" method="post">
            @method('delete') @csrf
            <button type="submit" class="btn btn-danger delete-confirm"><i
                    class="fa fa-trash"></i></button>
        </form>
    </td>



</tr>