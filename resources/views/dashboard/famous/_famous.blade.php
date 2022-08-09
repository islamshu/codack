<tr>
    <td>{{ $key + 1 }}</td>
    <td><img src="{{ asset('uploads/'.$item->image) }}" width="80" height="80" alt=""> </td>
    <td>{{ $item->name }} </td>
    <td>{{ $item->country->title }} </td>
    <td>{{ $item->phone }} </td>

    <td>
        <a href="{{ route('famous.edit', $item->id) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>

        <form style="display: inline"
            action="{{ route('famous.destroy', $item->id) }}"
            method="post">
            @method('delete') @csrf
            <button type="submit" class="btn btn-danger"><i
                    class="fa fa-trash"></i></button>
        </form>
    </td>
</tr>