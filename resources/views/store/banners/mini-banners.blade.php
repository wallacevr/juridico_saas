<div class="swiper mySwiper ">
    <div class="grid grid-cols-{{count($bannersMini)}} gap-{{count($bannersMini)}} mx-6 flex items-center">
        @foreach ($bannersMini as $banner)
         <a href="{{$banner->url}}">
            <div class="swiper-slidec max-h-48 px-8" >
                <img class="w-max-48 h-max-48 object-center object-cover" src="{{ tenant_public_path() . '/images/banners/'. $banner->image_url }}" alt="{{ $banner->name }}" />
            </div>
          </a>
        @endforeach
    </div>

</div>



@push('js')
<script>
    var swiper = new Swiper('.mySwiper', {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
          delay: 3500,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });
</script>
@endpush
