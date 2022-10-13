@extends('layouts.tenant', ['title' => __("New ticket")])

@section('content')
  @livewire('tenant.ticket.create-ticket')
@endsection

@push('js')
<script>
   

    $(document).ready(function() {
        $('#collections').select2();
        $('#products').select2();

       
    });
</script>

@endpush
