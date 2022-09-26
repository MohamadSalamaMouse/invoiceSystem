<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        $sections=Section::all();
        $products=Product::all();
        return view('products.products',compact('sections','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'Product_name'=>'required',
            'description'=>'required'

        ],[
            'Product_name.required'=>'يرجي ادخال اسم المنتج',
            'description.required'=>'يرجي ادخال الوصف'
        ]);
        Product::create([
            'product_name'=>$request->Product_name,
            'description'=>$request->description,
            'section_id'=>$request->section_id
        ]);
        session()->flash('Add','تم اضافة المنتج بنجاح');
        return redirect()->route('products.index');
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
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        //
        $id=$request->id;

       $product=Product::findOrFail($id);
       $product->product_name=$request->product_name;
      $product->description=$request->description;
      $product->section_id=$request->section_id;
      $product->save();
      session()->flash('edit','تم التعديل بنجاح');
      return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        Product::find($id)->delete();
        session()->flash('delete','تم حذف المنتج بنجاح');
        return redirect('/products');


    }
}
