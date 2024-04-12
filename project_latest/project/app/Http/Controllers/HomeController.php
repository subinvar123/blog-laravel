<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth::id())
        {
            $usertype = Auth()->user()->usertype;
            $post = Post::where('post_status','approved', '$post_status')->get();

            if($usertype=='user'){
                
                return view ('home.homepage',compact('post'));
            }
            elseif($usertype=='admin'){
                return view ('admin.adminhome');
            }
            
        }
    }

    public function homepage(){
        $post = Post::where('post_status','approved', '$post_status')->get();
        return view ('home.homepage',compact('post'));
    }
    public function detail_post(int $id){
        $post = Post::find($id);
        return view('home.detail_post',compact('post'));
    }


    public function createpost(){
        return view ('home.createpost');
    }
    public function addpost(Request $request){

        $user = Auth()->User();
        $name =$user->name;
        $id=$user->id;
        $usertype=$user->usertype;

       $post = new Post;

       $post->title = $request->title;
       $post->description = $request->description;
       $post->name = $name;
       $post->user_id = $id;
       $post->usertype = $usertype;

       $image = $request->image;
       if($image){
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('postimage', $imagename);
        $post->image = $imagename;
       }
       $post->post_status='pending';
       $post->save();
       return redirect()->back()->with('message', 'post added successfully');
    }

    public function showuserpost(){

        $user = Auth()->User();
        $userId=$user->id;
        $username=$user->name;
        $post = Post::where('user_id', $userId)->get();
        return view ('home.showuserpost', compact('post', 'username'));
    }
    public function deleteuserpost(int $id){

        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        $post->delete();

        return redirect()->back()->with('deletemessage', 'Post deleted successfully');
    }
    public function edituserpost(int $id){
        $post = Post::find($id);
        return view ('home.edituserpost', compact('post'));
    }
    
    public function updateuserpost(Request $request, $id){
        $post = Post::find($id);

        $post->title = $request->title;
       $post->description = $request->description;
       $image = $request->image;
       if($image){
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('postimage', $imagename);
        $post->image = $imagename;  
    }
    $post->save();
        return redirect()->back();
}

}
