<div id="mySidenav"
    class="sidenav flex flex-col h-screen py-8 bg-white border-r dark:bg-gray-800 dark:border-gray-600 border">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
        {{ __('label.Edit menu item') }}
    </h2>
    <a href="#" id="close-icon" class="close-button">&times;</a>

    <hr class="my-2 dark:border-black-600" />

    <input type="hidden" id="subcategoryIdEdit">

    <div class="relative mt-6">
        <div>
            <label for="subcategoryNameEdit"
                class="mx-1 text-sm font-medium text-gray-700">{{ __('label.Name') }}</label>
            <input type="text" id="subcategoryNameEdit"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="{{ __('label.e.g. Bags & Shoes') }}" />
        </div>
        <div class="pt-4">
            <label for="subcategoryUrlEdit"
                class="mx-1 text-sm font-medium text-gray-700">{{ __('label.Subcategory url') }}</label>
            <input type="text" id="subcategoryUrlEdit"
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
                    {{ __('actions.Cancel') }}
                </button>
            </span>
            <div class="flex-grow"></div>
            <span class="mx- inline-flex shadow-sm">
                <button type="button"
                    class="save-button py-1 px-10 h-30 bg-green-600 border border-green-300 rounded-md text-sm font-medium text-white hover:text-black focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition duration-150 ease-in-out">
                    {{ __('actions.Save') }}
                </button>
            </span>
        </div>
    </div>

</div>
