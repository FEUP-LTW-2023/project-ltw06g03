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
            tr.innerHTML = ''

            const td = document.createElement('td')
            td.innerHTML += '<h2>' + user.name + '</h2>'
            td.innerHTML += '<h3>' + user.role + '</h3>' 
            tr.appendChild(td)
        
            tr.innerHTML += '<td>' + '<h3>' + user.up + '</h3>' + '</td>'
            tr.innerHTML += '<td>' + '<h3>' + user.email + '</h3>' + '</td>'

            const td2 = document.createElement('td')
            td2.className = 'departments'
            td2.innerHTML = ''
            
            if(user.departments.length == 0) {
                td2.innerHTML = '<h4> User is not assigned to any department </h4>'
            }
            else {
                for(const department of user.departments) {
                    td2.innerHTML += '<h4 class="department">' + department + '</h4>'
                }
            }
            tr.appendChild(td2)

            td.innerHTML = ''
            td.innerHTML += '<button><a href="../pages/profile.php?up=<?=$user->up?>"><i class="fas fa-search"></i> </a></button>'
            td.innerHTML += '<button id="edit-departments"><i class="fas fa-building"></i></button>'

            const sessionResponse = (await fetch('../api/api_sessionRole.php')); 
            const session = await sessionResponse.json();
            console.log(session);
            if (session[0] == 'Admin') {
                td.innerHTML += '<button id="edit-role"><i class="fas fa-user-tag"></i></button>';
            }
        

            tr.appendChild(td)
            
            section.appendChild(tr)

        }


    })
  }