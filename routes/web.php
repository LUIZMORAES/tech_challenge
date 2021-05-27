<?php

use Illuminate\Support\Facades\Route;

//---------------------------------------------------------------------------------------------------------------------
Route::get('/', function () {
    //Rota de home externa
    return view('welcome');
});

//---------------------------------------------------------------------------------------------------------------------
//Rota de autenticação geradas automaticamente
Auth::routes();

//---------------------------------------------------------------------------------------------------------------------
//Rotas internas
//Administração---------------------------------------------------------------------------------------------------------
Route::get('/admin', [App\Http\Controllers\AuthController::class, 'ShowDashboard'])->name('admin');

Route::get('/admin/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('admin.login');

Route::post('/admin/login/do', [App\Http\Controllers\AuthController::class, 'login'])->name('admin.login.do');

Route::get('/admin/logout', [App\Http\Controllers\AuthController::class, 'showLogoutForm'])->name('admin.logout');

Route::get('/admin/painelprincipal', [App\Http\Controllers\HomeController::class, 'showPainelPrincipal'])->name('admin.painelprincipal');

Route::get('/session', [App\Http\Controllers\SessionController::class, 'session'])->name('session');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Usuarios

Route::group(['namespace' => 'Painel'], function(){

    Route::get('/Painel/Usuarios', [App\Http\Controllers\Painel\Usuarios\UsuariosController::class, 'index'])->name('Painel.Usuarios');

    Route::get('/Painel/Usuarios/create', [App\Http\Controllers\Painel\Usuarios\UsuariosController::class, 'create'])->name('Painel.Usuarios.create');

    Route::post('/Painel/Usuarios/store', [App\Http\Controllers\Painel\Usuarios\UsuariosController::class, 'store'])->name('Painel.Usuarios.store');

    Route::get('/Painel/Usuarios/edit/{id}', [App\Http\Controllers\Painel\Usuarios\UsuariosController::class, 'edit'])->name('Painel.Usuarios.edit');

    Route::get('/Painel/Usuarios/update/{id}', [App\Http\Controllers\Painel\Usuarios\UsuariosController::class, 'update'])->name('Painel.Usuarios.update');

    Route::get('/Painel/Usuarios/delete/{id}', [App\Http\Controllers\Painel\Usuarios\UsuariosController::class, 'delete'])->name('Painel.Usuarios.delete');

});

//Projetos

Route::group(['namespace' => 'Projetos'], function(){

    Route::get('/Projetos/Cotacao', [App\Http\Controllers\Projetos\Cotacao\CotacaoController::class, 'index'])->name('Projetos.Cotacao');

    Route::get('/Projetos/buscarmoeda', [App\Http\Controllers\Projetos\Cotacao\CotacaoController::class, 'buscarmoeda'])->name('Projetos.buscarmoeda');

    Route::get('/Projetos/buscarmoeda15', [App\Http\Controllers\Projetos\Cotacao\CotacaoController::class, 'buscarmoeda15'])->name('Projetos.buscarmoeda15');

    Route::get('/Projetos/imprimirmoeda', [App\Http\Controllers\Projetos\Cotacao\CotacaoController::class, 'imprimirmoeda'])->name('Projetos.imprimirmoeda');

    Route::get('/Projetos/pdfmoeda', [App\Http\Controllers\Projetos\Cotacao\CotacaoController::class, 'pdfrmoeda'])->name('Projetos.pdfmoeda');

});
