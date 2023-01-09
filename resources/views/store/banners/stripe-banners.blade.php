<div class="swiper mySwiper w-full">
    <div class=" w-full">
        @foreach ($bannersStripe as $banner)
        <a href="{{$banner->url}}">
          <div class="swiper-slidec max-h-32 w-full ">
              <img class="w-full" src="{{ tenant_public_path() . '/images/banners/'. $banner->image_url }}" alt="{{ $banner->name }}" />
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
