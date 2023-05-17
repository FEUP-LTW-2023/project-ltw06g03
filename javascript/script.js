
export function addPasswordToggle(eyes){
    for (let index = 0; index < eyes.length; index++) {
        eyes[index].addEventListener('click',(e)=>{
            toggleVisibility(e,eyes);
        })
    }
}
function toggleVisibility(e,eyes){
    e.preventDefault();
    let pass = document.querySelectorAll("form input[name='pass']");
    if(pass[0].type==='password'){
        for(let index=0; index<eyes.length;index++) {
            pass[index].type = 'text';
            eyes[index].className = ' fas fa-eye-slash';
        }
    }
    else {
        for (let index = 0; index < eyes.length; index++) {
            pass[index].type = 'password';
            eyes[index].className = ' fas fa-eye';

        }
    }
}