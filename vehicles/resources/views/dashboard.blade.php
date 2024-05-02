<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2>Vehicle List</h2>
                <table class="table table-striped table-bordered" id="vehicles-table">
                    <thead class="table-dark">
                        <tr>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Plate Number</th>
                            <th>Insurance Date</th>
                            <th>Actions</th> 
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <a href="{{ route('vehicle.create') }}" class="btn btn-primary">Create Vehicle</a>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            async function fetchData() {
                try {
                    const response = await fetch('api/vehicles');
                    if (!response.ok) {
                        throw new Error(`HTTP error: ${response.status}`);
                    }
                    const data = await response.json();

                    try {
                        createTable(data);
                    } catch (error) {
                        console.error(error);
                    }
                } catch (error) {
                    console.error(error);
                }
            }
            fetchData();

            function createTable(vehicles) {
                const vehiclesTable = document.getElementById('vehicles-table');
                const tbody = vehiclesTable.getElementsByTagName('tbody')[0];

                vehicles.data.forEach(vehicle => {
                    const row = tbody.insertRow();
                    row.innerHTML = `
                <td>${vehicle.brand}</td>
                <td>${vehicle.model}</td>
                <td>${vehicle.plate_number}</td>
                <td>${vehicle.insurance_date}</td>
                <td>
                    <a href="/vehicles/${vehicle.id}/edit" class="btn btn-info">Edit</a>
                    <button data-user-id="${vehicle.id}" type="button" class="btn btn-danger">Delete</button>
                </td>
            `;
                });

                const deleteBtn = document.querySelectorAll('.btn-danger');

                deleteBtn.forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const vehicle = e.target.getAttribute('data-user-id');
                        console.log(vehicle);
                        fetch(`api/vehicles/${vehicle}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        })
                        const tr = btn.closest('tr')
                        tr.remove()
                    });
                });
            }
        });
    </script>

</body>

</html>