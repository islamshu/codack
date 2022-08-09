<tr>
    <td>{{ $key }}</td>
    <td><img src="{{ asset('uploads/'.$store->image) }}" width="100" height="70" alt=""> </td>
    <td>{{ $store->title }} </td>
    <td>0 </td>
    <td>0</td>
    <td>
        <button class="btn btn-info" data-toggle="modal" data-target="#myModal4"
        onclick="make('{{ $store->id }}')"><i class="fa fa-edit"></i></button>
        <form style="display: inline" action="{{ route('stores.destroy',$store->id) }}" method="post">
            @method('delete') @csrf
            <button type="submit"  class="btn btn-danger"><i
                    class="fa fa-trash"></i></button>
        </form>
    </td>
</tr>
