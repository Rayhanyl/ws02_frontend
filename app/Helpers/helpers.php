<?php

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

function getToken()
{
    return session()->get('token');
}

function getUrlApi()
{
    $url = env('APP_API');
    return $url;
}

function getUrlRegis()
{
    $url = env('APP_API_REGISTER');
    return $url;
}

function getUrlEmail()
{
    $url = env('GET_USER');
    return $url;
}

function getUrlCode()
{
    $url = env('GET_CON_CODE');
    return $url;
}

function getUrlLogin()
{
    $url = env('APP_API_LOGIN');
    return $url;
}

function getUrl($url)
{
    $response = Http::withOptions(['verify' => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.session()->get('token'),
            'Accept' => 'application/json',
        ])
        ->get($url);
    if($response->status() == 200){
        return json_decode($response->getBody()->getContents());
    }
    return [];
}

function getUrlmail($url)
{
        $response = Http::withBasicAuth('admin', 'admin')
        ->withOptions(['verify' => false])
        ->withHeaders([
            'Authorization' => 'Basic YWRtaW46YWRtaW4=',
            'Accept' => 'application/json',
        ])
        ->get($url);
    if($response->status() == 200){
        return json_decode($response->getBody()->getContents());
    }
    return [];
}