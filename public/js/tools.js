// Onglets
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
// Compteur de caractères
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
}
