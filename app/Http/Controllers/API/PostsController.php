<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        // $this->middleware('auth:api')->except('welcome');
        // $this->user_id = auth('api')->user()->id;
        $user_id = Auth::id();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Gate::allows('isAdmin') || \Gate::allows('isAuthor')){
            return Post::with('category', 'user')->paginate(5);
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
        $user_id = Auth::id();   
        $title = $request['title'];
        $separator = '-';
        $slug = str_slug($title, $separator);
        $status = 1;

        $this->validate($request, [
            'title'         =>  'required|string|max:191',
            'body'          =>  'required',
            'category_id'      =>  'required|integer',
        ]);
        return Post::create([
            'title'         =>  $title,
            'category_id'   =>  $request['category_id'],
            'body'          =>  $request['body'],
            'status'        =>  $status,
            'user_id'       =>  $user_id,
            'slug'          =>  $slug,
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
         // check if the post with the returned ID exists
        $post = Post::findOrFail($id);

        $title = $request['title'];
        $separator = '-';
        $slug = str_slug($title, $separator);
        
         // sanitize the data
         $this->validate($request, [
            'title'         =>  'required|string|max:191',
            'body'          =>  'required',
            'category_id'   =>  'required|integer',
        ]);
        
        // if last request is true, update category details.
        $post->update($request->all());

        return ['message' => 'Post was succesfully updated.'];
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

    // public function blog(){
    //     return Post::with('category', 'user')->paginate(5);
        
    // }

}
