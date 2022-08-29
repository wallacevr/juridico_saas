<label for="{{$name}}" class="block text-sm font-medium leading-5 text-gray-700">{{__($label)}}@if($require??true)<span  class="red">*</span>@endif
</label>
<div class="mt-1 relative rounded-md ">
    <input id="{{$name}}" type="{{$type}}" name="{{$name}}" value="{{ old($name,  $value)}}" class="form-input block w-full sm:text-sm sm:leading-5 border" placeholder="{{__($placeholder)}}" />
</div>

@error($name)
<p class="mt-2 text-sm text-red-600">
    {{ $message }}
</p>
@enderror
