@extends('layouts.tenant', ['title' => __('Banners')]) @section('content')

<div class="">
	<div class="max-w-7xl mx-auto">
		<a href="{{ route('tenant.banners.create') }}" class="px-5 py-2 text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 active:bg-indigo-700 transition ease-in-out duration-150">
			{{ __('New banner') }}
		</a>
		<div class="block">
			<div class="flex flex-col">
				@include('tenant.banners.banner-table', [
				'banners' => $stripeBanners,
				'tableTitle' => 'Stripe banner'
				])

				@include('tenant.banners.banner-table', [
				'banners' => $fullBanners,
				'tableTitle' => 'Full banner'
				])

				@include('tenant.banners.banner-table', [
				'banners' => $showcaseBanners,
				'tableTitle' => 'Showcase banner'
				])

				@include('tenant.banners.banner-table', [
				'banners' => $sideBanners,
				'tableTitle' => 'Side banner'
				])

				@include('tenant.banners.banner-table', [
				'banners' => $miniBanners,
				'tableTitle' => 'Mini banner'
				])
			</div>
		</div>
	</div>
</div>

@include('layouts.snippets.delete-modal', ['entity' => 'banner'])

@endsection
