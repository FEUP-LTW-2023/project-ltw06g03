import {addPasswordToggle} from "./script.js";
const registerForm= document.getElementsByName("RegisterForm")[0];
registerForm.addEventListener("submit",async (event) => {
    await validateRegisterInputs(event);
});


const eyes= document.querySelectorAll('.registerForm label i.fa-eye');

addPasswordToggle(eyes);
async function validateRegisterInputs(event) {
    try {
        event.preventDefault();
        let registerForm = document.getElementsByClassName('registerForm')[0];
        let pass = document.querySelectorAll(".registerForm input[name='pass']");
        let up = document.querySelector(".registerForm input[name='up']");
        if (pass[0].value !== pass[1].value) throw "Passwords don't match";
        if(up.value<0) throw "Up must be positive";
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


