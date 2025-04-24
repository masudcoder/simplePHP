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

        if ($request->ref_id) {
            $data['show_search_result'] = 1;
            $data['search_by'] = $request->ref_id;

            if (strlen($request->ref_id) < 6) {
                $ref_id = 0;
            } else {
                $ref_id = (int)$request->ref_id;
            }

            $data['bid_info'] = DB::Table('bids')->where('id', $ref_id)->first();

            //retrieve services data, so far 5 services.
            //retrieve service id that already submitted by customer
            $selected_services = [];
            if (isset($data['bid_info']->id)) {
                $data['bid_services_data'] = DB::Table('bid_details')->where('bid_id', $data['bid_info']->id)->get();
                $bid_selected_services = DB::Table('bid_selected_services')->where('bid_id', $data['bid_info']->id)->get();
                foreach ($bid_selected_services as $bid_selected_service) {
                    $selected_services[] = $bid_selected_service->service_id;
                }
                $data['selected_services'] = $selected_services;
            }

            
        }
        return view('welcome', ['data' => $data]);
    }



    public function submitBid(Request $request)
    {

        if ($request->isMethod('post')) {
            DB::Table('bids')->where('id', $request->id)
                ->update(
                    [
                        'customer_name' => $request->name,
                        'customer_phone' => $request->phone,
                        'customer_email' => $request->email,
                        'status' => $request->action
                    ]
                );


            DB::table('bid_selected_services')->where('bid_id',  $request->id)->delete();

            $selected_services = $request->services ? $request->services : [];
            foreach ($selected_services as $serviceID) {
                DB::Table('bid_selected_services')->insert(
                    [
                        'bid_id' => $request->id,
                        'service_id' => $serviceID
                    ]
                );
            }

            //when accepted
            if ($request->action == 3) {
                // In admin panel it should show something more.
            }

            if ($request->action == 3 || $request->action == 4) {
                //mail("zamanmasudcoder@gmail.com","My subject",  $this->generateMailBody());
                return redirect('/')->with('success', 'Thank you, We will contact you as soon as possible.');
            }

            if ($request->action == 2) {
                return redirect('/')->with('success', 'Thank you. Please reach out if you change your mind.');
            }
        }
        return redirect('/');
    }

    public function generateMailBody()
    {
        $msg = "You\' have Received a New Request! New Bid has been submitted";
    }
}
