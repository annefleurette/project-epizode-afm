// Onglets
Array.from(document.getElementsByClassName("elementTab")).forEach(elt => {
	elt.addEventListener('click', () => { 
		showElt(elt)})
});

// Activer l'onglet choisi
window.addEventListener('load', () => {
	const queryString = window.location.search; // on recupere toute la partie apres le ? de l'url exemple : action=updateSeries&idseries=165&tab=2
	const urlParams = new URLSearchParams(queryString); // il transforme l'ensemble en objet avec une methode get qui permet d'appeler la clé d'un paramètre
	if(urlParams.get('tab') !== null){
			const tabs = Array.from(document.getElementsByClassName("elementTab"));
			const tabSelected = tabs.find(tab => tab.dataset.index == urlParams.get('tab'));
			showElt(tabSelected);
	}
})

function showElt(target){
	let eltClass = target.className;
	let eltIndex = target.dataset.index;
	let contentClass = `${eltClass.substring(0, eltClass.length - 3)}Content`;
	let contentElts = document.getElementsByClassName(contentClass);
	Array.from(contentElts).forEach(element => {
		if(element.dataset.tab == eltIndex){
			element.style.display = "block";
		}else{
			element.style.display = "none";
		}
	});
}
