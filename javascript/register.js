import {addPasswordToggle} from "./script.js";
import {isHtml} from "./api.js";

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
        let name = document.querySelector(".registerForm input[name='name']").value;
        let email = document.querySelector(".registerForm input[name='email']").value;
        if(name.length>30) throw "Name has to be shorter than 30 characters";
        if(isHtml(name) || isHtml(email) || isHtml(pass[0].value) || isHtml(pass[1].value))throw "Html elements are not allowed in fields"
        if (pass[0].value !== pass[1].value) throw "Passwords don't match";
        if(up.value<0) throw "Up must be positive";
        const response = await fetch('../api/api_user.php?up=' + up.value);
        let user = await response.json();

        user=user[0];
        if (user) throw "Account already created with " + up.value;
        registerForm.submit();
    }
    catch (e){
        let err=document.querySelector(".registerForm .errorMessage");
        err.innerText=e;
        return false
    }
}


