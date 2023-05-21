import {isHtml} from "./api.js";

const departmentForm= document.querySelector('.add-department');
const statusForm= document.querySelector('.add-status');
departmentForm.addEventListener('submit',(evt)=>{
    evt.preventDefault();
    let input = document.querySelector('.add-department input');
    let err=document.querySelector('.add-department .errorMessage');
    if(input.value==='')err.innerText="Name can't be null";
    //else if(isHtml(input.value))err.innerText="Html elements are not allowed";
    else departmentForm.submit();
})
statusForm.addEventListener('submit',(evt)=>{
    evt.preventDefault();
    let input = document.querySelector('.add-status input');
    let err=document.querySelector('.add-status .errorMessage');
    if(input.value==='')err.innerText="Name can't be null";
    //else if(isHtml(input.value))err.innerText="Html elements are not allowed";
    else statusForm.submit();
})