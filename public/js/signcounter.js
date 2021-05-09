// DECOMPTE DE CARACTERES
// Keyboard
document.getElementById("contentEpisode").addEventListener('keyup', ()=> {
	signCounter("contentEpisode", "signsEpisode")	
});
// Mobile
document.getElementById("contentEpisode").addEventListener('touchend', ()=> {
	signCounter("contentEpisode", "signsEpisode")	
});
function signCounter(target, show){
	let targetElt = document.getElementById(target)
	let showElt = document.getElementById(show)
	let total = targetElt.value.length;
	if (total <= 1) {
	  let message = total + " caractère";
	  showElt.innerHTML = message;
	}else{
	  let message = total + " caractères";
	  showElt.innerHTML = message;
	}
	document.getElementById("nbCharacters").value = total;
}
