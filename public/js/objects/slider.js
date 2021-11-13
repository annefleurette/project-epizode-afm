// SLIDER HOMEPAGE
/**
 * Represents a slider.
 * @constructor
 * @param {string} slide - the class of the elements that are going to slide.
 * @param {number} numberSlides - the number of elements to slide.
 * @param {number} interval - the timing between two slides.
 * @method [start] - manages working slider.
 * @method [showSlide] - displays the current slide.
 * @method [upSlide] - displays the next slide.
 * @method [downSlide] - displays the previous slide.
 * @method [addAuto] - manages automatic slider.
 */

// Class Diaporama

class Slider {
    constructor(slide, prev, next, play, pause, numberSlides, interval) {
        this.slide = document.getElementsByClassName(slide);
        this.number = numberSlides;
        this.interval = interval;
        this.totalIndex = this.number - 1;
        this.currentIndex = 0;
        this.currentSlide = this.slide[this.currentIndex];
        this.autoSlider = null;
    }
    start(){
        // On affiche le slide
        this.showSlide();
        // On automatise le diaporama
        this.addAuto();
    }
    showSlide(){  
        // On désactive tous les slides
        for(let u = 0; u <= this.totalIndex; u++) {
            this.slide[u].style.display="none";
        }
        // On active seulement la slide en cours
        this.currentSlide = this.slide[this.currentIndex];
        this.currentSlide.style.display = "block";
    }
    upSlide(){
        this.currentIndex++;
        if(this.currentIndex <= this.totalIndex) {
            this.showSlide();
        }else{
            this.currentIndex = 0;
            this.showSlide();
        } 
    }
    downSlide(){
        this.currentIndex--;
        if(this.currentIndex >= 0) {
          this.showSlide();
        }else{
          this.currentIndex = this.totalIndex;
          this.showSlide();
        }
    }
    addAuto(){
        this.autoSlider = setInterval(() => {
        this.upSlide();  
        }, this.interval);
    }
}