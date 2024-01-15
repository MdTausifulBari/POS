<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function createCategory(Request $request){

        try{
            $request->validate([
                "name" => "required|string|min:2|max:50",
            ]);

            $user_id = Auth::id();

            Category::create([
                "name" => $request->input("name"),
                "user_id" => $user_id
            ]);

            return response()->json([
                "status" => "success",
                "message" => "New Category is created."
            ]);

        }catch(Exception $exception){
            return response()->json([
                "status" => "fail",
                "message" => $exception->getMessage()
            ]);
        }

    }


    public function updateCategory(Request $request){

        try{
            $request->validate([
                "name" => "required|string|min:2|max:50",
                "id" => "required|string|min:1"
            ]);

            Category::where("id", $request->input("id"))->where("user_id", Auth::id())->update([
                "name" => $request->input("name")
            ]);

            return response()->json([
                "status"=> "success",
                "message" => "Category name is updated."
            ]);

        }catch(Exception $exception){
            return response()->json([
                "status"=> "fail",
                "message" => $exception->getMessage()
            ]);
        }

    }


    public function deleteCategory(Request $request){

        try{
            $request->validate([
                "id" => "required|string|min:1"
            ]);

            Category::where("id", $request->input("id"))->where("user_id", Auth::id())->delete();

            return response()->json([
                "status"=> "success",
                "message" => "Category delete Successful."
            ]);

        }catch(Exception $exception){
            return response()->json([
                "status"=> "fail",
                "message" => $exception->getMessage()
            ]);
        }

    }


    public function categoryById(Request $request){

        try{
            $request->validate([
                "id" => "required|string|min:1"
            ]);

            $category_id = $request->input("id");

            $rows = Category::where("id", $category_id)->where("user_id", Auth::id())->first();

            return response()->json([
                "status"=> "success",
                "message" => "Operation Successful.",
                "rows" => $rows
            ]);

        }catch(Exception $exception){
            return response()->json([
                "status"=> "fail",
                "message" => $exception->getMessage()
            ]);
        }

    }


    public function categoryList(Request $request){

        try{
            $user_id = Auth::id();

            $rows = Category::where("user_id", $user_id)->get();

            return response()->json([
                "status"=> "success",
                "message"=> "Operation Successful.",
                "rows"=> $rows
            ]);

        }catch(Exception $exception){
            return response()->json([
                "status"=> "success",
                "message"=> $exception->getMessage()
            ]);
        }

    }
}
