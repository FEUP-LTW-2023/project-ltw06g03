import {addPasswordToggle} from "./script.js";
const loginForm= document.getElementsByName("LoginForm")[0];
loginForm.addEventListener("submit",async (event) => {
    await validateLoginInputs(event);
});
const eyes= document.querySelectorAll('.loginForm label i.fa-eye');
addPasswordToggle(eyes);

async function validateLoginInputs(event){
    event.preventDefault();
    let pass = document.querySelector(".loginForm input[name='pass']");
    let up = document.querySelector(".loginForm input[name='up']");
    const response = await fetch('../actions/login.php?up=' + up.value+'&pass='+pass.value);
    let res = await response.json();
    if(res==''){
          window.location.href = window.location.origin+'/pages/home.php';
    }
    else{
        let err=document.querySelector(".loginForm .errorMessage");
        err.innerText=res[0];
    }
}

