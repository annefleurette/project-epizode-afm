// Onglets
Array.from(document.getElementsByClassName("elementTab")).forEach(elt => {
	elt.addEventListener('click', () => { 
		// On affiche le contenu associé au tab
		showElt(elt);
		// On supprime la class active partout
		let tabs = document.querySelectorAll(".active");
		Array.from(tabs).forEach(element => {
		element.classList.remove("active");
		})
		// On modifie l'animation sur le tab sélectionné
		elt.classList.add("active");
	})
});

// Activer l'onglet choisi
window.addEventListener('load', () => {
	const queryString = window.location.search; // on recupere toute la partie apres le ? de l'url exemple : action=updateSeries&idseries=165&tab=2
	const urlParams = new URLSearchParams(queryString); // il transforme l'ensemble en objet avec une methode get qui permet d'appeler la clé d'un paramètre
			const tabs = Array.from(document.getElementsByClassName("elementTab"));
			const tabIndex = urlParams.get('tab') ? urlParams.get('tab') : 1
			const tabSelected = tabs.find(tab => tab.dataset.index == tabIndex);
			showElt(tabSelected);
			tabSelected.classList.add("active");
	
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