						  		
function marcarFavorito(idrestaurante) {
	//alert(idrestaurante);
	$.post("/favoritos/anadirRestFavorito", {
		//idusuario: idusuario,
		idrestaurante: idrestaurante
	}, function (data)
	{
		if (data == 1)
		{
			//alert(data);
			$(".favorito"+idrestaurante).html('<div class="favorito-marcado"><i class="fa fa-star"></i>Restaurante favorito</div>');
		} else {
			//alert("nada");
			//console.log('Nada');              
		}
	})
	
};
	