<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryStoreRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
       // All Product
       $category = Category::all();

          // Return Json Response
       return response()->json([
          'category' => $category,

       ],200);

    }


    public function store(CategoryStoreRequest $request)
    {
        try {

            if($request->image){
                $file= $request->image;
                $filename= date('YmdHi').$request->image->getClientOriginalName();
                $file-> move(public_path('public/Image'), $filename);


            Category::create([
                'name' => $request->name,
                 'image' => $filename,
            ]);
        }

            // Return Json Response
            return response()->json([
                'message' => "Category successfully created."
            ],200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ],500);
        }
    }

    public function show($id)
    {
       // Product Detail
       $category = Category::find($id);
       if(!$category){
         return response()->json([
            'message'=>"Category Not Found"
         ],404);
       }

       // Return Json Response
       return response()->json([
          'category' => $category
       ],200);
    }

    public function update(CategoryStoreRequest $request, $id)
    {
        try {
            // Find product
            $category = Category::find($id);
            if(!$category){
              return response()->json([
                'message'=>'Category Not Found.'
              ],404);
            }


        $category->name = $request->name;

        if($request->image){
                $file= $request->image;
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('public/Image'), $filename);
                $category->image= $filename;
                $category->save();
               }
            // Return Json Response
            return response()->json([
                'message' => "Product successfully updated."
            ],200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ],500);
        }
    }

    public function destroy($id)
    {
        // Detail
        $category = Category::find($id);
        if(!$category){
          return response()->json([
             'message'=>'Product Not Found.'
          ],404);
        }

        $category->delete();

        // Return Json Response
        return response()->json([
            'message' => "Product successfully deleted."
        ],200);
    }
}
