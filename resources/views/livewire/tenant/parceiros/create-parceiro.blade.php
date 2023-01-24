<div>
         {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
        <h1 class="text-center">FICHA CADASTRAL</h1>
        <div class="row">
                <div class="col-12 col-lg-2 ">
                    <label class="form-control border-0 bg-transparent">
                        <input type="radio" name="tpparceiro" value="1" checked wire:model="tpparceiro">Fornecedor
                    </label>
                </div>
                <div class="col-12 col-lg-2">
                    <label class="form-control border-0 bg-transparent" >
                        <input type="radio" name="tpparceiro" value="2" wire:model="tpparceiro">Cliente
                    </label>
                </div>
                <div class="col-12 col-lg-2 ">
                    <label class="form-control border-0 bg-transparent" wire:model="tpparceiro">
                        <input type="radio" name="tpparceiro" value="1" >Ambos
                    </label>
                </div>
        </div>
        <div class="row">
                <div class="col-12 col-lg-3 ">
                    <label class="form-control border-0 bg-transparent">
                        <input type="radio" name="tppessoa" value="1" wire:model="tppessoa" checked>Pessoa Física
                    </label>
                </div>
                <div class="col-12 col-lg-3">
                    <label class="form-control border-0 bg-transparent">
                        <input type="radio" name="tppessoa" value="2" wire:model="tppessoa">Pessoa Jurídica
                    </label>
                </div>
                <div class="col-12 col-lg-2">
                    <label  class="form-control border-0 bg-transparent">Lista de Preços</label>
                </div>
                <div class="col-12 col-lg-3">
                    <select name="lstpreco" class="form-select">
                        <option value="">Nenhuma</option>
                        @foreach($listasprecos as $lista)
                            <option value="{{$lista->id}}">{{$lista->nome}}</option>

                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-lg-2 ">
                    <label class="form-control border-0 bg-transparent">
                        <input type="checkbox" name="ativo" value="1" checked wire:model="ativo">Ativo
                    </label>
                </div>
        </div>
            <div class="row ">
                    <div class="col-lg-3" >
                        @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'CPF/CNPJ', 'placeholder'=>'CPF/CNPJ', 'name'=>'cpfcnpj', 'value'=> '','wiremodel'=>'cpfcnpj' ])

                    </div>
                    <div class="col-lg-4">
                        @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Nome/Razão Social', 'placeholder'=>'Nome/Razão Social', 'name'=>'nome', 'value'=> '','wiremodel'=>'nome' ])

                    </div>
                    <div class="col-lg-4">
                    @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Apelido/Nome Fantasia', 'placeholder'=>'Apelido/Nome Fantasia', 'name'=>'apelido', 'value'=> '','wiremodel'=>'apelido' ])
                    </div>
            </div>
             @if($tppessoa==1)
                <div class="row">
                    <div class="col-lg-3" >
                         @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'RG', 'placeholder'=>'RG', 'name'=>'rg', 'value'=> '','wiremodel'=>'rg' ])
                    </div>
                    <div class="col-lg-3">
                         @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Emissor RG', 'placeholder'=>'Emissor Rg', 'name'=>'emissorrg', 'value'=> '','wiremodel'=>'emissorrg' ])
                    </div>
                    <div class="col-lg-2">
                         @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'UF RG', 'placeholder'=>'UF RG', 'name'=>'ufrg', 'value'=> '','wiremodel'=>'ufrg' ])
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-4" >
                    <label for="situacaoie"  class="form-control border-0 bg-transparent">Situação da IE do Destinatário</label>
                     <select name="situacaoie" class="form-select" wire:model="situacaoie" >
                        <option value="null">Selecione</option>
                        <option value="1">Não Contribuinte</option>
                        <option value="2">Contribuinte isento</option>
                        <option value="3">Contribuinte do ICMS</option>
                    </select>
                       
                    </div>
                    <div class="col-lg-4" >
                        @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Inscr. Estadual', 'placeholder'=>'Inscr. Estadual', 'name'=>'ie', 'value'=> '','wiremodel'=>'ie' ])
                    </div>
                    <div class="col-lg-4" >
                        @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Inscr. Municipal', 'placeholder'=>'Inscr. Municipal', 'name'=>'im', 'value'=> '','wiremodel'=>'im' ])
                    </div>
                </div>
            @endif
            
            @if($tppessoa==1)
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="sexo"  class="form-control border-0 bg-transparent">Gênero</label>
                            <select name="lstpreco" class="form-select" wire:model="genero">
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="dtnasc"  class="form-control border-0 bg-transparent" >Dt Nasc.</label>
                            <input type="date" class="form-control w-50" id="dtnasc" wire:model="dtnascimento">
                        </div>
                    </div>
                   
            @endif

   
    <ul class="nav nav-pills my-1" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active bg-transparent" id="pills-enderecos-tab" data-toggle="pill" href="#pills-enderecos" role="tab" aria-controls="pills-enderecos" aria-selected="false">Endereços</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="pills-fiscal-tab" data-toggle="pill" href="#pills-fiscal" role="tab" aria-controls="pills-fiscal" aria-selected="true">Fiscal</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="pills-contatos-tab" data-toggle="pill" href="#pills-contatos" role="tab" aria-controls="pills-contatos" aria-selected="false">Contatos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-limites-tab" data-toggle="pill" href="#pills-limtes" role="tab" aria-controls="pills-limites" aria-selected="false">Limites</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-bancarios-tab" data-toggle="pill" href="#pills-bancarios" role="tab" aria-controls="pills-bancarios" aria-selected="false">Dados Bancários</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-documentos-tab" data-toggle="pill" href="#pills-documentos" role="tab" aria-controls="pills-documentos" aria-selected="false">Documentos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-historico-tab" data-toggle="pill" href="#pills-historico" role="tab" aria-controls="pills-historico" aria-selected="false">Histórico</a>
        </li>
    </ul>
    <div class="tab-content pb-2" id="pills-tabContent">
        <div class="tab-pane fade show active pb-2" id="pills-enderecos" role="tabpanel" aria-labelledby="pills-enderecos-tab">
            <div class="row px-2">
                <div class="col-12 col-lg-2">
                    
                     @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Nome', 'placeholder'=>'Nome', 'name'=>'nomeendereco', 'value'=> '' ,'wiremodel'=>'nameaddress'])
                </div>
                <div class="col-12 col-lg-2">
                     @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'CEP', 'placeholder'=>'___-__', 'name'=>'cep', 'value'=> '' ,'wiremodel'=>'postalcode','wirechange'=>'preencherendereco'])
                </div>
                <div class="col-12 col-lg-4">
                     @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Logradouro', 'placeholder'=>'Logradouro', 'name'=>'logradouro', 'value'=> '' ,'wiremodel'=>'address'])
                </div>
                <div class="col-12 col-lg-4">
                     @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Bairro', 'placeholder'=>'Bairro', 'name'=>'bairro', 'value'=> '' ,'wiremodel'=>'district'])
                </div>
            </div>
            <div class="row px-2">

                <div class="col-12 col-lg-7">
                     @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'Cidade', 'placeholder'=>'Cidade', 'name'=>'cidade', 'value'=> '','wiremodel'=>'city' ])
                </div>
                <div class="col-12 col-lg-1">
                     @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'UF', 'placeholder'=>'UF', 'name'=>'uf', 'value'=> '' ,'wiremodel'=>'state'])
                </div>
                <div class="col-12 col-lg-2">
                     @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'numero', 'placeholder'=>'Nº', 'name'=>'numero', 'value'=> '' ,'wiremodel'=>'number'])
                </div>
                <div class="col-12 col-lg-2">
                     @include('layouts.snippets.fields', ['type'=>'text', 'label'=>'complemento', 'placeholder'=>'Complemento', 'name'=>'complemento', 'value'=> '','require'=>false ,'wiremodel'=>'complement'])
                </div>
            </div>
            <div class="row px-2">
                <div class="col-12">
                            <button type="button"  wire:click="addaddress" 
                                class="mt-3 flex justify-center  px-4 py-2 text-sm font-medium text-white bg-primary border border-transparent rounded">
                                {{__('Add')}}
                            </button>
                </div>
            </div>
            @foreach($cep as $key=>$value)
            <div class="row px-3">
              
                    <div class="col-2">{{__('Nome')}}:{{$nomeendereco[$key]}}</div>
                    <div class="col-2">{{__('CEP')}}:{{$cep[$key]}}</div>
                    <div class="col-4">{{__('Logradouro')}}:{{$logradouro[$key]}}</div>
                    <div class="col-4">{{__('Bairro')}}:{{$bairro[$key]}}</div>
                    <div class="col-3">{{__('Cidade')}}:{{$cidade[$key]}}</div>
                    <div class="col-2">{{__('UF')}}:{{$uf[$key]}}</div>
                    <div class="col-2">{{__('Nº')}}:{{$numero[$key]}}</div>
                    <div class="col-2">{{__('Complemento')}}:{{$complemento[$key]}}</div>
                
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button wire:click="destroyaddress({{$key}})" class="bg-danger rounded-circle py-1 px-1 border-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash bg-danger" viewBox="0 0 16 16">
                             <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                             <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <hr>
            @endforeach
        </div>
        <div class="tab-pane fade" id="pills-fiscal" role="tabpanel" aria-labelledby="pills-fiscal-tab">Fiscal
        <a  wire:click="ff" class="text-primary">Teste </a>
        </div>
        <div class="tab-pane fade" id="pills-contatos" role="tabpanel" aria-labelledby="pills-contatos-tab">Contatos</div>
        <div class="tab-pane fade" id="pills-limites" role="tabpanel" aria-labelledby="pills-limites-tab">Limites</div>
        <div class="tab-pane fade" id="pills-documentos" role="tabpanel" aria-labelledby="pills-documentos-tab">Contatos</div>
        <div class="tab-pane fade" id="pills-historico" role="tabpanel" aria-labelledby="pills-historico-tab">Contatos</div>
    </div>
    <div class="row px-2 pb-2">
   
        <div class="col-12">
                    <button type="button"  wire:click="store"
                        class=" flex justify-center  px-4  text-sm font-medium text-white bg-primary border border-transparent rounded">
                        {{__('Save')}}
                    </button>
        </div>
    </div>
    </div>
</div>
