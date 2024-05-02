<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        .modal-dialog {
            max-width: 600px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <h1>Hello admin</h1>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-primary mr-3" data-toggle="modal" data-target="#exampleModal">
                    Create New User
                </button>
                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-warning">Profile Dashboard</a>
            </div>
        </div>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">

            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        axios.get('/api/users')
            .then(response => {
                const users = response.data;
                const usersTableBody = document.getElementById('usersTableBody');

                usersTableBody.innerHTML = '';

                users.forEach(user => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td>${user.username}</td>
                <td>${user.email}</td>
                <td>
                    <button class="btn btn-danger btn-sm delete-btn" data-user-id="${user.id}">Delete</button>
                    ${user.is_active ? `<button class="btn btn-warning btn-sm deactivate-btn" data-user-id="${user.id}">Deactivate</button>` : ''}
                </td>
            `;
                    usersTableBody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Error fetching users:', error);
            });

            document.addEventListener('click', function(e) {
            if (e.target.classList.contains('delete-btn')) {
                const userId = e.target.getAttribute('data-user-id');
                axios.delete(`/api/user/${userId}`)
                    .then(response => {
                        if (response.data.success) {
                            e.target.closest('tr').remove();
                            console.log('User deleted successfully');
                        } else {
                            console.error('Error deleting user:', response.data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error deleting user:', error);
                    });
            } else if (e.target.classList.contains('deactivate-btn')) {
                const userId = e.target.getAttribute('data-user-id');
                axios.put(`/api/user/${userId}/deactivate`)
                    .then(response => {
                        if (response.data.success) {
                            console.log('User deactivated successfully');
                            e.target.remove();
                        } else {
                            console.error('Error deactivating user:', response.data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error deactivating user:', error);
                    });
            }
        });

        //creating user

        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;

            const data = new FormData(form);

            axios.post('/api/user', data)
                .then(response => {
                    console.log(response);
                    if (response.data.success) {
                        alert(response.data.message);
                        window.location.href = '/admin/dashboard';
                    }
                    document.getElementById('username').value = '';
                    document.getElementById('email').value = '';
                    document.getElementById('password').value = '';
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>

</html>