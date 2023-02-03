<div>
@foreach($processo as $processo)

        <div class="card p-3">
                <div class="row">
                    <div class="col-6">
                        <h4>   <i class='bx bxs-calendar-check'></i>Próximas Atividades</h4>
                        <a  class="btn text-white" href="{{route('tenant.recurso.create',['principal'=>$processo->id])}}">
                        <i class='bx bx-calendar-plus'></i> Adicionar Tarefa
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
    @endforeach
</div>
