<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


use Auth;
use App\Models\Book;
use App\Models\Page;
use App\Models\User;
use App\Models\Vault;
use App\Models\BookMark;
use App\Models\Archived;
use Illuminate\Http\Request;

class ArchivedController extends Controller
{
    // // ------------------------------------ Páginas // //

    public function archivedPag($id)
    {
        $book=Book::find($id);
        $archiveds=\DB::table('archiveds')->where('book_id','=',$id)->get();
        
        foreach($archiveds as $value){
            $page_id = $value->page_id;
        }
        
        $pages=\DB::table('pages')->where('archived','=',1)->where('book_id','=',$book->id)->get();

        return view('book.archived.archivedPag',['pages'=>$pages,'book'=>$book]);
    }
    
    // // ------------------------------------ Dotas def // //
    
    public function defArchived($id)
    {
        $page=Page::find($id);
        $book=Book::find($page->book_id);

        if($page->marked==1){
            
            $page->update([
                'archived'=>1,
                'marked'=>0,
            ]);

            $bookMark=\DB::table('book_marks')->where('page_id','=',$page->id)->delete();

            Archived::create([
                'user_id'=>Auth::id(),
                'page_id'=>$id,
                'book_id'=>Page::find($id)->book_id,
            ]);


            Image::where('page_id',$page->id)
            ->update(['archived'=>1]);

            return redirect()->route('book',['id'=>$book->id]);

        }else{

            $page->update([
                'archived'=>1,
            ]);

            Image::where('page_id',$page->id)
                    ->update(['archived'=>1]);

            Archived::create([
                'user_id'=>Auth::id(),
                'page_id'=>$id,
                'book_id'=>Page::find($id)->book_id,
            ]);
            return redirect()->route('book',['id'=>$book->id]);
        }
    }

    public function defDesarchived($id)
    {
        $page=Page::find($id);
        
        $page->update([
            'archived'=>0,
        ]);

        Image::where('page_id',$page->id)
                    ->update(['archived'=>0]);


        $archived=\DB::table('archiveds')->where('page_id','=',$page->id)->delete();

        $book=Book::find($page->book_id);

       return redirect()->route('book',['id'=>$book]);
    }
}
