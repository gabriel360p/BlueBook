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
class SearchController extends Controller
{
    // // ------------------------------------ Páginas // //

    public function resultsPage()
    {
        return view('dash.resultsPage');
    }

    // // ------------------------------------ Rotas def // //

    public function defSeach()
    {
        // $pages=\DB::table('pages')->where('title','like','%'.$_POST['busca'].'%')->get();
        
        $books=\DB::table('books')->where('title','like','%'.$_POST['busca'].'%')->get();
        $tasks=\DB::table('tasks')->where('title','like','%'.$_POST['busca'].'%')->get();

        return view('dash.results',['book'=>$books,'page'=>$pages,'task'=>$tasks,]);
    }
}
