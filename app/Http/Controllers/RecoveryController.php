<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Recovery;
use App\Notifications\notifyEditPassword;
use App\Notifications\notifyRecoveryPassword;
use Illuminate\Support\Facades\Auth;

class RecoveryController extends Controller
{
    // // ------------------------------------ Páginas // //

    public function confirmedEmail()
    {
        return view('recovery.confirmedEmail');
    }

    public function newPassword($user)
    {
        return view('recovery.newPassword',['user'=>$user]);
    }

    public function confirmedCode($email)
    {
        return view('recovery.confirmedCode',['email'=>$email]);
    }

    public function recoveryVault()
    {
        return view('recovery.confirmedCode',['email'=>$email]);
    }


    // // ------------------------------------ Rotas def // //

    public function defConfirmedEmail(Request $request)
    {

        $request->validate([
            'email'=>['required'],
        ]);

        $user=\DB::table('users')->where('email','like','%'.$_REQUEST['email'])->get();

        if(count($user)!=0){
            foreach($user as $value){
                $user = $value->id;
            }
            $user = User::find($user);

            $code=rand();

            Recovery::create([
                'code'=>$code,
            ]);

            $user->notify(new notifyRecoveryPassword($user,$code));
            return redirect()->route('confirmedCode',['email'=>$_REQUEST['email']]);
        }else{
            return back();
        }


    }

    public function defNewPassword(Request $request, $user)
    {
        $request->validate([
            'password'=>['confirmed','required','min:8']
        ]);
        $user=User::find($user);

        $user->update([
            'password'=>Hash::make($_REQUEST['password'])
        ]);

        return redirect()->route('login');
    }

    public function defConfirmedCode(Request $request, $email)
    {
        $codeCheck=\DB::table('recoveries')->where('code','like','%'.$_REQUEST['code'])->get();

        if(count($codeCheck)==1){

            $user=\DB::table('users')->where('email','like','%'.$email)->get();
            // dd($user);

            foreach($user as $value){
                $user= $value->id;
            }

            $user = User::find($user);

            foreach($codeCheck as $value){
                $codeCheck= $value->id;
            }
            $code=Recovery::find($codeCheck);

            $code->update([
                'confirmed'=>1,
            ]);    

            $code->delete();

            return redirect()->route('novaSenha',['user'=>$user]);
        }else{
            return redirect()->route('confirmedEmail');
        }
    }


}
