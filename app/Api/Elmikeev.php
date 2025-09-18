<?php

namespace App\Api;

use App\Models\Incomes;
use App\Models\Orders;
use App\Models\Sales;
use App\Models\Stocks;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Elmikeev
{
    private static $key = 'E6kUTYrYwZq2tN4QEtyzsbEBk3ie';
    private static $host = '109.73.206.144:6969';
    public static function get_orders()
    {
        $client = new Client();
        $date_from = '1970-01-01';
        $date_to = now()->format('Y-m-d H:i:s');

        $response = $client->get('http://'.self::$host.'/api/orders?dateFrom='.$date_from.'&dateTo='.$date_to.'&page=1&key='.self::$key);

        if($response->getStatusCode() != 200)
            return $response->getReasonPhrase();

        $response = json_decode($response->getBody()->getContents(), true);

        $last_page = $response['meta']['last_page'];

        DB::beginTransaction();

        try {

            Orders::insert($response['data']);

            for($page = 2; $page <= $last_page; $page++){
                $response = $client->get('http://'.self::$host.'/api/orders?dateFrom='.$date_from.'&dateTo='.$date_to.'&page='.$page.'&key='.self::$key);
                $response = json_decode($response->getBody()->getContents(), true);
                Orders::insert($response['data']);
                sleep(1);
            }
            DB::commit();
        } catch (\Exception $e) {
            return $e->getMessage();
            DB::rollBack();
        }
    }
    public static function get_sales()
    {
        $client = new Client();
        $date_from = '1970-01-01';
        $date_to = now()->format('Y-m-d H:i:s');

        $response = $client->get('http://'.self::$host.'/api/sales?dateFrom='.$date_from.'&dateTo='.$date_to.'&page=1&key='.self::$key);

        if($response->getStatusCode() != 200)
            return $response->getReasonPhrase();

        $response = json_decode($response->getBody()->getContents(), true);

        $last_page = $response['meta']['last_page'];

        DB::beginTransaction();

        try {

            Sales::insert($response['data']);

            for($page = 2; $page <= $last_page; $page++){
                $response = $client->get('http://'.self::$host.'/api/sales?dateFrom='.$date_from.'&dateTo='.$date_to.'&page='.$page.'&key='.self::$key);
                $response = json_decode($response->getBody()->getContents(), true);
                Sales::insert($response['data']);
                sleep(1);
            }
            DB::commit();
        } catch (\Exception $e) {
            return $e->getMessage();
            DB::rollBack();
        }
    }
    public static function get_stocks()
    {
        $client = new Client();
        $date_from = now()->format('Y-m-d');

        $response = $client->get('http://'.self::$host.'/api/stocks?dateFrom='.$date_from.'&page=1&key='.self::$key);

        if($response->getStatusCode() != 200)
            return $response->getReasonPhrase();

        $response = json_decode($response->getBody()->getContents(), true);

        $last_page = $response['meta']['last_page'];

        dd(Stocks::insert($response['data']));

        DB::beginTransaction();

        try {

            Stocks::insert($response['data']);

            for($page = 2; $page <= $last_page; $page++){
                $response = $client->get('http://'.self::$host.'/api/stocks?dateFrom='.$date_from.'&page='.$page.'&key='.self::$key);
                $response = json_decode($response->getBody()->getContents(), true);
                Stocks::insert($response['data']);
                sleep(1);
            }
            DB::commit();
        } catch (\Exception $e) {
            return $e->getMessage();
            DB::rollBack();
        }
    }
    public static function get_incomes()
    {
        $client = new Client();
        $date_from = '1970-01-01';
        $date_to = now()->format('Y-m-d');

        $response = $client->get('http://'.self::$host.'/api/incomes?dateFrom='.$date_from.'&dateTo='.$date_to.'&page=1&key='.self::$key);

        if($response->getStatusCode() != 200)
            return $response->getReasonPhrase();

        $response = json_decode($response->getBody()->getContents(), true);

        $last_page = $response['meta']['last_page'];

        DB::beginTransaction();

        try {

            Incomes::insert($response['data']);

            for($page = 2; $page <= $last_page; $page++){
                $response = $client->get('http://'.self::$host.'/api/incomes?dateFrom='.$date_from.'&dateTo='.$date_to.'&page='.$page.'&key='.self::$key);
                $response = json_decode($response->getBody()->getContents(), true);
                Incomes::insert($response['data']);
                sleep(1);
            }
            DB::commit();
        } catch (\Exception $e) {
            return $e->getMessage();
            DB::rollBack();
        }
    }
}
