import {roleDropdown} from './editRole.js';
import {departmentDropdown} from './editDepartment.js';2

const searchUser = document.querySelector("#searchuser")

if (searchUser) {
    searchUser.addEventListener('input', async function() {
        const response = await fetch('../api/api_users.php?up=' + this.value)
        const users = await response.json()

        if (users.length === 0) {
            const section = document.querySelector('#table-box')
            section.innerHTML = ''
            let tr = document.createElement('tr')
            tr.innerHTML = '<td colspan="3" class="noFound"><h2>No users found</h2></td>'
            section.appendChild(tr)
            return
        }

        const section = document.querySelector('#table-box')


        section.innerHTML = ''
    
        for (const user of users) {
            const tr = document.createElement('tr')
            tr.id = 'user-'+user.up
            tr.innerHTML = ''

            let td = document.createElement('td')
            td.innerHTML += '<h2>' + user.name + '</h2>'
            td.innerHTML += '<h3 class="user-role">' + user.role + '</h3>' 
            tr.appendChild(td)
        
            tr.innerHTML += '<td>' + '<h3>' + user.up + '</h3>' + '</td>'
            tr.innerHTML += '<td>' + '<h3>' + user.email + '</h3>' + '</td>'

            const td2 = document.createElement('td')
            const departmentsSection = document.createElement('section')
            departmentsSection.className = 'departments'
            departmentsSection.innerHTML = ''
            
            if(user.departments.length == 0) {
                departmentsSection.innerHTML = '<h4 class="no-department"> User is not assigned to any department </h4>'

            }
            else {
                const div = document.createElement('div')
                div.className = 'department-list'
                for(const department of user.departments) {
                    div.innerHTML += '<h4 class="department">' + department + '</h4>'
                }
                departments.appendChild(div)
            }
            td2.appendChild(departmentsSection)

            tr.appendChild(td2)

            td.innerHTML = ''
            td.className = 'users-buttons-' + user.up
            td.innerHTML += '<button><a href="../pages/profile.php?up='+ user.up +'"><i class="fas fa-search"></i></a></button>'
        
            if(user.role != "Student") {
                const departmentButton = document.createElement('button');
                departmentButton.id = 'edit-departments-' + user.up;
                departmentButton.className = 'edit-departments';
                departmentButton.innerHTML = '<i class="fas fa-building"></i>';
                const departmentsResponse = await fetch('../api/api_departments.php');
                const departments = await departmentsResponse.json();
                departmentButton.addEventListener('click', function (event) {
                    departmentDropdown(user.up, departments);
                });

                td.appendChild(departmentButton);
            
            }
            
              const sessionResponse = (await fetch('../api/api_session.php')); 
              const session = await sessionResponse.json();
              if (session.role === 'Admin') {
                const roleButton = document.createElement('button');
                roleButton.id = 'edit-role-' + user.up;
                roleButton.className = 'edit-role';
                roleButton.innerHTML = '<i class="fas fa-user-tag"></i>';
                roleButton.addEventListener('click', function (event) {
                    roleDropdown(user.up);
                  });
                td.appendChild(roleButton);
            }

            tr.appendChild(td)
            
            section.appendChild(tr)

        }


    })
  }