import { breakpoints } from '@/lib/config';

export const jsonFromScriptTag = id => {
  const script = document.getElementById(id);
  const json = JSON.parse(script.textContent || {});
  return json;
};

export const loadStyleSheet = (href, id) => new Promise((resolve, reject) => {
  if (document.getElementById(id)) {
    resolve(true);
    return;
  }
  const link = document.createElement('link');
  link.onload = () => resolve(true);
  link.onerror = () => reject(new Error(`error loading script ${id} @ ${href}`));
  link.href = href;
  link.type = 'text/css';
  link.rel = 'stylesheet';
  link.media = 'screen,print';
  document.getElementsByTagName('head')[0].appendChild(link);
});

export const loadScript = async (src, id, attrs = {}) => new Promise((resolve, reject) => {
  if (document.getElementById(id)) {
    resolve(true);
    return;
  }
  const script = document.createElement('script');
  script.onload = () => resolve(true);
  script.onerror = () => reject(new Error(`error loading script ${id} @ ${src}`));
  script.async = true;
  script.type = 'text/javascript';
  script.src = src;
  script.id = id;
  const attributes = Object.keys(attrs);
  if (attributes.length) {
    attributes.forEach(attribute => {
      script.setAttribute(attribute, attrs[attribute]);
    });
  }
  document.body.appendChild(script);
});

export const getEvent = (name, detail) => new CustomEvent(name, {
  detail,
  bubbles: false,
  cancelable: false,
});

export const dispatchEvent = (name, detail = {}) => {
  const customEvent = getEvent(name, detail);
  window.dispatchEvent(customEvent);
};

export const onDocReady = callback => {
  if (document.readyState !== 'loading') {
    callback();
  } else {
    document.addEventListener('DOMContentLoaded', callback);
  }
};

export const debounce = (callback, delay = 250) => {
  let timer;
  return (event) => {
    if (timer) clearTimeout(timer);
    timer = setTimeout(callback, delay, event);
  };
};

export const getStyles = (element, property = false) => {
  const styles = window.getComputedStyle(element);
  return !property ? styles : styles[property];
};

export const setStyles = (element, css = {}) => {
  // eslint-disable-next-line no-param-reassign, no-return-assign
  Object.keys(css).forEach(prop => element.style[prop] = css[prop]);
};


const breakpointHelper = (breakpoint, onChange) => {
  const mediaQuery = window.matchMedia(breakpoint);
  if (onChange) {
    mediaQuery.addEventListener('change', onChange);
  }
  return mediaQuery;
}

export const breakpointAbove = (bp, onChange = null) => {
  const breakpoint = `(min-width: ${breakpoints[bp]}px)`;
  return breakpointHelper(breakpoint);
};

export const breakpointBelow = bp => {
  const breakpoint = `(max-width: ${breakpoints[bp] - 1}px)`;
  return breakpointHelper(breakpoint);
};