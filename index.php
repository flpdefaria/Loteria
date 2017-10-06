<!DOCTYPE html>

<html lang="pt-br">

<head>

	<meta charset="UTF-8">
	
	<title>Loteria</title>
	
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE11">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="/">

    <style type="text/css">

    	.left{
    		float: left;
    		width: 10%;
    	}

    </style>

</head>
<body>

<link rel="stylesheet" type="text/css" href="css/style.css">

<div id="topo"><h1>MEGA S E N A</h1></div><br>

<div id="topoS"><p>Selecione os números:</p></div><br>

<div style="padding-left: 75px;" id="msg"></div>

<div  style="padding-left: 75px;">Sua aposta foi: <span id="aposta"></span></div>

<div  style="padding-left: 75px;">Sorteio: <span id="apostaMega"></span></div>

<br>

<form id="form">
	<div id="bodyl">
	<?php 
		for ($i=0; $i < 60; $i++) {

			$campo = $i < 9 ? '0'.($i+1) : $i+1;

			echo '<div class="left"><input name="aposta" id="c-'.$campo.'" type="checkbox" value="'.$campo.'" /><label for="c-'.$campo.'">'.$campo.'</label></div>';
		}
	?>
		<div>
			<button id="botao">Apostar</button>
			<a href="#" onclick="sortearMegaSena()" id="botao">Surpresinha</a>	
		</div>
	</div>
</form>
<div  style="padding-left: 498px; color: #03679e; font-size: 12px; padding-top: 2px;">Você preencheu: <span id="apostado">0</span> números</div>
<br>

<div style="padding-left: 75px;"><a href="#" onclick="jogar()" id="jogarbtn">Jogar</a></div><br>
<div style="padding-left: 75px;"><a href="#" onclick="sorteio()" id="sorteiobtn">Sortear</a></div>
<br><br>
<div id="topoS"><p>Lista dos Jogos:</p></div><br>

<br>
<!-- <div>Sorteio: <span id="megaSena">MegaSena</span></div> -->

<div style="padding-left: 75px;">
	<span id="listaSpan"></span>
</div>

<script src="jquery-3.2.1.min.js"></script>

<script>

	
	$.contarAcertos = function(a, b)
	{
	    return $.grep(a, function(i)
	    {
	        return $.inArray(i, b) > -1;
	    });
	};


	var getAposta = localStorage.getItem("aposta");
	var listaApostas= [];

	$('#aposta').html(getAposta ? getAposta : 'Você ainda não apostou.');

	function sortear(){

		var sorteados = '';

		for (var i = 0; i < 6; i++) {

			var random = Math.floor((Math.random() * 60) + 1);

			sorteados = i == 5 ? sorteados + random : sorteados + random + ', ';

		}

		localStorage.setItem("aposta", sorteados);

		localStorage.getItem("aposta");

		$('#aposta').html(localStorage.getItem("aposta"));
	}

	function sortearMegaSena(){

		var sorteados = '';

		for (var i = 0; i < 6; i++) {

			var random = Math.floor((Math.random() * 60) + 1);

			sorteados = i == 5 ? sorteados + random : sorteados + random + ', ';

		}

		localStorage.setItem("apostaMega", sorteados);

		localStorage.getItem("apostaMega");

		$('#apostaMega').html(localStorage.getItem("apostaMega"));
	}


	$('input').click(function(){

		console.log('aqui');

		var qtdAt = $('#form').serializeArray();

		$('#apostado').html(qtdAt.length);

	});

	$('#form').submit(function(e){
		var aposta = $(this).serializeArray();

		if(aposta.length > 6){

			$('#msg').html('Aposte apenas em 6 números');

				}else if(aposta.length < 6){

					var qtd = 6 -aposta.length;
					$('#msg').html('Aposte em mais '+ qtd +' números');

						}else{

							var apostaPush = [];

							for (var i = 0; i < aposta.length; i++) {
								apostaPush.push(aposta[i].value);

							}

							localStorage.setItem("aposta", apostaPush);

							$('#aposta').html(localStorage.getItem("aposta"));
						}

		e.preventDefault();

	});

//Salva os valores da apost

		$('#jogarbtn').click(function(){
			

			var a = $('#aposta').html();
			var aposta = a.split(',');	

			console.log(aposta);

			listaApostas.push(aposta);

			var htmlApostas = "";

			listaApostas.forEach(function(elem){

				htmlApostas += elem + "<br><br>";

			});

			
			var lista = $('#listaSpan').html(htmlApostas);
			var teste= [];

			var valoresSorteados = $('#megaSena').html();
			teste = valoresSorteados.split(',');

			
	});

//Salva os valores da apost

		$('#sorteiobtn').click(function(){
		debugger;		
			sortear();
			var a = $('#aposta').html();	

			 var testeSorteio = [1, 2, 3, 4, 5, 6];			    
			 var testeApostas = [];
			 var testeString = "";

			$.each(listaApostas, function( key, value ) {
  					
				var b = value.map(function(item) {
				    return parseInt(item, 10);
				});		

				testeApostas.push(b);

				var valores = listaApostas[key];

				var resultado = $.contarAcertos(testeSorteio, b);

				var opcoes = "";

				 for (var i = 0; i < listaApostas.length; i++) {
				 	
				 	var dezenas = listaApostas[i];
				 	
					for (var x = 0; x < dezenas.length; x++) {
						opcoes += dezenas[x] + ", ";
					}

				 	opcoes += "Acertos:" + resultado + "<br>";
				 }


				 
			})
			var lista = $('#listaSpan').html(opcoes);

			//var teste = count;
	});

//Informa o valor do sorteio

function testeSorteio(){

		var sorteados = '';

		for (var i = 0; i < 6; i++) {

			var random = Math.floor((Math.random() * 60) + 1);

			sorteados = i == 5 ? sorteados + random : sorteados + random + ', ';

		}

		localStorage.setItem("megaSena", sorteados);

		localStorage.getItem("megaSena");

		$('#megaSena').html(localStorage.getItem("megaSena"));

	}

</script>

<!-- <footer>
	<small>L O T E R I A<br>Copyright 2017 - Todos os direitos reservados</small>
</footer> -->

</body>
</html>