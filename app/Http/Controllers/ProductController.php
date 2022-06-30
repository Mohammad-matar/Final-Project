<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{       
    //Add a Product

    public function getAll(){
        $product = Product::all();
        $respond = [
            'status'=>200,
            'message'=> 'all product',
            'data'=> $product,
        ];

        return $respond;
    }
     //Get product by id

     public function getById($id){
        $product = Product::find($id);
        if (isset ($product)){
            $respond = [
                "status"=>200,
                "data"=> $product
            ];
            return $respond;
        }
        return 'product not found';
    }

      // CREATE A NEW product

      public function create(Request $request){
        $product = new Product;
        $validation = Validator::make($request-> all(),[
            'name' => 'required |string | max:255',
            'description' => 'required |string | max:255',
            'image' => 'required| mimes:jpeg,jpg,png,gif,svg | max:2048',
            'price'=> 'required | integer | max:100',
            'category_id'=>'required | integer '
        ]);

        if($validation->fails()){
            $respond = [
                "status"=>401,
                "message"=> $validation -> errors()->first(),
            ];
                return $respond;
        }
        
        if ($files = $request->file('image')) {
            $destinantionPath = 'image';
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinantionPath, $profileImage);
        }


        $product -> name =  $request-> name;
        $product -> description =  $request-> description;
        $product -> image = $profileImage;
        $product -> price = $request -> price;
        $product -> category_id = $request->category_id;


        $product-> save();
        return $respond = [
            'status'=> 200,
            'message'=>'the product is updated',
            'data'=>$product
        ];
    }
    //UPDATE AN ADMIN

    public function update(Request $request ,$id){
        $product = Product::find($id);

        if(isset($product)){
            $validation = Validator::make($request-> all(),[
                'product_name' => 'required |string | max:255',
                'product_description' => 'required |string | max:255',
                'picture' => 'required| string',
                'price'=> 'required | integer | max:10',
                'category_id'=>'required | integer '
            ]);

            if($validation->fails()){
                $respond = [
                    "status"=>401,
                    "message"=> $validation -> errors()->first(),
                ];
                    return $respond;
            };
            $request->product_name ? $product->product_name = $request->product_name: NULL;
            $request->product_description ? $product_description->product_description = $request->product_description: NULL;
            $request->picture ? $picture->picture = $request->picture: NULL;
            $request->price ? $price->price = $request->price: NULL;
            $request->category_id ? $category_id->category_id = $request->category_id: NULL;

            $product->save();

            return $respond = [
                'status'=>200,
                'message'=> 'the category updated',
                'data'=> $product,
                ];
        } 
        return 'Product not found';
    }

     // Delete a Product

     public function delete($id){
        $product= Product::find($id);
            if(isset($product)){
                $product->delete();
                $respond=[
                    'status'=> 200,
                    'message' => 'Product is deleted',

                ];
                return $respond;
            }
        return 'product not found';
    }
}
