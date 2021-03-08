<?php

Route::get('/', 'HomeController@index');
Auth::routes();

Route::get('/home', 'HomeController@home');
Route::post( '/cadastrar', 'HomeController@cadastrar' );
Route::post( '/atualizar', 'HomeController@atualizar' );
Route::get('/deletar', 'HomeController@deletar');

Auth::routes();

