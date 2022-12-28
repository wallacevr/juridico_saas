
<body style="font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 20px;">
    <div class="w-full text-center">
        <img class="object-none object-center bg-yellow-300 w-24 h-24" src="{{publicImage(get_config('general/store/logo/email'))}}" alt="Logo" style="display: block;" />    
    </div>
    <div>
        <p>Caro(a),<b>{{$customer->name}}</b></p>
    </div>
    <div>
        <p>Obrigado pelo seu registro! Sua conta na {{get_config('general/store/name')}} foi criada com sucesso.

        Com seu registro, você terá acesso aos seguintes benefícios:</p>        
    </div>
    <div>
        <p>
             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tags-fill" viewBox="0 0 16 16">
                <path d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                <path d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043-7.457-7.457z"/>
            </svg>
            <b>Acompanhe seus pedidos</b> <br>
             Acompanhe os status de seus pedidos desde a aprovação até a entrega.
        </p>
    </div>
    <div>
        <p>
            <i class="bi bi-cart-check-fill"></i>
            <b>Compra Rápida</b> <br>
            Registre seus dados apenas uma vez e você não precisará preencher o formulário novamente.
        </p>
    </div>
    <div>


    </div>
    
</body>
