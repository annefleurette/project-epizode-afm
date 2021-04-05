
/**
 * Represents a sign counter.
 * @constructor
 * @param {string} targetElt - the id of the element which displays the text.
 * @param {string} showElt - the id of the element which shows the text tap.
 * @method [start] - manages working signcounter.
 */

// Class Signcounter

class Signcounter {
  constructor(targetElt, showElt) {
    this.targetElt = document.getElementById(targetElt);
    this.showElt = document.getElementById(showElt); 
  }

  start(){
    // For keyboards
    this.targetElt.addEventListener("keyup", ()=> {
      let total = this.targetElt.value.length;
      if (total === 1) {
        let message = total + " caractère";
        this.showElt.innerHTML = message;
      }else{
        let message = total + " caractères";
        this.showElt.innerHTML = message;
      }
    });
    // For mobile/tablets
    this.targetElt.addEventListener("touchend", ()=> {
      this.showElt.style.display = "block";
      let total = this.targetElt.value.length;
      if (total = 1) {
        let message = total + " caractère";
        this.showElt.innerHTML = message;
      }else{
        let message = total + " caractères";
        this.showElt.innerHTML = message;
      }
    });
  }
}