const form= document.querySelector('form');
form.addEventListener('submit',(e)=>{
    validateInputs(e);
})
const imgInput= document.querySelector('form input[type=file]');
imgInput.addEventListener('input',async (e) => {
    let img = document.querySelector('form img');
    console.log(imgInput.files[0]);
    let reader = new FileReader();
    img.src = e.target.result;
    reader.onload = async function (e) {
        img.src = e.target.result;

    }
    reader.readAsDataURL(imgInput.files[0]);
    var formData = new FormData(); // Create a new FormData object
    formData.append('img', imgInput.files[0]); // Append the file to the form data

});

function validateInputs(e) {
    e.preventDefault();
    let pass= document.querySelectorAll("form input[name='pass']");
    if(pass[0].value===pass[1].value) form.submit();
    else {
        let err= document.querySelector('form .errorMessage');
        err.innerText="Passwords do not match";
    }


}