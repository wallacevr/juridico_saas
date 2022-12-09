<div 
    wire:ignore
    x-data 
    
    x-init="

    FilePond.setOptions({
        allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
        allowFileMetadata: true,
        allowReorder: true,
            server: {
                process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
                 },
            },
        });
        const pond = FilePond.create($refs.input,{
    files: [
        
    {{ $this->initialoptionimages[43] }}
    ]
});
console.log(pond.getMetadata());

   " 
   
    >
    <input type="file" x-ref="input">     
</div>


