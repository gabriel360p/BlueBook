<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


use Auth;
use App\Models\Book;
use App\Models\Page;
use App\Models\User;
use App\Models\Vault;
use App\Models\BookMark;
use App\Models\Task;
use App\Models\Image;
use App\Notifications\notifyBookDelete;

class TrashController extends Controller
{//trash controller irar 'monitorar' o 'lixo' das tarefas, paginas e cadernos.

    // // ------------------------------------ Páginas // //

    public function trashIndex()
    {
        $task=\DB::table('tasks')->where('user_id','=',Auth::id())->where('exclued','=',1)->get();
        $page=\DB::table('pages')->where('user_id','=',Auth::id())->where('exclued','=',1)->get();
        $book=\DB::table('books')->where('user_id','=',Auth::id())->where('exclued','=',1)->get();
        $images=\DB::table('images')->where('user_id','=',Auth::id())->where('exclued','=',1)->get();

        return view('trash.trashIndex',['book'=>$book,'page'=>$page,'task'=>$task,'images'=>$images]);
    }

    // // ------------------------------------ Dotas def // //

    // Exclude -------------------------------------------------------------------

    public function defExcluedBook($book)
    {
        $book=Book::find($book);
        
        Gate::authorize('delete-book',$book);

        $book->update([
            'exclued'=>1,
            'visualized'=>0,
        ]);
        return redirect()->route('books');
    }

    public function defExcluedPage($idPage,$idBook)
    {
        $page=Page::find($idPage);

        Gate::authorize('open-page',$page);
        
        $book=Book::find($page->book_id);

        $page->update([
            'visualized'=>0,
            'exclued'=>1,
        ]);
        return redirect()->route('book',['id'=>$book->id]);

    }

    public function defExcluedTask($task)
    {
        $task=Task::find($task);
        $task->update([
            'visualized'=>0,
            'exclued'=>1,
        ]);
        return redirect()->route('tarefas');
    }

    public function defExcludeImage($image)
    {
        $image=Image::find($image);
        $image->update([
            'visualized'=>0,
            'exclued'=>1,
        ]);
        return back();   
    }


    // Delete -------------------------------------------------------------------

    public function defDeleteBook($book)
    {
        $book=Book::find($book);

        $pages=\DB::table('pages')->where('book_id','=',$book->id)->delete();
        $pagesBook=\DB::table('pages')->where('book_id','=',$book->id)->delete();
        $markpages=\DB::table('book_marks')->where('book_id','=',$book->id)->delete();
        $archiveds=\DB::table('archiveds')->where('book_id','=',$book->id)->delete();
        $book->delete();

        $user=User::find(Auth::id());
        $user->notify(new notifyBookDelete($user));

        return redirect()->route('lixeira');
    }

    public function defDeletePage($page)
    {
        $page=Page::find($page)->delete();
        return redirect()->route('lixeira');
    }

    public function defDeleteTask($task)
    {
        $task=Task::find($task)->delete();
        return redirect()->route('lixeira');
    }

    // Recovery -------------------------------------------------------------------

    public function defRecoveryTask($task)
    {
        $task=Task::find($task);
        $task->update([
            'visualized'=>1,
            'exclued'=>0,
        ]);
        return redirect()->route('lixeira');
    }

    public function defRecoveryPage($page)
    {
        $page=Page::find($page);
        $page->update([
            'visualized'=>1,
            'exclued'=>0,
        ]);

        $book=Book::find($page->book_id);
    
        if($book->exclude==1){
            return back();
        }else{

            return redirect()->route('lixeira');
        }

    }

    public function defRecoveryBook($book)
    {
        $book=Book::find($book);
        $book->update([
            'visualized'=>1,
            'exclued'=>0,
        ]);
        return redirect()->route('lixeira');
    }

    public function defRecoveryImage($image)
    {
        $image=Image::fin($image);
        $image->update([
            'visualized'=>1,
            'exclued'=>0,
        ]);
    }
       
}
