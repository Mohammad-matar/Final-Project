<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;



class CategoryController extends Controller
{        //get a category

    public function getAll(){
        $category = Category::all();
        $respond = [
            'status'=>200,
            'message'=> 'all categories',
            'data'=> $category,
        ];

        return $respond;
    }

        //Get Categories by id

    public function getById($id){
        $category = Category::find($id);
        if (isset ($category)){
            $respond = [
                "status"=>200,
                "data"=> $category
            ];
            return $respond;
        }
        return 'not found';
    }

        // CREATE A NEW Category

    public function create(Request $request){
        $category = new Category;
        $validation = Validator::make($request-> all(),[
            'category_name' => 'required |string | max:255',
            'category_description' => 'required |string | max:255',
        ]);

        if($validation->fails()){
            $respond = [
                "status"=>401,
                "message"=> $validation -> errors()->first(),
            ];
                return $respond;
        }

        $category-> category_name =  $request-> category_name;
        $category-> category_description =  $request-> category_description;


        $category-> save();
        return $respond = [
            'status'=> 200,
            'message'=>'the category is updated',
            'data'=>$category
        ];
    }


    //UPDATE AN ADMIN

    public function update(Request $request ,$id){
        $category = Category::find($id);

        if(isset($category)){
            $validation = Validator::make($request-> all(),[
                'category_name' => 'string | max:255',
                'category_description ' => 'string | max:255',
            ]);

            if($validation->fails()){
                $respond = [
                    "status"=>401,
                    "message"=> $validation -> errors()->first(),
                ];
                    return $respond;
            };
            $request->category_name ? $category->category_name = $request->category_name: NULL;
            $request->category_description ? $category->category_description = $request->category_description: NULL;

            $category->save();

            return $respond = [
                'status'=>200,
                'message'=> 'the category updated',
                'data'=> $category,
                ];
        } 
        return 'Admin not found';
    }

         // Delete an admin

    public function delete($id){
        $category= Category::find($id);
            if(isset($category)){
                $category->delete();
                $respond=[
                    'status'=> 200,
                    'message' => 'Category is deleted',

                ];
                return $respond;
            }
        return 'Admin not found';
    }
    }