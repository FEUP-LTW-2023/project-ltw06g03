const registerForm= document.getElementsByName("RegisterForm")[0];
registerForm.addEventListener("submit",async (event) => {
    await validateRegisterInputs(event);
});


const eyes= document.querySelectorAll('.registerForm label i');
eyes[0].addEventListener('click',(e)=>toggleVisibility(e));
eyes[1].addEventListener('click',(e)=>toggleVisibility(e));

async function validateRegisterInputs(event) {
    try {
        event.preventDefault();
        let registerForm = document.getElementsByClassName('registerForm')[0];
        let pass = document.querySelectorAll(".registerForm input[name='pass']");
        let up = document.querySelector(".registerForm input[name='up']");
        if (pass[0].value !== pass[1].value) throw "Passwords don't match";
        if(up.value<0) throw "Up must be positive";
        if(up.value.length!=9)throw "Up must be a 9 digit number";
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