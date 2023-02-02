<div>
   		<!--start page wrapper -->
		

				

           <div class="card radius-10">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="mb-0">Envolvidos</h5>
								</div>
								<div class="font-22 ms-auto"><a href="#" class="ms-2" data-toggle="modal" data-target="#exampleModal"><i class="bx bx-user-plus"></i></a></i>
								</div>
							</div>
							<form action="{{route('tenant.envolvido.store')}}" method="post">
								@csrf	
								<div class="modal" ID="exampleModal" tabindex="-1" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Cadastro de Envolvido</h5>
											
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<p>Nome:<input type="text" name="nome"></p>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary">Salvar</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
										</div>
										</div>
									</div>
									</div>
							</form>
							                       
							<hr>
							<div class="row mt-4">

						</div>
						<div class="col-12">

						</div>
							<div class="table-responsive">
								<table class="table align-middle mb-0" id="envolvidos">
									<thead class="table-light">
										<tr>
											<th>id</th>
											<th>Nome</th>
					
											
											<th style="width:5%">Ação</th>
										</tr>
									</thead>
									<tbody>
										@foreach($envolvidos as $envolvido)
										<tr>
											<td>{{$envolvido->id}}</td>
											<td>
												<div class="d-flex align-items-center">
												{{-- <div class="recent-product-img">
														
															<img src="{{ asset('assets/images/icons/chair.png') }}" alt="">
														
													</div>--}}
													<div class="ms-2">
														<h6 class="mb-1 font-14">{{$envolvido->nome}}</h6>
													</div>
												</div>
											</td>

											<td style="width:5%">
												<div class="d-flex order-actions">	
												<form method="POST" action="{{ route('tenant.envolvido.destroy',['envolvido'=> $envolvido->id]) }}">
													@csrf
													@method('delete')
														<a href="#" class="ms-2 show_confirm" ><i class="bx bx-trash"></i></a>
													</form>

                                                               	
                                                                   <div class="modal fade
                                                                   @if($show === true) show @endif"
                                                                            id="modaledthistorico"
                                                                            style="display: @if($show === true)
                                                                                    block
                                                                            @else
                                                                                    none
                                                                            @endif;"
                                                                            ID="exampleModal" tabindex="-1" role="dialog">
                                                                   <form action="#" method="post">
                                                                    @csrf
                                                                           
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Cadastro de Envolvido</h5>
                                                                                
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="escondermodal()">
                                                                                <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Nome:<input type="text" name="nome" wire:model="nome"></p>
                                                                            </div>

                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-primary" wire:click="update()" >Salvar</button>
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="escondermodal()">Cancelar</button>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                </form>
                                                            </div>
                                                                

												
												</div>
											</td>
										</tr>
										@endforeach
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
</div>
