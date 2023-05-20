const userDepartments = document.querySelectorAll(".edit-departments")

if (userDepartments) {
    const departmentsapi = await fetch("../api/api_departments.php");
    const departmentsList = await departmentsapi.json();
    for(let i = 0; i < userDepartments.length; i++) {
        userDepartments[i].addEventListener('click', function (event) {
            const up = event.target.id.split('-')[2];
            departmentDropdown(up, departmentsList);
        });
    }
}

export function departmentDropdown(up, departmentsList) {
    let departments = document.querySelector(`#table-box tr#user-${up} .departments`);

    if (!departments) return;

    const dropdown = document.createElement('select');
    dropdown.id = 'dropdown-departments-' + up;
    dropdown.className = 'dropdown-departments';

    const option = document.createElement('option');
    option.value = '';
    option.textContent = 'Select a department';
    dropdown.appendChild(option);

    for (const department of departmentsList) {
        const option = document.createElement('option');
        option.value = department.name;
        option.textContent = department.name;
        dropdown.appendChild(option);
    }

    dropdown.addEventListener('change', async function (event) {
        const department = dropdown.value;
            let response = await fetch(`../actions/update_department.php?UP=${up}&department=${department}`) ;
            if (response.ok) {

                const dropdown = event.target;

                if (dropdown.tagName === 'SELECT' && dropdown.id.startsWith('dropdown-departments-')) {
                    const up = dropdown.id.split('-')[2];

                    const Departments = await fetch(`../api/api_user_departments.php?UP=${up}`);
                    const currentDepartments = await Departments.json();
                    const newdiv = document.createElement('div');
                    newdiv.classList.add('departments');
                    if (currentDepartments.length === 0) {
                        const noDepartmentsElement = document.createElement('h4');
                        noDepartmentsElement.classList.add('no-department');
                        noDepartmentsElement.textContent = 'User is not assigned to any department';
                        newdiv.appendChild(noDepartmentsElement);
                        
                    }
                    else {
                        const departmentsdiv = document.createElement('div');
                        departmentsdiv.classList.add('department-list-'+up+'');
                        for(const department of currentDepartments) {
                            const newDepartmentElement = document.createElement('h4');
                            newDepartmentElement.classList.add('department');
                            newDepartmentElement.textContent = department;
                            departmentsdiv.appendChild(newDepartmentElement);
                        }
                        newdiv.appendChild(departmentsdiv);
                    }
                    dropdown.replaceWith(newdiv);
                    const editButton = document.querySelector('#edit-departments-' + up + '');
                    editButton.addEventListener('click', function () {
                        departmentDropdown(up, departmentsList);
                    });
                }
            }


    });

    departments.replaceWith(dropdown);
}