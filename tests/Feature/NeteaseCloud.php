<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */


namespace Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Tests\TestCase;

class NeteaseCloud extends TestCase
{
    public function test_example()
    {
        // 从数据库获取数据
        $data = [
            'query' => [
                'id' => '32459197',
                'limit' => 20,
            ],
        ];

        $client = new Client(['verify' => false]);
        try {
            $response = $client->get('https://netease.api.x-lf.cn/artist/songs', $data);

            print_r(json_decode($response->getBody()->getContents()));


            $this->assertTrue(true, "可以访问");
        } catch (GuzzleException $e) {
            echo $e;
            $this->fail("发生错误");
        }
    }
}
