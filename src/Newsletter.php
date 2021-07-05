<?php

namespace Delta935142\Mitake;

use Illuminate\Support\Str;

class Newsletter
{
    const HOST = 'https://smsapi.mitake.com.tw';
    const CHARSET = 'UTF-8';

    /**
     * re time
     *
     * @var string
     */
    protected $reTime = '';

    /**
     * vl time
     *
     * @var string
     */
    protected $vlTime = '';

    /**
     * dest name
     *
     * @var string
     */
    protected $name = '';

    /**
     * client ID
     *
     * @var string
     */
    protected $clientId = '';

    /**
     * data
     *
     * @var array
     */
    protected $data = [];

    public function __construct()
    {
        $this->data = [
            'username' => config('mitake.username'),
            'password' => config('mitake.password'),
        ];
    }

    /**
     * set re time
     *
     * @param string $time
     * @return Newsletter
     */
    public function reTime(string $time): Newsletter
    {
        $this->reTime = $time;

        return $this;
    }

    /**
     * set vl time
     *
     * @param string $time
     * @return Newsletter
     */
    public function vlTime(string $time): Newsletter
    {
        $this->vlTime = $time;

        return $this;
    }

    /**
     * set dest name
     *
     * @param string $name
     * @return Newsletter
     */
    public function destName(string $name): Newsletter
    {
        $this->name = $name;

        return $this;
    }

    /**
     * set client ID
     *
     * @param string|int $id
     * @return Newsletter
     */
    public function client($id): Newsletter
    {
        $this->clientId = $id;

        return $this;
    }

    /**
     * 單筆發送
     *
     * @return array
     */
    public function smSend(string $phone, string $message): array
    {
        $url = config('mitake.url.send')
            ? config('mitake.url.send').'?CharsetURL='.config('mitake.charset')
            : self::HOST.'/api/mtk/SmSend?CharsetURL='.self::CHARSET;

        $this->data['dstaddr'] = $phone;
        $this->data['smbody'] = $message;
        $this->data['dlvtime'] = ($this->reTime != '') ? date('YmdHis', strtotime($this->reTime)) : null;
        $this->data['vldtime'] = ($this->vlTime != '') ? date('YmdHis', strtotime($this->vlTime)) : null;

        if ($this->name != '') $this->data['destname'] = $this->name;
        if ($this->clientId != '') $this->data['clientid'] = $this->clientId;

        $result = GuzzleHttpClient::setHost($url)
            ->toForm($this->data, 'post')
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
    public function smQuery(): array
    {
        $url = config('mitake.url.query')
            ? config('mitake.url.query')
            : self::HOST.'/api/mtk/SmQuery';

        $result = GuzzleHttpClient::setHost($url)
            ->toForm($this->data, 'post')
            ->get();

        if ($result['success']) {
            $result['contents'] = [
                'AccountPoint' => (int) Str::between($result['contents'], '=', "\r\n")
            ];
        }

        return $result;
    }
}