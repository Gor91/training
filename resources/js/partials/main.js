export function langs(el, lng) {

    let pattern;
    if (lng === 'hy')
        pattern = /^[\u0530-\u058FF|\u0020-\u0040]*$/;
    else
        pattern = /^[\u0000-\u009F]*$/;

    return (!pattern.test(el));
}
