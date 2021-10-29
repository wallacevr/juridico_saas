<label for="{{$name}}" class="block text-sm font-medium leading-5 text-gray-700">{{__($label)}}<span class="red">*</span>
</label>

<div class="mt-1">
    <textarea id="{{$name}}" name="{{$name}}" class="ckeditor">{{ old($name,  $value)}}</textarea>
</div>

@error($name)
<p class="text-red-500 text-xs mt-4">
    {{ $message }}
</p>
@enderror


@push('js')
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('{{$name}}', {
        filebrowserUploadUrl: "{{route('tenant.ckeditor.image-upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    })
</script>
@endpush
