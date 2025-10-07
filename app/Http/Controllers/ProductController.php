<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\ProductPhotoInsertRequest;
use App\Models\Product;
use App\Models\ProductPhoto;
use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('backend.product.index', [
            'products' => $this->productService->getAllProducts(10),
        ]);
    }

    public function create()
    {
        return view('backend.product.create', [
            'categories' => $this->productService->getAllCategories(),
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        $this->productService->createProduct($request->validated());
        return redirect()->route('admin.products.index')->with('success', 'You have successfully added a new product.');
    }

    public function show(Product $product)
    {
        return view('backend.product.show', [
            'item' => $product,
            'product_photos' => $product->photos,
        ]);
    }

    public function edit(Product $product)
    {
        return view('backend.product.edit', [
            'item' => $product,
            'categories' => $this->productService->getAllCategories(),
            'subcategories' => $this->categoryService->getSubcategoriesByCategoryId($product->category),
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $this->productService->updateProduct($product->id, $request->validated());
        return redirect()->route('admin.products.index')->with('success', 'You have successfully updated the product.');
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product->id);
        return back()->with('success', 'Product successfully moved to trash.');
    }

    public function trashed()
    {
        return view('backend.product.trashed', [
            'products' => $this->productService->getTrashedProducts(10),
        ]);
    }

    public function restore(Product $product)
    {
        $this->productService->restoreProduct($product->id);
        return back()->with('success', 'You have successfully restored the product.');
    }

    public function forceDelete(Product $product)
    {
        $this->productService->forceDeleteProduct($product->id);
        return back()->with('success', 'You have permanently deleted the product.');
    }

    public function view_product_photo(Product $product)
    {
        return view('backend.product.photos.index', [
            'product' => $product,
            'product_photos' => $this->productService->getPhotosForProduct($product->id, 10),
        ]);
    }

    public function addproductphoto(Product $product)
    {
        return view('backend.product.photos.create', [
            'product' => $product,
        ]);
    }

    public function addproductphotoinsert(ProductPhotoInsertRequest $request, Product $product)
    {
        $this->productService->addPhotosToProduct($product->id, $request->file('img_multiple', []));
        return redirect()->route('admin.products.photos.index', $product->id)->with('success', 'You have successfully added new photos.');
    }

    public function delete_product_photo(ProductPhoto $photo)
    {
        $this->productService->deleteProductPhoto($photo->id);
        return back()->with('success', 'You have deleted the product photo.');
    }
}