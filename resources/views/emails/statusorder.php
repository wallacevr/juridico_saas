
<body style="font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 20px;">
    <div class="w-full text-center">
        <img class="object-none object-center bg-yellow-300 w-24 h-24" src="{{publicImage(get_config('general/store/logo/email'))}}" alt="Logo" style="display: block;" />    
    </div>
    <div>
        <p>Caro(a),<b>{{$order->customer->name}}</b></p>
    </div>
    <div>
        <p>O status do seu pedido na {{get_config('general/store/name')}} foi alterado para {{__('$order->status')}}.</p>        
    </div>
    <div>
        <p>
             Você também pode acompanhar seus pedidos na seção de Meus Pedidos em nosso <a href="{{$currentDomain}}">{{$currentDomain}}</a>
        </p>
    </div>


    
</body>
