<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('Category:name,id', 'Store:name,id')->paginate();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::all();
        $stores = Store::all();
        return view(
            'dashboard.products.create',
            compact('product', 'categories', 'stores')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|',
            'store_id' => 'required|integer|exists:stores,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'price' => 'required|numeric',
            'compare_price' => 'nullable|numeric|gt:price',
            'status' => 'required|in:active,archived',
            'tags' => 'nullable'
        ]);
        $data = $request->except(['image', 'tags']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads/products', 'public');
            $data['image'] = $path;
        }

        $product = Product::create($data);

        if ($request->has('tags')) {
            $tags = explode(',', $request->post('tags'));
            $this->storeTags($tags, $product);
        }

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $stores = Store::all();
        $tagsArray = $product->tags()->pluck('name')->toArray();
        $tagsString = implode(',', $tagsArray);

        return view(
            'dashboard.products.edit',
            compact('product', 'categories', 'stores', 'tagsString')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255|',
            'store_id' => 'required|integer|exists:stores,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'price' => 'required|numeric',
            'compare_price' => 'nullable|numeric|gt:price',
            'status' => 'required|in:active,archived',
            'tags' => 'nullable|string'
        ]);

        $data = $request->except('image', 'tags');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('uploads/products', 'public');

            if (isset($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $path;
        }

        $this->updateTags($request->post('tags'), $product);


        $product->update($data);

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (isset($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product Deleted Successfully');
    }

    public function storeTags($tags, $product)
    {
        DB::beginTransaction();
        try {
            foreach ($tags as $key => $value) {
                $tag = Tag::where('slug', Str::slug($value))->first();
                $slug = Str::slug($value);
                if (!$tag) {
                    $tag = Tag::create([
                        'name' => $value,
                        'slug' => $slug,
                    ]);
                }
                $tag->products()->attach($product->id);

            }
            Db::commit();
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function updateTags($tagsString, Product $product)
    {
        $tags = explode(',', $tagsString);
        foreach ($tags as $key => $tag_name) {
            $tag = Tag::where('name', $tag_name)->first();
            if (!$tag) {
                $tag = Tag::create(
                    [
                        'name' => $tag_name,
                        'slug' => Str::slug($tag_name),
                    ]
                );
            }
            $ids[] = $tag->id;
        }
        $product->tags()->sync($ids);


    }

}
