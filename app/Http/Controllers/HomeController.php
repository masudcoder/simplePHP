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
        $data['bids'] =  DB::Table('bids')->get();
        return view('admin/manage_bids', ['data' => $data]);
    }

    public function createBid(Request $request)
    {
        if ($request->isMethod('post')) {
            $bid_id = DB::table('bids')->insertGetId([
                'user_id' => Auth::user()->id,
                'ref_id' => $request->input('ref_id'),
                'address' => $request->input('address'),
            ]);


            $service_descriptions = $request->input('service_description');
            $unit_prices = $request->input('unit_price');
            $qtys = $request->input('qty');

            for ($i = 0; $i < count($service_descriptions); $i++) {
                DB::table('bid_details')->insert([
                    'bid_id' => $bid_id,
                    'qty' => $qtys[$i],
                    'service_description' => $service_descriptions[$i],
                    'unit_price' => $unit_prices[$i],
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
            //change password here.
            //return redirect()->back()->with('success', 'Updated Successfully.');
        }

        return view('admin/change_pin');
    }
}
