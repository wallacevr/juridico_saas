<nav class="h-full flex space-x-5 ">

    @foreach(Tools::getAllMenu() as $menu)
    <div class="py-5" x-data="{menu_<?= $menu->id ?>:false}" @mouseover="menu_<?= $menu->id ?> = true" @mouseleave="menu_<?= $menu->id ?> = false">
        <div class="relative items-center cursor-pointer text-sm font-medium">
            <a href="{{$menu->url}}" class=" px-6  inline-flex items-center font-medium">
                {{$menu->title}}
                @if (!empty($menu->children[0]))
                <svg class="secundary-text ml-2 h-5 w-5 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                @endif
            </a>
            @if (!empty($menu->children[0]))
            <div x-show="menu_<?= $menu->id ?>" x-cloak class="absolute z-10 -ml-4 mt-3 transform px-2 w-32   sm:px-0 lg:ml-0 " style="min-width: 150px;">
                <div class="rounded-lg shadow-lg w-48">
                    <div class=" grid bg-white px-5 py-2 ">
                    @foreach($menu->children as $subCategoryChild)
                        <a href="{{$subCategoryChild->url}}" class=" py-2  text-secundary px-5  ">
                            {{$subCategoryChild->title}}
                        </a>
                       @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    @endforeach

</nav>
