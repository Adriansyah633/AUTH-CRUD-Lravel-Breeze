<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Products;
 
class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::orderBy('id', 'desc')->get();
        $total = Products::count();
        return view('admin.products.home', compact(['products', 'total']));
    }
 
    public function create()
    {
        return view('admin.products.create');
    }
 
    public function save(Request $request)
    {
        $validation = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required',
            'category' => 'required',
            'price' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $validation['image'] = $imageName;
        }
        $data = Products::create($validation);
        if ($data) {
            session()->flash('success', 'Product Add Successfully');
            return redirect(route('admin/products'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin.products/create'));
        }
    }
    public function edit($id)
    {
        $products = Products::findOrFail($id);
        return view('admin.products.update', compact('products'));
    }
 
    public function delete($id)
    {
        $products = Products::findOrFail($id)->delete();
        if ($products->image) {
            $imagePath = public_path('images/' . $products->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        if ($products) {
            session()->flash('success', 'Product Deleted Successfully');
            return redirect(route('admin/products'));
        } else {
            session()->flash('error', 'Product Not Delete successfully');
            return redirect(route('admin/products'));
        }
    }
 
    public function update(Request $request, $id)
    {
        $products = Products::findOrFail($id);
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $products->image = $imageName;
        }

        $title = $request->title;
        $category = $request->category;
        $price = $request->price;
 
        $products->title = $title;
        $products->category = $category;
        $products->price = $price;
        $data = $products->save();
        if ($data) {
            session()->flash('success', 'Product Update Successfully');
            return redirect(route('admin/products'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin/products/update'));
        }
    }
}