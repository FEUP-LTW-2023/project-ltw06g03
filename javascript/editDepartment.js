const userDepartments = document.querySelector(".edit-departments")

if (userDepartments) {
    userDepartments.addEventListener('click', function (event) {
        const up = event.target.id.split('-')[2];
        departmentDropdown(up);
    });
}

function departmentDropdown(up)


