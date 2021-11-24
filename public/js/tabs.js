// Activer l'onglet choisi
window.addEventListener('load', () => {
	const elementTabArray = Array.from(document.getElementsByClassName("elementTab"));
	elementTabArray.forEach(elt => {
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
	console.log('url', window.location);
	const urlComposed = window.location.href.split('/');
	console.log(urlComposed);
	let tabId = parseInt(urlComposed[urlComposed.length - 1]); // on récupère le numéro du tab
	if(urlComposed[3]==='updateSeries' && urlComposed.length === 5){ // Dans le cas spécifique updateSeries
		tabId = 1;
	}else if(urlComposed[3]==='displayMember' && urlComposed.length === 5){ // Dans le cas spécifique displayMember
		tabId = 1;
	}
	console.log('tabId', tabId);
	const queryString = window.location.search; // on recupere toute la partie apres le ? de l'url exemple : action=updateSeries&idseries=165&tab=2
	const urlParams = new URLSearchParams(queryString); // il transforme l'ensemble en objet avec une methode get qui permet d'appeler la clé d'un paramètre
	const tabs = Array.from(document.getElementsByClassName("elementTab"));
	let tabIndex = 1
	if(urlParams.get('tab')){
		tabIndex = urlParams.get('tab')
	}else if(tabId > 0 && tabId <= elementTabArray.length){
		tabIndex = tabId;
	}
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