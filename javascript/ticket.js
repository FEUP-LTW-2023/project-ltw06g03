const tickets= document.querySelectorAll(".ticketContainer");
const exp= document.querySelectorAll('.expandedTicket');
const closeButton= document.querySelectorAll('.expandedTicket button');

for (let i = 0; i < tickets.length; i++) {
    tickets[i].addEventListener('click',async function () {
            // Get the index of the clicked ticket
            const ticketIndex = i;

            exp[ticketIndex].style.display='grid';
        }
    );
    
}
for (let i = 0; i < closeButton.length; i++) {
    closeButton[i].addEventListener('click',async function () {
            const buttonIdx = i;
            exp[buttonIdx].style.display='none';
        }
    );
}


