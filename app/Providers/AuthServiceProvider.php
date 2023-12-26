<?php

namespace App\Providers;
use Auth;
use App\Models\User;
use App\Models\Book;
use App\Models\Page;
use App\Policies\UserPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {//aq registramos os gates, os portões - eles são mais utilizados para autorizar ações dentro do sistema, tipo verificar se o usuário logado pode ou não excluir alguma coisa.
        $this->registerPolicies();

        //user gates
        Gate::define('update', function($user,$product){
            return $user->id === $product->user_id; 
        });
        
        //book gates
        Gate::define('open-book', function(User $user, Book $book){
            return $user->id === $book->user_id;
        });

        Gate::define('edit-book', function(User $user, Book $book){
            return $user->id === $book->user_id;
        });

        Gate::define('delete-book', function(User $user, Book $book){
            return $user->id === $book->user_id;
        });

        //page gates
        Gate::define('open-page', function(User $user, Page $page){
            return $user->id === $page->user_id;
        });

        Gate::define('edit-page', function(User $user, Page $page){
            return $user->id === $page->user_id;
        });

        Gate::define('delete-page', function(User $user, Page $page){
            return $user->id === $page->user_id;
        });

        //editar perfil gates
        Gate::define('edit-profile', function(User $user){
            return $user->id === Auth::id();
        });

        Gate::define('edit-password', function(User $user){
            return $user->id === Auth::id();
        });


        //Vault Gates
        Gate::define('verify-vault', function(User $user, Book $book){
            if($user->id===$book->user_id){
                if($book->open==1){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        });

        

    }
}
