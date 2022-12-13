<div 
    wire:ignore wire:key="changeoptions"
    x-data 
   
    x-init="

    FilePond.setOptions({
        allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
        allowFileMetadata: true,
        imagePreviewMaxHeight:150,
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
        @if(!$this->changeoptions)  
        const pond = FilePond.create($refs.input,{
            files: [
        
            {{ $this->initialoptionimages[$this->optionid] }}
            ]
        });
        this.addEventListener('pondReset', e => {
                pond.removeFiles();
            });
        @else
            const pond = FilePond.create($refs.input);
            this.addEventListener('pondReset', e => {
                pond.removeFiles();
            });
        @endif


   " 
  
    >
    <input type="file" x-ref="input">     
</div>


