<?php

namespace App\Http\Controllers;
//gates
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


use Auth;
use App\Models\Book;
use App\Models\Page;
use App\Models\User;
use App\Models\Vault;
use App\Models\BookMark;
use App\Models\Image;
use Illuminate\Http\Request;

class BookPageController extends Controller
{
    // // ------------------------------------ Páginas // //

    public function bookNewPage($id)
    {//página de nova folha do caderno
        $book=Book::find($id);
        return view('book.bookpage.bookNewPage',['book'=>$book]);
    }

    public function bookPageView($idPage, $idBook)
    {//página de folha do caderno
        $page=Page::find($idPage);
        $book=Book::find($idBook);
        $images=\DB::table('images')->where('exclued','=',0)->where('book_id','=',$book->id)->get();

        Gate::authorize('open-page',$page);

        return view('book.bookpage.bookPageView',['page'=>$page,'book'=>$book,'images'=>$images]);
    }

    // // ------------------------------------ Rotas def // //


    public function defbookNewPage(Request $request,$id)
    {//página de nova folha do caderno
        $book=Book::find($id);
        if ($book->locked==1) {
            Page::create([
                'title'=>$_POST['title'],
                'subtitle'=>$_POST['subtitle'],
                'text'=>$_POST['text'],
                'user_id'=>Auth::id(),
                'user_name'=>User::find(Auth::id())->name,
                'book_id'=>$id,
                'locked'=>$book->locked,
            ]);

            $vault=Vault::find($book->vault_id);

            if($book->locked==1){
                Page::where('book_id',$book->id)
                      ->update(['locked' => 1,'vault_id' => $vault->id]);

                $pages=\DB::table('pages')->where('locked','=',1)->where('book_id','=',$book->id)->where('vault_id','=',$vault->id)->get();
                $markpages=\DB::table('book_marks')->where('book_id','=',$book->id)->get();
                $archiveds=\DB::table('archiveds')->where('book_id','=',$book->id)->get();

                return back();

            }else{//segundo if
                return redirect()->route('book',['id'=>$id]);
            }
        }else{//primeiro if
            Page::create([
                'title'=>$_POST['title'],
                'subtitle'=>$_POST['subtitle'],
                'text'=>$_POST['text'],
                'user_id'=>Auth::id(),
                'user_name'=>User::find(Auth::id())->name,
                'book_id'=>$id,
                'locked'=>$book->locked,
            ]);
        
            //devolvendo para a rota o id do livro
            return redirect()->route('book',['id'=>$id]);
        }
    }

    public function defbookSavePage(Request $request,$idPage,$idBook)
    {
        $page=Page::find($idPage);
        $book=Book::find($idBook);
        
        $page->update([
            'title'=>$_POST['title'],
            'subtitle'=>$_POST['subtitle'],
            'text'=>$_POST['text'],
        ]);

        return redirect()->route('book',['id'=>$book->id]);
    }
}