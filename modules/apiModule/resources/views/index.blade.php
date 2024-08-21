<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Pokémon</title>
    @vite(['modules/apiModule/public/css/styles.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Search for a Pokémon</h1>
        <form action="{{ route('pokemon.search') }}" method="GET" class="my-4">
            <div class="input-group">
                <input type="text" name="pokemon_name" class="form-control" placeholder="Enter Pokémon name" required>
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
        
        <ul class="list-group mt-4">
            @foreach ($pokemons as $pokemon)
                <li class="list-group-item">
                    <a href="{{route('pokemon.show',$pokemon['name'])}}">
                        {{ $pokemon['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        <!-- Mostrar enlaces de paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $pokemons->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>