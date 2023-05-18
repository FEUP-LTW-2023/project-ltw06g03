import {drawTickets,ticketSection} from "./ticket.js";

    const title= document.createElement('h2');
    title.innerText="My tickets";
    ticketSection.appendChild(title);
    const page=document.querySelector('.user-page');
    const response = await fetch('../api/api_session.php');
    const up = await response.json();
    page.appendChild(ticketSection);
    await drawTickets('../api/api_user_tickets.php?up='+up);








