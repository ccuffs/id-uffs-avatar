<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\IdUFFSAvatarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Avatar extends Controller
{
    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, IdUFFSAvatarService $avatarIdUFFS)
    {
        $credenciais = $request->validate([
            'user' => 'required',
            'password' => 'required',
        ]);

        $user = $avatarIdUFFS->fetch($credenciais);

        return $this->json([
            'uid' => $user->uid,
            'avatar_url' => $user->profile_url
        ]);
    }

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index($uid)
    {
        $user = User::where('uid', $uid)->first();

        if (!$user) {
            return redirect(Storage::url('default.svg'));
        }

        return redirect($user->sci_photo_url);
    }
}
