
/**
 * Represents a sign counter.
 * @constructor
 * @param {string} targetElt - the id of the element which displays the text.
 * @param {string} listenElt - the id of the element which listen the text tap.
 * @method [start] - manages working signcounter.
 */

// Class Signcounter

class Signcounter {
  constructor(targetElt, listenElt) {
    this.targetElt = document.getElementById(targetElt);
    this.listenElt = document.getElementById(triggerElt); 
  }

  start(){
    let total = this.targetElt.value.length;
    this.listenElt.innerHTML = total;
  }
}