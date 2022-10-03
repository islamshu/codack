
<tr>
     <td class="text-right">{{ $key + 1 }}</td>
     <td class="text-right">{{ $item->code }} </td>
     <td class="text-right">{{ $item->discount }} </td>
     <td class="text-right">{{ $item->use_count }} </td>
     <td class="text-right">
        <input type="checkbox" data-id="{{ $item->id }}" name="status" class="js-switch" checked="" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="background-color: rgb(100, 189, 99); border-color: rgb(100, 189, 99); box-shadow: rgb(100, 189, 99) 0px 0px 0px 11px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small style="left: 13px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
        </td>
             <td class="text-right">

        <button class="btn btn-info" data-toggle="modal"
            data-target="#myModal4" onclick="make('{{ $item->id }}')"><i
                class="fa fa-edit"></i></button>
        <form style="display: inline"
            action="{{ route('copouns.destroy', $item->id) }}" method="post">
            @method('delete') @csrf
            <button type="submit" class="btn btn-danger delete-confirm"><i
                    class="fa fa-trash"></i></button>
        </form>

    </td>
</tr>