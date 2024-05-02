<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vehicle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Vehicle</h2>
        <form action="{{ route('vehicles.update', $vehicle->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="brand" class="form-label">Brand:</label>
                <input type="text" name="brand" class="form-control" value="{{ $vehicle->brand }}">
            </div>

            <div class="mb-3">
                <label for="model" class="form-label">Model:</label>
                <input type="text" name="model" class="form-control" value="{{ $vehicle->model }}">
            </div>

            <div class="mb-3">
                <label for="plate_number" class="form-label">Plate Number:</label>
                <input type="text" name="plate_number" class="form-control" value="{{ $vehicle->plate_number }}">
            </div>

            <div class="mb-3">
                <label for="insurance_date" class="form-label">Insurance Date:</label>
                <input type="date" name="insurance_date" class="form-control" value="{{ $vehicle->insurance_date }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
