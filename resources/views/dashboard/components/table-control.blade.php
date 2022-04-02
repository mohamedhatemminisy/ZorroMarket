@if($name && $value && $permission)

<div class="btn-group" role="group" aria-label="Basic example">

    <a href="{{route($name.'.edit',$value -> id)}}" class="btn btn-sm btn-clean
                btn-icon mr-2 " title="@lang('admin.edit')">
        <i class="fa fa-edit"></i>
    </a>
 
    <a href="{{route($name.'.show',$value->id)}}" class="btn btn-sm btn-clean
                btn-icon mr-2 " title="{{trans('admin.details')}}"><i class="fas fa-eye"></i></a>  
    <form id="delete-form-{{ $value->id }}" style="display: inline-table;" action="{{route($name.'.destroy',$value -> id)}}" method="post">
        @csrf
        @method('delete')
        <button type="button" class="btn btn-sm btn-clean btn-icon" title="@lang('admin.delete')" onclick="confirmDelete
     ('delete-form-{{ $value->id }}')">
            <i class="fa fa-trash"></i>
        </button>
    </form>
 </div>
@endif