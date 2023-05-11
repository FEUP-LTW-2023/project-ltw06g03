(function(){
    emailjs.init("8KXY11A9FTg5vf4XQ");
})();

function sendEmail(to,subject, body){
    const servicesId="service_tn9akq9";
    const templateId="template_xwfc2td";
    let params={
        subject:subject,
        to:to,
        body:body,
    }
    emailjs.send(servicesId,templateId,params);
}

