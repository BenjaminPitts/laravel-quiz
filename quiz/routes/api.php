<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('quiz', function () {
    $quiz = DB::select('SELECT * FROM quiz ORDER BY random() LIMIT 1');
    return $quiz;
});

Route::post('quiz', function (Request $request) {
    DB::insert('INSERT INTO quiz (question, answer, answer_char, point_value) VALUES (?, ?, ?, ?)', [$request->question, $request->answer, strtoupper($request->answer_char), $request->point_value]);
    $quiz = DB::select('SELECT * FROM quiz ORDER BY id DESC');
    return $quiz;
});

Route::delete('quiz/{id}', function ($id) {
    DB::delete('DELETE FROM quiz WHERE id = ?', [$id]);
    $quiz = DB::select('SELECT * FROM quiz ORDER BY id DESC');
    return $quiz;
});

Route::put('quiz/{id}', function (Request $request, $id) {
    DB::update('UPDATE quiz SET question=?, answer=?, answer_char=?, point_value=? WHERE id = ?', [$request->question, $request->answer, strtoupper($request->answer_char), $request->point_value, $id]);
    $quiz = DB::select('SELECT * FROM quiz ORDER BY id DESC');
    return $quiz;
});
