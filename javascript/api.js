export async function getSession() {
    let response = await fetch('../api/api_session.php');
    return await response.json();
}
export async function getStatus(){
    let response = await fetch('../api/api_status.php');
    return  await response.json();
}


export async function getDepartments(){
    let response = await fetch('../api/api_departments.php');
    return  await response.json();
}




export function isHtml(testString){
    console.log("aqui");
    const htmlRegex = /<([a-z][a-z0-9]*)\b[^>]*>/i;
    return htmlRegex.test(testString);
}