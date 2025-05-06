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

            $data['bid_info'] = DB::Table('bids')
                ->where('id', $ref_id)
                ->where('is_deleted', 0)
                ->first();

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
                        'customer_first_name' => $request->customer_first_name,
                        'customer_last_name' => $request->customer_last_name,
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

            $this->sendMail([
                'customer_first_name' => $request->customer_first_name,
                'customer_last_name' => $request->customer_last_name,
                'customer_phone' => $request->phone,
                'customer_email' => $request->email,
                'status' => $request->action
            ]);
            //when accepted
            if ($request->action == 3) {
                // In admin panel it should show something more.
            }

            if ($request->action == 3 || $request->action == 4) {
                return redirect('/')->with('success', 'Thank you, We will contact you as soon as possible.');
            }

            if ($request->action == 2) {
                return redirect('/')->with('success', 'Thank you. Please reach out if you change your mind.');
            }
        }
        return redirect('/');
    }

    public function sendMail($customer)
    {
        $to = "info@gradeatree.com";
        $subject = "Bid submitted";

        $status = "";
        if ($customer['status'] == 2) {
            $status = "Declined";
        } else if ($customer['status'] == 3) {
            $status = "Accepted";
        } else if ($customer['status'] == 4) {
            $status = "Requested";
        }

       

        $message = "
        <html>
        <head>
        <title>Bid submitted</title>
        </head>
        <body>
        <p>Dear Admin,</p>
        <p>A new bid has been placed on your site.</p>
        <p><b>Status:</b>: $status</p>
        <table>
       
        <tr>
        <td><b>First Name:</b> ". $customer["customer_first_name"] ."</td>
        </tr>
        <tr>
        <td><b>Last Name:</b> ". $customer["customer_last_name"] ."</td>
        </tr>
        <tr>
        <td><b>Phone:</b> ". $customer["customer_phone"] ."</td>
        </tr>
        <tr>
        <td><b>Email:</b> ". $customer["customer_email"] ."</td>
        </tr>

        <tr>
        <td><br><br>Thank you.</td>
        </tr>
        </table>
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <no.reply@gradeatree.com>' . "\r\n";

        mail($to, $subject, $message, $headers);
    }
}
