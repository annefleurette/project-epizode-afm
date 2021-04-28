// ONGLETS
Array.from(document.getElementsByClassName("seriesTab")).forEach(elt => {
	elt.addEventListener('click', () => { 
		showElt(elt)})
});
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
