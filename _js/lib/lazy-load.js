import lazySizes from 'lazysizes';

const LOADED_CLASS = 'ls-loaded';
const ERROR_CLASS = 'ls-error';

lazySizes.cfg.lazyClass = 'ls-lazy';
lazySizes.cfg.loadedClass = LOADED_CLASS;
lazySizes.cfg.init = false;

const errorHandler = (element, onError) => {
  element.classList.add(ERROR_CLASS);
  if (onError) onError(element);
};

const loadHandler = (element, onLoad) => {
  element.classList.add(LOADED_CLASS);
  element.removeAttribute('data-src');
  if (onLoad) onLoad(element);
};

export const lazyLoadImage = (element, onLoad = null, onError = null) => {
  const { src } = element.dataset;
  element.onload = () => loadHandler(element, onLoad);
  element.onerror = () => errorHandler(element, onError);
  element.setAttribute('src', src);
};

export const lazyLoadBackground = (element, onLoad = null, onError = null) => {
  const bgSrc = element.dataset.src;
  const image = new Image();
  image.onload = () => {
    element.setAttribute('style', `background-image: url(${bgSrc})`);
    loadHandler(element, onLoad);
  };
  image.onerror = () => errorHandler(element, onError);
  image.setAttribute('src', bgSrc);
};

export default () => {
  lazySizes.init();

  // support for bg images
  const bgElements = document.querySelectorAll('[data-bg]');
  if (!bgElements) return;

  bgElements.forEach(bg => {
    bg.addEventListener('lazyloaded', event => {
      const bgImgUrl = event.target.getAttribute('data-bg');
      if (bgImgUrl) {
        event.target.style.backgroundImage = `url(${bgImgUrl})`;
      }
    });
  });
};
