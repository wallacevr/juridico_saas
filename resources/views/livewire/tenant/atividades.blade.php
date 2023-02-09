<div>
@foreach($processo as $processo)

        <div class="card p-3">
                <div class="row">
                    <div class="col-6">
                        <h4>   <i class='bx bxs-calendar-check'></i>Próximas Atividades</h4>
                        <button class="btn text-white" wire:click="showadd">
                            <i class='bx bx-calendar-plus'></i> Adicionar Tarefa
                        </button>
                    </div>
                </div>
                <div class="row">
                        @if($showadd)

                        
                                <div class="col-12 col-md-4">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'date',
                                        'label' => 'Data',
                                        'placeholder' => 'Data',
                                        'name' => 'data',
                                        'value' => '',
                                        'require' => true,
                                        'wiremodel' =>'data',
                                        'class'=>'w-100'
                                    ])
                                </div>
                                <div class="col-12 col-md-4">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'date',
                                        'label' => 'Prazo Limite',
                                        'placeholder' => 'Prazo Limite',
                                        'name' => 'prazolimite',
                                        'value' => '',
                                        'require' => true,
                                        'wiremodel' =>'prazolimite',
                                        'class'=>'w-100'
                                    ])
                                </div>
                              
                          
                                <div class="col-12 col-md-8 my-2">
                                    <textarea name="descricao" id="" class="w-100" rows="10" wire:model="descricao"></textarea>
                                </div>
                                <div class="col-12 col-md-8 my-2">
                                    <button class="btn btn-danger" wire:click="hideadd">Cancelar</button>  <button class="btn btn-primary" wire:click="store">Salvar</button>
                                </div>                              

                        @endif
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
    @endforeach

</div>
