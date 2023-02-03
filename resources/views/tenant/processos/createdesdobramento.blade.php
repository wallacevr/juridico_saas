@extends('layouts.tenant')

@section('style')
<link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
@endsection

@section('wrapper')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<form action="{{route('desdobramento.store')}}" method="post">
 @csrf
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

	 <div class="row">
			<div class="col-4">
					<label for="cliente_id" class="form-label">Clientes</label>

				<select class="js-example-basic-multiple form-select" name="cliente_id[]" multiple="multiple">
				@foreach($clientes as $cliente)
					<option value="{{$cliente->id}}" 
					@if($processocliente)
						
							@if( $processocliente->pluck('cliente_id')->contains($cliente->id))
								selected
							@endif
					
					@endif
					>{{$cliente->nome}}</option>
					
				@endforeach
				</select>
			</div>
			<div class="col-2">
					<label for="qualiclientes" class="form-label">Qualificação</label>
					
					<select class="js-example-basic-multiple form-select" name="qualiclientes" >
						@foreach($qualificacoes as $qualificacao)
							<option value="{{$qualificacao->id}}" >{{$qualificacao->descricao}}</option>
						
						@endforeach
				</select>
			</div>
	 </div>
	 <div class="row">
			<div class="col-4">
					<label for="envolvido_id" class="form-label">Envolvidos</label>
		
	
				<select class="js-example-basic-multiple form-select" name="envolvido_id[]" multiple="multiple">
				@foreach($envolvidos as $envolvido)
					<option value="{{$envolvido->id}}" 
					@if($processoenvolvidos)
						
							@if( $processoenvolvidos->pluck('envolvido_id')->contains($envolvido->id))
								selected
							@endif
					
					@endif
					>{{$cliente->nome}}</option>
					
				@endforeach
				</select>
			</div>
			<div class="col-2">
					<label for="qualienvolvidos" class="form-label">Qualificação</label>
					<select class="js-example-basic-multiple form-select" name="qualienvolvidos" >
						@foreach($qualificacoes as $qualificacao)
							<option value="{{$qualificacao->id}}" >{{$qualificacao->descricao}}</option>
						
						@endforeach
				</select>
			</div>
	 </div>
	 <div class="row">
			<div class="col-6">
					<label for="titulo" class="form-label">Título</label>
					<input type="text" class="form-control" name="titulo" placeholder="Título do Processo"></input>
			</div>
	 </div>
	 <div class="row">
			<div class="col-2">
					<label for="instancia" class="form-label">Instância</label>
				<select class="form-select" name="instancia" >
				@foreach($instancias as $instancia)
					<option value="{{$instancia->id}}">{{$instancia->descricao}}</option>
					
				@endforeach
				</select>
			</div>
			<div class="col-4">
					<label for="nprocesso" class="form-label">Nº</label>

			<input type="text" class="form-control" name="nprocesso" placeholder="Nº do Processo"
			@if($principal)
				value="{{$principal->numero}}"
			
			@endif
			></input>
			</div>
	 </div>
	 <div class="row">
			 <div class="col-2">
					<label for="nome" class="form-label">Juízo</label>

				<input type="text" class="form-control" name="nprocesso" placeholder="Nº"></input>
			</div>
			<div class="col-2">
					<label for="vara_id" class="form-label">Vara</label>
				<select class="form-select" name="vara_id" >
					@foreach($varas as $vara)
						<option value="{{$vara->id}}">{{$vara->descricao}}</option>
						
					@endforeach
				</select>
			</div>
			<div class="col-2">
					<label for="foro_id" class="form-label">Foro</label>
				<select class="form-select" name="foro_id" >
					@foreach($foros as $foro)
						<option value="{{$foro->id}}">{{$foro->descricao}}</option>
						
					@endforeach
				</select>
			</div>
	 </div>
	 <div class="row">
			<div class="col-6">
					<label for="acao_id" class="form-label">Ação</label>
		
	
				<select class="js-example-basic-multiple form-select" name="acao_id">
					@foreach($acoes as $acao)
						<option value="{{$acao->id}}">{{$acao->descricao}}</option>
						
					@endforeach
				</select>
			</div>
	 </div>
	 <div class="row">
			<div class="col-6">
					<label for="linktribunal" class="form-label">Link do Tribunal</label>
					<input type="text" class="form-control" name="linktribunal" placeholder="Digite o link do Tribunal"></input>
			</div>
	 </div>
	 <div class="row">
			<div class="col-6">
					<label for="objeto" class="form-label">Objeto</label>
					<textarea class="form-control" name="objeto" id="" cols="30" rows="5" placeholder="Digite a Descrição do processo"></textarea>
			</div>
	 </div>
	 <div class="row">
			<div class="col-2">
				<label for="valorcausa" class="form-label">Valor da Causa</label>
				<input  type="number"   name="valorcausa" placeholder="Valor da Causa"  min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
			</div>
			<div class="col-2">
				<label for="dtdistribuicao" class="form-label">Data da Distribuição</label>
				<input  type="Date"   name="dtdistribuicao" class="form-control" />
			</div>
			<div class="col-2">
				<label for="valorcondenacao" class="form-label">Valor da Condenação</label>
				<input  type="number"   name="valorcondenacao" placeholder="Valor da Condenação"  min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
			</div>
	 </div>
	 <div class="row">
			<div class="col-3">
				<label for="porcentagemhonoarios" class="form-label">% de Honorários</label>
				<input  type="number"   name="porcentagemhonorarios" placeholder="% de Honorários"  min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
			</div>

			<div class="col-3">
				<label for="honorarios" class="form-label">Valor da Condenação</label>
				<input  type="number"   name="honorarios" placeholder="Valor dos Honorários (R$)"  min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
			</div>
	 </div>
	 <div class="row">
			<div class="col-6">
					<label for="observacoes" class="form-label">Observações</label>
					<textarea class="form-control" name="observacoes" id="" cols="30" rows="5" placeholder="Digite a Descrição do processo"></textarea>
			</div>
	 </div>
	 <div class="row">
			<div class="col-6">
					<label for="responsavel_id" class="form-label">Responsáveis</label>

				<select class="js-example-basic-multiple form-select" name="responsavel_id[]" multiple="multiple">
				@foreach($users as $user)
					<option value="{{$user->id}}" 
					@if($responsaveis)
						
							@if( $responsaveis->pluck('user_id')->contains($user->id))
								selected
							@endif
					
					@endif
					>{{$user->name}}</option>
					
				@endforeach
				</select>
				<input type="hidden" name="processo_id" value="{{$principal->id}}"> 
			</div>
	 </div>
	 <div class="row ">
		<div class="col-6 text-center mt-2">
				<button class="btn btn-success" type="submit">Salvar</button>
		</div>
	</div>	
</form>
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
	window.onload = pf;
      $(function() {
          $(".knob").knob();
      });

	  $(document).ready(function() {
			$('.js-example-basic-multiple').select2();
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
