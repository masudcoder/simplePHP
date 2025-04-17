<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Bid;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
            ->select('bids.id', 'bids.address', 'bids.status', DB::raw('SUM(bid_details.qty * bid_details.unit_price) as total_price'))
            ->groupBy('bids.id', 'bids.address', 'bids.status')
            ->get();

           

        //$data['bids'] =  DB::Table('bids')->get();
        return view('admin/manage_bids', ['data' => $data]);
    }

    public function createBid(Request $request)
    {
        if ($request->isMethod('post')) {
            $bid_id = DB::table('bids')->insertGetId([
                'user_id' => Auth::user()->id,
                'address' => $request->input('address'),
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

        return view('admin/form_bid');
    }

    public function changePin(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->old_pin !=  Auth::user()->pin) {
                return redirect()->back()->with('error', 'Sorry, Old PIN is wrong!');
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
