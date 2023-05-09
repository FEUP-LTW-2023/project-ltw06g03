const registerButton= document.getElementsByName("RegisterButton")[0];
registerButton.addEventListener('click',OpenRegisterForm);
const loginButton= document.getElementsByName("LoginButton")[0];
loginButton.addEventListener('click',OpenLoginForm);
const cancelRegisterButton= document.getElementsByName("CancelRegister")[0];
cancelRegisterButton.addEventListener('click',function() { cancel(1); } );
const cancelLoginButton= document.getElementsByName("CancelLogin")[0];
cancelLoginButton.addEventListener('click',function() { cancel(0); } );

const registerForm= document.getElementsByName("RegisterForm")[0];
registerForm.addEventListener("submit",async (event) => {
    await checkRegisterInputs(event)
});

const eyes= document.querySelectorAll('.registerForm label i');
eyes[0].addEventListener('click',(e)=>toggleVisibility(e));
eyes[1].addEventListener('click',(e)=>toggleVisibility(e));



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
async function checkRegisterInputs(event) {
    try {
        event.preventDefault();
        let registerForm = document.getElementsByClassName('registerForm')[0];
        let pass = document.querySelectorAll(".registerForm input[name='pass']");
        let up = document.querySelector(".registerForm input[name='up']");
        if (pass[0].value !== pass[1].value) throw "Passwords don't match";
        const response = await fetch('../api/api_user.php?up=' + up.value);
        let user = await response.json();
        user=user[0];
        if (user['up'] !== -1) throw "Account already created with " + up.value;
        registerForm.submit();
    }
    catch (e){
        let err=document.querySelector(".registerForm .errorMessage");
        err.innerText=e;
        return false
    }
}

function toggleVisibility(e){
    e.preventDefault();
    let pass = document.querySelectorAll(".registerForm input[name='pass']");
    if(pass[0].type==='password'){
        pass[0].type='text';
        pass[1].type='text';
        eyes[0].className=' fas fa-eye-slash';
        eyes[1].className=' fas fa-eye-slash';
    }
    else{
        pass[0].type='password';
        pass[1].type='password';
        eyes[0].className=' fas fa-eye';
        eyes[1].className=' fas fa-eye';
    }

}