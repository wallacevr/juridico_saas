	@extends('layouts.tenant')

	@section('style')
	<link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
	@endsection

		@section('wrapper')
@livewire('tenant.envolvidos-index')


		<!--end page wrapper -->
		@endsection
		
	@section('script')
	<script src="{{ asset('assets/plugins/chartjs/js/Chart.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
	<script src="{{ asset('assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/jquery-knob/excanvas.js') }}"></script>
	<script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.js') }}"></script>
	  <script>
		  $(function() {
			  $(".knob").knob();
		  });
		  $(document).ready(function () {
			$('#envolvidos').DataTable({
				columnDefs: [
            {
                target: 2,
                visible: true,
                searchable: true,
            },
            {
                target: 3,
                visible: true,
				searchable: true,
            },
        ],
			});
		});
	  </script>
	  <script src="{{ asset('assets/js/index.js') }}"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Confirmação`,
              text: "Deseja realmente deletar o Envolvidox?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>
	@endsection