<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        @foreach ($bannersStripe as $banner)
        <div class="swiper-slide">
            <img class="w-full" src="{{ tenant_public_path() . '/images/banners/'. $banner->image_url }}" alt="{{ $banner->name }}" />
        </div>
        @endforeach
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
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
