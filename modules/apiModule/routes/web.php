<?php

use Illuminate\Support\Facades\Route;
use Modules\apiModule\Http\Controllers\HomeController;
use Modules\apiModule\Http\Controllers\ApiController;
Route::get('/', HomeController::class)->name('home');

Route::get('/', [ApiController::class, 'getAllPokemons'])->name('index');

Route::get('/pokemon/s', [ApiController::class, 'showApi']);

Route::get('/pokemons/search', [ApiController::class, 'searchPokemon'])->name('pokemon.search');
Route::get('/pokemons/{pokemon}', [ApiController::class, 'getPokemon'])->name('pokemon.show');
