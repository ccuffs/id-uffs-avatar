<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Support\Facades\SciScraper;

class Avatar extends Controller
{
    /*
    protected function getCredenciais(Entity $entity)
    {
        $data = json_decode($entity->data);
        $scraper = $entity->scrapers->first();

        if(!$scraper) {
            throw new \Exception('Entidade não possui scraper registrado para uso.');
        }

        $credenciais = [
            'usuario' => $scraper->access_user,
            'senha' => $scraper->access_password,
            'matricula' => $data->matricula,
            'scrapper' => $scraper->actor
        ];

        return $credenciais;
    }*/

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *//*
    public function info(Entity $entity)
    {
        $credenciais = $this->getCredenciais($entity);
        $info = SgaScraper::usando($credenciais)->historico()->get();

        return $this->json($info);
    }*/

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *//*
    public function historicoPdf(Entity $entity)
    {
        $credenciais = $this->getCredenciais($entity);
        $info = SgaScraper::usando($credenciais)->historico(true, true)->get();

        return response()->file($info['pdfPath']);
    }*/

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *//*
    public function create($iduffs)
    {
        $credenciais = $this->getCredenciais($entity);
        $info = SgaScraper::usando($credenciais)->historico()->get();

        return $this->json($info);
    }*/

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index($iduffs)
    {
        /*
        $credenciais = $this->getCredenciais($entity);
        $info = SgaScraper::usando($credenciais)->historico()->get();
*/
        return $this->json($iduffs);
    }
}