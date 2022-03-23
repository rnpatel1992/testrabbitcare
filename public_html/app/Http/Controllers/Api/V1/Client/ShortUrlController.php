<?php

namespace App\Http\Controllers\Api\V1\Client;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

   
        try {
            

            //start validation
            $rules = [
                'origin_url' => ['required','url', new BlacklistedUrl],
                'expiry_date' => 'nullable|date_format:Y-m-d H:i:s',
            ];
            $validator = Validator::make($request->all(), $rules);

            //return error response 422 if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' =>$validator->messages()
                ],Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $short_url = new ShortUrl();
            $short_url->origin_url = $request->origin_url;
            $short_url->expiry_date = $request->expiry_date;
            $short_url->short_code = Str::random(8);
            $short_url->save();
            
            $short_url_response = MiscHelper::getShortUrl($short_url->short_code);

            //return success response with 200 
            return response()->json([
                'success' => true,
                'message' => 'Short url generated successfully!',
                'data' => [
                    'short_url'=>$short_url_response
                ]
            ],Response::HTTP_OK);


        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
