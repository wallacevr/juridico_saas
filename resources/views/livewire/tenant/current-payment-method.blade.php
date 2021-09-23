<div>
    <h4 class="font-medium text-gray-900">{{__("applicationSettings.Current payment method")}}</h4>
    @if(tenant()->hasDefaultPaymentMethod())
    <p class="mt-2 text-sm text-gray-600">
        {{ ucfirst(tenant()->defaultPaymentMethod()->asStripePaymentMethod()->card->brand) }} {{__("applicationSettings.ending in")}}
        {{ tenant()->defaultPaymentMethod()->asStripePaymentMethod()->card->last4 }}
    </p>
    @else
    <p class="mt-2 text-sm text-gray-600">
    {{__("applicationSettings.No payment method set yet. Please add one below")}}
    </p>
    @endif
</div>