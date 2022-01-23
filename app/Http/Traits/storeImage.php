<?php

namespace App\Http\Traits;

use App\Models\Image;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

trait storeImage
{

    public function imageUpload(Request $request, $productId)
    {
        try {
            if ($request->hasFile('image')) {

                $imageNameArr = [];
                for ($i = 0; $i < count($request->image); $i++) {
                    // you can also use the original name

                    $imageName = time() . '-' . $request->image[$i]->getClientOriginalName();
                    $imageNameArr[] = $imageName;
                    // Upload request->image[i] to public path e images directory
                    $request->image[$i]->move(str_replace('\\', '/', public_path('images')), $imageName);
                    // Database operation

                    $image = new Image();
                    $image->product_id = $productId;
                    $image->path = $imageName;
                    $image->save();

                }

                if ($request->hasFile('product_display')) {

                    $requestDisplayImage = [$request->product_display];
                    $imageNameArr = [];
                    for ($i = 0; $i < count($requestDisplayImage); $i++) {
                        // you can also use the original name

                        $imageName = time() . '-' . $requestDisplayImage[$i]->getClientOriginalName();
                        $imageNameArr[] = $imageName;
                        // Upload request->image[i] to public path e images directory
                        $requestDisplayImage[$i]->move(str_replace('\\', '/', public_path('images')), $imageName);
                        // Database operation

                        $imageDisplay = new Image();
                        $imageDisplay->product_id = $productId;
                        $imageDisplay->path = $imageName;
                        $imageDisplay->save();
                        $product = Product::find($productId);
                        $product->product_display = $imageDisplay->id;
                        $product->save();
                    }
                }

            }




            return;
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
