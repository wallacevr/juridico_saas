<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Início | Senha Top/title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     
      <meta property="og:type" content="website" />
      <meta property="og:image:width" content="500" />
      <meta property="og:image:height" content="630" />
     
      <meta property="og:url"content="https://www.senhatop.com.br/" />
      <meta property="og:site_name"content="senhatop.com.br" />

      <meta property="og:title" content="Soluções em Gestão de Atendimento" />
		<meta name="theme-color" content="#fff"/>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="robots" content="all">
		<meta name="revisit-after" content="7 day">
		<meta name="language" content="Portuguese">
		<meta name="generator" content="N/A">
		<meta content="text/html; charset=UTF-8; X-Content-Type-Options=nosniff" http-equiv="Content-Type" />
		<!-- <link rel="icon" href="public/img/favicon.png" type="image/png" sizes="16x16"> -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
		  <link rel="stylesheet" type="text/css" href="public/css/app.css">
        <link rel="stylesheet" type="text/css" href="public/css/appheader.css">
        <link rel="stylesheet" type="text/css" href="public/css/banner.css">
        <link rel="stylesheet" type="text/css" href="public/css/appfooter.css">
        <link rel="stylesheet" type="text/css" href="public/css/principal.css">
        <style>
body{
    text-align: center;
    background-size: 100%;
  font-family: sans-serif;
  font-weight: 100;
}
h5{
  color:#FFF !important;

  margin: 40px 0px 20px;
}
.contador{
   position:relative !important;
   top:100px!important;
}
.logotopo{

   width:150px !important;
    height:80px !important;

}
#footer{
   position:relative !important;
   bottom:350px!important;
}
 #clockdiv{
    font-family: sans-serif;
    color: #fff;
    display: inline-block;
    font-weight: 100;
    text-align: center;
    font-size: 30px;
}
#clockdiv > div{
    padding: 5px;
    border-radius: 3px;
    background: linear-gradient(to right, #1370af , #55d4e0) !important;
    display: inline-block;
}
#clockdiv div > span{
    padding: 5px;
    border: 0px;
    background-color:rgba(0, 0, 0, 0.0)!important;
    display: inline-block;
}
smalltext{
    padding-top: 5px;
    font-size: 16px;
}

</style>
	</head>
	<body data-logo="public/img/LOGO_BAC.png"  background="public/img/Background.png">
        <!-- HEADER-->
        <header>
          
        <div class="container">
            <nav class="navbar navbar-expand-xl navbar-light">
                <a href="./" id="home" class="navbar-brand">
                  <img
                     src="public/img/LOGO_BAC.png"
                     alt=""
                     class="img-fluid logotopo"
                  />
                
               </a>
              
               </div>
            </nav>
         </div>
         </header>
        <div class="contador">
               <h5 class="px-1">Em breve sua nova plataforma de Telemedicina <br>
estará on-line e disponível 24 horas por dia e 07 dias por semana. <br>
Sem carência, sem limite de idade e sem limite de consultas. <br>
 Com assinaturas individuais e familiar a partir de R$22,99.</h1>
               <div id="clockdiv">
                  <div>
                     <span class="days" id="day"></span>
                     <div class="smalltext">Dias</div>
                  </div>
                  <div>
                     <span class="hours" id="hour"></span>
                     <div class="smalltext">Horas</div>
                  </div>
                  <div>
                     <span class="minutes" id="minute"></span>
                     <div class="smalltext">Min.</div>
                  </div>
                  <div>
                     <span class="seconds" id="second"></span>
                     <div class="smalltext">Seg.</div>
                  </div>
               </div>
      
            <p id="demo"></p>
      </div>
<script>
  
var deadline = new Date("Jul 04, 2022 19:00:00").getTime();
  
var x = setInterval(function() {
  
var now = new Date().getTime();
var t = deadline - now;
var days = Math.floor(t / (1000 * 60 * 60 * 24));
var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((t % (1000 * 60)) / 1000);
document.getElementById("day").innerHTML =days ;
document.getElementById("hour").innerHTML =hours;
document.getElementById("minute").innerHTML = minutes; 
document.getElementById("second").innerHTML =seconds; 
if (t < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "TIME UP";
        document.getElementById("day").innerHTML ='0';
        document.getElementById("hour").innerHTML ='0';
        document.getElementById("minute").innerHTML ='0' ; 
        document.getElementById("second").innerHTML = '0'; }
}, 1000);
</script>




<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="public/js/functions.js"></script>
<script>
   // window.cookieconsent.initialise({
   //   "palette": {
   //     "popup": {
   //       "background": "#f5f5f5",
   //       "text": "#000000"
   //     },
   //     "button": {
   //       "background": "#134179",
   //       "text": "#ffffff"
   //     }
   //   },
   //   "content": {
   //     "message": "Este site usa cookies para proporcionar uma experiência digital aprimorada. Você pode obter mais informações sobre os cookies que usamos e sobre como alterar as configurações de cookie <a href='politica-de-privacidade.html' style='color:#000;'>clicando aqui</a>. Se continuar a usar este site sem alterar as configurações, você está concordando com nosso uso de cookies.",
   //     "dismiss": "Concordar e fechar",
   //     "link": false,
   //   }
   // });


   </script>
	</body>
</html>