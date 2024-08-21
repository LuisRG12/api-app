<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>hola</h2>
    @dd($pokemonData)
    
    {{-- <h1>Pokémon Name: {{ ($pokemonName) }}</h1> --}}
</body>
</html> 

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Details</title>
</head>
<body>
    <h1>Hola</h1>
    @if(isset($pokemonData))
    <h1>{{ ucfirst($pokemonData['name']) }}</h1>
    @elseif(isset($error))
        <p>{{ $error }}</p>
    @endif
</body>
</html> --}}