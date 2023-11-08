<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
class CartController extends Controller
{

     public function viewcart($user_id)
    {
       
        $cart = Cart::where('user_id',$user_id)->get();

        if(!$cart){
            return response()->json([
                'message'=>"empty cart"
            ],404);
        }
        return response()->json([
            'cart' => $cart
        ],200);


    }

    public function addtocart(Request $request)
    {
    //    if(auth('sanctum')->check())
       if($request->user_id)
        {
            $user_id=$request->user_id;
            $product_id=$request->product_id;
            $product_qty=$request->product_qty;
            $product_price=$request->product_price;
            $product_status=$request->product_status;

            $productCheck=Product::where('id',$product_id)->first();
            if($productCheck)
            {

               if(Cart::where('product_id',$product_id)->where('user_id',$user_id)->exists())
               {
                   return response()->json([
                    'status'=>409,
                    'message'=>'Already added to cart',
                   ]);
               }
               else{

                   $cartItem=new cart;
                   $cartItem->user_id=$user_id;
                   $cartItem->product_id=$product_id;
                   $cartItem->product_qty=$product_qty;
                   $cartItem->product_price=$product_price;
                   $cartItem->product_status=$product_status;
                   $cartItem->save();
                    return response()->json([
                        'status'=>201,
                        'message'=>'Add to Cart',
                    ]);

            }

            }
            else{

                  return response()->json([
                'status'=>401,
                'message'=>'i am in cart',
            ]);

            }
        }
        // else{
        //     return response()->json([
        //         'status'=>401,
        //         'message'=>'Login to cart',
        //     ]);
        // }
    }
      public function product_cart($user_id)
    {
        $cart = Cart::where('user_id',$user_id)->where('product_status','pending')->get();

        if(!$cart){
            return response()->json([
                'message'=>"empty cart"
            ],404);
        }
        return response()->json([
            'cart' => $cart
        ],200);

    }
     public function show($id)
    {

       $product = Product::find($id);
       if(!$product){
         return response()->json([
            'message'=>"product Not Found"
         ],404);
       }


       return response()->json([
          'product' => $product
       ],200);

    }

   public function update_status(Request $request,$id)
    {
        try {
            // Find product
            $cart = Cart::find($id);
            if($cart){
             $cart->product_qty=$request->product_qty;
             $cart->product_price=$request->product_price;
             $cart->product_status='confirmed';
             $cart->save();
            }

            return response()->json([
                'message' => "Order Confirmed"
            ],200);
            } catch (\Exception $e) {

                return response()->json([
                    'message' => "Something went wrong!"
                ],500);
            }
    }

     public function product_cart2($id)
    {
        $cart = Cart::where('id',$id)->where('product_status','pending')->get();

        if(!$cart){
            return response()->json([
                'message'=>"empty cart"
            ],404);
        }
        return response()->json([
            'cart' => $cart
        ],200);

    }
     public function view_confirmorder()
    {
       // All Product
       $cart = Cart::where('product_status','confirmed')->get();

          // Return Json Response
       return response()->json([
          'cart' => $cart,

       ],200);

    }





}
