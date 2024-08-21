<?php

namespace Modules\apiModule\Models;

use Illuminate\Support\Facades\Http;


class PokemonModel
{
    public static function getPokemonUrl($pokemonUrl)
    {
        $response = Http::get($pokemonUrl);
        if ($response->successful()) {
            $pokemonData = $response->json();
            return $pokemonData;
        } else {
            return response()->json(['error' => 'Failed to fetch Pokémon data'], 404);
        }
    }
    public static function getPokemonInfo($pokemonSpeciesUrl)
    {
        $pokemonData = PokemonModel::getPokemonUrl($pokemonSpeciesUrl);
        $pokemonDescription = collect($pokemonData['flavor_text_entries'])
            ->where('language.name', 'en')
            ->pluck('flavor_text')
            ->unique()
            ->map(function ($text) {
                return str_replace("\n", ' ', $text);
            })
            ->implode(' ');

        return $pokemonDescription;
    }

    public static function getPokemonGenus($pokemonSpeciesUrl)
    {
        $pokemonData = PokemonModel::getPokemonUrl($pokemonSpeciesUrl);
        $pokemonGenus = collect($pokemonData['genera'])
            ->firstWhere('language.name', 'en')['genus'];

        return $pokemonGenus;
    }


    public static function getPokemonHabitatShape($pokemonData)
    {
        $pokemonHabitatUrl = data_get($pokemonData, 'species.url');
        $pokemonData = PokemonModel::getPokemonUrl($pokemonHabitatUrl);
        $pokemonHabitat = $pokemonData['habitat']['name'];
        $pokemonShape = $pokemonData['shape']['name'];

        return [$pokemonHabitat, $pokemonShape];
    }


    public static function getDescription($pokemonData)
    {
        $pokemonSpeciesUrl = data_get($pokemonData, 'species.url');
        $pokemonDescription = PokemonModel::getPokemonInfo($pokemonSpeciesUrl);

        return $pokemonDescription;
    }

    public static function getGenus($pokemonData)
    {
        $pokemonSpeciesUrl = data_get($pokemonData, 'species.url');
        $pokemonGenus = PokemonModel::getPokemonGenus($pokemonSpeciesUrl);

        return $pokemonGenus;
    }

    public static function getProfile($pokemonData)
    {
        $pokemonHeight = $pokemonData['height'];
        $pokemonWeight = $pokemonData['weight'];
        [$pokemonHabitat, $pokemonShape] = PokemonModel::getPokemonHabitatShape($pokemonData);

        return compact('pokemonHeight', 'pokemonWeight', 'pokemonHabitat', 'pokemonShape');
    }

    public static function getAbilities($pokemonData)
    {
        $pokemonAbilities = collect($pokemonData['abilities'])
            ->pluck('ability.name')
            ->map(function ($name) {
                return ucfirst($name);
            });

        $abilitiesList = '<ul>';
        foreach ($pokemonAbilities as $ability) {
            $abilitiesList .= "<li>{$ability}</li>";
        }
        $abilitiesList .= '</ul>';

        return $abilitiesList;
    }

    public static function getStats($pokemonData)
    {
        $pokemonAbilitiesName = collect($pokemonData['stats'])
            ->pluck('stat.name')
            ->map(function ($name) {
                return ucfirst($name);
            })
            ->toArray(); // Convertir a array para usar en array_combine


        $pokemonAbilitiesValue = collect($pokemonData['stats'])
            ->pluck('base_stat')
            ->toArray(); // Convertir a array para usar en array_combine

        $statsList = '<ul>';
        foreach (array_combine($pokemonAbilitiesName, $pokemonAbilitiesValue) as $name => $stat) 
        {
            $statsList .= "<li>{$name}: {$stat}</li>";
        }
        $statsList .= '</ul>';

        return $statsList;
    }
}
