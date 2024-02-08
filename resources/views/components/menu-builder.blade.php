<ol>
    @forelse ($menuItem as $item)
        <li class="dd-item" data-id="{{ $item->id }}">
            <div class="pull-right item_action">
                <button type="button" class="btn btn-danger btn-sm float-right" onclick="deleteItem('{{ $item->id }}')"><i class="fa-solid fa-trash"></i></button>
                <form action="{{ route('menu.module.destroy',$item->id) }}" id="delete_form_{{ $item->id }}" method="post" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                <a href="{{ route('menu.module.edit',['menu'=>$item->menu_id,'module'=>$item->id]) }}" class="btn btn-primary btn-sm float-right edit mr-1"><i class="fa-solid fa-pen-to-square"></i></a>
            </div>
            <div class="dd-handle">
                @if ($item->type == 1)
                    <strong>Divider: {{ $item->divider_title }}</strong>
                @else
                    <span>{{ $item->module_name }}</span> <small class="url">{{ $item->url }}</small>
                @endif
            </div>
            @if (!$item->children->isEmpty())
                <x-menu-builder :menuItem="$item->children"/>
            @endif
        </li>
    @empty
        <div class="text-center">
            <strong class="text-danger">No menu item found</strong>
        </div>
    @endforelse
</ol>