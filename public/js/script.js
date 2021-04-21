// ONGLETS
Array.from(document.getElementsByClassName("seriesTab")).forEach(elt => {
	elt.addEventListener('click', () => { 
		showElt(elt)})
});
// DECOMPTE DE CARACTERES
// Keyboard
document.getElementById("contentEpisode").addEventListener('keyup', ()=> {
	signCounter("contentEpisode", "signsEpisode")	
});
// Mobile
document.getElementById("contentEpisode").addEventListener('touchend', ()=> {
	signCounter("contentEpisode", "signsEpisode")	
});
