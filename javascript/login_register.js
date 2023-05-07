
function cancel(x){
    let form= document.getElementsByClassName("loginRegisterForm");
    if(x<0 || x>=form.length) throw "Invalid argument";
    form[x].style.display='none';
    enableScroll();
}

function OpenLoginForm(){
    let form= document.getElementsByName("LoginForm");
    form[0].style.display='flex';
    disableScroll();
}
function OpenRegisterForm(){
    let form= document.getElementsByName("RegisterForm");
    form[0].style.display='flex';
    disableScroll();
}

function disableScroll(){
    let body= document.body;
    body.style.overflow='hidden';
}
function enableScroll(){
    let body= document.body;
    body.style.overflow='scroll';
}


