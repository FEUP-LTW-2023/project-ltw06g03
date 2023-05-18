import {drawTickets,ticketSection} from "./ticket.js";
const page=document.querySelector('.tickets');
const form= document.querySelector('.newTicket');
const formButtons= document.querySelectorAll('.newTicket button');
const newTicket= document.querySelector(".menu  header button");
const search= document.querySelector(' .menu .searchbar input');
console.log(search.value);
let user;
let status;
search.addEventListener('input',async () => {
    console.log(search.value)
    await drawTickets('../api/api_tickets.php?up='+search.value);
})
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
await drawTickets('../api/api_tickets.php?up=');

async function validateInputs() {
    let title = document.querySelector('.newTicket form input[type=text]');
    console.log(title.value);
    let text = document.querySelector('form textarea');
    let error = document.querySelector('form .errorMessage');
    if (title.value === '') error.innerHTML = 'Title can not be empty';
    if (title.value.length>50) error.innerHTML = 'Title has to be shorter than 50 characters';
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