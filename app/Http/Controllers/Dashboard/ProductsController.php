<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Http\Request;
use View;

class ProductsController extends Controller
{
    public function __construct()
    {
        $categories = Category::withTranslation()->get();
        $brands = Brand::withTranslation()->get();
        $vendors = User::role(['vendor'])->get();
        View::share('vendors', $vendors);
        View::share('categories', $categories);
        View::share('brands', $brands);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $role =  $user->getRoleNames()[0];
        if ($role == 'admin') {
            $products = Product::orderBy('id', 'desc')->paginate(PAGINATION_COUNT);
        } elseif ($role == 'vendor') {
            $products = Product::orderBy('id', 'desc')->where('added_by', auth()->user()->id)->paginate(PAGINATION_COUNT);
        }
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        if (!$request->has('is_active'))
            $data['is_active'] = 0;
        else
            $data['is_active'] = 1;
        // $data['slug'] =  str_replace(' ', '-', $request->slug);
        if ($request->hasFile('main_image')) {
            $data['main_image'] = upload_image($request->file('main_image'), 'main_image');
        }
        if ($request->hasFile('video')) {
            $data['video'] = upload_image($request->file('video'), 'video');
        }
        if ($request->added_by) {
            $data['added_by'] = $request->added_by;
        } else {
            $data['added_by'] = auth()->user()->id;
        }
        $product = Product::create($data);
        foreach ($request->categories as $category) {
            $product_cat = new ProductCategory();
            $product_cat->category_id = $category;
            $product_cat->product_id = $product->id;
            $product_cat->save();
        }
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $image = upload_image($image, 'images_');
                $product_images = new ProductImage();
                $product_images->image = $image;
                $product_images->product_id = $product->id;
                $product_images->save();
            }
        }
        return redirect()->route('products.index')
            ->with(['success' => trans('admin.added')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::orderBy('id', 'DESC')->find($id);
        foreach ($product->categories as $cat) {
            $category_ids[] = $cat->id;
        }
        return view('dashboard.products.edit', compact('product', 'category_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $data = $request->all();
        if (!$request->has('is_active'))
            $data['is_active'] = 0;
        else
            $data['is_active'] = 1;
        if ($request->hasFile('main_image')) {
            $data['main_image'] = upload_image($request->file('main_image'), 'main_image');
        } else {
            $product->main_image;
        }
        if ($request->hasFile('video')) {
            $data['video'] = upload_image($request->file('video'), 'video');
        } else {
            $product->video;
        }
        if ($request->added_by) {
            $data['added_by'] = $request->added_by;
        } else {
            $data['added_by'] = auth()->user()->id;
        }
        $product->update($data);
        ProductCategory::where('product_id', $product->id)->delete();
        foreach ($request->categories as $category) {
            $product_cat = new ProductCategory();
            $product_cat->category_id = $category;
            $product_cat->product_id = $product->id;
            $product_cat->save();
        }
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $image = upload_image($image, 'images_');
                $product_images = new ProductImage();
                $product_images->image = $image;
                $product_images->product_id = $product->id;
                $product_images->save();
            }
        }
        return redirect()->route('products.index')->with(['success' =>  trans('admin.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::orderBy('id', 'DESC')->find($id);
            if (!$product)
                return redirect()->route('products.index')->with(['error' => trans('admin.coun_not_found')]);
            $product->delete();
            return redirect()->route('products.index')->with(['success' =>  trans('admin.detelted_sucess')]);
        } catch (\Exception $ex) {
            return redirect()->route('products.index')->with(['error' =>  trans('admin.try_again')]);
        }
    }
}
