<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.manage_product');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status',1)->orderby('id','asc')->get();
        return view('admin.product.add_product',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, product $product)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'category_id' => 'required',
        ]);
        $post = $request->only('category_id','name', 'description','price','sale_price','quantity','status');
        $image = CommonFunction::file_upload($request, 'image', 'product');
        $image1 = CommonFunction::file_upload($request, 'image1', 'product');
        $image2 = CommonFunction::file_upload($request, 'image2', 'product');
        $postData = array_merge($post, [
            'image' => $image,
            'image1' => $image1,
            'image2' => $image2,
        ]);

        $product->create($postData);
        return back()->with('message', 'Save Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function getProducts(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = product::orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->editColumn('status', function ($list) {
                    return CommonFunction::getStatus($list->status);
                })

                ->editColumn('image', function ($list) {
                    return CommonFunction::getImageFromURL($list->image);
                })
                
                ->addColumn('action', function ($list) {
                    return '<a style="padding:2px;font-size:15px;" href="' . route('product.edit', ['product' => $list->id]) . '" class="btn btn-primary btn-xs pl-1 pr-1"> <i class="fa fa-edit"></i> </a>
                        <a href="javascript:void(0);" style="padding:2px; font-size:15px; color: #fff" class="btn btn-danger btn-xs pl-1 pr-1" id="' . $list->id . '" onClick="deleteproduct(this.id,event)"> <i class="fas fa-trash"></i></a>';
                })
                ->addIndexColumn()
                ->rawColumns(['status','image', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            // Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::where('status',1)->orderby('id','asc')->get();
        if(!$product){
            abort(403,'Not Found');
        }
        return view('admin.product.edit_product',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::where('id',$id)->first();
        if(!$product){
            abort(403,'product Not Found');
        }
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->description = $request->description;
        if($request->image){
            @unlink($product->image);
            $product->image = CommonFunction::file_upload($request, 'image', 'product');
        }
        if($request->image1){
            @unlink($product->image1);
            $product->image1 = CommonFunction::file_upload($request, 'image1', 'product');
        }
        if($request->image2){
            @unlink($product->image2);
            $product->image2 = CommonFunction::file_upload($request, 'image2', 'product');
        }
        $product->status = $request->status;
        $product->save();
        return redirect()->route('product.index')->with('message', 'product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(!$product){
            abort(403,'product Not Found');
        }
        else{
            @unlink($product->image);
            @unlink($product->image1);
            @unlink($product->image2);
        }
        $product->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}
