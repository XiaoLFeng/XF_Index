<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

namespace App\Http\Controllers\Function;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Index;
use ErrorException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class Music extends Controller
{

    private array $data;

    public function __construct()
    {
        $data = new Index();
        $this->data = $data->data;
        $this->data['neteaseUserId'] = DB::table('info')->find(23)->data;
        $this->data['neteaseArtistsId'] = DB::table('info')->find(24)->data;
        $this->data['neteaseApi'] = DB::table('info')->find(25)->data;
    }

    protected function viewMusic(): Application|Factory|View
    {
        $this->data['musicArist'] = $this->getArtist();
        $this->data['musicAlbum'] = $this->getArtistAlbum();
        $getMusic = $this->getArtistAllMusic();
        foreach ($this->data['musicAlbum'] as $value) {
            $j = 0;
            try {
                for ($i = 0; $getMusic[$i]['id'] != null; $i++) {
                    if ($getMusic[$i]['album']->id == $value->id) {
                        $this->data['musicMusic'][$value->id][$j] = $getMusic[$i];
                        unset($this->data['musicMusic'][$value->id][$j]['album']);
                        $j++;
                    }
                }
            } catch (ErrorException $e) {
            }
        }
        return view('function.music', $this->data);
    }

    private function getArtist(): array
    {
        // 从数据库获取歌手ID
        $queryData = [
            'query' => [
                'id' => $this->data['neteaseArtistsId'],
            ],
        ];
        $verify = ['verify' => true];
        if ($_SERVER['SERVER_PORT'] != 443) $verify = ['verify' => false];
        $client = new Client($verify);
        try {
            $response = $client->get($this->data['neteaseApi'] . '/artist/detail', $queryData);
            $returnJson = (array)json_decode($response->getBody()->getContents());
            $returnJson = $returnJson['data'];
            unset($returnJson->videoCount);
            unset($returnJson->vipRights);
            unset($returnJson->secondaryExpertIdentiy);
            unset($returnJson->user);
        } catch (GuzzleException $e) {
            $returnJson['code'] = 403;
            $returnJson['Exception'] = json_decode($e);
        }
        return (array)$returnJson;
    }

    private function getArtistAlbum(): array
    {
        // 从数据库获取歌手ID
        $queryData = [
            'query' => [
                'id' => $this->data['neteaseArtistsId'],
            ],
        ];
        $verify = ['verify' => true];
        if ($_SERVER['SERVER_PORT'] != 443) $verify = ['verify' => false];
        $client = new Client($verify);
        try {
            $response = $client->get($this->data['neteaseApi'] . '/artist/album', $queryData);
            $returnJson = (array)json_decode($response->getBody()->getContents());
            // 整理数据
            $returnJson = $returnJson['hotAlbums'];
            for ($i = 0; ; $i++) {
                try {
                    if ($returnJson[$i]->id != null) {
                        unset($returnJson[$i]->artist);
                        unset($returnJson[$i]->songs);
                        unset($returnJson[$i]->paid);
                        unset($returnJson[$i]->onSale);
                        unset($returnJson[$i]->mark);
                        unset($returnJson[$i]->awardTags);
                    }
                } catch (ErrorException $e) {
                    break;
                }
            }
        } catch (GuzzleException $e) {
            $returnJson['code'] = 403;
            $returnJson['Exception'] = json_decode($e);
        }
        return $returnJson;
    }

    protected function apiDemo(): JsonResponse
    {

        return Response::json($this->getArtistAllMusic());
    }

    private function getArtistAllMusic()
    {
        // 从数据库获取歌手ID
        $queryData = [
            'query' => [
                'id' => $this->data['neteaseArtistsId'],
            ],
        ];
        $verify = ['verify' => true];
        if ($_SERVER['SERVER_PORT'] != 443) $verify = ['verify' => false];
        $client = new Client($verify);
        try {
            $response = $client->get($this->data['neteaseApi'] . '/artist/songs', $queryData);
            $returnJson = (array)json_decode($response->getBody()->getContents());
            // 整理数据
            $returnJson = $returnJson['songs'];
            for ($i = 0; ; $i++) {
                try {
                    if ($returnJson[$i]->id != null) {
                        // 时间换算
                        $sec = $returnJson[$i]->dt / 1000;
                        $minute = floor($sec / 60);
                        $second = $sec % 60;
                        $returnJson[$i] = [
                            'album' => $returnJson[$i]->al,
                            'id' => $returnJson[$i]->id,
                            'name' => $returnJson[$i]->name,
                            'duration' => $minute . '分' . $second . '秒',
                            'maxBrLevel' => $returnJson[$i]->privilege->maxBrLevel,
                        ];
                    }
                } catch (ErrorException $e) {
                    break;
                }
            }
        } catch (GuzzleException $e) {
            $returnJson['code'] = 403;
            $returnJson['Exception'] = json_decode($e);
        }
        return $returnJson;
    }

    private function getArtistSingleMusic(int $albumId): array
    {
        $queryData = [
            'query' => [
                'id' => $albumId,
            ],
        ];
        $verify = ['verify' => true];
        if ($_SERVER['SERVER_PORT'] != 443) $verify = ['verify' => false];
        $client = new Client($verify);
        try {
            $response = $client->get($this->data['neteaseApi'] . '/album', $queryData);
            $returnJson = (array)json_decode($response->getBody()->getContents());
            $returnJson = $returnJson['songs'];
            for ($i = 0; ; $i++) {
                try {
                    if ($returnJson[$i]->id != null) {
                        // 时间换算
                        $sec = $returnJson[$i]->dt / 1000;
                        $minute = floor($sec / 60);
                        $second = $sec % 60;
                        $returnJson[$i] = [
                            'id' => $returnJson[$i]->id,
                            'name' => $returnJson[$i]->name,
                            'picUrl' => $returnJson[$i]->al->picUrl,
                            'duration' => $minute . '分' . $second . '秒',
                            'maxBrLevel' => $returnJson[$i]->privilege->maxBrLevel,
                        ];
                    }
                } catch (ErrorException $e) {
                    break;
                }
            }
        } catch (GuzzleException $e) {
            $returnJson['code'] = 403;
            $returnJson['Exception'] = json_decode($e);
        }
        return $returnJson;
    }
}
