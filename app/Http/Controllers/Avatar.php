<?php

namespace App\Http\Controllers;

use App\Cli\SciScraper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use CCUFFS\Auth\AuthIdUFFS;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Avatar extends Controller
{
    protected SciScraper $sci;

    public function __construct(SciScraper $sci)
    {
        $this->sci = $sci;
    }

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $credenciais = $request->validate([
            'user' => 'required',
            'password' => 'required',
        ]);

        $auth = new AuthIdUFFS();
        $info = $auth->login($credenciais);

        if ($info === null) {
            return abort(401, 'Invalid idUFFS or password');
        }

        $user = User::firstOrNew([
            'uid' => $info->uid
        ]);

        $payload = $this->sci->usando($credenciais)->get();

        $image = Http::withOptions(['verify' => false])
                    ->withHeaders(['Cookie' => $payload->cookie])
                    ->get($payload->avatarUrl);

        $imageName = $info->uid . '.jpg';
        Storage::disk('public')->put($imageName, $image);

        $user->sci_photo_url = Storage::url($imageName);
        $user->name = $info->name;
        $user->email = $info->email;
        $user->password = Crypt::encryptString($info->pessoa_id);
        $user->save();

        return $this->json([
            'uid' => $user->uid,
            'avatar_url' => $user->sci_photo_url
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
