
const galleryContainer = document.querySelector('.container');
const galleryControlsContainer = document.querySelector('.gallery-controls');
const galleryControls = ['precedent', 'suivant'];
const galleryItems = document.querySelectorAll('.card');
const detail = document.querySelectorAll('.detail');

class Carousel {

  constructor(container, items, controls) {
    this.carouselContainer = container || galleryContainer;
    this.carouselControls = controls;
    this.carouselArray = [...items];
  }

  updateGallery() {
    this.carouselArray.forEach(el => {
      el.classList.remove('card1');
      el.classList.remove('card2');
      el.classList.remove('card3');
      el.classList.remove('card4');
      el.classList.remove('card5');
      el.classList.remove('card6');
      el.classList.remove('card7');
      el.classList.remove('card8');
      el.classList.remove('card9');
    });



    this.carouselArray.slice(0, 9).forEach((el, i) => {
      el.classList.add(`card${i+1}`);
    });

    detail.forEach(element => {
      element.style.display='none';
    });
  }


  setCurrentState(direction) {
    const currentIndex = this.carouselArray.findIndex(el => el.classList.contains('card1'));

    if (direction.classList.contains('gallery-controls-precedent')) {
      this.carouselArray.unshift(this.carouselArray.pop());
    } else {
      this.carouselArray.push(this.carouselArray.shift());
    }

    const newIndex = this.carouselArray.findIndex(el => el.classList.contains('card1'));

    if (currentIndex !== newIndex) {
      this.updateGallery();
    }
  }


  

  setControls() {
    const galleryControlsElement = document.querySelector('.gallery-controls');
  
    this.carouselControls.forEach(control => {
      const button = document.createElement('button');
      button.className = `gallery-controls-${control}`;
      button.innerText = control;
      galleryControlsElement.appendChild(button);
    });
  }


  useControls() {
    const triggers = [...galleryControlsContainer.children];

    triggers.forEach(control => {
      control.addEventListener('click', e => {
        e.preventDefault();
        this.setCurrentState(control);
      });
    });
  }

}

const exampleCarousel = new Carousel(galleryContainer, galleryItems, galleryControls);

exampleCarousel.setControls();
exampleCarousel.useControls();

function affDetail(nom){
  nom.style.display='flex';
}

function turn(){
  document.getElementsByClassName('card3')[0].classList.toggle('card_det');
}