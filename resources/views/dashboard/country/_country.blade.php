<tr>
    <td>{{ $key }}</td>
    <td><img src="{{ asset('uploads/'.$country->flag) }}" width="100" height="70" alt=""> </td>
    <td>{{ $country->title }} </td>
    <td>{{ $country->code }}</td>
   
    <td>
        <button class="btn btn-info" data-toggle="modal" data-target="#myModal4"
        onclick="make('{{ $country->id }}')"><i class="fa fa-edit"></i></button>
        <form style="display: inline" action="{{ route('country.destroy',$country->id) }}" method="post">
            @method('delete') @csrf
            <button type="submit"  class="btn btn-danger"><i
                    class="fa fa-trash"></i></button>
        </form>
    </td>
</tr>
