let expanded=null;
let expandedTicket=null;
const body= document.querySelector("main");
export let ticketSection=document.createElement('div');
ticketSection.className="ticketSection";
let response = await fetch('../api/api_session.php');
let user = await response.json();
let href_;
let loading=false;
let count=0;
let role=user['role'];
response = await fetch('../api/api_status.php');
const allStatus= await response.json();
response = await fetch('../api/api_departments.php');
const allDepartments= await response.json();
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
        ticketSection.appendChild( ticketContainer);
        ticketContainer.addEventListener('click', () => {
            expand(tickets[index])
        });
        if (expandedTicket !== null && tickets[index]['id'] === expandedTicket['id']) await expand(tickets[index]);
    }
    loading = false;
    if(href!==href_) await drawTickets(href_);
}
function drawTicket(ticket) {

    let ticketContainer = document.createElement("div");
    ticketContainer.className = "ticketContainer";
    ticketContainer.appendChild(userInfo(ticket['client']));

    let subject= document.createElement("div");
    subject.className="subject";
    let p=document.createElement('p');
    p.innerText=ticket['title'];

    subject.appendChild(p);

    let imgs = assignImgs(ticket['assigns']);

    let dep = document.createElement("div");
    dep.className = "department";
    p = document.createElement('p');
    p.innerText = ticket['department'];
    dep.appendChild(p);
    let status;

    status = document.createElement("div");
    status.className = "status";
     p = document.createElement('p');
    p.innerText = ticket['status'];
    status.appendChild(p);
    ticketContainer.appendChild(subject);
    ticketContainer.appendChild(imgs);
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
    expand.appendChild(await drawMessages(ticket));
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
    h2.innerText=ticket['title'];
    button.innerText='X';
    button.addEventListener('click',closeSection);
    header.appendChild(h2);
    header.appendChild(button);
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
    h5 = document.createElement('h5');
    h5.innerText = "Status";
    const status = document.createElement('div');
    status.className='status'
    status.appendChild(h5);
    if (role !== 'Admin' && role !== 'Staff') {
        let p = document.createElement('p');
        p.innerHTML = ticket['department'];
        department.appendChild(p);
        p = document.createElement('p');
        p.innerText = ticket['status'];
        status.appendChild(p);
    } else {
        let select = document.createElement('select');

        let op= document.createElement('option');
        op.innerText= ticket['status'];
        select.appendChild(op);
        for( let index=0; index<allStatus.length;index++){
            if(allStatus[index]!==ticket['status']) {
                let op = document.createElement('option');
                op.innerText = allStatus[index];
                select.appendChild(op);
            }
        }
        status.appendChild(select);
        select.addEventListener('change',async () => {
            let response = await fetch('../actions/update_ticket.php?status=' + select.value + '&department=' + ticket['department']+'&id='+ticket['id']);
            let res= await response.json();
            response = await fetch('../actions/add_event.php?id='+ticket['id']+'&description=Changes Status to '+select.value);
            let event_res=await response.json();
            if(res[0]==='' && event_res[0]==='') await drawTickets(href_);
        });

        let select2 = document.createElement('select');

        let op2= document.createElement('option');
        op2.innerText= ticket['department'];
        select2.appendChild(op2);
        for( let index=0; index<allDepartments.length;index++){
            if(allDepartments[index]!==ticket['department']) {
                let op = document.createElement('option');
                op.innerText = allDepartments[index];
                select2.appendChild(op);
            }
        }
        department.appendChild(select2);
        select2.addEventListener('change',async () => {
            let response = await fetch('../actions/update_ticket.php?status=' + ticket['status'] + '&department=' +select2.value+'&id='+ticket['id']);
            let res= await response.json();
            response = await fetch('../actions/add_event.php?id='+ticket['id']+'&description=Changed department to '+select2.value);
            let event_res=await response.json();
            if(res[0]==='' && event_res[0]==='') await drawTickets(href_);
        });


    }
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
async function drawMessages(ticket) {
    let messages = ticket['messages'];
    const messagesSection = document.createElement('div');
    messagesSection.className = 'messages';
    let message_index = 0, event_index = 0;
    let response = await fetch('../api/api_events.php?id=' + ticket['id']);
    if(response.ok) {
        let events= await response.json();
        console.log(events);
        console.log(messages);
        while (message_index+event_index<messages.length+events.length){
            if(events.length===event_index) messagesSection.appendChild(drawMessage(messages[message_index++]));
            else if(messages.length===message_index) messagesSection.appendChild(drawEvent(events[event_index++]));
            else if( messages[message_index]['date']>events[event_index]['date'] ){
                messagesSection.appendChild(drawEvent(events[event_index++]));
            }
            else{
                messagesSection.appendChild(drawMessage(messages[message_index++]));
            }
        }
    }
        if (role === 'Admin' || role === 'Staff' || ticket['client']['up'] === user['up'])
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
function drawEvent(event){
    const eventContainer= document.createElement('div');
    eventContainer.className='event';
    const userInf_=userInfo(event['user']);
    const p=document.createElement('p');
    p.className="text";
    p.innerHTML=event['description'];
    eventContainer.appendChild(userInf_);
    eventContainer.appendChild(p);
    return eventContainer;
}
function form(){
    const form=document.createElement('form');

    const text=document.createElement('textarea');
    const submit= document.createElement('button');
    submit.innerText="Send";
    submit.addEventListener('click',async  (e) => {
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

    const assigns = document.createElement('div');
    assigns.className = "assigns";
    let h5 = document.createElement('h5');
    h5.innerText = "Assigns";
    assigns.appendChild(h5);

    let mess;
    if(ticket['assigns'].length===0) {
         mess= document.createElement('a');
        mess.innerText = "No one assign";
    }else {
        mess=assignImgs(ticket['assigns']);
        }

    if(role==='Admin' || role ==='Staff') {

        const assignTable = await drawAssignTable(ticket);
        assigns.appendChild(assignTable);
        mess.addEventListener('click',()=>{
            assignTable.style.display='block';
        });

    }
    assigns.appendChild(mess);

    return assigns;
}
async function drawAssignTable(ticket) {
    let response = await fetch('../api/api_users_assign.php?id=' + ticket['id']);
    let assignUsers = await response.json();
     response = await fetch('../api/api_users_not_assign.php?id=' + ticket['id']);

    let usersNotAssign = await response.json();

    const assignTable = document.createElement('div');
    assignTable.className = "assignTable";
    const header= document.createElement('header');
    const cancel= document.createElement('button');
    cancel.innerText='X';
    cancel.addEventListener('click',()=>{
        assignTable.style.display='none';
    })
    const form= document.createElement('form');
    form.className="searchbar";
    const i= document.createElement('i');
    i.className="fas fa-search";
    const input=document.createElement('input');
    input.type='text';
    form.appendChild(i);
    form.appendChild(input);
    input.addEventListener('input',async () => {
        let response = await fetch('../api/api_users_assign.php?id=' + ticket['id']+'&search='+input.value);
        let assignUsers = await response.json();
        response = await fetch('../api/api_users_not_assign.php?id=' + ticket['id']+'&search='+input.value);

        let usersNotAssign = await response.json();
        drawElements(users, assignUsers, usersNotAssign, ticket);
    });
    header.appendChild(form);
    header.appendChild(cancel);
    assignTable.appendChild(header);
    const users= document.createElement('div');
    users.className='users';
    assignTable.appendChild(users);
    drawElements(users,assignUsers,usersNotAssign,ticket);
    return assignTable;
}
function drawElements(section,assignUsers,usersNotAssign,ticket){
    section.innerHTML='';

    let ul = document.createElement('ul');
    ul.className = 'assigned';
    for (let index = 0; index < assignUsers.length; index++){
        let li = drawAssignTableElement(assignUsers [index],ticket, true);
        ul.appendChild(li);
    }
    section.appendChild(ul);
    ul = document.createElement('ul');
    ul.className = 'notAssigned';
    for (let index = 0; index < usersNotAssign.length; index++) {
        let li = drawAssignTableElement(usersNotAssign[index],ticket, false);
        ul.appendChild(li);
    }
    section.appendChild(ul);
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
            response = await fetch('../actions/add_event.php?id='+ticket['id']+'&description=Assigned '+user['name']);
            let event_res=await response.json();
            if(res[0]==='' && event_res[0]==='') await drawTickets(href_);

        } else {
            let response = await fetch('../actions/discharge.php?up='+user['up']+'&id='+ticket['id']);
            let res=await response.json();
            response = await fetch('../actions/add_event.php?id='+ticket['id']+'&description=Discharged '+user['name']);
            let event_res=await response.json();
            if(res[0]==='' && event_res[0]==='') await drawTickets(href_);
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
function assignImgs(assignUsers){
    let imgs=document.createElement('div');
    imgs.className="assignImg";
    let count=assignUsers.length;
    if(assignUsers.length>3) count=3;
    for(let index=0;index<count;index++){
        let img= document.createElement("img");
        img.src=assignUsers[index]['img'];
        imgs.appendChild(img);
    }
    return imgs;

}
async function sendMessage(text) {
    text= text.replace(/\r?\n/g, '<br />');
    const response = await fetch('../actions/sendMessage.php?text='+text+'&id='+expandedTicket['id']);
    let res = await response.json();
    if(res!==''){

    }
}