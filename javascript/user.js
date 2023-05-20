import {drawTickets,ticketSection} from "./ticket.js";
    const url = new URL(window.location.href);

// Get the value of a specific parameter
    const tickets= document.createElement('section');
    tickets.className='tickets';
    const header= document.createElement('header');
    header.className='topBar';

    const up = url.searchParams.get('up');
    const title= document.createElement('h3');
    title.innerText="User tickets";
    header.appendChild(title);
    tickets.appendChild(header);
    const page=document.querySelector('.user-page');
    tickets.appendChild(ticketSection)
    page.appendChild(tickets);
    await drawTickets('../api/api_user_tickets.php?up=' + up);







