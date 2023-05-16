export function disableScroll(){
    const body =document.querySelector('body');
    body.style.overflow='hidden';
    const elment= document.createElement('a');
    elment.innerText='Ola bitch';
    return elment;
}