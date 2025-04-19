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
        $data['service_title'] = ["Tree Removal", "Stump Grinding", "Tree Trimming & Pruning", "Debris Clean Up", "Tree/Plant Healthcare"];
        
        if ($request->isMethod('post')) {
            $data['show_search_result'] = 1;
            $data['search_by'] = $request->ref_id;
            $data['bid_info'] = DB::Table('bids')->where('id', (int)$request->ref_id)->first();
            if (isset($data['bid_info']->id)) {
                $data['bid_services_data'] = DB::Table('bid_details')->where('bid_id', $data['bid_info']->id)->get();
            }
        }
        return view('welcome', ['data' => $data]);
    }

    public function submitBid(Request $request)
    {
        if ($request->action == 3 || $request->action == 4) {
            DB::Table('bids')->where('id', $request->id)->update(['status' => $request->action]);
            //mail("zamanmasudcoder@gmail.com","My subject",  $this->generateMailBody());
            return redirect('/')->with('success', 'Thank you, We\'ll contact you later.');
        }
        return redirect('/');
    }

    public function generateMailBody() {
        $msg = "You\' have Received a New Request! New Bid has been submitted";
    }
}
