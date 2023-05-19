function roleDropdown(up) {
    const userRoleElement = document.querySelector(`#table-box tr#user-${up} h3.user-role`);
    
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
          newRoleElement.textContent = role;
          dropdown.replaceWith(newRoleElement);
        }
      };
      xhr.send();
    }
  });
  
  