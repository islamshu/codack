<tr>
    <td>{{ $key }}</td>
    <td><img src="{{ asset('uploads/'.$soical->icon) }}" width="30" height="30" alt=""> </td>
    <td>{{ $soical->title }} </td>
   
    <td>
        <button class="btn btn-info" data-toggle="modal" data-target="#myModal4"
        onclick="make('{{ $soical->id }}')"><i class="fa fa-edit"></i></button>
        <form style="display: inline" action="{{ route('soical.destroy',$soical->id) }}" method="post">
            @method('delete') @csrf
            <button type="submit"  class="btn btn-danger delete-confirm"><i
                    class="fa fa-trash"></i></button>
        </form>
    </td>
</tr>
