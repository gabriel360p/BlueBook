<?php

namespace App\Exceptions;

use Exception;

class UndefinedVariable extends Exception
{//tratando erros utilizando o laravel

    public function register()
    {

        $this->reportable(function(NotFoundHttpException){
            return response()->view('errors.404');
        });

    }
}
