@extends('layouts.tenant', ['title' => __("Edit ticket")])

@section('content')
  @livewire('tenant.ticket.edit-ticket',['ticket'=>$ticket->id])
@endsection

@push('js')
<script>
   

    $(document).ready(function() {
        $('#collections').select2();
        $('#products').select2();

       
    });
</script>

@endpush
