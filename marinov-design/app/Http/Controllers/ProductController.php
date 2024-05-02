<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Type;
use ImageKit\ImageKit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Material;
use App\Models\Maintenance;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{

    protected $imageKit;

    public function __construct()
    {
        $this->imageKit = new ImageKit(
            env('IMAGEKIT_PUBLIC_KEY'),
            env('IMAGEKIT_PRIVATE_KEY'),
            env('IMAGEKIT_URL_ENDPOINT')
        );
    }


    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $types = Type::all();
        $materials = Material::all();
        $maintenances = Maintenance::all();

        return view('products.create', compact('categories', 'types', 'materials', 'maintenances'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // Validate form data including images
        $request->validate([
            // Existing validation rules
            'materials' => 'required|array',
            'materials.*' => 'exists:materials,id',
            'maintenances' => 'required|array',
            'maintenances.*' => 'exists:maintenances,id',
        ]);

        try {
            // Create product instance
            $product = Product::create($request->validated());

            // Handle image uploads and associate with the product
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageUrl = $this->uploadImage($image);
                    if ($imageUrl) {
                        // Create product image instance
                        $productImage = new ProductImage(['image' => $imageUrl]);
                        // Associate product image with product
                        $product->images()->save($productImage);
                    }
                }
            }

            // Attach materials and maintenances to the product
            if ($request->has('materials')) {
                $product->materials()->attach($request->materials, ['created_at' => now(), 'updated_at' => now()]);
            }

            if ($request->has('maintenances')) {
                $product->maintenances()->attach($request->maintenances, ['created_at' => now(), 'updated_at' => now()]);
            }

            return redirect()->route('products.index')->with('success', 'Product created successfully!');
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->route('products.create')->withErrors(['error' => $e->getMessage()]);
        }
    }

    protected function uploadImage($image)
    {
        $fileName = time() . '' . $image->getClientOriginalName();

        // Upload image using ImageKit
        $upload = $this->imageKit->upload([
            'file' => fopen($image->getRealPath(), 'r'),
            'fileName' => $fileName,
        ]);

     

        if ($upload->result) {
            return $upload->result->url;
        } else {
            return false;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $types = Type::all();
        $materials = Material::all();
        $maintenances = Maintenance::all();

        return view('products.edit', compact('product', 'categories', 'types', 'materials', 'maintenances'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $request->validate([
            'materials' => 'required|array',
            'materials.*' => 'exists:materials,id',
            'maintenances' => 'required|array',
            'maintenances.*' => 'exists:maintenances,id',
        ]);
    
        try {
            // Update product details
            $product->update($request->validated());
    
            // Handle image uploads and associate with the product
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageUrl = $this->uploadImage($image);
                    if ($imageUrl) {
                        // Create product image instance
                        $productImage = new ProductImage(['image' => $imageUrl]);
                        // Associate product image with product
                        $product->images()->save($productImage);
                    }
                }
            }
    
            // Sync materials and maintenances with the product
            if ($request->has('materials')) {
                $product->materials()->sync($request->materials);
            } else {
                $product->materials()->detach();
            }
    
            if ($request->has('maintenances')) {
                $product->maintenances()->sync($request->maintenances);
            } else {
                $product->maintenances()->detach();
            }
    
            return redirect()->route('products.index')->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('products.edit', $product->id)->withErrors(['error' => 'Failed to update product. Please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
