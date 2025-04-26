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
            ->select('bids.id', 'bids.street', 'bids.city', 'bids.state', 'bids.zip', 'bids.customer_name', 'bids.customer_phone', 'bids.customer_email', 'bids.status', DB::raw('SUM(bid_details.qty * bid_details.unit_price) as total_price'))
            ->groupBy('bids.id', 'bids.street', 'bids.city', 'bids.state', 'bids.zip', 'bids.customer_name', 'bids.customer_phone', 'bids.customer_email', 'bids.status')
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

    public function editBidForm($bid_id)
    {
        $data['bid_info'] = $this->generalData->getBidinfo($bid_id);

        if (empty($data['bid_info'])) {
            return redirect('/manageBids')->with('error', 'Invalid Bid.');
        }
        $data['bid_services_data'] = DB::Table('bid_details')->where('bid_id', $bid_id)->get();

        $selected_services = [];
        $bid_selected_services = DB::Table('bid_selected_services')->where('bid_id', $bid_id)->get();
        foreach ($bid_selected_services as $bid_selected_service) {
            $selected_services[] = $bid_selected_service->service_id;
        }
        $data['selected_services'] = $selected_services;

        return view('admin/edit_bid', ['data' => $data]);
    }

    public function updateBid(Request $request)
    {
        if ($request->isMethod('post')) {

            DB::table('bids')
                ->where('id', $request->id)
                ->update([
                    'street' => $request->input('street'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'zip' => $request->input('zip'),
                    'customer_name' => $request->input('name'),
                    'customer_phone' => $request->input('phone'),
                    'customer_email' => $request->input('email')
                ]);

            $service_descriptions = $request->input('service_description');
            $unit_prices = $request->input('unit_price');
            $qtys = $request->input('qty');
            $bid_row_ids = $request->input('bid_row_id');

            for ($i = 0; $i < count($service_descriptions); $i++) {
                DB::table('bid_details')
                    ->where('id', $bid_row_ids[$i])
                    ->update([
                        'qty' => (int) $qtys[$i],
                        'service_description' => $service_descriptions[$i],
                        'unit_price' => number_format((float) $unit_prices[$i], 2, '.', ''),
                    ]);
            }

            // bid services selected

            if ($request->input('status') !== 1) {
                $selected_services = $request->services ? $request->services : [];
                DB::table('bid_selected_services')->where('bid_id',  $request->id)->delete();
                if ($request->input('name') || $request->input('phone') || $request->input('email')) {
                    foreach ($selected_services as $serviceID) {
                        DB::Table('bid_selected_services')
                            ->insert(
                                [
                                    'bid_id' => $request->id,
                                    'service_id' => $serviceID
                                ]
                            );
                    }
                }
            }

            
        }
        return redirect()->back()->with('success', 'Bid Updated successfully.');
    }


    public function deleteBid(Request $request)
    {
        if ($request->isMethod('post')) {

            if ($request->input('id')) {
                DB::table('bids')->where('id', $request->input('id'))->delete();
                DB::table('bid_details')->where('bid_id', $request->input('id'))->delete();
                DB::table('bid_selected_services')->where('bid_id', $request->input('id'))->delete();
            }
            return redirect('/manageBids')->with('success', 'Bid has been deleted successfully.');
        }
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
