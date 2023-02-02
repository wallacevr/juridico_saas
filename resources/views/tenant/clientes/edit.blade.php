@extends('layouts.tenant')

@section('style')
<link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
@endsection

@section('wrapper')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<form action="{{route('tenant.cliente.update',['cliente'=>$cliente->id])}}" method="post">
 @csrf
 @method('put')
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
	<div class="row ps-2">

				<!-- Default radio -->
					<div class="form-check col-2">
					<input class="form-check-input" type="radio" name="tppessoa" id="pessoafisica" value="1" onclick="pf()" 
					@php 
						if($cliente->cpf !=null) { 
            				
           				  echo "checked"; 
						}
					@endphp
					
					/>
					<label class="form-check-label" for="pessoafisica"> Pessoa Física </label>
					</div>

					<!-- Default checked radio -->
					<div class="form-check col-2">
					<input class="form-check-input" type="radio" name="tppessoa" id="pessoajuridica" value="2" onclick="pj()" 
					@php 
						if($cliente->cnpj !=null) { 
            				
           				  echo "checked"; 
						}
					@endphp
					/>
					<label class="form-check-label" for="pessoajuridica"> Pessoa Jurídica </label>
					</div>

		</div>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Informações Pessoais</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Documentos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Informações Complementares</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
  <input type="hidden" class="form-control" name="id" placeholder="id" value="{{ $cliente->id }}"></input>
		<div class="row">
			<div class="col-6">
						
					<label for="nome" class="form-label"></label>
					<input type="text" class="form-control" name="nome" placeholder="Nome/RazãoSocial" value="{{ $cliente->nome }}"></input>
			</div>
		</div>
		<div class="row">
			<div class="col-6 pj">
					<label for="nomefantasia" class="form-label"></label>
					<input type="text" class="form-control pj" name="nomefantasia" placeholder="Nome Fantasia" value="{{ $cliente->nomefantasia }}"></input>
			</div>
		</div>
		<div class="row">
			<div class="col-3">
					<label for="telefone" class="form-label"></label>
					<input type="text" class="form-control" name="telefone" placeholder="Telefone"  value="{{ $cliente->telefone }}" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);"></input>
			</div>
			<div class="col-3">
					<label for="email" class="form-label"></label>
					<input type="email" class="form-control" name="email" placeholder="Email" value="{{ $cliente->email}}"></input>
			</div>
		</div>
		<div class="row">

			<div class="col-6">
					<label for="site" class="form-label"></label>
					<input type="url" class="form-control" name="site" placeholder="Site" value="{{ $cliente->site}}"></input>
			</div>
		</div>
		<div class="row">

			<div class="col-2">
					<label for="cep" class="form-label"></label>
					<input type="text" class="form-control" name="cep" id="cep" placeholder="CEP" value="{{ $cliente->cep }}"></input>
			</div>
			
			<div class="col-1">
					<label for="uf" class="form-label"></label>
					<input type="text" class="form-control" name="uf" id="uf" placeholder="UF" value="{{ $cliente->uf}}"></input>
			</div>
			<div class="col-3">
						<label for="cidade" class="form-label"></label>
						<input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade" value="{{ $cliente->municipio }}"></input>
				</div>
		</div>	
		<div class="row">
				<div class="col-3">
						<label for="bairro" class="form-label"></label>
						<input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro" value="{{ $cliente->bairro }}"></input>
				</div>
				<div class="col-3">
						<label for="rua" class="form-label"></label>
						<input type="text" class="form-control" name="rua" id="rua" placeholder="Rua" value="{{ $cliente->logradouro }}"></input>
				</div>
		</div>	
		<div class="row">
			
				<div class="col-3">
						<label for="numero" class="form-label"></label>
						<input type="text" class="form-control" name="numero" id="numero" placeholder="Nº" value="{{ $cliente->num }}"></input>
				</div>
				<div class="col-3">
						<label for="complemento" class="form-label"></label>
						<input type="text" class="form-control" name="complemento" id="complemento" placeholder="Complemento" value="{{ $cliente->complemento }}"></input>
				</div>
		</div>

  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  		<div class="row">
			<div class="col-3 pj">
					<label for="cnpj" class="form-label"></label>
					<input type="text" class="form-control pj" name="cnpj" id="cnpj" placeholder="CNPJ" value="{{ $cliente->cnpj }}"> </input>
			</div>
			<div class="col-3 pf">
					<label for="cpf" class="form-label"></label>
					<input type="text" class="form-control pf" name="cpf"id="cpf" placeholder="CPF" value="{{ $cliente->cpf}}"></input>
			</div>
		</div>
		<div class="row pj">
			<div class="col-3">
					<label for="ie" class="form-label"></label>
					<input type="text" class="form-control pj" name="ie" id="ie" placeholder="Inscrição Estadual" value="{{ $cliente->ie}}"></input>
			</div>
			<div class="col-3">
					<label for="ccm" class="form-label"></label>
					<input type="text" class="form-control pj" name="ccm" id="ccm" placeholder="Inscrição Municipal" value="{{ $cliente->ccm }}"></input>
			</div>
		</div>
		<div class="row ps-3 pt-2 pj">
				Optante Simples
				<!-- Default radio -->
					<div class="form-check col-1 ps-5">
						<input class="form-check-input pj" type="radio" name="simples" id="noptsimples"/>
						<label class="form-check-label pj" for="noptsimples"> Não </label>
					</div>

					<!-- Default checked radio -->
					<div class="form-check col-1 ps-5">
						<input class="form-check-input pj" type="radio" name="simples" id="optsimples" checked/>
						<label class="form-check-label pj" for="optsimples">Sim</label>
					</div>

		</div>
		<div class="row pf">
			<div class="col-3 pf">
					<label for="rg" class="form-label pf"></label>
					<input type="text" class="form-control pf" name="rg" id="rg" placeholder="RG" value="{{ $cliente->rg}}"></input>
			</div>
			<div class="col-3 pf">
					<label for="ctps" class="form-label pf"></label>
					<input type="text" class="form-control pf" name="ctps" id="ctps" placeholder="CTPS" value="{{ $cliente->ctps }}"></input>
			</div>
		</div>
		<div class="row pf">
			<div class="col-3 pf">
					<label for="pis" class="form-label pf"></label>
					<input type="text" class="form-control pf" name="pis" id="pis" placeholder="PIS" value="{{ $cliente->pis}}"></input>
			</div>
			<div class="col-3 pf">
					<label for="cnh" class="form-label pf"></label>
					<input type="text" class="form-control pf" name="cnh" id="cnh" placeholder="CNH" cvalue="{{ $cliente->cnh}}"></input>
			</div>
		</div>
		<div class="row pf">
			<div class="col-3 pf">
					<label for="titulo" class="form-label"></label>
					<input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo de Eleitor" value="{{ $cliente->tituloeleitor }}"></input>
			</div>
			<div class="col-3 pf">
					<label for="passaporte" class="form-label"></label>
					<input type="text" class="form-control" name="passaporte" id="passaporte" placeholder="Passaporte" value="{{ $cliente->passaporte }}"></input>
			</div>
		</div>
		<div class="row">
			<div class="col-3 pf">
					<label for="reservista" class="form-label"></label>
					<input type="text" class="form-control" name="reservista" id="reservista" placeholder="Certificado de Reservista" value="{{ $cliente->certificadoreservista }}"></input>
			</div>
	
		</div>

  </div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
  		<div class="row pf">
			<div class="col-3">
					<label for="nomemae" class="form-label"></label>
					<input type="text" class="form-control" name="nomemae" id="nomemae" placeholder="Nome da Mãe" value="{{ $cliente->nomemae }}"></input>
			</div>
			<div class="col-3">
					<label for="nomepai" class="form-label"></label>
					<input type="text" class="form-control" name="nomepai" id="nomepai" placeholder="Nome do Pai" value="{{ $cliente->nomepai }}"></input>
			</div>
		</div>
		<div class="row pf">
			<div class="col-3">
					<label for="naturalidade" class="form-label"></label>
					<input type="text" class="form-control" name="naturalidade" id="naturalidade" placeholder="Naturalidade" value="{{ $cliente->naturalidade }}"></input>
			</div>
			<div class="col-3">
					<label for="nacionalidade" class="form-label"></label>
					<input type="text" class="form-control" name="nacionalidade" id="nacionalidade" placeholder="Nacionalidade" value="{{ $cliente->naciolalidade }}"></input>
			</div>
		</div>
		<div class="row mt-2 pf">
			<div class="col-1 mt-2">
				<label for="dtnasc" class="form-label">Dt. Nasc.</label>
			</div>
			<div class="col-2">
					
					<input type="date" class="form-control" name="dtnasc" id="dtnasc" placeholder="Data de Nascimento" value="{{ $cliente->dtnascimento }}"></input>
			</div>
		</div>
		
		<div class="col-6">
		<hr>
		</div>
		<div class="row">
			<div class="col-12">
				<h4>Conta Bancária</h4>
			</div>
			<div class="col-3">
					<label for="tpconta_id" class="form-label"></label>
					<select type="text" class="form-control" name="tpconta_id" id="tpconta_id" >
						<option value="">Tipo de Conta</option>
						<option value="1"
						@php 
						
						if($cliente->tpconta_id==1) { 
            				
           				  echo "selected"; 
						}
						@endphp
						
						>Conta Corrente</option>
						<option value="2"
						@php 
						if($cliente->tpconta_id==2) { 
            				
           				  echo "selected"; 
						}
						@endphp
						
						>Poucpança</option>
					</select>
			</div>
			<div class="col-3 ">
					<label for="Banco" class="form-label"></label>
					<input type="text" class="form-control" name="banco" id="banco" placeholder="Banco" value="{{ $cliente->banco }}"></input>
			</div>

		</div>
		<div class="row">
			<div class="col-3">
					<label for="conta" class="form-label"></label>
					<input type="text" class="form-control" name="conta" id="conta" placeholder="Conta e Dígito" value="{{ $cliente->conta }}"></input>
			</div>
			<div class="col-3">
					<label for="agencia" class="form-label"></label>
					<input type="text" class="form-control" name="agencia" id="agencia" placeholder="Agencia e Digito" value="{{ $cliente->agencia }}"></input>
			</div>
		</div>
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
	var cpf = document.getElementById('cpf'); 
	
	if(cpf.value!=""){
		window.onload = pf;
		
	}else{
		window.onload = pj;
	
	}
	
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
