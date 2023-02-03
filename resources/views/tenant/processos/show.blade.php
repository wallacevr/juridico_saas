@extends('layouts.tenant')

@section('style')
<link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
@endsection

@section('wrapper')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<div class="ps-3">
			@if($errors->any())
				<div class="row">
					<div class="alert alert-danger col-6" role="alert">
							@foreach($errors->all() as $error)
								{{ $error }} <br>
							@endforeach
							</div>
					</div>
			@elseif(session()->has('success'))
				<div class="row">
					<div class="alert alert-success" role="alert">
						{{ session('success') }}
					</div>
				</div>

			@endif
			
		@foreach($processo as $processo)
		<div class="row">
			<div class="col-6">
			
				<p>Título: 
					@if($processo->titulo!=null)
						{{ $processo->titulo }}
					@endif
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
			
				<p>Processo: 
					@if($processo->numero!=null)
						{{ $processo->numero }}
					@endif
				</p>
			</div>
			
		<div class="row">
			<div class="col-3 ">
				<p><b>Clientes:  </b> <br> 
				
					@forelse($processo->clientes as $cliente)
						@if( $cliente!=false)
							{{ $cliente->nome }} <br> 	
						@endif
					@empty

					@endforelse
				</p>
			</div>
			
			<div class="col-3">
			{{--	<p><b> Envolvidos: </b> <br> 
					
					@forelse($processo->envolvidos as $envolvido)
						@if( $envolvido!=false)
							{{ $envolvido->nome }} <br> 	
						@endif
					@empty

					@endforelse
					
				</p>--}}
			</div>
		</div>
	
	<div class="card p-3">
	<div class="row">
				<div class="col-6">
					<h5>Dados do Processo</h5>
				</div>
			</div>
			<div class="row">
				<div class="col-6">
				
					<p>Ação: 
						@if($processo->acao!=null)
							{{ $processo->acao->descricao }}
						@endif
					</p>
			</div>
			<div class="row">
				<div class="col-6">
				
					<p>Número: 
						@if($processo->numero!=null)
							{{ $processo->numero }}
						@endif
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-6">
				
					<p>Juízo: 
						@if($processo->juizo!=null)
							{{ $processo->juizo}}
						@endif
						@if($processo->vara!=null)
							{{ $processo->vara->descricao}}
						@endif
						@if($processo->foro!=null)
							{{ $processo->foro->descricao}}
						@endif
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-6">
				
					<p>Valor da Causa: 
						@if($processo->valorcausa!=null)
							{{ $processo->valorcausa }}
						@endif
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-6">
				
					<p>Valor da Condenação: 
						@if($processo->valorcondenacao!=null)
							{{ $processo->valorcondenacao }}
						@endif
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-6">
				
					<p>Data Criação: 
						
						{{date_format($processo->created_at,'d/M/Y')}}
					</p>
				</div>
			</div>
	</div>
	
	@livewire("tenant.atividades",['id'=>$processo->id])
		
	<div class="card p-3">
					<div class="row">
						<div class="col-6">
							<h5>   <img src="{{asset('icons/court-icon.png')}}" alt="Bootstrap" width="50" height="50" class="btn-icon1 court">Recursos e desdobramentos</h5>
							<a  class="btn text-white" href="{{route('tenant.recurso.create',['principal'=>$processo->id])}}">
								<i class='bx bxs-plus-circle text-white'></i> Adicionar Recurso
							</a>
							<a  class="btn text-white" href="{{route('tenant.desdobramento.create',['principal'=>$processo->id])}}">
								<i class='bx bxs-plus-circle text-white'></i> Adicionar Desdobramento
							</a>
							<div class="row">
								 <div class="col-12">
									<ol>
										<li>
										<a href="{{route('tenant.processo.edit',['id'=>$processo->id])}}">
												@if($processo->instancia!=null)
													{{$processo->instancia->descricao}} 
												@endif
												
												@if($processo->numero!=null)
												- 
													{{$processo->numero}} 
												@endif
												
												@if($processo->acao!=null)
												-
													{{$processo->acao->descricao}} 
												@endif
										</a>		
													
														@foreach($processo->desdobramentos as $desdobramento)
														<ol>	
															<li>
																<a href="{{route('tenant.processo.edit',['id'=>$desdobramento->id])}}">		
																	@if($desdobramento->instancia!=null)
																		{{$desdobramento->instancia->descricao}} 
																	@endif
																
																	@if($desdobramento->numero!=null)
																	- 	
																		{{$desdobramento->numero}} 
																	@endif
																	
																	@if($desdobramento->acao!=null)
																	-
																		{{$desdobramento->acao->descricao}} 
																	@endif
																</a>
															</li>
														</ol>

														@endforeach
													
												

											</li>

										</ol>

								 </div>
								 @foreach($processo->recursos as $recurso)

									<div class="col-12">
										<ol>
											<li>
											<a href="{{route('tenant.processo.edit',['id'=>$recurso->id])}}">
												@if($recurso->instancia!=null)
													{{$recurso->instancia->descricao}} 
												@endif
												
												@if($recurso->numero!=null)
												- 
													{{$recurso->numero}} 
												@endif
												
												@if($recurso->acao!=null)
												-
													{{$recurso->acao->descricao}} 
												@endif
												@foreach($recurso->desdobramentos as $desdobramento)
											</a>
														<ol>	
															<li>
																<a href="{{route('tenant.processo.edit',['id'=>$desdobramento->id])}}">
																	@if($desdobramento->instancia!=null)
																		{{$desdobramento->instancia->descricao}} 
																	@endif
																	
																	@if($desdobramento->numero!=null)
																	- 
																		{{$desdobramento->numero}} 
																	@endif
																	
																	@if($desdobramento->acao!=null)
																	-
																		{{$desdobramento->acao->descricao}} 
																	@endif
																</a>

															</li>
														</ol>

														@endforeach
													
											</li>
										</ol>
								</div>
								 @endforeach
							</div>

								
						</div>
					</div>
			</div>
		


	</div>	
@livewire('tenant.historico-index',['id'=>$processo->id])


	
@endforeach	
@endsection

@section('script')
<script src="{{ asset('assets/plugins/chartjs/js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-knob/excanvas.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
  <script>

	
      $(function() {
          $(".knob").knob();
      });

	  $(document).ready(function() {
				





			$("#cep").mask("99999-999");
			$('#cpf').mask('000.000.000-00');
			$('#cnpj').mask('00.000.000/0000-00');
	  		let urlViaCep = function(cep) {
                return `https://viacep.com.br/ws/${cep}/json/`;
            } ;

            let bloquear = function(value) {
                $('.postalcode-complete').prop('disabled', value);
            };
			let preencher = function(data) {
                $('#uf').val(data.uf);
                $('#cidade').val(data.localidade);
                $('#bairro').val(data.bairro);
                $('#rua').val(data.logradouro);
            };
			$('#cep').on('change', function() {

				bloquear(true);

				let cep = $(this).val();
				let url = urlViaCep(cep);

				$.ajax({
					url,
					type: 'GET',
					success: function(data) {
						preencher(data);
					},
					error: function(request, status, error) {
						console.log(request, status, error);
					},
					complete: function()
					{
						bloquear(false);
					}
				})

				});
		});
		function mask(o, f) {
  setTimeout(function() {
    var v = mphone(o.value);
    if (v != o.value) {
      o.value = v;
    }
  }, 1);
}

function mphone(v) {
  var r = v.replace(/\D/g, "");
  r = r.replace(/^0/, "");
  if (r.length > 10) {
    r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
  } else if (r.length > 5) {
    r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
  } else if (r.length > 2) {
    r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
  } else {
    r = r.replace(/^(\d*)/, "($1");
  }
  return r;
}
function pf(){
	var elements = document.getElementsByClassName('pf');            
        for(j=0; j < elements.length; j++){
            
            elements[j].style.display = "flex";
          
        }
		var elementspj = document.getElementsByClassName('pj');            
        for(j=0; j < elementspj.length; j++){
            
            elementspj[j].style.display = "none";
			elementspj[j].value="";
        }   
}
function pj(){
	var elements = document.getElementsByClassName('pj');            
        for(j=0; j < elements.length; j++){
            
            elements[j].style.display = "flex";
          
        }
		var elementspf = document.getElementsByClassName('pf');            
        for(j=0; j < elementspf.length; j++){
            
            elementspf[j].style.display = "none";
			elementspf[j].value="";
          
        }   
}
  </script>
  <script src="{{ asset('assets/js/index.js') }}"></script>
@endsection
