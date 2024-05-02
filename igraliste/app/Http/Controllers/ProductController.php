<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Status;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Support\Arr;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        return view('homepage');
    }

    public function create()
    {
        $colors = Color::all();
        $sizes = Size::all();
        $brands = Brand::whereHas('status', function ($query) {
            $query->where('name', 'active');
        })->get();
        $categories = Category::all();
        $tags = Tag::all();
        $statuses = Status::all();
        $discounts = Discount::all();
        return view('products.create', compact('colors', 'sizes', 'brands', 'categories', 'tags', 'statuses', 'discounts'));
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    public function store(ProductRequest $request)
    {
        try {

            DB::beginTransaction();


            $product = new Product($request->only(['name', 'description', 'price', 'quantity', 'brand_id', 'status_id', 'category_id', 'color_id', 'size_id', 'size_advice']));


            if ($request->filled('discount_id')) {
                $product->discount_id = $request->input('discount_id');
            }

            if (isset($request['tags'])) {
                $tags = explode(',', $request['tags'][0]);
                $tagIds = [];
                foreach ($tags as $tag) {
                    $tagModel = Tag::firstOrCreate(['name' => trim($tag)]);
                    $tagIds[] = $tagModel->id;
                }
                $product->save();
                $product->tags()->sync($tagIds);
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {

                    $path = Storage::disk('public')->put('products', $image);


                    $product->images()->create(['image_path' => $path]);
                }
            }


            DB::commit();

            return redirect()->route('homepage')->with('success', 'Производот е успешно креиран.');
        } catch (\Exception $e) {

            DB::rollBack();


            Log::error('Error creating product: ' . $e->getMessage());


            return redirect()->back()->withInput()->with('error', 'Настана грешка при креирањето на производот. Обидете се повторно.');
        }
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $validatedData = $request->validated();

            DB::beginTransaction();

            $productData = Arr::except($validatedData, ['tags', 'images']);
            $product->update($productData);

            if (isset($request['tags'])) {
                $tags = explode(',', $request['tags'][0]);
                foreach ($tags as $tag) {
                    $tagModel = Tag::firstOrCreate(['name' => trim($tag)]);
                    $tagIds[] = $tagModel->id;
                }
                $product->tags()->sync($tagIds);
            }


            if ($request->hasFile('images')) {

                foreach ($product->images as $oldImage) {
                    if (Storage::disk('public')->exists($oldImage->image_path)) {
                        Storage::disk('public')->delete($oldImage->image_path);
                    }
                }

                $product->images()->delete();


                foreach ($request->file('images') as $image) {
                    $path = Storage::disk('public')->put('products', $image);
                    $product->images()->create(['image_path' => $path]);
                }
            }


            if ($request->has('discount_id')) {
                $product->discount_id = $request->input('discount_id');
                $product->save();
            }


            DB::commit();

            return redirect()->route('homepage')->with('success', 'Производот е успешно ажуриран.');
        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('error', 'Производот не е ажуриран. Ве молиме обидете се повторно.');
        }
    }

    public function edit(Product $product)
    {
        $colors = Color::all();
        $sizes = Size::all();
        $brands = Brand::whereHas('status', function ($query) {
            $query->where('name', 'active');
        })->get();
        $categories = Category::all();
        $tags = Tag::all();
        $statuses = Status::all();
        $discounts = Discount::all();
        return view('products.edit', compact('product', 'colors', 'sizes', 'brands', 'categories', 'tags', 'statuses', 'discounts'));
    }
}
