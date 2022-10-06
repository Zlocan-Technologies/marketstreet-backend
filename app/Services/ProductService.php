<?php 

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    DB, 
    Http, 
    Crypt, 
    Hash, 
    Mail
};
use App\Util\{
    CustomResponse,
};
use App\Http\Resources\{
    ProductResource
};
use App\Http\Requests\{
    CreateProduct, 
    ReviewProduct
};
use App\Models\{
    User, 
    Product, 
    Category, 
    Order, 
    Review, 
    ProductImage
};


class ProductService
{
    public function show($id)
    {
        $product = Product::find($id);
        if(!$product) return CustomResponse::error('Product not found', 404);

        $message = "Product Details:";
        $product = new ProductResource($product);
        return CustomResponse::success($message, $product);
    }

    public function store(CreateProduct $request)
    {
        $product = Product::create([
            'seller_id' => auth()->user()->id,
            'category_id' => $request['category_id'],
            'name' => $request['name'],
            'brand' => $request['brand'],
            'quantity' => isset($request['quantity']) ? $request['quantity'] : NULL,
            'price' => $request['price'],
            'description' => $request['description'],
            'shipping_cost' => $request['shipping_cost'],
            'is_negotiable' => $request['is_negotiable']
        ]);

        
        if($request->hasFile('image')):
            $image = $request->file('image');
            foreach($image as $photo):
                $response = \Cloudinary\Uploader::upload($photo);
                $url = $response["url"];
                ProductImage::create([
                    'url' => $url,
                    'product_id' => $product->id
                ]);
            endforeach;
        endif;

        $message = "Product has been created";
        $product = Product::without('reviews', 'owner')->where([
            'id' => $product->id
        ])->first();
        return CustomResponse::success($message, $product);
    }

    public function dropship(CreateProduct $request)
    {
        $product = Product::create([
            'seller_id' => auth()->user()->id,
            'category_id' => $request['category_id'],
            'name' => $request['name'],
            'brand' => $request['brand'],
            'quantity' => isset($request['quantity']) ? $request['quantity'] : NULL,
            'price' => $request['price'],
            'description' => $request['description'],
            'shipping_cost' => $request['shipping_cost'],
            'is_negotiable' => $request['is_negotiable']
        ]);

        $images = $product->images()->pluck('url');
        foreach($images as $url):
            ProductImage::create([
                'url' => $url,
                'product_id' => $product->id
            ]);
        endforeach;

        $message = "Product has been created";
        $product = Product::without('reviews', 'owner')->where([
            'id' => $product->id
        ])->first();
        return CustomResponse::success($message, $product);
    }

    public function update(CreateProduct $request, $id)
    {
        $product = Product::find($id);
        if(!$product) return CustomResponse::error('Product not found', 404);

        $product->update([
            'category_id' => $request['category_id'],
            'name' => $request['name'],
            'brand' => $request['brand'],
            'quantity' => isset($request['quantity']) ? $request['quantity'] : NULL,
            'price' => $request['price'],
            'description' => $request['description'],
            'shipping_cost' => $request['shipping_cost'],
            'is_negotiable' => $request['is_negotiable']
        ]);

        $images = $product->images()->pluck('url');
        foreach($images as $image):
            $parts = explode('/', $image);
            $count = count($parts);
            $publicId = explode('.', $parts[$count - 1]);
            $response = \Cloudinary\Uploader::destroy($publicId[0]);
        endforeach;
        $product->images()->delete();

        if($request->hasFile('image')):
            $image = $request->file('image');
            foreach($image as $photo):
                $response = \Cloudinary\Uploader::upload($photo);
                $url = $response["url"];
                $product->images()->create([
                    'url' => $url
                ]);
            endforeach;
        endif;

        $message = "Product has been updated";
        return CustomResponse::success($message, $product->fresh());
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if(!$product) return CustomResponse::error('Product not found', 404);

        foreach($product->images as $image):
            $image->delete();
        endforeach;
        $product->delete();
        $message = "Product deleted";
        return CustomResponse::success($message, null);
    }

    public function getCategories()
    {
        $categories = Category::all();
        return CustomResponse::success("Categories:", $categories);
    }

    public function createCategories(Request $request)
    {
        /*foreach($request->category as $category){
            DB::table('categories')
            ->insert([
                "name" => $category,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        $categories = Category::create([
            'name' => $request['name'],
            'slug' => isset($request['slug']) ? $request['slug'] : NULL,
            'image' => '',
            'description' => ''
        ]);*/

        return CustomResponse::success("Categories:", NULL);
    }

    public function review(ReviewProduct $request, $id)
    {
        $user = auth()->user();
        try{
            $review = Review::create([
                'user_id' => $user->id,
                'name' => $user->firstname.' '.$user->lastname,
                'product_id' => $id,
                'text' => $request['text'],
                'rating' => $request['rating']
            ]);

            $owner = Product::find($id)->owner;
            if($request['text']):
                $reviews = $owner->profile->reviews + 1;
                $owner->profile()->update([
                    'reviews' => $reviews
                ]);
            endif;

        }catch(\Exception $e){
            $message = $e->getMessage();
            return CustomResponse::error($message);
        }
        
        return CustomResponse::success("successful", $review);
    }

    public function getProducts($categoryId)
    {
        $category = Category::find($categoryId);
        if(!$category) return CustomResponse::error('Category not found', 404);

        $products = $category->products;
        return CustomResponse::success("Products:", $products);
    }

    public function FetchAllStoreProducts()
    {
        $products = Product::without('reviews', 'owner')->get();
        return CustomResponse::success("Products:", $products);
    }

    public function getAllUserProducts($userId)
    {
        $products = Product::with('category')
        ->without('reviews', 'owner')
        ->where([
            'seller_id' => $userId
        ])->get();
        return CustomResponse::success("Products:", $products);
    }

    public function addProductToWishlist(Request $request)
    {
        $wishlist = Wishlist::create([
            'user_id' => auth()->user()->id,
            'product_id' => $request['id']
        ]);
        $message = "Product has been added to wishlist";
        return CustomResponse::success($message, $wishlist);
    }

    public function getWishlist()
    {
        $user = auth()->user()->id;
        $wishlists = $user->wishlists;
        return CustomResponse::success("Wishlists:", $wishlists);
    }

    public function FetchProductsByPrice(Request $request)
    {
        $min = $request['minPrice'];
        $max = $request['maxPrice'];
        $products = Product::without('reviews', 'owner')
        ->whereBetween('price', [$min, $max])
        ->get();
        return CustomResponse::success("Products:", $products);
    }
    
}