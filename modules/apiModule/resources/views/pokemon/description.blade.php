<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ ucfirst($name) }} - Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container my-5">

    <!-- Pokemon Name and Genus -->
    <div class="row">
        <div class="col-12 text-center">
            <h1>{{ ucfirst($name) }} - <small class="text-muted">{{ $pokemonGenus }}</small></h1>
        </div>
    </div>

    <!-- Pokemon Description -->
    <div class="row my-4">
        <div class="col-12">
            <h2>Description</h2>
            <p class="lead">
               {{ $pokemonDescription }}
            </p>
        </div>
    </div>

    <!-- Pokemon Profile -->
    <div class="row my-4">
        <div class="col-md-6">
            <h2>Profile</h2>
            <ul class="list-group">
                <li class="list-group-item"><strong>Height:</strong> {{ $profile['pokemonHeight'] }}</li>
                <li class="list-group-item"><strong>Weight:</strong> {{ $profile['pokemonWeight'] }}</li>
                <li class="list-group-item"><strong>Habitat:</strong> {{ $profile['pokemonHabitat'] }}</li>
                <li class="list-group-item"><strong>Shape:</strong> {{ $profile['pokemonShape'] }}</li>
            </ul>
        </div>
    </div>

    <!-- Pokemon Abilities -->
    <div class="row my-4">
        <div class="col-md-6">
            <h2>Abilities</h2>
            <ul class="list-group">
                {!! $abilities !!}
            </ul>
        </div>
    </div>

    <!-- Pokemon Stats -->
    <div class="row my-4">
        <div class="col-md-6">
            <h2>Stats</h2>
            <ul class="list-group">
                {!! $stats !!}
            </ul>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

