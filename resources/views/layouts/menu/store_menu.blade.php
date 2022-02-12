<nav class="h-full flex space-x-5 ">
    @foreach(Tools::getAllMenu() as $menu)
    <div class="py-5" x-data="{menu_<?= $menu->id ?>:false}" @mouseover="menu_<?= $menu->id ?> = true" @mouseleave="menu_<?= $menu->id ?> = false">
        <div class="relative  items-center cursor-pointer text-sm font-medium">
            <button type="button" class=" px-6 text-gray-500 group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-indigo-100 focus:ring-offset-2 " aria-expanded="false">
                <span>{{$menu->title}}</span>
                <!--
              Heroicon name: solid/chevron-down

              Item active: "text-gray-600", Item inactive: "text-gray-400"
            -->
                @if (!empty($menu->children[0]))
                <svg class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                @endif
            </button>
            @if (!empty($menu->children[0]))
            <div x-show="menu_<?= $menu->id ?>" x-cloak class="absolute z-10 -ml-4 mt-3 transform px-2 w-32   sm:px-0 lg:ml-0 " style="min-width: 150px;">
                <div class="rounded-lg shadow-lg w-48">
                    <div class=" grid bg-white px-5 py-2 ">
                    @foreach($menu->children as $subCategoryChild)
                        <a href="#" class=" py-2  text-gray-500 hover:text-indigo-100 px-5  ">
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