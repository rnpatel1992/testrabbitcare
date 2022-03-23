<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use \Illuminate\Http\Response;
use App\Rules\BlacklistedUrl;
use MiscHelper;

class ShortUrlController extends Controller
{
    /**
     * FInd url from database based on given short_code and 301 redirect to the url, 404 if not found, 410 for deleted.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $short_code
     * @return \Illuminate\Http\Response
     */
    public function redirectOrigin(Request $request,$short_code)
    {

        $short_url = ShortUrl::where('short_code',$short_code)->first();
        if($short_url && $short_url->exists())
        {
            if($short_url->expiry_date->isFuture())
            {
                $short_url->increment('total_hits');            
                return redirect($short_url->origin_url, Response::HTTP_FOUND);    
            }
            else
            {
                return abort(Response::HTTP_GONE, 'Expired');
            }
            
        }
        else
        {
            $deleted_short_url = ShortUrl::withTrashed()->where('short_code',$short_code)->first();
            if($deleted_short_url && $deleted_short_url->exists())
            {
                return abort(Response::HTTP_GONE, 'Deleted');
            }   
        }

        return abort(Response::HTTP_NOT_FOUND);
    }
}
