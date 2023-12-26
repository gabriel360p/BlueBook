<?php

namespace App\Http\Controllers;
//gates
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Http\Request;
use Auth;
use App\Models\Book;
use App\Models\Page;
use App\Models\User;
use App\Models\BookMark;
use App\Models\Vault;


class BookController extends Controller
{
    // // ------------------------------------ Páginas // //

    public function booksIndex()
    {//pagina inicial da aba cadernos

        //ele só vai pegar os cadernos que podem ser vizualizados, esse campo controla a vizualização, impedindo de mostrar itens arquivados ou deletados. Ele também controla a vizualização de cadernos trancados, ele só mostra os destrancados, os trancados só são vistos no cofre.

        $allmybooks=\DB::table('books')->where('vault','=',0)->where('visualized','=',1)->where('user_id','=',Auth::id())->get();
        return view('book.booksIndex',['allmybooks'=>$allmybooks]);
    }

    public function newBook()
    {//página de novo caderno
        return view('book.newBook');
    }

    public function editBook($id)
    {//página de editar caderno
        $book=Book::find($id);

        Gate::authorize('open-book',$book);

        return view('book.editBook',['book'=>$book]);
    }

    public function viewBook($id)
    {//página de abrir caderno
        $book=Book::find($id);

        Gate::authorize('open-book',$book);

        $markpages=\DB::table('book_marks')->where('book_id','=',$book->id)->get();

        $archiveds=\DB::table('archiveds')->where('book_id','=',$book->id)->get();

        //ele só vai pegar as páginas que podem ser vizualizadas, esse campo controla a vizualização, impedindo de mostrar itens arquivados ou deletados
        $pages=\DB::table('pages')->where('book_id','=',$book->id)->where('exclued','=',0)->where('archived','=',0)->where('visualized','=',1)->where('user_id','=',Auth::id())->get();

        $vault=\DB::table('vaults')->where('book_id','=',$book->id)->get();
        // dd($vault);

        return view('book.viewBook',['book'=>$book,'pages'=>$pages,'markpages'=>$markpages,'archiveds'=>$archiveds,'vault'=>$vault]);
    }

    // // ------------------------------------ Rotas def // //

    public function defnewBook(Request $request)
    {//criar novo caderno
        $request->validate([
            'title'=>'min:5|max:255',
            'description'=>'min:15|max:255',
        ],[
            'title.required'=>'O titulo tem no minino 5 caracteres e no máximo de 255!',
            'description.required'=>'A descrição tem no minino 15 caracteres e no máximo de 255!',
        ]);
        
        $user=User::find(Auth::id());
        Book::updateOrCreate([
            'user_id'=>Auth::id(),
            'user_name'=>$user->name,
            'title'=>$_POST['title'],
            'description'=>$_POST['description'],
            'archived'=>0,
            'exclued'=>0,
        ]);

        return redirect()->route('books');
    }

    public function defeditBook(Request $request,$id)
    {//editar o caderno
        $book=Book::find($id);

        $request->validate([
            'title'=>'min:5|max:255',
            'description'=>'min:15|max:255',
        ],[
            'title.required'=>'O titulo tem no minino 5 caracteres e no máximo de 255!',
            'description.required'=>'A descrição tem no minino 15 caracteres e no máximo de 255!',
        ]);
        
        $user=User::find(Auth::id());
        $book->update([
            'user_id'=>Auth::id(),
            'user_name'=>$user->name,
            'title'=>$_POST['title'],
            'description'=>$_POST['description'],
        ]);
        return redirect()->route('books');
    }


}
