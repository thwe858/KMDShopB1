<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $categories=Category::orderBy('id','DESC')->paginate(2);
        return view ('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $file_name = time().'.'.$request->image->extension();

        $request->image->move(
            public_path('images/categories'),
            $file_name
        );

        Category::create([
            'name' => $request->name,
            'image' => 'images/categories/'.$file_name,
        ]);

        return redirect()->route('backend.categories.index');
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
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Find category
    $category = Category::findOrFail($id);

    // Validation
    $request->validate([
        'name' => 'required|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    // Update name
    $category->name = $request->name;

    // Upload new image
    if ($request->hasFile('image')) {

        // Delete old image
        if (!empty($request->old_image) && file_exists(public_path($request->old_image))) {
            unlink(public_path($request->old_image));
        }

        // Generate new filename
        $fileName = time() . '.' . $request->image->extension();

        // Move image
        $request->image->move(public_path('images/categories'), $fileName);

        // Save image path
        $category->image = '/images/categories/' . $fileName;
    }

    // Save changes
    $category->save();

    return redirect()
            ->route('backend.categories.index')
            ->with('success', 'Category updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $category = Category::findOrFail($id);

    $category->delete();

    return redirect()
        ->route('backend.categories.index')
        ->with('success', 'Category deleted successfully.');
}
}