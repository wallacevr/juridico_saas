@extends('layouts.tenant', ['title' => __('General configuration')])

@section('content')
    <form action="{{ route('tenant.layout.image.update') }}" method="POST" id="storeSettings">
        @csrf

        <!-- Block 1 -->
        <div class="flex flex-row flex-wrap">
            <!-- header -->
            <div class="w-full md:w-1/3">
                <div class="px-4 md:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Store Image Configuration') }}
                    </h3>
                    <p class="mt-1 text-sm leading-5 text-gray-600">
                        {{ __('Here you can customize image size') }}
                    </p>
                </div>
            </div>

            <!-- body -->
            <div class="-0 w-full md:w-2/3 pl-0 md:pl-2 ">

                <div class="shadow overflow-hidden sm:rounded-md bg-white">

                    <div class="px-4 py-5  sm:p-6">
                        <h5 class="text-lg font-medium leading-6 text-gray-900">{{ __('Thumbnail') }}</h5>
                        <div class="mt-6 flex">
                            <div class="sm:col-span-1">
                                <label for="username"
                                    class="block text-sm font-medium text-gray-700">{{ __('Width') }}<span
                                        class="red">*</span></label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="number" name="thumb_width"
                                        class="block w-20 border border-gray-300 shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="140" value="{{ get_config('general/layout/thumb_width') }}">
                                    <span
                                        class="bg-gray-50 border border-l-0 border-gray-300 px-3 inline-flex items-center text-gray-500 sm:text-sm">px</span>
                                </div>

                            </div>
                            <div class="sm:col-span-1 te">
                                <div>&nbsp;</div>
                                <div class="mt-2  text-gray-700"> <label
                                        class="block text-lg font-medium leading-5 text-gray-500 px-2"> X </label> </div>
                            </div>
                            <div class="sm:col-span-1">

                                <label for="username"
                                    class="block text-sm font-medium text-gray-700">{{ __('Height') }}<span
                                        class="red">*</span></label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text" name="thumb_height"
                                        class="require block w-20 border border-gray-300 shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="140" value="{{ get_config('general/layout/thumb_height') }}">
                                    <span
                                        class="bg-gray-50 border border-l-0 border-gray-300 px-3 inline-flex items-center text-gray-500 sm:text-sm">px</span>
                                </div>

                            </div>
                        </div>


                    </div>

                    @include('layouts.snippets.divide')
                    <div class="px-4 py-5  sm:p-6">
                        <h5 class="text-lg font-medium leading-6 text-gray-900">{{ __('Small') }}</h5>
                        <div class="mt-6 flex">
                            <div class="sm:col-span-1">
                                <label for="username"
                                    class="block text-sm font-medium text-gray-700">{{ __('Width') }}<span
                                        class="red">*</span></label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="number" name="small_width"
                                        class="block w-20 border border-gray-300 shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="140" value="{{ get_config('general/layout/small_width') }}">
                                    <span
                                        class="bg-gray-50 border border-l-0 border-gray-300 px-3 inline-flex items-center text-gray-500 sm:text-sm">px</span>
                                </div>

                            </div>
                            <div class="sm:col-span-1 te">
                                <div>&nbsp;</div>
                                <div class="mt-2  text-gray-700"> <label
                                        class="block text-lg font-medium leading-5 text-gray-500 px-2"> X </label> </div>
                            </div>
                            <div class="sm:col-span-1">

                                <label for="username"
                                    class="block text-sm font-medium text-gray-700">{{ __('Height') }}<span
                                        class="red">*</span></label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text" name="small_height"
                                        class="require block w-20 border border-gray-300 shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="140" value="{{ get_config('general/layout/small_height') }}">
                                    <span
                                        class="bg-gray-50 border border-l-0 border-gray-300 px-3 inline-flex items-center text-gray-500 sm:text-sm">px</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    @include('layouts.snippets.divide')
                    <div class="px-4 py-5  sm:p-6">
                        <h5 class="text-lg font-medium leading-6 text-gray-900">{{ __('Medium') }}</h5>
                        <div class="mt-6 flex">
                            <div class="sm:col-span-1">
                                <label for="username"
                                    class="block text-sm font-medium text-gray-700">{{ __('Width') }}<span
                                        class="red">*</span></label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="number" name="medium_width"
                                        class="block w-20 border border-gray-300 shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="140" value="{{ get_config('general/layout/medium_width') }}">
                                    <span
                                        class="bg-gray-50 border border-l-0 border-gray-300 px-3 inline-flex items-center text-gray-500 sm:text-sm">px</span>
                                </div>

                            </div>
                            <div class="sm:col-span-1 te">
                                <div>&nbsp;</div>
                                <div class="mt-2  text-gray-700"> <label
                                        class="block text-lg font-medium leading-5 text-gray-500 px-2"> X </label> </div>
                            </div>
                            <div class="sm:col-span-1">

                                <label for="username"
                                    class="block text-sm font-medium text-gray-700">{{ __('Height') }}<span
                                        class="red">*</span></label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text" name="medium_height"
                                        class="require block w-20 border border-gray-300 shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="140" value="{{ get_config('general/layout/medium_height') }}">
                                    <span
                                        class="bg-gray-50 border border-l-0 border-gray-300 px-3 inline-flex items-center text-gray-500 sm:text-sm">px</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    @include('layouts.snippets.divide')
                    <div class="px-4 py-5  sm:p-6">
                        <h5 class="text-lg font-medium leading-6 text-gray-900">{{ __('Big') }}</h5>
                        <div class="mt-6 flex">
                            <div class="sm:col-span-1">
                                <label for="username"
                                    class="block text-sm font-medium text-gray-700">{{ __('Width') }}<span
                                        class="red">*</span></label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="number" name="big_width"
                                        class="block w-20 border border-gray-300 shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="140" value="{{ get_config('general/layout/big_width') }}">
                                    <span
                                        class="bg-gray-50 border border-l-0 border-gray-300 px-3 inline-flex items-center text-gray-500 sm:text-sm">px</span>
                                </div>

                            </div>
                            <div class="sm:col-span-1 te">
                                <div>&nbsp;</div>
                                <div class="mt-2  text-gray-700"> <label
                                        class="block text-lg font-medium leading-5 text-gray-500 px-2"> X </label> </div>
                            </div>
                            <div class="sm:col-span-1">

                                <label for="username"
                                    class="block text-sm font-medium text-gray-700">{{ __('Height') }}<span
                                        class="red">*</span></label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text" name="big_height"
                                        class="require block w-20 border border-gray-300 shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="140" value="{{ get_config('general/layout/big_height') }}">
                                    <span
                                        class="bg-gray-50 border border-l-0 border-gray-300 px-3 inline-flex items-center text-gray-500 sm:text-sm">px</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @include('layouts.snippets.save')



    </form>
@endsection
