<tr>
    <td>{{ $key }}</td>
    <td>{{ $famous->title }} </td>
   
    <td>
        <button class="btn btn-info" data-toggle="modal" data-target="#myModal4"
        onclick="make('{{ $famous->id }}')"><i class="fa fa-edit"></i></button>
        <form style="display: inline" action="{{ route('stores.destroy',$famous->id) }}" method="post">
            @method('delete') @csrf
            <button type="submit"  class="btn btn-danger"><i
                    class="fa fa-trash"></i></button>
        </form>
    </td>
</tr>
