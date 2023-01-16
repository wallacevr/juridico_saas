


<div 
    wire:ignore
    x-data="{pond: null}"
    
    x-init="
    FilePond.registerPlugin(FilePondPluginImagePreview);
    FilePond.setOptions({
        allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
            server: {
                process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first()}}', filename, load)
                 },
            },
        });
        
    FilePond.create($refs.prodimage,
    {
  
            @if(isset($this->initialimages))
            files: [
               {{$this->initialimages}}
               
           
             ]
            @endif
}   );" 
    >
    <input type="file" x-ref="prodimage">     
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
