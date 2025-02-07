<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('categories.index');
        $request = request();
        $filters = $request->query();
        $categories = Category::filter($filters)->paginate();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.   
     */
    public function create()
    {
        Gate::authorize('categories.create');

        $category = new Category();
        $parents = Category::all();
        return view('dashboard.categories.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('categories.create');

        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'status' => 'required|in:active,archived',

        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $path = $file->store('uploads/categories', 'public');
            $data['image'] = $path;

        }

        $category = Category::create($data);

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Category Added Successfully');


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
    public function edit(Category $category)
    {
        Gate::authorize('categories.update');

        $parents = Category::
            where('id', '<>', $category->id)
            ->where(function (Builder $builder) use ($category) {
                $builder->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $category->id);
            })
            ->get();



        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        Gate::authorize('categories.update');

        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('uploads/categories', 'public');

            if (isset($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $data['image'] = $path;

        }
        $category->update($data);

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Gate::authorize('categories.delete');

        $image = $category->image;
        if (isset($image)) {
            Storage::disk('public')->delete($image);
        }

        $category->delete();
        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Category Deleted Successfully');
    }
}
