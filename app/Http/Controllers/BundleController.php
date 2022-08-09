<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bundle;
use Illuminate\Support\Facades\Validator;


class BundleController extends Controller
{
    //get a bundles
    public function getAll()
    {
        $bundle = Bundle::all();
        $respond = [
            'status' => 200,
            'message' => 'get all bundles successfully',
            'data' => $bundle,
        ];

        return $respond;
    }
    public function getById($id)
    {
        $bundle = Bundle::find($id);
        if (isset($bundle)) {
            $respond = [
                'status' => 200,
                'data' => 'Bundle Found'
            ];
            return $respond;
        }
        return $respond = [
            'status' => 404,
            'message' => 'Bundle Not Found'
        ];
    }

    // CREATE A NEW Bundle
    public function create(Request $request)
    {
        $bundle = new Bundle;
        $validation = Validator::make($request->all(), [
            'name' => 'required |string | max:255',
            'price' => 'required | string',
            'image' => ' string',
        ]);

        if ($validation->fails()) {
            $respond = [
                "status" => 401,
                "message" => $validation->errors()->first(),
            ];
            return $respond;
        }

        $bundle->name =  $request->name;
        $bundle->price =  $request->price;
        $bundle->image =  $request->image;


        $bundle->save();
        return $respond = [
            'status' => 200,
            'message' => 'the bundle is updated',
            'data' => $bundle
        ];
    }

    // Update The Bundle
    public function update(Request $request, $id)
    {
        $bundle = Bundle::find($id);

        if (isset($bundle)) {
            $validation = Validator::make($request->all(), [
                'name' => 'required |string | max:255',
                'price' => 'required | string',
                'image' => ' string',
            ]);

            if ($validation->fails()) {
                $respond = [
                    "status" => 401,
                    "message" => $validation->errors()->first(),
                ];
                return $respond;
            };
            $request->name ? $bundle->name = $request->name : NULL;
            $request->price ? $bundle->price = $request->price : NULL;
            $request->image ? $bundle->image = $request->image : NULL;

            $bundle->save();

            return $respond = [
                'status' => 200,
                'message' => 'bundle is updated',
                'data' => $bundle,
            ];
        }
        return $respond = [
            'status' => 404,
            'message' => 'bundle not updated',
        ];
    }
    // Delete Bundle

    public function delete($id)
    {
        $bundle = Bundle::find($id);
        if (isset($bundle)) {
            $bundle->delete();
            $respond = [
                'status' => 200,
                'message' => 'bundle is deleted',

            ];
            return $respond;
        }
        return $respond = [
            'status' => 404,
            'message' => 'bundle not found',
        ];
    }
}
