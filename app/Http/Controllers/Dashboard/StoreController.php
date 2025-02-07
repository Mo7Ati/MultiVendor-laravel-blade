<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::paginate();
        return view('dashboard.stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $store = new Store();
        return view('dashboard.stores.create', compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo_image' => 'nullable|image',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->except('logo_image');

        if ($request->hasFile('logo_image')) {

            $file = $request->file('logo_image');
            $path = $file->store('uploads/stores', 'public');
            $data['logo_image'] = $path;

        }

        $store = Store::create($data);

        return redirect()->route('dashboard.stores.index')
            ->with('success', 'Store Added Successfully');


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
    public function edit(Store $store)
    {

        return view('dashboard.stores.edit', compact('store'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo_image' => 'nullable|image',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->except('logo_image');

        if ($request->hasFile('logo_image')) {
            $image = $request->file('logo_image');
            $path = $image->store('uploads/stores', 'public');

            if (isset($store->logo_image)) {
                Storage::disk('public')->delete($store->logo_image);
            }

            $data['logo_image'] = $path;

        }
        $store->update($data);

        return redirect()->route('dashboard.stores.index')
            ->with('success', 'Store Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {

        $image = $store->logo_image;
        if (isset($image)) {
            Storage::disk('public')->delete($image);
        }
        $store->delete();
        return redirect()->route('dashboard.stores.index')
            ->with('success', 'Store Deleted Successfully');

    }
}
