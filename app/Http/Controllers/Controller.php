<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    	{
    	// 54.237.133.81?
    	Request::setTrustedProxies(['127.0.0.1', request()->server->get('REMOTE_ADDR')], Request::HEADER_X_FORWARDED_PROTO);
    	}
}
