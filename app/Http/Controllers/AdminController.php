<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;


class AdminController extends Controller
{
    //Get All Admins
    public function getadmin()
    {
        $admin = Admin::orderBy('username')->get();
        $respond = [
            "status" => 200,
            "message" => "Get all admins successfully",
            "data" => $admin
        ];
        return $respond;
    }

    //Get Admins by id
    public function getById($id)
    {
        $admin = Admin::find($id);
        if (isset($admin)) {
            $respond = [
                "status" => 200,
                "message" => "Get admin successfully",
                "data" => $admin
            ];
            return $respond;
        }
        return $respond = [
            "status" => 404,
            "message" => "Admin not found",
        ];
    }

    // CREATE A NEW ADMIN
    public function create(Request $request)
    {
        $admin = new Admin;
        $validation = Validator::make($request->all(), [
            'username' => 'required |string | max:255',
            // badna l email => badna ye required wou | shakel email wou |unique mne : table admins wel row email,
            'password' => 'required | string | min:6',
        ]);

        if ($validation->fails()) {
            $respond = [
                "status" => 401,
                "message" => $validation->errors()->first(),
            ];
            return $respond;
        }

        $admin->username =  $request->username;
        $admin->password = Hash::make($request->password);
        $admin->save();

        $respond = [
            "status" => 200,
            "message" => "Admin added successfully",
            "data" => $admin
        ];
        return $respond;
    }

    //UPDATE AN ADMIN
    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);

        if (isset($admin)) {
            $validation = Validator::make($request->all(), [
                'username' => 'string | max:255',
                'password' => 'confirmed',
            ]);

            if ($validation->fails()) {
                $respond = [
                    "status" => 401,
                    "message" => $validation->errors()->first(),
                ];
                return $respond;
            };
            $request->username ? $admin->username = $request->username : NULL;
            $request->password ? $admin->password = Hash::make($request->password) : NULL;
            $admin->save();

            return $respond = [
                'status' => 200,
                'message' => 'The profile is updated - badawi nose is big',
                'data' => $admin,
            ];
        }
        return $respond = [
            'status' => 404,
            'message' => 'Admin not found',
        ];
    }

    // Delete an admin
    public function delete($id)
    {
        $admin = Admin::find($id);
        if (isset($admin)) {
            $admin->delete();
            $respond = [
                'status' => 200,
                'message' => 'Admin is deleted',
            ];
            return $respond;
        }
        return $respond = [
            'status' => 404,
            'message' => 'Admin not found',
        ];;
    }
}
