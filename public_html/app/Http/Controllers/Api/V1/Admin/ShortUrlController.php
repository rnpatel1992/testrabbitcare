<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use \Illuminate\Http\Response;

class ShortUrlController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
           
            $listShortUrls = ShortUrl::select('id','origin_url','short_code','expiry_date','total_hits');

            $listShortUrls->orderBy('created_at','desc');

            if($request->has('short_code') && $request->short_code!="") {
                $listShortUrls->where('short_code','like',$request->short_code);
            }
            if($request->has('keyword') && $request->keyword!="") {
                $listShortUrls->where('origin_url','like','%' . $request->keyword . '%' );
            }
            $result = $listShortUrls->paginate(25)->appends(\Request::only(['short_code','keyword']));

            return response()->json([
                'success' => true,
                'data' => [
                    'short_url_list'=>$result
                ]
            ],Response::HTTP_OK);


        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            $short_url = ShortUrl::find($id);
            if($short_url)
            {
                $short_url->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Record deleted successfully!'
                ],Response::HTTP_OK);
            }
            return response()->json([
                'success' => false,
                'message' => 'No record found!'
            ],Response::HTTP_NOT_FOUND);
            


        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ],Response::HTTP_BAD_REQUEST);
        }
    }

}
