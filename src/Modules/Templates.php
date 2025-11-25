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
        return $this->safeRequest('GET', $this->module . '/whatsapp', ['query' => $params]);
    }

    private function safeRequest($method, $endpoint, $options = [])
    {
        try {
            return $this->client->request($method, $endpoint, $options);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->formatException($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->formatException($e);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return $this->formatException($e);
        } catch (\Throwable $e) {
            // LAST DEFENSE – menangkap semua error fatal
            return [
                'status' => 'error',
                'data'   => null,
                'error' => $e->getMessage()
            ];
        }
    }

    private function formatException($e)
    {
        $status = $e->hasResponse()
            ? $e->getResponse()->getStatusCode()
            : null;

        $body = $e->hasResponse()
            ? json_decode($e->getResponse()->getBody()->getContents(), true)
            : null;

        return [
            'status' => 'error',
            'data'   => null,
            'error' => $body['error']['messages'][0],
        ];
    }
}
