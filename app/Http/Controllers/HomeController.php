<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Bid;
use App\Models\GeneralData;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $generalData;

    public function __construct()
    {
        $this->generalData = new GeneralData();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin/home');
    }

    public function manageBids()
    {
        $data['bids'] = DB::table('bids')
            ->join('bid_details', 'bids.id', '=', 'bid_details.bid_id')
            ->select('bids.id', 'bids.street', 'bids.city', 'bids.state','bids.zip', 'bids.customer_name', 'bids.customer_phone', 'bids.customer_email', 'bids.status', DB::raw('SUM(bid_details.qty * bid_details.unit_price) as total_price'))
            ->groupBy('bids.id', 'bids.street', 'bids.city', 'bids.state','bids.zip', 'bids.customer_name', 'bids.customer_phone', 'bids.customer_email', 'bids.status')
            ->get();



        //$data['bids'] =  DB::Table('bids')->get();
        return view('admin/manage_bids', ['data' => $data]);
    }

    public function createBid(Request $request)
    {
        $data = [];
        $data['next_ref_id'] = $this->generalData->getNextRefID();

        if ($request->isMethod('post')) {
            $bid_id = DB::table('bids')->insertGetId([
                'user_id' => Auth::user()->id,
                'street' => $request->input('street'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zip' => $request->input('zip')
            ]);


            $service_descriptions = $request->input('service_description');
            $unit_prices = $request->input('unit_price');
            $qtys = $request->input('qty');


            for ($i = 0; $i < count($service_descriptions); $i++) {
                DB::table('bid_details')->insert([
                    'bid_id' => $bid_id,
                    'qty' => (int) $qtys[$i],
                    'service_description' => $service_descriptions[$i],
                    'unit_price' => number_format((float) $unit_prices[$i], 2, '.', ''),
                ]);
            }

            return redirect('/manageBids')->with('success', 'Bid has been added successfully.');
        }

        return view('admin/form_bid', ['data' => $data]);
    }

    public function editBidForm()
    {
        // $data['single_info'] = $this->generalData->getBidinfo($id);
        return view('admin/form_bid');
    }

    public function details($bid_id)
    {
        $data['bid_info'] = $this->generalData->getBidinfo($bid_id);
        $data['bid_services_data'] = DB::Table('bid_details')->where('bid_id', $bid_id)->get();


        $selected_services = [];
        $bid_selected_services = DB::Table('bid_selected_services')->where('bid_id', $bid_id)->get();
        foreach ($bid_selected_services as $bid_selected_service) {
            $selected_services[] = $bid_selected_service->service_id;
        }
        $data['selected_services'] = $selected_services;


        return view('admin/bid_details', ['data' => $data]);
    }



    public function changePin(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->old_pin !=  Auth::user()->pin) {
                return redirect()->back()->with('error', 'Sorry, Current PIN is wrong!');
            }

            if ($request->new_pin !=  $request->confirm_pin) {
                return redirect()->back()->with('error', 'New PIN and Confirm PIN does not match.');
            }

            if ($request->old_pin == $request->new_pin) {
                return redirect()->back()->with('error', 'Old PIN and New PIN is same.');
            }

            //change password here.
            DB::Table('users')->where('id', Auth::user()->id)
                ->update([
                    'pin' => $request->new_pin,
                ]);

            return redirect()->back()->with('success', 'Updated Successfully.');
        }

        return view('admin/change_pin');
    }
}
