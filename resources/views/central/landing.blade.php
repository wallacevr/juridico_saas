@extends('layouts.central')

@section('content')

     <!--BANNER-->

     <section
      id="banner">
         
         <div class="bd-example">
            <div id="carouselExampleCaptions" class="carousel slide carousel-fade " data-ride="carousel">

               <div class="carousel-inner">
              
                  <div class="carousel-item active"  data-interval="5000" >
                     <a href="#">
                        <img class="d-block w-100 banner" src="{{asset('img/Banner1.gif')}}" alt="Terceiro slide">
                     </a>  
                     <div class="carousel-caption text-left">
 
                    </div>
                    
                   </div>
                   
                   {{--
                     <div class="carousel-item " data-interval="5000">
                        <a href="#">
                           <img src="{{asset('img/Banner_Background03.png')}}" class="d-block w-100 banner" alt="...">
                        </a>
                     <div class="carousel-caption text-left">
                        <a href="#">
                     
                           <div class="row">
                                 <div class="col-5 col-sm-4 col-lg-5">
                   
                                    
                                 </div>
                                 <div class="col-4 col-lg">
                                   
                 
                                 </div>
                               
                           
                              </div>
                        </a>
                     </div>

                  </div>
                  --}}
  
                  
                 
                        <div class="carousel-item" data-interval="5000">
                        <a href="#">
                                 <img class="d-block w-100 banner" src="{{asset('img/Banner_Background02.png')}}" alt="Segundo slide">
                        </a>   
                         <div class="carousel-caption text-left">
                           <a href="#">
                             
                              <div class="row px-3">
                                 <div class="col-4 col-sm-4 col-lg-6">
                            
                                 
                                 </div>
                                 <div class="col-12 col-lg">
                                    
                               
                                 </div>
                              </div>
                           </a>
                        </div>
                   </div>
       
                   </div>
                  </a>

               </div>
               
               <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
            </div>
         </div>


          </div>
   </section>
      <!--FIM BANNER-->
 <section id="vantagens">
    <div class="container py-2">
       <div class="row justify-content-center">
         <h4 class="text-uppercase mb-4">confira algumas <span>vantagens</span></h4>
       </div>
       <div class="row">
         <div class="col-12 col-lg">
            <div class="card" style="width: 100%;">
               <img src="{{asset('img/icons/online.png')}}" class="card-img-top" alt="...">
               <div class="card-body">
                 <h5 class="card-title">Online</h5>
                 <p class="card-text">Com IziSystem você não precisa se preocupar com instalação ou espaço de armazenamento<a href="#">Saiba Mais</a></p>
                  
               </div>
             </div>
             <div class="card" style="width: 100%;">
               <img src="{{asset('img/icons/gestao.png')}}" class="card-img-top" alt="...">
               <div class="card-body">
                 <h5 class="card-title">Relatórios e Gráficos</h5>
                 <p class="card-text">Relatórios e gráficos para auxiliar a sua gestão.<a href="#">Saiba Mais</a></p>

               </div>
             </div>

         </div>
         <div class="col-12 col-lg">
            <div class="card" style="width: 100%;">
               <img src="{{asset('img/icons/organizacao.png')}}" class="card-img-top" alt="...">
               <div class="card-body">
                 <h5 class="card-title">Organização</h5>
                 <p class="card-text">Organize os processos de sua empresa <a href="#">Saiba Mais</a></p>

               </div>
             </div>
             <div class="card" style="width: 100%;">
               <img src="{{asset('img/icons/ecommerce.png')}}" class="card-img-painel" alt="...">
               <div class="card-body">
                 <h5 class="card-title">Ecommerce</h5>
                 <p class="card-text">Venda seus produtos e serviços online de forma simples<a href="#">Saiba Mais</a></p>

               </div>
             </div>

         </div>
         <div class="col-12 col-lg">
            <div class="card-form">
            <h6 class="text-center text-uppercase mb-2">Crie sua Conta Grátis</h6>
                <form class="mt-8 sm:flex" action="{{ route('central.tenants.step-1') }}" method="post" id="step-form">
                    @csrf
                    @include('layouts.snippets.fields', ['type'=>'email', 'class'=>'w-full px-5','label'=>'Write the email you use the most', 'placeholder'=>'Write the email you use the most', 'name'=>'email', 'value'=> '' ,'classLabel'=>'sr-only'])
                    <div class="mt-3  sm:mt-0 sm:ml-3 sm:flex-shrink-0">
                        <button type="submit" class=" btn btn-secondary d-flex align-items-center justify-content-center botao-enviar"> {{__('Register')}}</button>
                    </div>
                </form>
            </div>


         </div>
       </div>
    </div>

 </section>

   <section
   id="quemsomos"
   style="background-image: url('{{asset('img/LOGO.png')}}');" 
  class="pb-5"
   >
      <div class="container py-5">

            <div class="row align-items-center justify-content-center justify-content-lg-end">
               <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8">
                  <h3 class="text-uppercase">O Que é o <span>IziSystem?</span></h3>
                  <p class="my-3">
                  O IziSystem é uma plataforma de gestão empresarial 100% que oferece recursos para organizar o processo de sua empresa e agilizar a tomada de decisões.
                  </p>
                  <p class="my-3">
                  Com os nossos serviços você pode abandonar papéis e planilhas e  automatizar processos de sua empresa.
                  </p>
                 
                  <p class="my-3">
                  O IziSystem veio para trazer mais agilidade e controle a sua empresa
                  </p>
               
                  
                  <div class="row align-items-center justify-content-center justify-content-lg-start py-5">
                  <h4 class="text-center">ESCOLHA O PLANO <br><span>IDEAL PARA SUA EMPRESA</span></h4>
                     <div class="col-12 col-lg-8">
                      <div class="text-center text-md-left w-100 my-2">
                         <a href="#"><button class="myBtn">Clique Aqui</button></a>
                      </div>
                     </div>
                  </div>
               </div>
           </div>

      </div>
   </section>

   

@endsection