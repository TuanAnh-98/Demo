<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'imageUrl' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
        ]);

        if ($request->has('imageUrl')) {
            $file = $request->file('imageUrl');
            $filename = $file->getClientOriginalName();
            $path = 'uploads/product/' . $product->id . '/';
            $file->move($path, $filename);

            $product->update([
                'imageUrl' => $path . $filename
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'imageUrl' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

    if ($request->has('imageUrl')) {
        $image = $request->file('imageUrl');
        if ($image && $image->isValid()) {
            $oldImagePath = ltrim($product->imageUrl, '/');
            $booleanFile = Storage::disk('public')->exists($oldImagePath);
            if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
                $booleanFile = 'true';
            }
            $filename = $image->getClientOriginalName();
            $path = 'uploads/product/' . $product->id . '/';
            $image->move($path, $filename);
            $validated['imageUrl'] = $path . $filename; 
        } else {
            return redirect()->back()->withErrors(['imageUrl' => 'The uploaded file is not valid.']);
        }
    }
        
        $product->update($validated);
        return redirect()->back()->with('success', 'Product update successfully.');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
