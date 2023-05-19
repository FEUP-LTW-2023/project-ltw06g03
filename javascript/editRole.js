const rolebutton = document.querySelectorAll('.edit-role');
if(rolebutton) {
  for (let i = 0; i < rolebutton.length; i++) {
    rolebutton[i].addEventListener('click', function (event) {
        const up = event.target.id.split('-')[2];
        roleDropdown(up);
    });
  }
}


function roleDropdown(up) {
    let userRoleElement = document.querySelector(`#table-box tr#user-${up} h3.user-role`);
    
    if (!userRoleElement) {
      return;
    }

    const currentRole = userRoleElement.textContent.trim();
    
    const dropdown = document.createElement('select');
    dropdown.id = `dropdown-${up}`;
    
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


    dropdown.addEventListener('change', function () {
    const role = dropdown.value;

    const xhr = new XMLHttpRequest();
        xhr.open('GET', `../actions/update_role.php?UP=${up}&role=${role}`);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
            const newRoleElement = document.createElement('h3');
            newRoleElement.classList.add('user-role');
            newRoleElement.textContent = role;

            newRoleElement.addEventListener('click', roleDropdown.bind(null, up));
            
            dropdown.replaceWith(newRoleElement);
        }
    };
    xhr.send();

  });

    userRoleElement.replaceWith(dropdown);
}
  
  const tableBox = document.querySelector('#table-box');
  tableBox.addEventListener('change', function (event) {
    const dropdown = event.target;
  
    if (dropdown.tagName === 'SELECT' && dropdown.id.startsWith('dropdown-')) {
      const up = dropdown.id.split('-')[1];
      const role = dropdown.value;
  
      const xhr = new XMLHttpRequest();
      xhr.open('GET', `../actions/update_role.php?UP=${up}&role=${role}`);
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          const newRoleElement = document.createElement('h3');
          newRoleElement.classList.add('user-role');
          newRoleElement.textContent = role;
          dropdown.replaceWith(newRoleElement);
          changeButtons(up, role);
        }
      };
      xhr.send();
    }
  
  });
  
async function changeButtons(up, role)  {

  const buttons = document.querySelector('.users-buttons-' + up + '')

  buttons.innerHTML = ''
  buttons.innerHTML += '<button><a href="../pages/profile.php?up='+ up +'"><i class="fas fa-search"></i> </a></button>'


  if(role != "Student") {
    const departmentButton = document.createElement('button');
    departmentButton.id = 'edit-departments-' + up;
    departmentButton.className = 'edit-departments';
    departmentButton.innerHTML = '<i class="fas fa-building"></i>';
    departmentButton.addEventListener('click', function (event) {
      departmentDropdown(up);
    });
    buttons.appendChild(departmentButton);

}

  const sessionResponse = (await fetch('../api/api_sessionRole.php')); 
  const session = await sessionResponse.json();
  if (session[0] == 'Admin') {
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
