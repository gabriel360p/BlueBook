<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Notifications\notifyEditPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileImage;

class UserController extends Controller
{

//    isso serve como um gate/middleware que protege, somente o admin pode ver essa página
    public function __construct () {
        $this->middleware('auth');
        
        //autorização via Policy para resource controller
        $this->authorizeResource(User::class);
    }

    //listar todos os usuários do sistema
    //so admin pode fazer isso
    public function index() {

        //não tava funcionando, então comentei
        // $users = User::where('id', '<>', Auth::id())->get();

        //fiz esse aqui e funcionou
        $users =\DB::table('users')->where('id','=',Auth::id())->get();

        return view('users.index',[
            'users' => $users
        ]);
    }

    public function defeditPassword(Request $request,$id)
    {//def de editar senha
        $user=User::find($id);

        Gate::authorize('edit-password',$user);

        $request->validate([
            'old_password' => ['required', 'min:8'],
            'password' => ['required', 'min:8','confirmed', Rules\Password::defaults()],
        ]);

        if(Hash::check($_POST['old_password'],$user->password)){
            $user->update([
                'password'=>Hash::make($_POST['password']),
            ]);

            //notificação de senha alterada
            $user->notify(new notifyEditPassword($user));

            return redirect()->route('profile',['user'=>$user->id]);

        }else{
            return back();
        }
    }

    public function editPassword($id)
    {//página de editar senha
        return view('users.editPassword',['user'=>User::find($id)]);
    }

    //definir um usuário como super admin
    public function superAdmin (Request $request, User $user) {        
        
        $this->authorize('superAdmin');        

        $user = User::find($user->id);
        $user->admin = 1;
        $user->save();
        
        return back();

    }

    public function show (Request $request, User $user) {
        return view ('users.show', ['user'=>$user]);
    }

    //editar dados
    public function edit(Request $request, User $user) {
        return view('users.edit', [
            'user'=>$user
        ]);
    }

    //salvar dados editados
    public function update(UserUpdateRequest $request, User $user) {       
        
        //atualizar os dados

        Gate::authorize('edit-profile',$user);

        $user->update([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('profile',['user'=>$user->id]);
    }
}
