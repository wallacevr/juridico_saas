<div
    wire:ignore
    x-data="{pond: null}"
    x-init="
        FilePond.registerPlugin(FilePondPluginImagePreview);
        pond = FilePond.create($refs.input,
        {
            @if($this->initiallogos[$this->initialkey]!='')
          
            files: [
                
                    {{$this->initiallogos[$this->initialkey]}}
            
                
             ]
             @endif
});
        pond.setOptions({
            allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
            labelIdle:'{{__('Drag & Drop your files or Brownse')}}',
            
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
                },
            },
        });
">
    
   
    
    <input type="file" x-ref="input">     
</div>


