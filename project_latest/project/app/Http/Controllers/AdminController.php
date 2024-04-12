<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function post_page()
    {
        return view('admin.post_page');
    }

    public function add_post(Request $request)
    {

        $user = Auth()->User();
        $name = $user->name;
        $id = $user->id;
        $usertype = $user->usertype;

        $post = new Post;

        $post->title = $request->title;
        $post->description = $request->description;
        $post->name = $name;
        $post->user_id = $id;
        $post->usertype = $usertype;

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('postimage', $imagename);
            $post->image = $imagename;
        }
        $post->post_status = 'pending';
        $post->save();
        return redirect()->back()->with('message', 'post added successfully');
    }

    public function show_post()
    {

        $post = Post::all();
        return view('admin.show_post', compact('post'));
    }

    public function delete_post(int $id)
    {

        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        $post->delete();

        return redirect()->back()->with('deletemessage', 'Post deleted successfully');
    }
    public function edit_post(int $id)
    {
        $post = Post::find($id);
        return view('admin.edit_post', compact('post'));
    }

    public function update_post(Request $request, $id)
    {
        $post = Post::find($id);

        $post->title = $request->title;
        $post->description = $request->description;
        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('postimage', $imagename);
            $post->image = $imagename;
        }
        $post->save();
        return redirect()->back();
    }

    public function approve(int $id)
    {

        $post = Post::find($id);
        $status = $post->post_status;
        if (request('value') == 1) {
            if ($status == 'pending') {
                $post->post_status = 'approved';
                $post->save();
            }
        }


        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        return redirect()->back()->with('message', 'approved');
    }

    public function reject(int $id)
    {

        $post = Post::find($id);
        $status = $post->post_status;
        if (request('value') == 2) {
            if ($status == 'pending') {
                $post->post_status = 'rejected';
                $post->save();
            }
        }


        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        return redirect()->back()->with('message', 'Rejected');
    }
}
