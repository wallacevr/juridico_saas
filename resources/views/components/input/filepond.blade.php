


<div 
    wire:ignore
    x-data 
    
    x-init="

    FilePond.setOptions({
        allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
            server: {
                process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
                 },
            },
        });
    FilePond.create($refs.input,
    {
            @if(isset($this->initialimages))
            files: [
               {{$this->initialimages}}
               
           
             ]
            @endif
}   );" 
    >
    <input type="file" x-ref="input">     
</div>
