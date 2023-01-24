<label for="{{$name}}" class="@if(empty($classLabel))block form-control border-0 bg-transparent @else {{$classLabel}} @endif">{{__($label)}}@if(($require??true) && !empty($label))<span  class="red">*</span>@endif
</label>

<div class="mt-1 rounded-md ">

    <input id="{{$name}}" type="{{$type}}" name="{{$name}}" value="{{ old($name,  $value)}}" class="form-control block w-100 sm:text-sm sm:leading-5 border real @isset($class) {{$class}}   @endisset " @if(($require??true)) required @endif placeholder="{{__($placeholder)}}"
    
    
    @isset($min)
        min={{$min}}
    @endisset
    
    @isset($step)
        step={{$step}}
    @endisset
    @isset($datanumbertofixed)
        data-number-to-fixed={{$datanumbertofixed}}
    @endisset
    @isset($datanumberstepfactor)
        data-number-stepfactor={{$datanumberstepfactor}}
    @endisset
    @isset($wiremodel)

             wire:model="{{$wiremodel}}"

    @endisset
    @isset($wirechange)

      wire:change="{{$wirechange}}"

    @endisset
    @isset($wirekeydown)

    wire:keydown="{{$wirekeydown}}"

    @endisset
    @isset($min)
        min="{{$min}}"

    @endisset

    />
</div>

@error($name)
<p class="mt-2 text-sm text-danger">
    {{ $message }}
</p>
@enderror
