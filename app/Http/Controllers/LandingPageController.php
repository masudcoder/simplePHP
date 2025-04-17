<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;


class LandingPageController extends Controller
{

    public function index(Request $request)
    {
        $data = [];
        if ($request->isMethod('post')) {
            $id = (int) ltrim($request->ref_id, '0');
            
            if ($id) {
                $data['bid_info'] = DB::Table('bids')->where('id', $id)->first();
                if (isset($data['bid_info']->id)) {
                    $data['bid_services_data'] = DB::Table('bid_details')->where('bid_id', $data['bid_info']->id)->get();
                }
            }
        }
        return view('welcome', ['data' => $data]);
    }

    public function submitBid(Request $request) {
        if($request->action == 3 || $request->action == 4)
        {
            DB::Table('bids')->where('id', $request->id) ->update(['status' => $request->action]);
            return redirect('/')->with('success', 'Thank you, We\'ll contact you later.');
        }
        return redirect('/');
    }
}
