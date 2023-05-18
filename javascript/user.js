import {drawTickets,ticketSection} from "./ticket.js";
    const url = new URL(window.location.href);

// Get the value of a specific parameter
    const up = url.searchParams.get('up');
    const title= document.createElement('h2');
    title.innerText="User tickets";
    ticketSection.appendChild(title);
    const page=document.querySelector('.user-page');

    page.appendChild(ticketSection);
    await drawTickets('../api/api_user_tickets.php?up=' + up);









