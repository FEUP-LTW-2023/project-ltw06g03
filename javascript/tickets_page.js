import {drawTickets,ticketSection} from "./ticket.js";
const page=document.querySelector('.tickets');
const form= document.querySelector('.newTicket');
const formButtons= document.querySelectorAll('.newTicket button');
const newTicket= document.querySelector(".menu  header button");
const search= document.querySelector(' .menu .searchbar input');
const url = new URL(window.location.href);
const op=Number(url.searchParams.get('op'));


const li= document.querySelectorAll('.menu ul li');
let api='';
li[op].className='selected';

if(op>=0 && op<3){
    api='../api/api_tickets.php?';
}
else if(op>=3 && op<6) {
    let response=await fetch('../api/api_session.php');
    let user =await response.json();
    api='../api/api_user_tickets.php?up='+user['up']+'&';
}
else if(op>=6 && op<8){
    let response=await fetch('../api/api_session.php');
    let user =await response.json();
    api='../api/api_assign_tickets.php?up='+user['up']+'&';
}

if(op===1 || op===4 || op===6 ) api+='status=OPEN&';
else if(op===2 || op===5 || op===7) api+='status=CLOSED&';


search.addEventListener('input', async () => {
    await drawTickets(api+'search=' + search.value);
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
await drawTickets(api+'search=');

async function validateInputs() {
    let department= document.querySelector('.newTicket select');
    let title = document.querySelector('.newTicket form input[type=text]');
    let text = document.querySelector('form textarea');
    let error = document.querySelector('form .errorMessage');
    if (title.value === '') error.innerHTML = 'Title can not be empty';
    else if (title.value.length>50) error.innerHTML = 'Title has to be shorter than 50 characters';
    else if (text.value === '') error.innerHTML = 'Description can not be empty';
    else if(department.value==='') error.innerHTML='Chose a department';
    else {
        const response = await fetch('../actions/newTicket.php?title='+title.value+'&text='+text.value+'&department='+department.value);
        if (response.ok) {
            let res = await response.json();
            console.log(res);
            if (res[0] === '') {
               document.querySelector('form').submit();
                form.style.display = 'none';
                page.style.display = 'flex';

            } else {
                error.innerHTML = "Error sending the message";
            }
        }
        else {
            error.innerHTML="ERR";
        }
    }
}

