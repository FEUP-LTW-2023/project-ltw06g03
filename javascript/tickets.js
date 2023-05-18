import {drawTickets,ticketSection} from "./ticket.js";



const page=document.querySelector('.tickets');
page.appendChild(ticketSection);
await drawTickets('../api/api_user_tickets.php?up=202108793');