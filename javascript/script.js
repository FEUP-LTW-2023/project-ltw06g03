const footerForm=document.querySelector("footer .row .col form ");

footerForm.addEventListener("submit", (e)=>{
    let email=document.querySelector("footer .row .col form textarea");
    sendEmail("franciscocardoso.3003@gmail.com","Feed back",email.value);
    window.alert("Email sent with success!");
})