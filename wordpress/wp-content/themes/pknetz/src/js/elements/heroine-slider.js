class HeroineSlider {
  constructor() {
    this.sliderOuter = document.querySelector('.pkn-fp-carousel-outer');
    this.slidesTrack = document.querySelector('.pkn-fp-carousel-slides');
    this.slides = document.querySelectorAll('.pkn-fp-slide');
    this.slideCount = this.slides.length;
    this.currentSlide = 0;
    this.currentSlideElement = this.slidesTrack.querySelector(".pkn-slide-active");
    this.pageDots = document.querySelectorAll('.pkn-fp-pagination-item');
    this.slideTimeout = null;

    this.init();
  }

  init() {
    this.addEventListeners();
    this.startSlideTimeout();
  }

  addEventListeners() {
    this.slides.forEach((slide) => {
      slide.addEventListener('click', () => {
        window.location.href = slide.dataset.targetUrl;
      });
    });

    this.pageDots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        this.goToSlide(index);
      });
    });
  }

  goToSlide(index) {
    let lastSlide = this.currentSlideElement;
    let lastIndex = this.currentSlide;
    lastSlide.classList.add('pkn-slide-past');
    this.currentSlide = index;
    this.currentSlideElement = this.slides[index];
    this.currentSlideElement.classList.add('pkn-slide-active');
    this.pageDots[lastIndex].classList.remove('pkn-pagination-item-active');
    this.pageDots[index].classList.add('pkn-pagination-item-active');
    setTimeout(() => {
      lastSlide.classList.remove('pkn-slide-active');
      lastSlide.classList.remove('pkn-slide-past');
    }, 500);
    clearInterval(this.slideTimer);
    this.startSlideTimeout();
  }

  startSlideTimeout() {
    this.slideTimer = setTimeout(() => {
      this.goToNextSlide();
    }, 10000);
  }

  goToNextSlide() {
    let lastSlide = this.currentSlideElement;
    let lastIndex = this.currentSlide;
    lastSlide.classList.add('pkn-slide-past');
    this.currentSlide = (this.currentSlide + 1) % this.slideCount;
    this.currentSlideElement = this.slides[this.currentSlide];
    this.currentSlideElement.classList.add('pkn-slide-active');
    this.pageDots[lastIndex].classList.remove('pkn-pagination-item-active');
    this.pageDots[this.currentSlide].classList.add('pkn-pagination-item-active');
    setTimeout(() => {
      lastSlide.classList.remove('pkn-slide-active');
      lastSlide.classList.remove('pkn-slide-past');
    }, 500);
    clearInterval(this.slideTimer);
    this.startSlideTimeout();
  }
}

if (document.querySelector('.pkn-fp-carousel-outer')) {
  const slider = new HeroineSlider();
  document.querySelector('.pkn-fp-carousel-outer').slider = slider;
}