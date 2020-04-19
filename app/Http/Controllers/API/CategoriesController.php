<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\User;

class CategoriesController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        // check if the user with the returned ID exists
        // $user_id = auth('api')->user()->id;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('isAdmin');
        if(\Gate::allows('isAdmin') || \Gate::allows('isAuthor')){
            // return Category::with('user')->paginate(5);
            return auth()->user()->category()->with('user')->paginate(5);
        }
    }

    public function allCategories(){
        if(\Gate::allows('isAdmin') || \Gate::allows('isAuthor')){
            return Category::latest()->get();
            // return auth()->user()->category()->with('user')->paginate(5);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|string|max:191',
        ]);
        return Category::create([
            'name'  =>  $request['name'],
            'user_id'  =>  auth('api')->user()->id
        ]);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // check if the category with the returned ID exists
        $category = Category::findOrFail($id);
        
         // sanitize the data
         $this->validate($request, [
            'name'      =>  'required|string|max:191',
        ]);
        
        // if last request is true, update category details.
        $category->update($request->all());

        return ['message' => 'Category was succesfully updated.'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Search function for category
    public function search(){
        if ($search = \Request::get('q')) {
            $categories = Category::where(function($query) use ($search){
                $query->where('name', 'LIKE', "%$search%")
                ->leftjoin('users', 'categories.user_id', '=', 'users.id')
                ->orWhere('categories.name', 'LIKE', "%$search%");
            })->paginate(5);
        }else{
            $categories = Category::latest()->paginate(5);
        }
        return $categories;
        }
}
