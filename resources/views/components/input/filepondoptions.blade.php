<div
    wire:ignore
    x-data="{pond: null}"
    x-init="
        FilePond.registerPlugin(FilePondPluginImagePreview);
        pond = FilePond.create($refs.options_{{$this->optionid}},
        {
            files: [
                @if(isset($this->initialoptionimages[$this->optionid]))
                    {{$this->initialoptionimages[$this->optionid]}}
                @endif
                
             ]
        });
        pond.setOptions({
            allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
            labelIdle:'{{__('Drag & Drop your files or Brownse')}}',
            
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{$attributes->whereStartsWith('wire:model')->first()}}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{$attributes->whereStartsWith('wire:model')->first()}}', filename, load)
                },
            },
        });
">
    
   
    
    <input type="file" x-ref="options_{{$this->optionid}}">     
</div>

@push('styles')
    @once
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    @endonce
@endpush

@push('scripts')
    @once
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    @endonce
@endpush
