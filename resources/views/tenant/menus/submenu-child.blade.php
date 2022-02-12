@if(!empty($menuChild->children[0]))
@foreach($menuChild->children as $subMenuChild)
<li id="{{'menu-'. $subMenuChild->id }}" data-id="{{ $subMenuChild->id }}" data-name="{{ $subMenuChild->title }}" data-url="{{ $subMenuChild->url }}">
    <div>
        <span class="submenu-title">{{ $subMenuChild->title }}</span>

        <div class="float-right">
            @include('tenant.menus.submenu-edit-buttons')
        </div>

    </div>

    <ol>
        @include('tenant.menus.submenu-child', [ 'menuChild' => $subMenuChild])
    </ol>
</li>
@endforeach
@endif