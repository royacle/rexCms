<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        
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
            // return Post::with('user', 'categories')->get();
            // $posts = 'select * from categories c, users u, posts p
            //           where c.user_id = u.id and
            //           c.id = p.category_id';
            // return $posts = Post::latest()->paginate(5);
            // $posts = Post::with('user','category')->get();
            // return Post::find(1)->paginate(5);
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
        // check if the user with the returned ID exists
        $user_id = auth('api')->user()->id;
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
        //
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
}
