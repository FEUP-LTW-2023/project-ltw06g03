import {drawTickets} from "./ticket.js";
const ticketSection= document.querySelector(".ticketSection");
const tickets= document.querySelectorAll(".ticketContainer");
const exp= document.querySelectorAll('.expandedTicket');
const closeButton= document.querySelectorAll('.expandedTicket button');
const response = await fetch('../api/api_user_tickets.php?up=202108793' );
let res = await response.json();
if(res.length>0) {
    const ticketSection= document.createElement('div');

    ticketSection.className="ticketSection";
    const title= document.createElement('h2');
    title.innerText="My tickets";
    ticketSection.appendChild(title);
    const page=document.querySelector('.user-page');
    page.appendChild(ticketSection);
    drawTickets(res,ticketSection);
}


