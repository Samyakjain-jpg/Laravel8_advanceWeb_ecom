<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = category::whereNotNull('category_id')->get();
        return view('admin.product.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'name' =>$request->name,
            'category_id' =>$request->category_id,
            'price' => $request->price,
        );
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $fileName = date('dmY').time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path("/uploads"),$fileName);
            $data['image'] = $fileName;
        }
        $create = Product::create($data);
        return redirect()->route('product.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Product $product)
    {
        $id = $request->id;
        $product = Product::findOrFail($id);
        $categories = category::WhereNotNull('category_id')->get();
        return view('admin.product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $id = $request->id;
        $data = array(
            'name' =>$request->name,
            'category_id' =>$request->category_id,
            'price' => $request->price,
        );
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $fileName = date('dmY').time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path("/uploads"),$fileName);
            $data['image'] = $fileName;
        }

        $create =product::where('id',$id)->update($data);
        return redirect()->route('product.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Request $request)
    {
        $id = $request->id;
        $product = product::find($id);
        $product->delete();
        return response()->json('success');
    }


    public function extraDetails(Request $request)
    {
        $id = $request->id;
        $product = product::where('id',$id)->with('productdetail')->first();
        return view('admin.product.extraDetails',compact('id','product'));
    }
    public function extraDetailsStore(Request $request)
    {
        $id = $request->id;
        $data= array(
            'title'=> $request->title,
            'product_id'=> $request->product_id,
            'product_id'=> $request->id,
            'total_item'=> $request->total_item,
            'description'=> $request->description        
        );
        $detatil = ProductDetail::updateOrCreate(
            ['product_id' => $id],
            $data
        );
        return redirect()->route('product.list');
    }
}
