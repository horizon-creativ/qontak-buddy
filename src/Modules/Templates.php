<?php

namespace Horizondoxa\QontakBuddy\Modules;

use Horizondoxa\QontakBuddy\Core\QontakClient;

class Templates
{
    protected $client;
    protected $module;

    public function __construct(QontakClient $qontakClient)
    {
        $this->client = $qontakClient;
        $this->module = 'templates';
    }

    /**
     * get template list
     * 
     * @param array $params
     * @return array
     */
    public function getTemplates($params)
    {
        return $this->client->request('GET', $this->module . '/whatsapp', ['query' => $params]);
    }
}
