<?php

namespace Modules\apiModule\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use Modules\apiModule\Models\PokemonModel;

class ApiController extends Controller
{
    public function getAllPokemons()
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon?limit=1000");

        if ($response->successful()) {
            $pokemonData = $response->json();
            
            $pokemons = collect($pokemonData['results']);

            $perPage = 20;

            // Obtener la página actual
            $currentPage = request()->get('page', 1);

            // Crea una instancia de LengthAwarePaginator
            $paginatedPokemons = new LengthAwarePaginator(
                $pokemons->forPage($currentPage, $perPage), 
                $pokemons->count(), 
                $perPage, 
                $currentPage, 
                ['path' => request()->url(), 'query' => request()->query()] // Información de la URL
            );

            $pokemonList = '<ul class="list-group mt-4">';
            foreach ($paginatedPokemons as $pokemon) {
                $pokemonList .= '<li class="list-group-item"><a href="'.route('pokemon.show', $pokemon['name']).'">'.$pokemon['name'].'</a></li>';
            }
            $pokemonList .= '</ul>';

            // Enlaces de paginación
            $paginationLinks = '<div class="d-flex justify-content-center mt-4">'.$paginatedPokemons->links().'</div>';

             return view('apiModule::index', ['pokemonList' => $pokemonList, 'paginationLinks' => $paginationLinks]);
        } else 
        {
            return response()->json(['error' => 'Failed to fetch Pokémon data'], 404);
        }
    }

    // public function showApi(Request $request) 
    // {   
    //     $pokemonName = strtolower($request->input('pokemon_name'));
    //     $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$pokemonName}");
    //     if ($response->successful())
    //     {
    //         $pokemonData = $response->json();
    //         return view('apiModule::prueba',compact('pokemonData'));
    //     }else 
    //     {
    //        return response()->json(['error' => 'Failed to fetch Pokémon data'], 404);
    //     }
    // }

    public function searchPokemon(Request $request)
    {
        $pokemonName = strtolower($request->input('pokemon_name'));
        return $this->getPokemon($pokemonName);
    }

    public function getPokemon($name){

         // Obtener datos de la especie del Pokémon
         $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$name}");
        
         if ($response->successful()){
            $pokemonData = $response->json();
            
            $pokemonDescription = PokemonModel::getDescription($pokemonData);
            $pokemonGenus = PokemonModel::getGenus($pokemonData);
            $pokemonName = $name;

            $pokemonProfile = PokemonModel::getProfile($pokemonData);
            $pokemonAbilities = PokemonModel::getAbilities($pokemonData);
            $pokemonStats = PokemonModel::getStats($pokemonData);


            return view('apiModule::pokemon.description', [
                        'pokemonDescription' => $pokemonDescription,
                        'pokemonGenus' => $pokemonGenus,
                        'name' => $pokemonName,
                        'profile' => $pokemonProfile,
                        'abilities' => $pokemonAbilities,
                        'stats' => $pokemonStats
                    ]);
         }
    }
}
