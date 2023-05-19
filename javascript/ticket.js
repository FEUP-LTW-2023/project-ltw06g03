let expanded=null;
let expandedTicket=null;
const body= document.querySelector("main");
export let ticketSection=document.createElement('div');
ticketSection.className="ticketSection";
const response = await fetch('../api/api_session.php');
let user = await response.json();
let href_;
let loading=false;
let count=0;
export async function drawTickets(href) {
    href_ = href;
    if(loading)return;
    loading=true;
    const response = await fetch(href);
    let tickets = await response.json();
    count++;
    console.log(href_);
    ticketSection.innerHTML = '';
    ticketSection.className = 'ticketSection';
    if (tickets.length === 0) {
        const notFound = document.createElement('div');
        notFound.className = "notFound";
        const p = document.createElement('p');
        p.innerText = "No tickets found";
        notFound.appendChild(p);
        ticketSection.appendChild(notFound);
    }

    for (let index = 0; index < tickets.length; index++) {
        let ticketContainer = drawTicket(tickets[index]);
        ticketSection.appendChild(ticketContainer);
        ticketContainer.addEventListener('click', () => {
            expand(tickets[index])
        });
        if (expandedTicket !== null && tickets[index]['id'] === expandedTicket['id']) await expand(tickets[index]);
    }
    loading = false;
    if(href!==href_) await drawTickets(href_);
    console.log(count);

}
function drawTicket(ticket){

    let ticketContainer= document.createElement("div");
    ticketContainer.className="ticketContainer";
    ticketContainer.appendChild(userInfo(ticket['client']));
    console.log();
    let subject= document.createElement("div");
    subject.className="subject";
    let p=document.createElement('p');
    p.innerText=ticket['title'];
    subject.appendChild(p);
    let dep= document.createElement("div");
    dep.className="department";
    p=document.createElement('p');
    p.innerText=ticket['department'];
    dep.appendChild(p);
    let status= document.createElement("div");
    status.className="status";
    p=document.createElement('p');
    p.innerText=ticket['status'];
    status.appendChild(p);
    ticketContainer.appendChild(subject);
    ticketContainer.appendChild(dep);
    ticketContainer.appendChild(status);

    return ticketContainer;
}

function userInfo(user){
    const userInf=document.createElement("div");
    userInf.className="user-info";
    const profileImg=document.createElement("img");
    profileImg.src=user['img'];
    const name= document.createElement("h4");
    name.innerText=user['name'];
    const up= document.createElement("p");
    up.innerText=user['up'];
    userInf.appendChild(profileImg);
    userInf.appendChild(name);
    userInf.appendChild(up);

    return userInf;
}

async function expand(ticket) {
    body.style.overflow = 'hidden';
    if (expanded !== null) closeSection();
    const expand = document.createElement('div');
    expand.className = "expandedTicket";
    expand.appendChild(drawExpandedHeader(ticket));
    expand.appendChild(await drawExpandedExtraInf(ticket));
    expand.appendChild(drawExpandedAbout(ticket));
    expand.appendChild(drawMessages(ticket['messages'], ticket));
    expandedTicket = ticket;
    expanded = expand;
    body.appendChild(expand);
    const mess = document.querySelector(".messages");
    mess.scrollTop = mess.scrollHeight;

}
function drawExpandedHeader(ticket){
    const header= document.createElement('header');
    const h2= document.createElement('h2');
    const button=document.createElement('button');
    //const status= document.createElement('div');
    //const p=document.createElement('p');
   // status.className='status';
    h2.innerText=ticket['title'];
    button.innerText='X';
    //p.innerText=ticket['status'];
    button.addEventListener('click',closeSection);
    //status.appendChild(p);
    header.appendChild(h2);
    header.appendChild(button);
    //header.appendChild(status);
    return header;
}
async function drawExpandedExtraInf(ticket) {
    const extraInf = document.createElement('div');
    extraInf.className = "extra-inf";
    const department = document.createElement('div');
    department.className = "department";

    let h5 = document.createElement('h5');
    h5.innerText = "Departments";
    department.appendChild(h5);
    let p = document.createElement('p');
    p.innerHTML = ticket['department'];
    h5.innerText = "Departments";
    department.appendChild(h5);
    department.appendChild(p);

    h5 = document.createElement('h5');
    h5.innerText = "Status";
    const status = document.createElement('div');
    status.appendChild(h5);
    p = document.createElement('p');
    status.className = 'status';
    p.innerText = ticket['status'];
    status.appendChild(p);
    extraInf.appendChild(status);
    extraInf.appendChild(status);
    extraInf.appendChild(department);
    extraInf.appendChild(await assigns(ticket));
    return extraInf;
}
function drawExpandedAbout(ticket){
    const about=document.createElement('div');
    about.className="about";
    const userInfo_=userInfo(ticket['client']);
    const problem=document.createElement('p');
    problem.className="text";
    problem.innerText=ticket['problem'];
    about.appendChild(userInfo_);
    about.appendChild(problem);
    return about;
}
function drawMessages(messages){
    const messagesSection=document.createElement('div');
    messagesSection.className='messages';
    for(let index=0; index<messages.length;index++) messagesSection.appendChild(drawMessage(messages[index]));
    messagesSection.appendChild(form());
    return messagesSection;
}

function drawMessage(message){
    const messageContainer= document.createElement('div');
    messageContainer.className='message';
    const userInf_=userInfo(message['client']);
    const p=document.createElement('p');
    p.className="text";
    p.innerHTML=message['text'];
    messageContainer.appendChild(userInf_);
    messageContainer.appendChild(p);
    return messageContainer;
}
function form(){
    const form=document.createElement('form');

    const text=document.createElement('textarea');
    const submit= document.createElement('button');
    submit.innerText="Send";
    submit.addEventListener('click',async (e) => {
        e.preventDefault();
        await sendMessage(text.value);
        await drawTickets(href_);

    });
    text.name="text";
    form.appendChild(text);
    form.appendChild(submit);
    return form;
    
}
async function assigns(ticket) {
    let role = user['role'];
    const assigns = document.createElement('div');
    assigns.className = "assigns";
    let h5 = document.createElement('h5');
    h5.innerText = "Assigns";
    assigns.appendChild(h5);
    let response = await fetch('../api/api_users_assign.php?id=' + ticket['id']);
    let assignUsers = await response.json();

    let mess;
    if(assignUsers.length===0) {
         mess= document.createElement('a');
        mess.innerText = "No one assign";
    }else {
         mess=document.createElement('div');
        mess.className="assignImg";
        let count=assignUsers.length;
        if(assignUsers.length>3) count=3;
        for(let index=0;index<count;index++){
            let img= document.createElement("img");
            img.src=assignUsers[index]['img'];
            mess.appendChild(img);
        }
    }

    if(role==='Admin' || role ==='Staff') {
        response = await fetch('../api/api_users_not_assign.php?id=' + ticket['id']);
        let usersNotAssign = await response.json();
        const assignTable = await drawAssignTable(ticket, assignUsers, usersNotAssign);
        assigns.appendChild(assignTable);
    }


    assigns.appendChild(mess);

    return assigns;
}
async function drawAssignTable(ticket,assignUsers,usersNotAssign) {
    const assignTable = document.createElement('div');
    assignTable.className = "assignTable";
    let ul = document.createElement('ul');
    ul.className = 'assigned';
    for (let index = 0; index < assignUsers.length; index++){
        let li = drawAssignTableElement(assignUsers [index],ticket, true);
        ul.appendChild(li);
    }
    assignTable.appendChild(ul);
    ul = document.createElement('ul');
    ul.className = 'notAssigned';
    for (let index = 0; index < usersNotAssign.length; index++) {
        let li = drawAssignTableElement(usersNotAssign[index],ticket, false);
        ul.appendChild(li);
    }
    assignTable.appendChild(ul);
    return assignTable;
}
function drawAssignTableElement(user_,ticket_,checked){
    const li= document.createElement('li');
    const label= document.createElement('label');
    const checkBox= document.createElement('input');
    checkBox.type='checkBox';
    checkBox.id=user_['up'];
    checkBox.checked=checked;
    label.htmlFor=user_['up'];
    checkBox.addEventListener('change', async function () {
        const user = user_;
        const ticket = ticket_;
        if (this.checked) {
            let response = await fetch('../actions/assign.php?up='+user['up']+'&id='+ticket['id']);
            let res=await response.json();
            if(res[0]==='') console.log("Assigned");
        } else {
            let response = await fetch('../actions/discharge.php?up='+user['up']+'&id='+ticket['id']);
            let res=await response.json();
            if(res[0]==='') console.log("Discharge");
        }
    });
    let user=userInfo(user_);
    li.appendChild(checkBox);
    label.appendChild(user);
    li.appendChild(label);
    return li;
}
function closeSection(){
    body.removeChild(expanded);
    expanded=null;
    expandedTicket=null;
    body.style.overflow='scroll';
}
async function sendMessage(text) {
    text= text.replace(/\r?\n/g, '<br />');
    const response = await fetch('../actions/sendMessage.php?text='+text+'&id='+expandedTicket['id']);
    let res = await response.json();
    if(res!==''){

    }
}