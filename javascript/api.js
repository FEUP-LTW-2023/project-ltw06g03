let response = await fetch('../api/api_session.php');
export let user = await response.json();
response = await fetch('../api/api_status.php');
export const allStatus= await response.json();
response = await fetch('../api/api_departments.php');
export const allDepartments= await response.json();