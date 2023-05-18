import {drawTickets,ticketSection} from "./ticket.js";
const page=document.querySelector('.tickets');
const form= document.querySelector('.newTicket');
const formButtons= document.querySelectorAll('.newTicket button');
const newTicket= document.querySelector(".menu  header button");
newTicket.addEventListener('click',()=>{
    page.style.display='none';
    form.style.display='flex';
});
formButtons[0].addEventListener('click',(e)=>{
    e.preventDefault();
    form.style.display='none';
    page.style.display='flex';
});
formButtons[1].addEventListener('click',async (e) => {
    e.preventDefault();
    await validateInputs();
});


page.appendChild(ticketSection);
await drawTickets('../api/api_user_tickets.php?up=202108793');

async function validateInputs() {
    let title = document.querySelector('.newTicket form input[type=text]');
    console.log(title.value);
    let text = document.querySelector('form textarea');
    let error = document.querySelector('form .errorMessage');
    if (title.value === '') error.innerHTML = 'Title can not be empty';
    else if (text.value === '') error.innerHTML = 'Description can not be empty';
    else {
        const response = await fetch('../actions/newTicket.php?title='+title.value+'&text='+text.value);
        if (response.ok) {
            let res = await response.json();

            console.log(res);
            if (res[0] === '') {
                form.style.display = 'none';
                page.style.display = 'flex';
            } else {
                error.innerHTML = res[0];
            }
        }
        else {
            error.innerHTML="ERR";
        }
    }

}