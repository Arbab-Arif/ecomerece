<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Traits\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use FileHelper;

    public function index()
    {

        return view('admin.products.index');
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        //        dd($request->all());
        $validator = Validator::make($request->all(), [
            'name'        => 'required',
            'qty'         => 'required',
            'price'       => 'required',
            'thumbnail'   => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'gallery'     => 'required|array',
            'gallery.*'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            // Redirect back with error messages
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->saveFileAndGetName($request->file('thumbnail'), Product::class);
        }

        if ($request->hasFile('gallery')) {
            $galleryData = [];
            foreach ($request->file('gallery') as $file) {
                $galleryData[] = ['image' => $this->saveFileAndGetName($file, ProductGallery::class)];
            }
        }
        $product = Product::create($data);
        $product->productGallery()->createMany($galleryData);

        return to_route('product.index')->with('success', 'Product created successfully.');

    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Product $product, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required',
            'qty'         => 'required',
            'price'       => 'required',
            'thumbnail'   => 'image|mimes:jpeg,png,jpg,gif,svg',
            //            'gallery'     => 'required|array',
            'gallery.*'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            // Redirect back with error messages
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->updateFileAndGetName($request->file('thumbnail'), $product->thumbnail, Product::class);
        }
        $product->update($data);
        if ($request->hasFile('gallery')) {
            $galleryData = [];
            foreach ($request->file('gallery') as $file) {
                $galleryData[] = ['image' => $this->saveFileAndGetName($file, ProductGallery::class)];
            }
            $product->productGallery()->createMany($galleryData);
        }

        return to_route('product.index')->with('success', 'Product Updated successfully.');

    }

    public function deleteProductGallery(ProductGallery $productGallery)
    {
        $this->deleteFile($productGallery->image);
        $productGallery->delete();

        return back();
    }

    public function destroy(Product $product)
    {
        if ($product->thumbnail) {
            $this->deleteFile($product->thumbnail);
        }
        if ($product->productGallery) {
            foreach ($product->productGallery as $productGallery) {
                $this->deleteFile($productGallery->image);
            }
            $product->productGallery()->delete();
        }
        $product->delete();

        return to_route('product.index')->with('success', 'Product deleted successfully.');
    }
}
