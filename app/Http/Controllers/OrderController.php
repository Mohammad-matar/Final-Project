<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    //getall a Order

    public function getAll()
    {
        $order = Order::all();
        $respond = [
            'status' => 200,
            'message' => ' get all Order',
            'data' => $order,
        ];

        return $respond;
    }

    //Get order by id

    public function getById($id)
    {
        $order = Order::find($id);
        if (isset($order)) {
            $respond = [
                "status" => 200,
                "data" => $order
            ];
            return $respond;
        }
        return $respond = [
            "status" => 404,
            "message" => 'order not found'
        ];
    }

    // CREATE A NEW order

    public function create(Request $request)
    {
        $order = new Order;
        $validation = Validator::make($request->all(), [
            'username' => 'required |string | max:255',
            'email' => 'required |string | max:255',
            'location' => 'required | integer | min:1',
            'phone_number' => 'required | integer ',
            'text' => 'required | string | max:255'
        ]);

        if ($validation->fails()) {
            $respond = [
                "status" => 401,
                "message" => $validation->errors()->first(),
            ];
            return $respond;
        }

        $order->username =  $request->username;
        $order->email =  $request->email;
        $order->location =  $request->location;
        $order->phone_number = $request->phone_number;
        $order->text = $request->text;


        $order->save();
        return $respond = [
            'status' => 200,
            'message' => 'the is the new order',
            'data' => $order
        ];
    }

        //Update an order
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (isset($order)) {
            $validation = Validator::make($request->all(), [
                'username' => 'required |string | max:255',
                'email' => 'required |string | max:255',
                'location' => 'required | integer | min:1',
                'phone_number' => 'required | integer ',
                'text' => 'required | string | max:255'
            ]);

            if ($validation->fails()) {
                $respond = [
                    "status" => 401,
                    "message" => $validation->errors()->first(),
                ];
                return $respond;
            };

            $order->username = $request->username;
            $order->email = $request->email;
            $order->location = $request->location;
            $order->phone_number = $request->phone_number;
            $order->text = $request->text;

            $order->save();



            return $respond = [
                'status' => 200,
                'message' => 'the order updated',
                'data' => $order,
            ];
        }
        return $respond = [
            'status' => 404,
            'message' => 'the order isnt updated',
        ];
    }

     // Delete an order

     public function delete($id)
     {
         $order = Order::find($id);
         if (isset($order)) {
             $order->delete();
             $respond = [
                 'status' => 200,
                 'message' => 'order is deleted',
 
             ];
             return $respond;
         }
         return $respond = [
             'status' => 404,
             'message' => 'the order isnt deleted',
         ];
     }
}
