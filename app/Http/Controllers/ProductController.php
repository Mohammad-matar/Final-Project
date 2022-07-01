<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //Add a Product

    public function getAll()
    {
        $product = Product::all();
        foreach ($product as $each) {
            $each->category;
        }
        $respond = [
            'status' => 200,
            'message' => 'all product',
            'data' => $product,
        ];

        return $respond;
    }
    //Get product by id

    public function getById($id)
    {
        $product = Product::find($id);
        $product->category;


        if (isset($product)) {
            $respond = [
                "status" => 200,
                "data" => $product
            ];
            return $respond;
        }
        return $respond = [
            "status" => 404,
            "message" => 'Product Not Found'
        ];
    }
    public function getByCategory($id)
    {
        $product = Product::whereRelation("category", "id", $id)->get();
        foreach ($product as $each) {
            $each->category;
        }


        if (isset($product)) {
            $respond = [
                "status" => 200,
                "data" => $product
            ];
            return $respond;
        }
        return $respond = [
            "status" => 404,
            "message" => 'Product Not Found'
        ];
    }

    // CREATE A NEW product

    public function create(Request $request)
    {
        $product = new Product;
        $validation = Validator::make($request->all(), [
            'name' => 'required |string | max:255',
            'description' => 'required |string | max:255',
            'image' => 'required| mimes:jpeg,jpg,png,gif,svg | max:2048',
            'price' => 'required | integer | max:100',
            'category_id' => 'required | integer '
        ]);

        if ($validation->fails()) {
            $respond = [
                "status" => 401,
                "message" => $validation->errors()->first(),
            ];
            return $respond;
        }

        if ($files = $request->file('image')) {
            $destinantionPath = 'image';
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinantionPath, $profileImage);
        }


        $product->name =  $request->name;
        $product->description =  $request->description;
        $product->image = $profileImage;
        $product->price = $request->price;
        $product->category_id = $request->category_id;


        $product->save();
        return $respond = [
            'status' => 200,
            'message' => 'the is the new product',
            'data' => $product
        ];
    }
    //UPDATE A product

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (isset($product)) {
            $validation = Validator::make($request->all(), [
                'name' => 'required |string | max:255',
                'description' => 'required |string | max:255',
                'image' => 'required | string',
                'price' => 'required | integer | min:1',
                'category_id' => 'required | integer '
            ]);

            if ($validation->fails()) {
                $respond = [
                    "status" => 401,
                    "message" => $validation->errors()->first(),
                ];
                return $respond;
            };

            $product->name = $request->name;
            $product->description = $request->description;
            $product->image = $request->image;
            $product->price = $request->price;
            $product->category_id = $request->category_id;

            $product->save();



            return $respond = [
                'status' => 200,
                'message' => 'the category updated',
                'data' => $product,
            ];
        }
        return $respond = [
            'status' => 404,
            'message' => 'the product isnt updated',
        ];
    }

    // Delete a Product

    public function delete($id)
    {
        $product = Product::find($id);
        if (isset($product)) {
            $product->delete();
            $respond = [
                'status' => 200,
                'message' => 'Product is deleted',

            ];
            return $respond;
        }
        return $respond = [
            'status' => 404,
            'message' => 'the product isnt deleted',
        ];
    }
}
