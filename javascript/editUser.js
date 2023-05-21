import {addPasswordToggle} from "./script.js";
import {isHtml} from "./api";
const form= document.querySelector('form');
const eyes= document.querySelectorAll('form i.fa-eye');
addPasswordToggle(eyes);
form.addEventListener('submit',(e)=>{
    validateInputs(e);
})
const imgInput= document.querySelector('form input[type=file]');
imgInput.addEventListener('input',async (e) => {
    let img = document.querySelector('form img');
    let reader = new FileReader();
    img.src = e.target.result;
    reader.onload = async function (e) {
        img.src = e.target.result;

    }
    reader.readAsDataURL(imgInput.files[0]);



});

function validateInputs(e) {
    let err= document.querySelector('form .errorMessage');
    e.preventDefault();
    let pass= document.querySelectorAll("form input[name='pass']");
    let name=document.getElementsByName('name')[0].value;
    let email= document.getElementsByName('email')[0].value;
    if(isHtml(name)|| isHtml(email)|| isHtml(pass[0].value) )err.innerText="Html elements are not allowed";
    else if(name>30){
        err.innerText='Name has to be shorter that 30 characters';
    }
    else if(pass[0].value===pass[1].value) {
        const formData = new FormData(); // Create a new FormData object
        formData.append('img', imgInput.files[0]);
        formData.append('name',name);
        formData.append('email',document.getElementsByName('email')[0].value)
        formData.append('pass',document.getElementsByName('pass')[0].value)// Append the file to the form data
        fetch('../actions/update_user.php', {
            method: 'POST',
            body: formData
        })
            .then(async function (response) {
                if (response.ok) {
                    let res= await response.json();
                    if(res[0]===''){
                        window.location.href = window.location.origin+'/pages/profile.php';
                    }
                    else   throw res[0] ;
                    // Handle the response from PHP if needed
                } else {
                    throw "Error while uploading the images!";
                }
            })
            .catch(function(error) {
                err.innerText=error;
            });
    }
    else {

        err.innerText="Passwords do not match";
    }
}
