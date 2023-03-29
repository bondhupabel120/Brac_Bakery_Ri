<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.manage_category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $data = $request->only(['name','des','status']);
        $category->create($data);
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

    public function getCategories(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = Category::orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->editColumn('status', function ($list) {
                    return CommonFunction::getStatus($list->status);
                })

                ->editColumn('des', function ($list) {
                    return strip_tags(html_entity_decode($list->des));
                })
                
                ->addColumn('action', function ($list) {
                    return '<a style="padding:2px;font-size:15px;" href="' . route('category.edit', ['category' => $list->id]) . '" class="btn btn-primary btn-xs pl-1 pr-1"> <i class="fa fa-edit"></i> </a>
                        <a href="javascript:void(0);" style="padding:2px; font-size:15px; color: #fff" class="btn btn-danger btn-xs pl-1 pr-1" id="' . $list->id . '" onClick="deleteCategory(this.id,event)"> <i class="fas fa-trash"></i></a>';
                })
                ->addIndexColumn()
                ->rawColumns(['status', 'des', 'action'])
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
        $category = Category::find($id);
        if(!$category){
            abort(403,'Not Found');
        }
        return view('admin.category.edit_category',compact('category'));
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
        $category = Category::where('id',$id)->first();
        if(!$category){
            abort(403,'Category Not Found');
        }
        $category->name = $request->name;
        $category->des = $request->des;
        $category->status = $request->status;
        $category->save();
        return redirect()->route('category.index')->with('message', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if(!$category){
            abort(403,'Category Not Found');
        }
        $category->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}
