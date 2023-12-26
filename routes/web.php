<?php

//-------------------------------------------------------- 

use Illuminate\Support\Facades\middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WellcomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookPageController;
use App\Http\Controllers\VaultController;
use App\Http\Controllers\BookMarkController;
use App\Http\Controllers\ArchivedController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\RecoveryController;

use Illuminate\Http\Request;
use App\Models\User;

//-------------------------------------------------------- Sistema de Autentificação
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

//-------------------------------------------------------- Rotas de edição do usuario/users
Route::controller(UserController::class)->group(function(){
    Route::get('users','index');
    Route::get('users/show/{user}','show')->name('profile');
    Route::get('users/admin/{user}','superAdmin');
    Route::get('users/edit/{user}', 'edit');

    //página de editar senha
    Route::get('/users/editPassword/{user}', 'editPassword');

    //rot def de editar senha
    Route::post('/defeditPassword/{user}','defeditPassword');

    Route::post('/users/update/{user}','update');
});
//-------------------------------------------------------- Outras Rotas da aplicação:

//Controller das páginas básicas
Route::controller(WellcomeController::class)->group(function(){//grupo de rotas 
    Route::get('/','index')->name('index');//leva para página index
    Route::get('/login','loginPage')->name('login');//leva para página index
    Route::get('/register','registerPage');//leva para página index
    Route::get('/dash','dash')->middleware('auth');//leva para página index

    
    Route::get('/auth','auth');

});

//middleware para todos
Route::middleware(['auth'])->group(function(){

    //controller do livro
    Route::controller(BookController::class)->group(function(){
        //rotas para book
        Route::get('/dash/books','booksIndex')->name('books');
        Route::get('/dash/newbook','newBook');
        Route::get('/dash/editbook/{id}','editBook');
        Route::get('/dash/book/{id}','viewBook')->name('book');

        //rotas def para book 
        Route::post('/newBook','defnewBook');
        Route::post('/editBook/{id}','defeditBook');
    });

    //controller de paginas
    Route::controller(BookPageController::class)->group(function(){
        //rotas para paginas
        Route::get('/dash/book/newpage/{id}','bookNewPage');
        Route::get('/dash/book/pageview/{idPage}/{idBook}','bookPageView')->name('pagina');

        //rotas def para paginas
        Route::post('/defnewpage/{id}','defbookNewPage');
        Route::post('/defsavepage/{idPage}/{idBook}','defbookSavePage');
    });

    //controller do BookMark
    Route::controller(BookMarkController::class)->group(function(){
        //rotas de páginas para páginas marcadas
        Route::get('/dash/book/markpage/{id}','markPages');

        //rotas def de páginas marcadas
        Route::get('/defDesmark/{id}','defDesmark');
        Route::get('/defMark/{id}','defMark');
    });

    //Controlle das páginas arquivadas
    Route::controller(ArchivedController::class)->group(function(){
        //rotas de paginas para aquivados
        Route::get('/dash/book/archived/{id}','archivedPag');

        //rotas def para arquivados
        Route::get('/defArchived/{id}','defArchived');
        Route::get('/defDesarchived/{id}','defDesarchived');
    });

    //controller do cofre
    Route::controller(VaultController::class)->group(function(){
        //rota das página do cofre
        Route::get('/dash/vault/insertPassword/{book}','insertPassword');
        Route::get('/dash/vault/cofres','vaults');
        Route::get('/dash/vault/vaultAlert{book}','vaultAlert');
        Route::get('/dash/vault/vaultConfigure/{book}','vaultConfigure');

        //rotas def para o cofre
        Route::get('/defconfigurevault/{book}','defconfigurevault');
        Route::post('/defOpenVault/{book}','defOpenVault');
        Route::get('/defCloseVault/{bookt}','defCloseVault');
        Route::post('/defNewpasswordVault/{bookt}','defNewpasswordVault');
        Route::post('/defDeactiveVault/{bookt}','defDeactiveVault');
    });

    //controller das tasks
    Route::controller(TaskController::class)->group(function(){
        //rotas das páginas de tarefas
        Route::get('/dash/tasks','tasksIndex')->name('tarefas');
        Route::get('/dash/newtask','newTask');
        Route::get('/dash/edittask/{task}','edittask');
        Route::get('/dash/concluedTasks','concluedTasks');

        Route::post('/defNewTask/','defNewTask');
        Route::get('/defConlued/{task}','defConlued');
        Route::post('/defEditTask/{task}','defEditTask');
        Route::get('/defDesConlued/{task}','defDesConlued');
    });
        

    //controller da lixeira
    Route::controller(TrashController::class)->group(function(){
        //rotas de página de lixeira
        Route::get('/dash/trashIndex','trashIndex')->name('lixeira');

        //rotas def de lixeira

        //livro
        Route::get('/defExcluedBook/{book}','defExcluedBook');
        Route::get('/defDeleteBook/{book}','defDeleteBook');
        Route::get('/defRecoveryBook/{book}','defRecoveryBook');

        //paginas
        Route::get('/defExcluedPage/{idPage}/{idBook}','defExcluedPage');
        Route::get('/defDeletePage/{page}','defDeletePage');
        Route::get('/defRecoveryPage/{page}','defRecoveryPage');

        //tarefas
        Route::get('/defExcluedTask/{task}','defExcluedTask');
        Route::get('/defDeleteTask/{task}','defDeleteTask');
        Route::get('/defRecoveryTask/{task}','defRecoveryTask');

        //documentos/fotos -- falta implementar
        Route::get('/defExcludeImage/{image}','defExcludeImage');
        Route::get('/defRecoveryImage/{image}','defRecoveryImage');
    });

    //controller de notificações
    Route::controller(NotificationController::class)->group(function(){
        //rotas de páginas para as notificações
        Route::get('/dash/notificationsIndex','notificationsIndex')->name('notifications');

        //rotas de def para notificações
        Route::get('/defReadNotifications/','defReadNotifications');
        Route::get('/defDeleteNotifications/','defDeleteNotifications');
    });

    //cotroller de buscas
    Route::controller(SearchController::class)->group(function(){
        //rotas de páginas para pesquisa
        Route::get('/dash/resultsPage','resultsPage');

        //rotas de def para pesquisa
        Route::post('/defSeach/','defSeach');
    });

    //controller de images
    Route::controller(ImageController::class)->group(function(){
        //rotas def de images
        Route::get('/defDeleteImage/{image}','defDeleteImage');
        Route::post('/defInputImage/{page}/{book}','defInputImage');

        //foto de perfile
        Route::post('/defProfile/','defProfile');
    });

});


    // Route::post('/defProfile',function(){
    //     dd($document=$_POST['document']);
    // });


    Route::controller(RecoveryController::class)->group(function(){
        Route::get('/confirmedEmail/','confirmedEmail')->name('confirmedEmail');
        Route::get('/newPassword/{user}','newPassword')->name('novaSenha');
        Route::get('/confirmedCode/{email}','confirmedCode')->name('confirmedCode');

        Route::post('/defConfirmedEmail/','defConfirmedEmail');
        Route::post('/defNewPassword/{user}','defNewPassword');
        Route::post('/defConfirmedCode/{email}/','defConfirmedCode');

    });



//baixar documentos
//https://pt.stackoverflow.com/questions/371843/como-fazer-um-download-de-arquivo-para-o-servidor-com-php-laravel

//gerar pdf
//https://blog.especializati.com.br/gerar-pdf-no-laravel-com-dompdf/