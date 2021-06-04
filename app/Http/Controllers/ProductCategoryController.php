<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::latest()->paginate(10);
        return view('pages.product_categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:3']
        ]);

        $title       = $request->get('title');
        $description = $request->get('description');
        $image       = $request->get('image');

        try {
            $category = ProductCategory::create([
                'title'       => $title,
                'slug'        => Str::slug($title),
                'description' => $description,
                'image'       => $image
            ]);

            return response()->json([
                'success' => true,
                'data'    => $category
            ], 201);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $categories)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:3']
        ]);

        $title       = $request->get('title', $categories->title);
        $description = $request->get('description', $categories->description);
        $image       = $request->get('image', $categories->image);

        try {
            $categories->update([
                'title'       => $title,
                'slug'        => Str::slug($title),
                'description' => $description,
                'image'       => $image
            ]);

            return response()->json([
                'success' => true,
                'data'    => $categories
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $categories)
    {
        $categories->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data Produk Kategori');
    }
}
