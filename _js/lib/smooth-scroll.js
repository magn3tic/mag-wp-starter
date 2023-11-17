import Lenis from '@studio-freight/lenis';
import { gsap, ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);
gsap.ticker.lagSmoothing(0);

const lerpDefault = 0.1;
const multDefault = 1;

export let lenis = new Lenis({
  lerp: lerpDefault,
  wheelMultiplier: multDefault,
  smoothTouch: false,
});

gsap.ticker.add(time => {
  lenis.raf(time * 1000);
});

lenis.on('scroll', event => {
  ScrollTrigger.update();
});

// scroll anchor hash links
const handleScrollLink = () => {
  const id = anchor.hash.replace('#', '');
  const target = document.getElementById(id);
  if (!target) return;
  anchor.addEventListener('click', event => {
    event.preventDefault();
    lenis.scrollTo(target);
  });
};

export default () => {
  const scrollAnchors = document.querySelectorAll('a[href^="#"]');
  scrollAnchors.forEach(handleScrollLink);
};
