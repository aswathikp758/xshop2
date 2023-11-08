<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductStoreRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use DB;

//php artisan storage:link = php artisan storage:link = http://127.0.0.1:8000/storage/1.jpg


class ProductController extends Controller
{
   public function index()
    {
       // All Product
       $products = Product::orderBy('id', 'DESC')->get();

       // Return Json Response
       return response()->json([
          'products' => $products
       ],200);
    }
     public function mobiles()
    {
       // All Product
       $mobiles = Product::where('category','Mobile Phone')->get();

       // Return Json Response
       return response()->json([
          'products' => $mobiles
       ],200);
    }
    public function fashions()
    {
       // All Product
       $fashions = Product::where('category','Fashion')->get();

       // Return Json Response
       return response()->json([
          'fashions' => $fashions
       ],200);
    }
    public function appliances()
    {
       // All Product
       $appliances = Product::where('category','Appliances')->get();

       // Return Json Response
       return response()->json([
          'appliances' => $appliances
       ],200);
    }

    public function store(ProductStoreRequest $request)
    {

        try {

            if($request->image){
                $file= $request->image;
                $filename= date('YmdHi').$request->image->getClientOriginalName();
                $file-> move(public_path('public/Image'), $filename);
                Product::create([
                'name' => $request->name,
                'category'=>$request->category,
                'quantity'=>$request->quantity,
                'price'=>$request->price,
                'image' => $filename,
                'description' => $request->description
            ]);
        }

            // Return Json Response
            return response()->json([
                'message' => "product successfully created."
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
       $product = Product::find($id);
       if(!$product){
         return response()->json([
            'message'=>"Product Not Found"
         ],404);
       }

       // Return Json Response
       return response()->json([
          'product' => $product
       ],200);
    }

    public function update(ProductStoreRequest $request, $id)
    {
         try {
            // Find product
            $product = Product::find($id);
            if(!$product){
              return response()->json([
                'message'=>'Product Not Found.'
              ],404);
            }


            $product->name = $request->name;
            $product->category=$request->category;
            $product->quantity=$request->quantity;
            $product->price=$request->price;
            $product->description = $request->description;

           if($request->image){
                $file= $request->image;
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('public/Image'), $filename);
                $product->image= $filename;
                $product->save();
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
        $product = Product::find($id);
        if(!$product){
          return response()->json([
             'message'=>'Product Not Found.'
          ],404);
        }



        // Delete Product
        $product->delete();

        // Return Json Response
        return response()->json([
            'message' => "Product successfully deleted."
        ],200);
    }


}
