<?php

namespace App\Services;

use App\Cli\SciScraper;
use App\Models\User;
use CCUFFS\Auth\AuthIdUFFS;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class IdUFFSAvatarService
{
    protected SciScraper $sci;

    public function __construct(SciScraper $sci)
    {
        $this->sci = $sci;
    }

    /**
     * Busca o avatar de um usuário UFFS utilizando o id uffs.
     * 
     * @param mixed $credenciais
     * 
     * @return \Eloquent\Model usuário com as informações do avatar.
     */
    public function fetch($credenciais)
    {
        $auth = new AuthIdUFFS();
        $info = $auth->login($credenciais);

        if ($info === null) {
            throw ValidationException::withMessages(['idUFFS ou senha inválidos']);
        }

        $user = User::firstOrNew([
            'uid' => $info->uid
        ]);

        $payload = $this->sci->usando($credenciais)->get();

        if (!$payload) {
            throw ValidationException::withMessages(['Problema na obtenção de dados']);
        }

        $image = Http::withOptions(['verify' => false])
                    ->withHeaders(['Cookie' => $payload->cookie])
                    ->get($payload->avatarUrl);

        $imageName = $info->uid . '.jpg';
        Storage::disk('public')->put($imageName, $image);

        $user->sci_photo_url = Storage::url($imageName);
        $user->name = $info->name;
        $user->email = $info->email;
        $user->password = Hash::make($info->pessoa_id);

        $user->save();

        return $user;
    }
}