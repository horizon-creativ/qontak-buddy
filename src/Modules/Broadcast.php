<?php

namespace Horizondoxa\QontakBuddy\Modules;

use Horizondoxa\QontakBuddy\Core\QontakClient;

class Broadcast
{
    protected $client;
    protected $module;

    public function __construct(QontakClient $qontakClient)
    {
        $this->client = $qontakClient;
        $this->module = 'broadcast';
    }

    /**
     * send direct message
     * 
     * @param array $data
     * @return array
     */
    public function sendMessage(array $data)
    {
        return $this->client->request('POST', $this->module . '/whatsapp/direct', ['json' => $data]);
    }

    /**
     * get message log
     * 
     * @param string $messageId
     * @return array
     */
    public function getMessageLog($messageId)
    {
        return $this->client->request('GET', $this->module . '/' . $messageId . 'whatsapp/log');
    }
}
