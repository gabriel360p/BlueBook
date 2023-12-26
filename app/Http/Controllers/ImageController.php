<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Auth;
use File;
use App\Models\Book;
use App\Models\Page;
use App\Models\User;
use App\Models\Vault;
use App\Models\BookMark;
use App\Models\Image;
use App\Models\ProfileImage;


class ImageController extends Controller
{

    public function defProfile(Request $request)
    {

        if( $request->hasFile('document')&&$request->file('document')->isValid() ){
            // dd($request->document);

            $requestImg = $request->document; // capturando imagem do forms
            $extension = $requestImg->extension();//pegando a extensão da imagem

            //alterando o nome do arquivo - altera para não ter nomes repetidos
            $imgName = md5($requestImg->getClientOriginalName() . strtotime("now")). "." . $extension;

            //mandando a imagem para um diretorio
            $requestImg->move(public_path('img/events'), $imgName);

            Auth::user()->update([
                'photo'=>$imgName,
            ]);

            return back();
        }else{
            return back();
        }

    }


    public function defInputImage($book,$page,Request $request)
    {
        $book=Book::find($book);
        $page=Page::find($page);

        if( $request->hasFile('document')&&$request->file('document')->isValid() ){
            $requestImg = $request->document; // capturando imagem do forms
            $extension = $requestImg->extension();//pegando a extensão da imagem

            //alterando o nome do arquivo - altera para não ter nomes repetidos
            $imgName = md5($requestImg->getClientOriginalName() . strtotime("now")). "." . $extension;

            //mandando a imagem para um diretorio
            $requestImg->move(public_path('img/events'), $imgName);

            Image::create([
                'user_id'=>Auth::id(),
                'book_id'=>$book->id,
                'page_id'=>$page->id,
                //salvando no banco de dados o nome da imagem
                'image'=>$imgName,
            ]);        
            return back();
        }

        return back();
    }


    public function defDeleteImage($image)
    {
        $image=Image::find($image);;

        //apagando arquivos, muito simples!!    
        File::delete('img/events/'.$image->image);

        //apagando o registro do banco de dados
        $image->delete();

        return back();
    }
}

