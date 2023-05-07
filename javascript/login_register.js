
const registerButton= document.getElementsByName("RegisterButton")[0];
registerButton.addEventListener('click',OpenRegisterForm);
const loginButton= document.getElementsByName("LoginButton")[0];
loginButton.addEventListener('click',OpenLoginForm);
const cancelRegisterButton= document.getElementsByName("CancelRegister")[0];
cancelRegisterButton.addEventListener('click',function() { cancel(1); } );
const cancelLoginButton= document.getElementsByName("CancelLogin")[0];
cancelLoginButton.addEventListener('click',function() { cancel(0); } );


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


