<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\UserUtility;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function initSession()
    {
        $util = UserUtility::where('slug','request_counts')->where('user_id',auth()->id())->sum('value');
        if(!empty($util))
            session()->put(['requestCount'=>$util]);
        else
            session()->forget('requestCount');
    }
}
