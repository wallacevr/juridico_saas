<div id="mySidenav"
    class="sidenav flex flex-col h-screen py-8 border-r bg-gray-100 border-gray-600 border">
    <h2 class="text-2xl font-semibold text-gray-800 text-white">
        {{ __('label.Edit menu item') }}
    </h2>
    <a href="#" id="close-icon" class="close-button">&times;</a>

    <hr class="my-2 border-black-600" />

    <input type="hidden" id="submenuIdEdit">

    <div class="relative mt-6">
        <div>
            <label for="submenuNameEdit"
                class="mx-1 text-sm font-medium text-gray-700">{{ __('label.Name') }}</label>
            <input type="text" id="submenuNameEdit"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="{{ __('label.e.g. Bags & Shoes') }}" />
        </div>
        <div class="pt-4">
            <label for="submenuUrlEdit"
                class="mx-1 text-sm font-medium text-gray-700">{{ __('label.Submenu url') }}</label>
            <input type="text" id="submenuUrlEdit"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="{{ __('label.www.mystore.com/shoes') }}" />
        </div>
    </div>

    <div class="flex flex-col justify-between flex-1 mt-6">
        <span class="flex items-center px-4 py-2">
        </span>

        <div class="flex items-right px-4 -mx-2">
            <span class="mx-2 inline-flex shadow-sm">
                <button type="button"
                    class="close-button py-1 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                    {{ __('Cancel') }}
                </button>
            </span>
            <div class="flex-grow"></div>
            <span class="ml-3 inline-flex rounded-md shadow-sm">
                <button type="submit"
                    class="menu-submit py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                    {{ __('Change') }}
                </button>
            </span>
        </div>
    </div>

</div>
