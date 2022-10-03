<tr>
     <td class="text-right">{{ $key }}</td>
     <td class="text-right"><img src="{{ asset('uploads/'.$store->image) }}" width="50" height="30" alt=""> </td>
     <td class="text-right">{{ $store->title }} </td>
     <td class="text-right">0 </td>
     <td class="text-right">0</td>
     <td class="text-right">{{ @$store->user->hasRole('Admin') ?'الادارة' : @$store->user->name }}</td>
     <td class="text-right">
        @if(auth()->user()->hasRole('Admin'))

        <button class="btn btn-info" data-toggle="modal" data-target="#myModal4"
        onclick="make('{{ $store->id }}')"><i class="fa fa-edit"></i></button>
        <form style="display: inline" action="{{ route('stores.destroy',$store->id) }}" method="post">
            @method('delete') @csrf
            <button type="submit"  class="btn btn-danger delete-confirm"><i
                    class="fa fa-trash"></i></button>
        </form>
        @else
        _
        @endif
    </td>
</tr>
