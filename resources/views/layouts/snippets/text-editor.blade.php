<label for="{{$name}}" class="block text-sm font-medium leading-5 text-gray-700">{{__($label)}}<span class="red">*</span>
</label>

<div class="mt-1">
    <textarea id="{{$name}}" name="{{$name}}" class="ckeditor"

	
	>{{ old($name,  $value)}}

	</textarea>
</div>

@error($name)
<p class="mt-2 text-sm text-red-600">
    {{ $message }}
</p>
@enderror


@push('script')
<script src="//cdn.ckeditor.com/4.17.2/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('{{$name}}', {
        filebrowserUploadUrl: "{{route('tenant.ckeditor.image-upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
        filebrowserBrowseUrl: "{{ route('tenant.ckeditor.browse-images') }}",
        language: 'pt-br',
        toolbarGroups: [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	    ],
        removeButtons: 'Save,Cut,Copy,Undo,Find,Scayt,Form,Subscript,Superscript,CopyFormatting,Blockquote,BidiLtr,Anchor,Smiley,SpecialChar,PageBreak,Iframe,About,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,RemoveFormat,BidiRtl,Language,Maximize,ShowBlocks,Format,Font,FontSize,Table,HorizontalRule,Unlink,CreateDiv,Outdent,Indent,SelectAll,Replace,Redo,NewPage,ExportPdf,Preview,Print,Paste,PasteText,PasteFromWord'
    })
</script>
@endpush