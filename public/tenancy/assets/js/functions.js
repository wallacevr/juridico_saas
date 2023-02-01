$.fn.placeholder = function () {
    $.each($(this), (index, element) => {
        var $input = $(element).find(':input');
        var $label = $(element).find('label');
        $input.attr('placeholder', $label.text());
    });
};

$(".navbar-collapse").collapse("hide");
$(window).scroll(function () {
   if ($(this).scrollTop() > 50) {
      $("header").addClass("fixed");
   } else {
      $("header").removeClass("fixed");
   }
});

window.scroll({
   top: 0, 
   left: 0, 
   behavior: 'smooth'
 });
 
 //scroll para posição selecionada no inicio
 window.scrollBy({ 
   top: 0, // pode ser negativo o valor
   left: 0, 
   behavior: 'smooth' 
 });

//  MODAL

 var modal = document.getElementById("myModal");

 // botao que abre o modal
 var btn = document.getElementById("myBtn");

 
 // pega o span que fecha o modal
 var span = document.getElementsByClassName("close")[0];
 
 // quando clica abre o modal
 btn.onclick = function() {
   modal.style.display = "block";
 }
 
 // quando clicado fecha o modal
 span.onclick = function() {
   modal.style.display = "none";
 }
 
 // quando clica fora fecha o modal
 window.onclick = function(event) {
   if (event.target == modal) {
     modal.style.display = "none";
   }
 }

 var modal = document.getElementById("myModal");

 // botao que abre o modal
 var btn = document.getElementById("myBtn1");

 
 // pega o span que fecha o modal
 var span = document.getElementsByClassName("close")[0];
 
 // quando clica abre o modal
 btn.onclick = function() {
   modal.style.display = "block";
 }
 
 // quando clicado fecha o modal
 span.onclick = function() {
   modal.style.display = "none";
 }
 
 // quando clica fora fecha o modal
 window.onclick = function(event) {
   if (event.target == modal) {
     modal.style.display = "none";
   }
 }

//  MODAL 2

var modal = document.getElementById("myModal");

// botao que abre o modal
var btn = document.getElementById("myBtn2");


// pega o span que fecha o modal
var span = document.getElementsByClassName("close")[0];

// quando clica abre o modal
btn.onclick = function() {
  modal.style.display = "block";
}

// quando clicado fecha o modal
span.onclick = function() {
  modal.style.display = "none";
}

// quando clica fora fecha o modal
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

//  MODAL 3

var modal = document.getElementById("myModal");

// botao que abre o modal
var btn = document.getElementById("myBtn3");


// pega o span que fecha o modal
var span = document.getElementsByClassName("close")[0];

// quando clica abre o modal
btn.onclick = function() {
  modal.style.display = "block";
}

// quando clicado fecha o modal
span.onclick = function() {
  modal.style.display = "none";
}

// quando clica fora fecha o modal
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
 