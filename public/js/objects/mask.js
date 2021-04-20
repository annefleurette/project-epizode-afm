
/**
 * Represents a sign counter.
 * @constructor
 * @param {string} targetElt - the class of the tab element.
 * @param {string} showElt - the class of the section which is shown.
 * @method [start] - manages working mask.
 */

// Class Mask

class Mask {
  constructor(targetElt, showElt) {
  	this.targeElt = document.getElementsByClassName(targetElt);
    this.showElt = document.getElementsByClassName(showElt);
	this.showElt.style.display = "none";
	}

  start(){
	for (i = 0; i < this.targetElt.length; i++) {
		this.showElt.style.display = "none";
		this.targetElt[i].addEventListener("click", ()=> {
		      this.showElt[i].style.display = "block";
		});
  	}
  }
}