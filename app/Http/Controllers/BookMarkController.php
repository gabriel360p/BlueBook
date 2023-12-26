<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//gates
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Auth;
use App\Models\Book;
use App\Models\Page;
use App\Models\User;
use App\Models\Image;
use App\Models\BookMark;
class BookMarkController extends Controller
{
    // // ------------------------------------ Páginas // //
    
    public function markPages($id)
    {   
        $user=User::find(Auth::id());
        $markpages=\DB::table('book_marks')->where('book_id','=',$id)->get();

        foreach($markpages as $value){
            $page_id=$value->page_id;
            $book=$value->book_id;
        }

        $pages=\DB::table('pages')->where('marked','=',1)->where('book_id','=',$book)->get();

        $book=Book::find($book);

        return view('book.markbook.markPages',['pages'=>$pages,'book'=>$book,'user'=>$user]);
    }

    // // ------------------------------------ Dotas def // //

    public function defMark($id)
    {
        $page = Page::find($id);

        //atualzando todas as imagens

        $page->update([
            'marked'=>1,
        ]);

        Image::where('page_id',$page->id)
                    ->update(['marked'=>1]);

        BookMark::updateOrCreate([
            'user_id'=>Auth::id(),
            'page_id'=>$page->id,
            'book_id'=>$page->book_id,

        ]);
        return redirect()->route('book',['id'=>$page->book_id]);

    }

   public function defDesmark($id)
    {
        $page = Page::find($id);

        $page->update([
            'marked'=>0,
        ]);

        Image::where('page_id',$page->id)
                    ->update(['marked'=>0]);

        $bookMark=\DB::table('book_marks')->where('page_id','=',$id)->delete();

        return redirect()->route('book',['id'=>$page->book_id]);

    }
}
