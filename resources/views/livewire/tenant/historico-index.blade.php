<div>
    @foreach($processo as $processo)
        <div class="card p-3">

        <div class="row">
            <div class="col-6">
                <h5><i class='bx bx-history'></i>Histórico <a  class="btn" data-toggle="modal" data-target="#exampleModal">
                <i class='bx bxs-plus-circle text-white'></i>
                </a></h5>
               

                        <!-- Modal -->
                        <form action="{{route('tenant.processo.addhistorico',['processo'=>$processo->id])}}" method="post">
                        @csrf
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Histórico</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            
                    <div class="form-group">
                        <label for="dtmov">Data </label>
                        <input type="date" class="form-control" id="data" name="data"  >
                        @error('dtmovimentacao') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Descrição</label>

                        <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="10" placeholder="Descrição da Movimentação" ></textarea>
                        @error('descricao') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                    </form>
                            </div>

                            </div>
                        </div>
                        </div>

            </div>
        </div>
        <style>
        td {
        white-space: pre;
        }
        </style>
            <table class="table table-hover" id="historico">
                <thead>
                    <tr>
                       
                        <th scope="col">Data</th>
                        <th scope="col">Descricao</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                @foreach($processo->historico as $historico)
                    <tr>
                       
                    <th scope="row">
                    {{ date("d/m/Y", strtotime($historico->data))}}
                    </th>
                    <th>
                            <div>
                                @php 
                                echo nl2br($historico->descricao);
                                @endphp
                            </div>
                    </th>
                    <th>
                        <a wire:click="modaledthistorico({{$historico->id}})" class="btn btn-warning text-white ms-2"><i class="bx bx-edit-alt"></i></a>
                        <a wire:click="delete({{$historico->id}})" class="btn btn-danger ms-2 show_confirm" ><i class="bx bx-trash"></i></a>
                    </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            

                        <!-- Modal -->

                        <div class="modal fade
                        
                                @if($show === true) show @endif"
                                id="modaledthistorico"
                                style="display: @if($show === true)
                                        block
                                @else
                                        none
                                @endif;"
                        
                        
                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form  method="post">
                        @csrf							
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Alteracao de Histórico</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="escondermodal()"> 
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            
                    <div class="form-group">
                        <label for="dtmov">Data </label>
                        <input type="date" class="form-control" id="dataedit" name="data"  wire:model="data">
                        @error('dtmovimentacao') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Descrição</label>

                        <textarea class="form-control" name="descricao" id="descricaoedit" cols="30" rows="10" placeholder="Descrição da Movimentação" wire:model="descricao"></textarea>
                        @error('descricao') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="escondermodal()">Cancelar</button>
                                <button type="button" wire:click="update()" class="btn btn-primary">Salvar</button>
                        
                    </div>
                    </form>
                </div>




            
        </div>
        <div class="row ">
        <div class="col-6 text-center mt-2">
                <button class="btn btn-success" type="submit">Salvar</button>
        </div>
        </div>	

        </div>
    @endforeach
</div>
<script>
     $(document).ready(function () {
        window.livewire.emit('show');
    });

    window.livewire.on('show', () => {
        $('#modaledthistorico').modal('show');
    });
</script>