// Déclencher l'affichage et le non affichage d'un élément
document.getElementById("triggerElt").addEventListener('click', ()=>{
	document.getElementById("hidden").style.display = "block";
	document.getElementById("trigger").style.display = "none";
	document.getElementById("dateEpisode").setAttribute("required", "");
});