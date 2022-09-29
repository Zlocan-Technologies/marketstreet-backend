<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\{CreateProduct, ReviewProduct};

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

    public function getProducts($categoryId)
    {
        return $this->productService->getProducts($categoryId);
    }

    public function review(ReviewProduct $request, $id)
    {
        return $this->productService->review($request, $id);
    }
}
