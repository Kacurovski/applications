<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Tag;
use App\Models\Brand;
use App\Models\Status;
use App\Models\Category;
use App\Models\BrandImage;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BrandRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
        return view('brands.index');
    }

    public function create()
    {
        $statuses = Status::all();
        $categories = Category::all();
        $tags = Tag::all();
        return view('brands.create', compact('statuses', 'categories', 'tags'));
    }

    public function store(BrandRequest $request)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $brandData = Arr::except($validatedData, ['categories', 'tags', 'images']);
            $brand = Brand::create($brandData);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = Storage::disk('public')->put('brands', $image);
                    $brand->images()->create(['image_path' => $path]);
                }
            }

            if (isset($validatedData['categories'])) {
                $brand->categories()->sync($validatedData['categories']);
            }

            if (isset($request['tags'])) {
                $tags = explode(',', $request['tags'][0]);
                foreach ($tags as $tag) {
                    $tagModel = Tag::firstOrCreate(['name' => trim($tag)]);
                    $tagIds[] = $tagModel->id;
                }
                $brand->tags()->sync($tagIds);
            }

            DB::commit();

            return redirect()->route('brands.index')->with('success', 'Брендот е успешно креиран.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating brand: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again later.']);
        }
    }


    public function show(Brand $brand)
    {
        return view('brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        $statuses = Status::all();
        $tags = Tag::all();
        $categories = Category::all();
        return view('brands.edit', compact('brand', 'statuses', 'tags', 'categories'));
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            $brand->update(Arr::except($validatedData, ['categories', 'tags', 'images']));

            $brand->tags()->detach();

            if (isset($validatedData['tags'])) {
                $tags = explode(',', $validatedData['tags'][0]);

                foreach ($tags as $tag) {
                    $tagModel = Tag::firstOrCreate(['name' => trim($tag)]);
                    $brand->tags()->attach($tagModel->id);
                }
            }

            if (isset($validatedData['categories'])) {
                $brand->categories()->sync($validatedData['categories']);
            }

            if ($request->hasFile('images')) {
            
                foreach ($brand->images as $oldImage) {
                    if (Storage::disk('public')->exists($oldImage->image_path)) {
                        Storage::disk('public')->delete($oldImage->image_path);
                    }
                }
             
                $brand->images()->delete();

                
                foreach ($request->file('images') as $image) {
                    $path = Storage::disk('public')->put('brands', $image);
                    $brand->images()->create(['image_path' => $path]);
                }
            }

            DB::commit();

            return redirect()->route('brands.index')->with('success', 'Брендот е успешно ажуриран.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating brand: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again later.']);
        }
    }

    // public function destroy(Brand $brand)
    // {
    //     DB::transaction(function () use ($brand) {
    //         $brand->images()->delete();
    //         $brand->delete();
    //     });

    //     if (request()->wantsJson()) {
    //         return response()->json(['message' => 'Brand deleted successfully']);
    //     }

    //     return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    // }
}
