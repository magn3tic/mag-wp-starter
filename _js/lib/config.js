
export const ELEMENTS = {
  main: document.getElementById('main'),
};

const TEMPLATE_BODY_CLASSES = ['home'];

export const PAGES = TEMPLATE_BODY_CLASSES.reduce((result, classname) => {
  result[classname] = document.body.classList.contains(classname);
  return result;
}, {});

export const breakpoints = {
  xs: 500,
  sm: 620,
  md: 767,
  lg: 992,
  xl: 1199,
  xxl: 1440,
};