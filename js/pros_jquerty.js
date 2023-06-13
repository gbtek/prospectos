// JavaScript Document

//Div en el centro de la pagina MODAL
function DivModal(pagina, DivOrigen){
		CargarPagDiv(pagina, DivOrigen);
		setTimeout(popup, 200);
	function popup() {
		$(DivOrigen).css("display", "block");
	}
}

function CargarPagDiv(pagina,idDIV){
 		$(idDIV).load(pagina);
}

function Cancelar(DivOrigen){
	$(DivOrigen).hide();
	$(DivOrigen).html("");
}