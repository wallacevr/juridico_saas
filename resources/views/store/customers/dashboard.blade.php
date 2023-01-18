@extends('layouts.store', ['title' => 'My account'])

@section('content')

@include('layouts.snippets.customer-header')
{{--
<div class="container mx-auto m-15">
  <div class="text-2xl text-gray-800 mb-5">{{ __('Account information') }}</div>
  <p><a href="{{ route('store.customer.addresses')}}">{{ __('My addresses') }}</a></p>
  <p>{{ __('Change password') }}</p>
  <p>{{ __('Wishlist') }}</p>

  <div class="text-2xl text-gray-800 mb-5 mt-5">{{ __('My orders') }}</div>
  <p>{{ __('Order history') }}</p>
  <p>{{ __('Returns') }}</p>
  <p>{{ __('Transactions') }}</p>
</div>
--}}
@livewire('store.customers.myaccount',['tabvertical'=>$tabvertical])
@endsection


@push('js')

<script>
    $(document).ready(function() {
        $('#postalcode').mask('00000-000');
        $("#taxvat").keydown(function(){
          try {
              $("#taxvat").unmask();
          } catch (e) {}

          var tamanho = $("#taxvat").val().length;

          if(tamanho < 11){
              $("#taxvat").mask("999.999.999-99");
          } else {
              $("#taxvat").mask("99.999.999/9999-99");
          }

          // ajustando foco
          var elem = this;
          setTimeout(function(){
              // mudo a posição do seletor
              elem.selectionStart = elem.selectionEnd = 10000;
          }, 0);
          // reaplico o valor para mudar o foco
          var currentValue = $(this).val();
          $(this).val('');
          $(this).val(currentValue);
      });
        $('#phone').mask('(00) 00000-0000');
        $('#telephone').mask('(00) 0000-0000');

        $("#costumerForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 5
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 255
                },
                taxvat: {
                    required: true,
                },
                phone: {
                    required: true,
                    minlength: 10
                },
                postalcode: {
                    required: true,
                    minlength:8
                },
                address: {
                    required: true,
                    minlength: 10
                },
                neighborhood: {
                    required: true
                },
                city: {
                    required: true
                },
                state: {
                    required: true
                },
                country: {
                    required: true
                },

                terms: {
                    required: true
                },
            }
        });
  });
</script>
@endpush

