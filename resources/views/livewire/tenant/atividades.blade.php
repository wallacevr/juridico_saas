<div>
@foreach($processo as $processo)

        <div class="card p-3">
                <div class="row">
                    <div class="col-6">
                        <h4>   <i class='bx bxs-calendar-check'></i>Próximas Atividades</h4>
                        <button class="btn text-white" data-toggle="modal" data-target="#addtarefaModal">
                        <i class='bx bx-calendar-plus'></i> Adicionar Tarefa
                        </button>
                        <div class="modal fade" id="addtarefaModal" tabindex="-1" role="dialog" aria-labelledby="addtarefaModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addtarefaeModalLabel">Adicionar Tarefa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                <div class="row">
                                     <div class="col-12 col-lg-6 form-group">
                                             <label for="recipient-name" class="col-form-label">Data:</label>
                                            <input type="date" class="form-control" id="recipient-name">
                                     </div>
                                     <div class="col-12 col-lg-6 form-group">
                                             <label for="recipient-name" class="col-form-label">Prazo Final:</label>
                                            <input type="date" class="form-control" id="recipient-name">
                                     </div>
                                </div>    
                                <div class="row">
                                        <div class="col-12 form-group" wire:ignore>
                                                @include('layouts.snippets.text-editor-product', [
                                                    'label' => 'Description',
                                                    'name' => 'description',
                                                    'value' => '',
                                                    'wiremodel' =>'description',
                                                    'class'=>'w-100'
                                                ])
                                                <script>
                                                        const editor = CKEDITOR.replace('description');
                                                        editor.on('change', function(event){
                                                            console.log(event.editor.getData())
                                                            @this.set('description', event.editor.getData());
                                                        })
                                                </script>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Send message</button>
                            </div>
                            </div>
                        </div>
                        </div>
                        
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
