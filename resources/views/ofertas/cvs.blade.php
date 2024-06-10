<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CVs Disponibles</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">CVs Disponibles</h1>
        <ul class="list-group">
            @foreach($cvs as $cv)
                <li class="list-group-item">{{$cv->descripcion}}</li>
            @endforeach
        </ul>
    </div>
</body>
</html>
