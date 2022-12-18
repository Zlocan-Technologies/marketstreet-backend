<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\{
    CreateProduct, 
    ReviewProduct
};

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function show($id)
    {
        return $this->productService->show($id);
    }

    public function store(CreateProduct $request)
    {
        return $this->productService->store($request);
    }

    public function dropship(Request $request, $id)
    {
        return $this->productService->dropship($request, $id);
    }
    
    public function initiateDeposit(InitiateDeposit $request)
    {
        return $this->productService->initiateDeposit($request);
    }

    public function update(CreateProduct $request, $id)
    {
        return $this->productService->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->productService->destroy($id);
    }

    public function getCategories()
    {
        return $this->productService->getCategories();
    }

    public function createCategories(Request $request)
    {
        return $this->productService->createCategories($request);
    }

    public function review(ReviewProduct $request, $id)
    {
        return $this->productService->review($request, $id);
    }

    public function getProducts($categoryId)
    {
        return $this->productService->getProducts($categoryId);
    }

    public function FetchAllStoreProducts()
    {
        return $this->productService->FetchAllStoreProducts();
    }

    public function getAllUserProducts($userId)
    {
        return $this->productService->getAllUserProducts($userId);
    }

    public function Wishlist($id, $action)
    {
        return $this->productService->Wishlist($id, $action);
    }

    public function getWishlist()
    {
        return $this->productService->getWishlist();
    }

    public function FetchProductsByPrice($min, $max)
    {
        return $this->productService->FetchProductsByPrice($min, $max);
    }

    public function fetchTrendingProducts()
    {
        return $this->productService->fetchTrendingProducts();
    }

    public function searchProducts($query)
    {
        return $this->productService->searchProducts($query);
    }

    public function createProducts(Request $request)
    {
        return $this->productService->createProducts($request);
    }
}
