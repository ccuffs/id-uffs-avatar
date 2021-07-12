<?php

namespace App\Cli;

use Illuminate\Support\Facades\Log;

/**
 * 
 */
class SciScraper
{
    protected array $config;
    protected array $requests;

    public function __construct($config)
    {
        $this->config = $config;
    }

    protected function secureLog($cmd)
    {
        $out = preg_replace('/senha=(.*) /i', 'senha=*** ', $cmd);
        Log::info($out);
    }

    protected function runCli($args = '')
    {
        $output = [];
        $code = -1;
        $sci = $this->config['bin'];
        $configPath = $this->config['config_path'];
        $cmd = "$sci $args --config=\"$configPath\"";
        
        $this->secureLog($cmd);

        exec($cmd, $output, $code);

        if ($code != 0) {
            throw new \Exception("Error running sciscrapper (code $code): " . implode("\n", $output));
        }

        return json_decode(implode('', $output));
    }

    protected function runRequests($requests)
    {
        if (count($requests) == 0) {
            throw  new \Exception('Lista de comandos está vazia. Use sci()->usando()->...->get()');
        }

        if (!isset($requests['credenciais'])) {
            throw new \Exception('Credenciais de acesso não informadas. Use sci()->usando()->...');
        }

        $args = '';

        foreach($requests['credenciais'] as $key => $value) {
            $args .= "--$key=\"$value\" ";
        }

        $result = $this->runCli($args);
        return $result;
    }

    public function usando(array $credenciais)
    {
        if (!isset($credenciais['user']) || empty($credenciais['user'])) {
            throw  new \Exception('Nenhum usuário informado nas credenciais. Use sci()->usando(["user" => "...", "password" => "..."])');
        }

        if (!isset($credenciais['password']) || empty($credenciais['password'])) {
            throw  new \Exception('Nenhuma senha informada nas credenciais. Use sci()->usando(["user" => "...", "password" => "..."])');
        }

        $this->requests['credenciais'] = [
            'usuario' => $credenciais['user'],
            'senha' => $credenciais['password'],
        ];

        return $this;
    }

    public function get()
    {
        $result = $this->runRequests($this->requests);
        $this->requests = [];

        return $result;
    }
}