<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;



class CategoryController extends Controller
{
    //get a category
    public function getAll()
    {
        $category = Category::all();
        $respond = [
            'status' => 200,
            'message' => 'get all categories successfully',
            'data' => $category,
        ];

        return $respond;
    }

    //Get Categories by id
    public function getById($id)
    {
        $category = Category::find($id);
        if (isset($category)) {
            $respond = [
                "status" => 200,
                "data" => $category
            ];
            return $respond;
        }
        return $respond = [
            "status" => 404,
            "message" => "category not found"
        ];
    }

    // CREATE A NEW Category
    public function create(Request $request)
    {
        $category = new Category;
        $validation = Validator::make($request->all(), [
            'name' => 'required |string | max:255',
            'description' => 'required |string | max:255',
        ]);

        if ($validation->fails()) {
            $respond = [
                "status" => 401,
                "message" => $validation->errors()->first(),
            ];
            return $respond;
        }

        $category->name =  $request->name;
        $category->description =  $request->description;


        $category->save();
        return $respond = [
            'status' => 200,
            'message' => 'the category is updated',
            'data' => $category
        ];
    }


    //UPDATE AN ADMIN

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (isset($category)) {
            $validation = Validator::make($request->all(), [
                'name' => 'string | max:255',
                'description ' => 'string | max:255',
            ]);

            if ($validation->fails()) {
                $respond = [
                    "status" => 401,
                    "message" => $validation->errors()->first(),
                ];
                return $respond;
            };
            $request->name ? $category->name = $request->name : NULL;
            $request->description ? $category->description = $request->description : NULL;

            $category->save();

            return $respond = [
                'status' => 200,
                'message' => 'the category updated',
                'data' => $category,
            ];
        }
        return $respond = [
            'status' => 404,
            'message' => 'Category not updated',
        ];
    }

    // Delete an admin

    public function delete($id)
    {
        $category = Category::find($id);
        if (isset($category)) {
            $category->delete();
            $respond = [
                'status' => 200,
                'message' => 'Category is deleted',

            ];
            return $respond;
        }
        return $respond = [
            'status' => 404,
            'message' => 'Category not found',
        ];
    }
}
