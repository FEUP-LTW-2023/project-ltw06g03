let expanded=null;
const body= document.querySelector("main");
export function  drawTickets(tickets,section){
    for(let index=0; index<tickets.length;index++){
        let ticketContainer=drawTicket(tickets[index]);
        console.log(ticketContainer);
        section.appendChild(ticketContainer);
        ticketContainer.addEventListener('click',()=>{expand(tickets[index])});
    }
}
function drawTicket(ticket){
    const ticketContainer= document.createElement("div");
    ticketContainer.className="ticketContainer";
    ticketContainer.appendChild(userInfo(ticket['client']));
    const subject= document.createElement("div");
    subject.className="subject";
    let p=document.createElement('p');
    p.innerText=ticket['title'];
    subject.appendChild(p);
    const dep= document.createElement("div");
    dep.className="department";
    p=document.createElement('p');
    p.innerText='cica';
    dep.appendChild(p);
    const status= document.createElement("div");
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
    const name= document.createElement("h3");
    name.innerText=user['name'];
    const up= document.createElement("p");
    up.innerText=user['up'];
    userInf.appendChild(profileImg);
    userInf.appendChild(name);
    userInf.appendChild(up);
    return userInf;
}

function expand(ticket_){
    if(expanded!==null) closeSection();
    const ticket= ticket_;
    const expand=document.createElement('div');
    expand.className="expandedTicket";
    expand.appendChild(drawExpandedHeader(ticket));
    expand.appendChild(drawExpandedExtraInf(ticket));
    expand.appendChild(drawExpandedAbout(ticket));
    expand.appendChild(drawMessages(ticket['messages']));

    expanded=expand;
    body.appendChild(expand);
    const mess= document.querySelector(".messages");
    mess.scrollTop=mess.scrollHeight;

}
function drawExpandedHeader(ticket){
    const header= document.createElement('header');
    const h2= document.createElement('h2');
    const button=document.createElement('button');
    const status= document.createElement('div');
    const p=document.createElement('p');
    status.className='status';
    h2.innerText=ticket['title'];
    button.innerText='X';
    p.innerText=ticket['status'];
    button.addEventListener('click',closeSection);
    status.appendChild(p);
    header.appendChild(h2);
    header.appendChild(button);
    header.appendChild(status);
    return header;
}
function drawExpandedExtraInf(ticket){
    const extraInf= document.createElement('div');
    extraInf.className="extra-inf";
    const department=document.createElement('div');
    department.className="department";
    const assigns= document.createElement('div');
    assigns.className="assigns";
    let h5=document.createElement('h5');
    h5.innerText="Departments";
    department.appendChild(h5);
    h5=document.createElement('h5');
    h5.innerText="Assigns";
    assigns.appendChild(h5);
    extraInf.appendChild(department);
    extraInf.appendChild(assigns);
    return extraInf;
}
function drawExpandedAbout(ticket){
    const about=document.createElement('div');
    about.className="about";
    const userInfo_=userInfo(ticket['client']);
    const problem=document.createElement('p');
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
    p.innerText=message['text'];
    messageContainer.appendChild(userInf_);
    messageContainer.appendChild(p);
    return messageContainer;
}
function form(){
    const form=document.createElement('form');

    const text=document.createElement('textarea');
    const submit= document.createElement('button');
    submit.type="submit";
    submit.addEventListener('submit',(e)=>sendMessage(e));
    text.name="text";
    form.appendChild(text);
    form.appendChild(submit);
    return form;
    
}
function closeSection(){
    body.removeChild(expanded);
    expanded=null;
}
function sendMessage(e){
    e.preventDefault();
    
}



