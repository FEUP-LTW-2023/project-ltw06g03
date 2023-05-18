const searchUser = document.querySelector("#searchuser")

if (searchUser) {
    searchUser.addEventListener('input', async function() {
        const response = await fetch('../api/api_users.php?name=' + this.value)
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
            let tr = document.createElement('tr')
            tr.innerHTML = ''

            let td = document.createElement('td')
            td.innerHTML += '<h2>' + user.name + '</h2>'
            td.innerHTML += '<h3>' + user.role + '</h3>' 
            tr.appendChild(td)
        
            tr.innerHTML += '<td>' + '<h3>' + user.up + '</h3>' + '</td>'
            tr.innerHTML += '<td>' + '<h3>' + user.email + '</h3>' + '</td>'

            td.innerHTML = ''
            for(const department of user.departments) {
                td.innerHTML += '<h4' + department.name + '</h4>'
            }

            tr.appendChild(td)
            
            td.innerHTML = ''
            td.innerHTML += '<i class="fas fa-search"></i> &nbsp;'
            td.innerHTML += '<i class="fas fa-edit"></i> &nbsp;'
            td.innerHTML += '<i class="fas fa-trash-alt"></i>'

            
            tr.appendChild(td)
            
            section.appendChild(tr)

        }


    })
  }