<?php

namespace App\Http\Controllers\Web;

use App\Enums\ErrorType;
use App\Services\BookService;
use Illuminate\Http\Request;
use App\Services\GiftService;
use App\Http\Controllers\Web\BaseController;

class HomeController extends BaseController
{
    private $url_domain;
    private $access_key;

    public function __construct()
    {
        $this->access_key = file_get_contents(public_path() . "/access_key.txt");
        $this->url_domain = config('app.url_domain_api') . $this->access_key;
    }

    public function index(Request $request)
    {
        $url = $this->url_domain . '/index.json';

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $this->sendSuccess(json_decode($response), trans('response.success'));
    }

    public function getMovieWithCategorySlug(Request $request, $cateSlug)
    {
        $url = $this->url_domain . '/danh-sach/' . $cateSlug . '.json?';

        if (isset($request->page)) $url .= 'page=' . $request->page . '&';
        if (isset($request->slug)) $url .= 'slug=' . $request->slug . '&';
        if (isset($request->sort_field)) $url .= 'sort_field=' . $request->sort_field . '&';
        if (isset($request->category)) $url .= 'category=' . $request->category . '&';
        if (isset($request->country)) $url .= 'country=' . $request->country . '&';
        if (isset($request->year)) $url .= 'year=' . $request->year . '&';
        
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $this->sendSuccess(json_decode($response), trans('response.success'));
    }

    public function search(Request $request)
    {
        $url = $this->url_domain . '/tim-kiem.json?';

        if (isset($request->page)) $url .= 'page=' . $request->page . '&';
        if (isset($request->keyword)) $url .= 'keyword=' . $request->keyword . '&';

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $this->sendSuccess(json_decode($response), trans('response.success'));
    }

    public function show(Request $request, $slug)
    {
        $url = $this->url_domain . '/phim/'. $slug .'.json?';

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $this->sendSuccess(json_decode($response), trans('response.success'));
    }

    public function createFileAccessKey(Request $request)
    {
        file_put_contents(public_path() . "/access_key.txt", $request->access_key);
        $access_key = file_get_contents(public_path() . "/access_key.txt");

        return $access_key;
    }
}
