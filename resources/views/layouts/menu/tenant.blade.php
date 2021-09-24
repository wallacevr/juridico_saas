<!-- This example requires Tailwind CSS v2.0+ -->
<?php
$navigations = create_menu();
?>
<div class="flex flex-col flex-grow border-r border-gray-200 pt-5 pb-4 bg-white overflow-y-auto" >
    <div class="mt-5 flex-grow flex flex-col">
        <nav class="flex-1 px-2 space-y-1 bg-white" aria-label="Sidebar">
            @foreach($navigations as $keyMenu =>$navigation)
            @if(empty($navigation['children']))
            <div>
                <a href="{!! $navigation['href'] !!}" class="bg-gray-100 text-gray-900 group w-full flex items-center pl-2 py-2 text-sm font-medium rounded-md">
                    {!! get_icon($navigation['icon']) !!}
                    {!! $navigation['name'] !!}
                </a>
            </div>
            @else
            <div class="space-y-1" x-data="{products_<?=$keyMenu?>:false}">
                <!-- Current: "bg-gray-100 text-gray-900", Default: "bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900" -->
                <button @click="products_<?=$keyMenu?> = !products_<?=$keyMenu?>" type="button" class="bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900 group w-full flex items-center pl-2 pr-1 py-2 text-left text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" aria-controls="sub-menu-1" aria-expanded="false">
                    {!! get_icon($navigation['icon']) !!}
                    <span class="flex-1">
                    {!! $navigation['name'] !!}
                    </span>
                    <svg class="text-gray-300 ml-3 flex-shrink-0 h-5 w-5 transform group-hover:text-gray-400 transition-colors ease-in-out duration-150" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M6 6L14 10L6 14V6Z" fill="currentColor" />
                    </svg>
                </button>
                @foreach($navigation['children'] as $child)
                    <div x-show="products_<?=$keyMenu?>" class="space-y-1" id="sub-menu-1">
                        <a href="{!! $child['href'] !!}" class="group w-full flex items-center pl-11 pr-2 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50">
                        {!! $child['name'] !!}
                        </a>
                    </div>
                @endforeach
            </div>
            @endif
            @endforeach



        </nav>
    </div>
</div>