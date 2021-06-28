<?php

return [
    
    /**
     * 三竹簡訊使用者帳號
     */
    'username' => env('MITAKE_USERNAME', ''),

    /**
     * 三竹簡訊使用者密碼
     */
    'password' => env('MITAKE_PASSWORD', ''),

    /**
     * 編碼
     */
    'charset'  => 'UTF-8',

    /**
     * API url
     */
    'url' => [

        /**
         * 發送
         */
        'send'  => 'https://smsapi.mitake.com.tw/api/mtk/SmSend',

        /**
         * 查詢
         */
        'query' => 'https://smsapi.mitake.com.tw/api/mtk/SmQuery'
    ],
];