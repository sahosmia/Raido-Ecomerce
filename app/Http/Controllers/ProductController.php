<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\ProductPhotoInsertRequest;
use App\Models\Product;
use App\Models\Product_photo;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->middleware('auth');
        $this->productService = $productService;
    }

    public function index()
    {
        return view('product.index', [
            'products' => $this->productService->getAllProducts(10),
        ]);
    }

    public function create()
    {
        return view('product.create', [
            'categories' => $this->productService->getAllCategories(),
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        $this->productService->createProduct(
            $request->validated(),
            $request->file('img'),
            $request->file('img_multiple', [])
        );

        return redirect()->route('admin.products.index')->with('success', 'You have successfully added a new product.');
    }

    public function show(Product $product)
    {
        return view('product.show', [
            'item' => $product,
            'product_photos' => $product->photos,
        ]);
    }

    public function edit(Product $product)
    {
        return view('product.edit', [
            'item' => $product,
            'categories' => $this->productService->getAllCategories(),
            'subcategories' => $this->productService->getSubcategoriesByCategoryId($product->category),
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $this->productService->updateProduct($product->id, $request->validated(), $request->file('img'));
        return redirect()->route('admin.products.index')->with('success', 'You have successfully updated the product.');
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product->id);
        return back()->with('success', 'Product successfully moved to trash.');
    }

    public function trashed()
    {
        return view('product.trashed', [
            'products' => $this->productService->getTrashedProducts(10),
        ]);
    }

    public function restore($id)
    {
        $this->productService->restoreProduct($id);
        return back()->with('success', 'You have successfully restored the product.');
    }

    public function forceDelete($id)
    {
        $this->productService->forceDeleteProduct($id);
        return back()->with('success', 'You have permanently deleted the product.');
    }

    public function getSubcategories(Request $request)
    {
        $subcategories = $this->productService->getSubcategoriesByCategoryId($request->id);
        return response()->json($subcategories);
    }

    public function view_product_photo(Product $product)
    {
        return view('product.photos.index', [
            'product' => $product,
            'product_photos' => $this->productService->getPhotosForProduct($product->id, 10),
        ]);
    }

    public function addproductphoto(Product $product)
    {
        return view('product.photos.create', [
            'product' => $product,
        ]);
    }

    public function addproductphotoinsert(ProductPhotoInsertRequest $request, Product $product)
    {
        $this->productService->addPhotosToProduct($product->id, $request->file('img_multiple', []));
        return redirect()->route('admin.products.photos.index', $product->id)->with('success', 'You have successfully added new photos.');
    }

    public function delete_product_photo(Product_photo $photo)
    {
        $this->productService->deleteProductPhoto($photo->id);
        return back()->with('success', 'You have deleted the product photo.');
    }
}