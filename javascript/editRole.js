import { departmentDropdown } from './editDepartment.js';

const rolebutton = document.querySelectorAll('.edit-role');
if(rolebutton) {
  for (let i = 0; i < rolebutton.length; i++) {
    rolebutton[i].addEventListener('click', function (event) {
      const up = event.target.closest('button').id.split('-')[2];
      roleDropdown(up);
    });
  }
}


export async function roleDropdown(up) {
    let userRoleElement = document.querySelector(`#table-box tr#user-${up} h3.user-role`);
    
    if (!userRoleElement) {
      return;
    }

    const currentRole = userRoleElement.textContent.trim();
    
    const dropdown = document.createElement('select');
    dropdown.id = `dropdown-role-${up}`;
    
    const options = ['Student', 'Staff', 'Admin'];
    options.forEach((option) => {
      const optionElement = document.createElement('option');
      optionElement.value = option;
      optionElement.textContent = option;
      
      if (option === currentRole) {
        optionElement.selected = true;
      }
      
      dropdown.appendChild(optionElement);
    });

    const sessionResponse = (await fetch('../api/api_session.php')); 
    const session = await sessionResponse.json();
    userRoleElement.replaceWith(dropdown);


    dropdown.addEventListener('change', async function (event) {
    const role = dropdown.value;

    let response = await fetch(`../actions/update_role.php?UP=${up}&role=${role}`) ;
    if (response.ok) {
      if (dropdown.tagName === 'SELECT' && dropdown.id.startsWith('dropdown-role-')) {
        const up = dropdown.id.split('-')[2];
        const role = dropdown.value;
    
        const newRoleElement = document.createElement('h3');
        newRoleElement.classList.add('user-role');
        newRoleElement.textContent = role;
        dropdown.replaceWith(newRoleElement);

        if (parseInt(up,10) === parseInt(session.up,10)) {
          window.location.reload();
        }
        else {
          await changeButtons(up, role, session.role);
        }
      }
    }
  });

}


  
async function changeButtons(up, role, sessionRole)  {

  const buttons = document.querySelector('.users-buttons-' + up + '')

  buttons.innerHTML = ''
  buttons.innerHTML += '<button><a href="../pages/profile.php?up='+ up +'"><i class="fas fa-search"></i> </a></button>'

  if(role !== "Student") {
    const departmentButton = document.createElement('button');
    departmentButton.id = 'edit-departments-' + up;
    departmentButton.className = 'edit-departments';
    departmentButton.innerHTML = '<i class="fas fa-building"></i>';
    const departmentsResponse = await fetch('../api/api_departments.php');
    const departments = await departmentsResponse.json();
    departmentButton.addEventListener('click', function (event) {
      departmentDropdown(up, departments);
    });
    buttons.appendChild(departmentButton);

}

  if (sessionRole === 'Admin') {
    const roleButton = document.createElement('button');
    roleButton.id = 'edit-role-' + up;
    roleButton.className = 'edit-role';
    roleButton.innerHTML = '<i class="fas fa-user-tag"></i>';
    roleButton.addEventListener('click', function (event) {
      roleDropdown(up);
    });
    buttons.appendChild(roleButton);

}

} 
