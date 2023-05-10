
const loginForm= document.getElementsByName("LoginForm")[0];
loginForm.addEventListener("submit",async (event) => {
    await validateLoginInputs(event);
});
const eyes= document.querySelector('.loginForm label i');
eyes.addEventListener('click',(e)=>toggleVisibility(e));
async function validateLoginInputs(event){
    console.log("hello");
    event.preventDefault();
    let pass = document.querySelector(".loginForm input[name='pass']");
    let up = document.querySelector(".loginForm input[name='up']");
    const response = await fetch('../actions/login.php?up=' + up.value+'&pass='+pass.value);

    let res = await response.json();
    console.log(res);
    if(res==''){
          window.location.href = 'http://localhost:9000/pages/home.php';
    }
    else{
        let err=document.querySelector(".loginForm .errorMessage");
        err.innerText=res[0];
    }
}

function toggleVisibility(e){
    e.preventDefault();
    let pass = document.querySelector(".loginForm input[name='pass']");
    if(pass.type==='password'){
        pass.type='text';
        eyes.className=' fas fa-eye-slash';

    }
    else{
        pass.type='password';
        eyes.className=' fas fa-eye';

    }

}