<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//gates
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Auth;
use App\Models\Book;
use App\Models\Page;
use App\Models\User;
use App\Models\BookMark;
use App\Notifications\notifyActiveVault;
use App\Notifications\notifyDeactiveVault;


class VaultController extends Controller
{
    // // ------------------------------------ Páginas // //

    public function vaults()
    {
        $book=\DB::table('books')->where('user_id','=',Auth::id())->where('vault','=',1)->get();
        return view('vault.vaultIndexPage',['book'=>$book]);
    }

    public function vaultAlert($book)
    {
        $book=Book::find($book);
        return view('vault.vaultAlert',['book'=>$book]);
    }

    public function insertPassword($book)
    {
        $book=Book::find($book);
        if($book->open==1){
            return redirect()->route('book',['id'=>$book]);
        }else{
            return view('vault.insertPassword',['book'=>$book]);
        }
    }

    public function vaultConfigure($book)
    {//rota para página de configuração do cofre
        $book=Book::find($book);
        Gate::authorize('verify-vault',$book);
        return view('vault.vaultConfigure',['book'=>$book]);
    }



    // // ------------------------------------ Dotas def // //


    public function defNewpasswordVault($book,Request $request)
    {
        $book=Book::find($book);

        $request->validate([
            'old_password'=>['required','min:8'],
            'password'=>['required','min:8','confirmed'],
        ]);

        if(Hash::check($_POST['old_password'],$book->password)){
            $book->update([
                'password'=>Hash::make($_POST['password']),
            ]);
            return redirect()->route('book',['id'=>$book->id]);
        }else{
            return back();
        }
    }

    public function defOpenVault($book,Request $request)
    {//abrindo para acessar os itens do cofre
        $book=Book::find($book);

        $request->validate([
            'password' => ['required', 'min:8','confirmed'],
        ]);

        $password=$_POST['password'];
        //a verificação é feito analisando a senha sem hash com a senha que tem hash:
        // $password=$_POST['password']; -> essa senha não tem hash nenhum, mas mesmo assim
        //a usamos para comparar com a senha que está dentro do banco, a comparação não é feita de hash a hash, mas
        //sim de senha e hash, especificamente nessa ordem

        if(Hash::check($password,$book->password)){

        //atualizando o status da tranca
        $book->update([
            'open'=>1,
        ]);

        Page::where('book_id',$book->id)
              ->update(['open' => 1]);

        return redirect()->route('book',['id'=>$book->id]);

        }else{
            //voltando para trás, pois a senha estava incorreta
            return back();
        }
    }

    public function defCloseVault($book)
    {//fechar o cofre
        $book=Book::find($book);
        $book->update([
            'open'=>0,
        ]);

        Page::where('book_id',$book->id)
              ->update(['open' => 0]);

        return redirect()->route('books');
    }

    public function defconfigurevault($book)
    {//adicionando proteção ao caderno
        $book=Book::find($book);

        $book->update([
            'vault'=>1,
            //a senha padrão, será a senha de login do usuário
            'password'=>User::find(Auth::id())->password,
            'open'=>0,
        ]);

        //atualizando vários objetos ao mesmo tempo (atualizando um vetor)
        Page::where('book_id',$book->id)
              ->update(['open' => 0,'vault' => 1]);
        // --------------

        $user=User::find(Auth::id());

        //notificando ao usuario que o em seu caderno foi ativado a função cofre
        $user->notify(new notifyActiveVault($book,$user));

        return redirect()->route('books',['book'=>$book->id]);
    }

    public function defDeactiveVault(Request $request,$book)
    {
        $book=Book::find($book);

        $request->validate([
            'password' => ['required', 'min:8'],
        ]);

        if(Hash::check($_POST['password'],$book->password)){
            $book->update([
                'open'=>1,
                'vault'=>0,
                'password'=>null,
            ]);

            Page::where('book_id',$book->id)
                  ->update(['open' => 0,'vault' => 0]);

            $user=User::find(Auth::id());
            //notificando ao usuario que o em seu caderno foi ativado a função cofre
            $user->notify(new notifyDeactiveVault($book,$user));

            return redirect()->route('books',['id'=>$book->id]);
        }else{
            return back();
        }
    }

}
