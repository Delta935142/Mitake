<?php

namespace Delta935142\Mitake;

use GuzzleHttp\Client;

class GuzzleHttpClient
{
    /**
     * api host
     *
     * @var string
     */
    protected static $host = '';

    /**
     * api path
     *
     * @var string
     */
    protected static $path = '';

    /**
     * header
     *
     * @var string
     */
    protected static $header = '';

    /**
     * timeout 
     * 單位:秒
     *
     * @var integer
     */
    protected static $timeout = 30;

    /**
     * result
     *
     * @var array
     */
    protected static $result = [
        'success'  => true,
        'contents' => ''
    ];

    /**
     * 取得結果
     *
     * @return array
     */
    public static function get(): array
    {
        return static::$result;
    }

    /**
     * set api host
     *
     * @param string $host
     * @return GuzzleHttpClient
     */
    public static function setHost(string $host): GuzzleHttpClient
    {
        static::$host = $host;

        return new self();
    }

    /**
     * set api path
     *
     * @param string $path
     * @return GuzzleHttpClient
     */
    public static function setPath(string $path): GuzzleHttpClient
    {
        static::$path = $path;

        return new self();
    }

    /**
     * set header
     *
     * @param string $header
     * @return GuzzleHttpClient
     */
    public static function setHeader(string $header): GuzzleHttpClient
    {
        static::$header = $header;

        return new self();
    }

    /**
     * set timeout
     *
     * @param string $sconed
     * @return GuzzleHttpClient
     */
    public static function setTimeout(string $sconed): GuzzleHttpClient
    {
        static::$timeout = $sconed;

        return new self();
    }

    /**
     * to form
     *
     * @param array $data
     * @param string $method
     * @return GuzzleHttpClient
     */
    public static function toForm(array $data = [], string $method = 'get'): GuzzleHttpClient
    {
        $client = new Client([
            'base_uri' => static::$host,
            'timeout'  => static::$timeout,
            'verify'   => true
        ]);

        try {
            $response = ($method == 'get')
                ? $client->get(static::$path, ['query' => $data])
                : $client->post(static::$path, ['form_params' => $data]);

            $status = true;
            $contents = $response->getBody()->getContents();
            $contents = is_array(json_decode($contents, true))
                ? json_decode($contents, true)
                : $contents;
        } catch (\Exception $e) {
            $status = false;
            $contents = [
                'httpStatusCode' => $e->getCode(),
                'message'        => $e->getMessage()
            ];
        }

        static::$result = [
            'success'  => $status,
            'contents' => $contents
        ];

        return new self();
    }
}