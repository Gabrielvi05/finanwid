<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\SugestoesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransacaoController;

// Dashboard protegida com sessão customizada
Route::get('/dashboard', function () {
    if (!session()->has('usuario_id')) {
        return redirect()->route('login');
    }
    return view('dashboard');
})->name('dashboard');

// APIs de transações protegidas por sessão (middleware web)
Route::middleware(['web'])->group(function () {
    Route::get('/api/transacoes', [TransacaoController::class, 'getTransacoes']);
    Route::post('/api/transacoes', [TransacaoController::class, 'inserir']);
    Route::post('/importar-transacoes', [TransacaoController::class, 'importar'])->name('importar.transacoes'); // Rota para importação CSV
});

// Logout manual
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Páginas estáticas
Route::view('/trabalhe-conosco', 'trabalhe_conosco')->name('trabalhe');
Route::view('/sugestoes', 'rec_ou_sug')->name('sugestoes');

// Formulário de sugestões
Route::post('/sugestoes/enviar', [SugestoesController::class, 'enviar'])->name('sugestoes.enviar');

// Cadastro
Route::post('/cadastro', [CadastroController::class, 'store'])->name('cadastro.store');
Route::view('/cadastro', 'cadastro')->name('cadastro');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Página inicial
Route::get('/', function () {
    return view('index');
})->name('home');
