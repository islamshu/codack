<tr>
     <td class="text-right">{{ $key + 1 }}</td>
     <td class="text-right"><img src="{{ asset('uploads/'.$item->image) }}" width="80" height="80" alt=""> </td>
     <td class="text-right">{{ $item->name }} </td>
     <td class="text-right">{{ $item->country->title }} </td>
     <td class="text-right">{{ $item->phone }} </td>

     <td class="text-right">
        <a href="{{ route('famous.edit', $item->id) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>

        <form style="display: inline"
            action="{{ route('famous.destroy', $item->id) }}"
            method="post">
            @method('delete') @csrf
            <button type="submit" class="btn btn-danger delete-confirm"><i
                    class="fa fa-trash"></i></button>
        </form>
    </td>
</tr>