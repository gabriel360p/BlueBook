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

class NotificationController extends Controller
{
    // // ------------------------------------ Páginas // //
    
    public function notificationsIndex()
    {   
        $notificationUnread=Auth::user()->unreadNotifications;
        $notificationRead=Auth::user()->readNotifications;
        // dd($notificationUnread);

        return view('notifications.notificationsIndex',['notificationUnread'=>$notificationUnread,'notificationRead'=>$notificationRead]);   
    }


    // // ------------------------------------ Rotas def // //

    public function defReadNotifications()
    {   
        $notificationUnread=Auth::user()->unreadNotifications->markAsRead();
        return redirect()->route('notifications');
    }

    public function defDeleteNotifications()
    {   
        $notificationUnread=Auth::user()->notifications()->delete();
        return redirect()->route('notifications');
    }
}
