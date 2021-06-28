<?php

namespace Delta935142\Mitake;

use Illuminate\Support\Str;

class Newsletter
{
    /**
     * re time
     *
     * @var string
     */
    protected static $reTime = '';

    /**
     * vl time
     *
     * @var string
     */
    protected static $vlTime = '';

    /**
     * dest name
     *
     * @var string
     */
    protected static $name = '';

    /**
     * client ID
     *
     * @var string
     */
    protected static $clientId = '';

    /**
     * set re time
     *
     * @param string $time
     * @return Newsletter
     */
    public static function reTime(string $time): Newsletter
    {
        self::$reTime = $time;

        return new self();
    }

    /**
     * set vl time
     *
     * @param string $time
     * @return Newsletter
     */
    public static function vlTime(string $time): Newsletter
    {
        self::$vlTime = $time;

        return new self();
    }

    /**
     * set dest name
     *
     * @param string $name
     * @return Newsletter
     */
    public static function destName(string $name): Newsletter
    {
        self::$name = $name;

        return new self();
    }

    /**
     * set client ID
     *
     * @param string|int $id
     * @return Newsletter
     */
    public static function client($id): Newsletter
    {
        self::$clientId = $id;

        return new self();
    }

    /**
     * 單筆發送
     *
     * @return array
     */
    public static function smSend(string $phone, string $message): array
    {
        $url = config('mitake.url.send').'?CharsetURL='.config('mitake.charset');

        $data = [
            'username' => config('mitake.username'),
            'password' => config('mitake.password'),
            'dstaddr'  => $phone,
            'smbody'   => $message,
        ];

        $data['dlvtime'] = (self::$reTime != '') ? date('YmdHis', strtotime(self::$reTime)) : null;
        $data['vldtime'] = (self::$vlTime != '') ? date('YmdHis', strtotime(self::$vlTime)) : null;

        if (self::$name != '') $data['destname'] = self::$name;
        if (self::$clientId != '') $data['clientid'] = self::$clientId;

        $result = GuzzleHttpClient::setHost($url)
            ->toForm($data, 'post')
            ->get();

        if ($result['success']) {
            $arr = explode("\r\n", $result['contents']);
            $result['contents'] = [
                'msgid'        => Str::after($arr[1], '='),
                'statuscode'   => (int) Str::after($arr[2], '='),
                'AccountPoint' => (int) Str::after($arr[3], '='),
            ];
        }

        return $result;
    }
    

    /**
     * 查詢餘額
     *
     * @return array
     */
    public static function smQuery(): array
    {
        $url = config('mitake.url.query');

        $data = [
            'username' => env('MITAKE_USERNAME', ''),
            'password' => env('MITAKE_PASSWORD', ''),
        ];

        $result = GuzzleHttpClient::setHost($url)
            ->toForm($data, 'post')
            ->get();

        if ($result['success']) {
            $result['contents'] = [
                'AccountPoint' => (int) Str::between($result['contents'], '=', "\r\n")
            ];
        }

        return $result;
    }
}