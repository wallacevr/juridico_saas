	@extends('layouts.tenant')

	@section('style')
	<link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
	@endsection

		@section('wrapper')
		<!--start page wrapper -->
		

				

					  <div class="card radius-10">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="mb-0">Processos</h5>
								</div>
								<div class="font-22 ms-auto"><a href="{{route('tenant.processo.create')}}" class="ms-2"><i class="bx bx-folder-plus"></i></a></i>
								</div>
							</div>
							<hr>
							<div class="row mt-4">
							<div class="col-12">
								@error('message')
									<div class="alert alert-danger" role="alert">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="col-12">
							@if (session('success'))
								<div class="alert alert-success" role="alert">
									{{ session('success') }}
								</div>
							@endif
						</div>
							<div class="table-responsive">
								<table class="table align-middle mb-0" id="clientes">
									<thead class="table-light">
										<tr>
											
											<th>Título</th>
											<th>Clientes</th>
											<th>Ação/Foro</th>
											<th>Ultima movimentação</th>
											
											<th>Ação</th>
										</tr>
									</thead>
									<tbody>
										@foreach($processos as $processo)
										<tr>
											<td>{{$processo->titulo}}</td>
											<td>
												
												@forelse($processo->clientes as $cliente)
													@if( $cliente!=false)
														{{ $cliente->nome }} <br> 	
													@endif
												@empty

												@endforelse
											</td>
											<td>
														@if($processo->acao!=null)
															{{$processo->acao->descricao}}
															/
														@endif
														
														@if($processo->foro!=null)
															{{$processo->foro->descricao}}
														@endif
											</td>
											<td></td>
											

											<td>
												<div class="d-flex order-actions">	
													<a href="{{route('tenant.processo.show',['id'=>$processo->id])}}" class="ms-2"><i class="bx bx-show"></i></a>
													<a href="{{route('tenant.processo.edit',['id'=>$processo->id])}}" class="ms-2"><i class="bx bx-edit-alt"></i></a>
													<form method="POST"  action="{{ route('tenant.processo.destroy',['processo'=> $processo->id]) }}">
													@csrf
													@method('delete')
														<a href="#" class="ms-2 show_confirm  btn btn-danger" ><i class="bx bx-trash"></i></a>
													</form>

												
												</div>
											</td>
										</tr>
										@endforeach
										
									</tbody>
								</table>
							</div>
						</div>
					</div>


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
			$('#clientes').DataTable({
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
              text: "Deseja realmente deletar o Processo?",
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