<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class paypalController extends Controller
{
    public function index(){

        return view('products.welcome');
    }
    
    public function payment(){

        $data=[];
        $data['items']=[
            [
            'name'=>'Apple',
            'price'=>100,
            'description'=>'Macbook pro 14 inch',
            'qty'=>1
            ]

        ];
        $data['invoice_id']=1;
        $data['invoice_description']="order Invoice";
        $data['return_url']=route('sucess');
        $data['cancel_url']=route('cancel');
        $data['total']=100;

        $provider=new ExpressCheckout;
        $response = $provider->setExpressCheckout($data);
        $response = $provider->setExpressCheckout($data,true);
        return redirect($response['paypal_link']);
    }
    public function cancel(){

        dd('you are canceled this payment');
    }

    public function sucess(Request $request){
        $provider=new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        if(in_array(strtoupper($response['ACK']),['SUCCESS','SUCCESSWITHWARNING'])){
           dd('your payment with successfully');
        }
        dd("please try again later");
    }
}
