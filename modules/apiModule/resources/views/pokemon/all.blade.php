<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Pokémon</title>
</head>
<body>
    <h1>All Pokémon</h1>
    <ul>
        @foreach($pokemons['results'] as $pokemon)
            <li>
                <a href="{{ $pokemon['url'] }}" target="_blank">{{ $pokemon['name'] }}</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
