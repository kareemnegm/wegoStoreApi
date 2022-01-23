<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use App\Models\Store;
use App\Models\SubCategory;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\storeImage;
class ProductController extends Controller
{

use storeImage;

    public function createProduct(Request $request)
    {
        try {
            $user = User::find(Auth::id());
            if ($user == null) {
                return response()->json("wrong credentials", 500);
            } else {
                if ($user->role == Auth::user()->role) {
                    if ($request->has('subcategory_id')) {
                        $subcat = SubCategory::find($request->subcategory_id);
                        if ($subcat == null) {
                            return response()->json('no subcategory found', 406);
                        } else {
                            $check = $subcat->category->store_owner_id;
                            if ($check == Auth::id()) {
                                $storeID = Store::where('store_owner_id', Auth::id())->value('id');
                                $product = Product::create([
                                    'name' => $request->name,
                                    'price' => $request->price,
                                    'SKU' => $request->SKU,
                                    'quantity' => $request->quantity,
                                    'rating_display' => $request->rating_display,
                                    'rating' => $request->rating,
                                    'description' => $request->description,
                                    'specification' => $request->specification,
                                    'detail' => $request->detail,
                                    'created_by' => Auth::id(),
                                    'store_id' => $storeID,
                                    'productExtraAttributes' => json_decode($request->productExtraAttributes, true)
                                ]);
                                $product->subcategory()->attach($request->subcategory_id);
                                $this->imageUpload($request, $product->id);
                                return response()->json($product, 201);
                            } else {
                                return response()->json('not authorized to add products to this subcategory ', 401);
                            }
                        }
                    }
                }
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }


    public function getProduct($id)
    {
        try {
            $product = Product::where('id',$id)->with('images')->get();
            return response()->json($product, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }


    public function addAttributeToProduct($productId, Request $request)
    {
        try {
            $user = User::find(Auth::id());
            if ($user == null) {
                return response()->json('not authorized to edit this product', 401);
            }
            $product = Product::find($productId);
            if ($product->created_by == $user->id) {
                $product->productExtraAttributes = array_merge($product->productExtraAttributes, (json_decode($request->productExtraAttributes, true)));
                $product->save();
                return response()->json($product, 200);
            } else {
                return response()->json('not authorized to edit this product', 401);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
    }


    public function destroy($id)
    {
        $user = User::find(Auth::id());
        if ($user->role == 'storeOwner') {
            $store = Store::where('store_owner_id', $user->id)->exists();
            if ($store == true) {
                $store_id = Store::where('store_owner_id', $user->id)->value('id');
                $product = Product::find($id);
                if ($product == null) {
                    return response()->json('no product found', 404);
                } else {
                    if ($product->store_id == $store_id) {
                        $deleted = $product->delete();
                        if ($deleted == true) {
                            return response()->json('product has been deleted', 200);
                        } else {
                            return response()->json('error', 500);
                        }
                    }
                }
            } else {
                return response()->json(' store dosent exist for this user', 403);
            }
        }
    }
}
