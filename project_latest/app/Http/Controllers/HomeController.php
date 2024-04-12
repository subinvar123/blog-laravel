<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Postlike;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;
            $post = Post::where('post_status', 'approved', '$post_status')->get();

            if ($usertype == 'user') {

                return view('home.homepage', compact('post'));
            } elseif ($usertype == 'admin') {
                $userCount = User::where('usertype', 'user')->count();
                $postCount = Post::count();
                $userApproved = Post::where('post_status', 'approved')->count();
                $userPending = Post::where('post_status', 'pending')->count();
                // return view ('admin.adminhome', compact('postCount'));
                return view('admin.adminhome', compact('postCount', 'userCount', 'userApproved', 'userPending'));
            }
        }
    }

    public function homepage(Request $request): JsonResponse
    {
        // dd(Auth::user());
        $userdetails = User::all();
        $categories = Category::all();
        // Retrieve filter values from the query parameters
        $selectedCategory = $request->query('category');
        $searchQuery = $request->query('search');
        $posts = Post::where('post_status', 'approved');
        if ($searchQuery || $selectedCategory) {
            if ($selectedCategory) {
                $posts->where('category_id', $selectedCategory);
            }

            // Apply search filter if search query is provided
            if ($searchQuery) {
                $posts->where('title', 'like', '%' . $searchQuery . '%');
            }
        }
        $posts = $posts->get();
        $imageUrl = url('postimage/');
        // Append image URLs to each post
        // $posts = $posts->get();
        foreach ($posts as $post) {
            // Count likes for each post and store it in the array with post id as key
            $postLikesCounts[$post->id] = Postlike::where('post_id', $post->id)->where('is_liked', 1)->count();

            $post->image_url = $imageUrl . '/' . $post->image;
            // Append like counts to each post object
            $post->likes_count = $postLikesCounts[$post->id] ?? 0;
        }
        $subscription = null; // Default value
        // dd('here');
        // if (Auth::user()) {
        //     // dd('here');
        //     // Fetch subscription value from the authenticated user
        //     $subscription = Auth()->user()->subscription;
        // }
        return response()->json([
            'post' => $posts,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'searchQuery' => $searchQuery,
            'userdetails' => $userdetails
            //'subscription'=>$subscription
        ]);
    }

    public function detail_post(int $id, Request $request): JsonResponse
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $comments = Comment::where('post_id', $id)->get();
        // dd($comments);
        $imageUrl = url('postimage/');
        $post->image_url = $imageUrl . '/' . $post->image;

        return response()->json([
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function addComment(int $id, Request $request): JsonResponse
    {
        $post = Post::find($id);
        // Validate comment data if needed
        // Create a new comment instance
        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->comment = $request->input('comment'); // Assuming 'comment' is the name of the field containing the comment in the request

        // // Save the comment to the database
        $comment->save();

        $imageUrl = url('postimage/');
        $post->image_url = $imageUrl . '/' . $post->image; // Assuming 'image' is the column in your 'posts' table that stores the image filename

        return response()->json([
            'post' => $post,
            'comment' => $comment // Optionally, you can return the saved comment as well
        ]);
    }



    public function createpost()
    {
        $categories = Category::all();
        return view('home.createpost', compact('categories'));
    }
    public function addpost(Request $request): JsonResponse
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
        //    $post->category_id = $request->category;

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('postimage', $imagename);
            $post->image = $imagename;
        }
        $post->post_status = 'pending';
        $post->save();
        return response()->json([
            'post' => $post
        ]);
        //return redirect()->back()->with('message', 'post added successfully');
    }

    public function showuserpost(): JsonResponse
    {
        // print_r('jgfcjdgc');
        $user = Auth::user();
        $userId = $user->id;

        $posts = Post::where('user_id', $userId)->get();
        // Define the base URL for the image path
        $imageUrl = url('postimage/');
        // Append image URLs to each post
        foreach ($posts as $post) {
            $post->image_url = $imageUrl . '/' . $post->image; // Assuming 'image_name' is the column in your 'posts' table that stores the image filename

        }
        //return view ('home.showuserpost', compact('post', 'username'));
        return response()->json([
            'post' => $posts,

            // 'imageUrl'=>$imageUrl
        ]);
    }
    public function deleteuserpost11(int $id): JsonResponse
    {

        $post = Post::find($id);
        print_r($post);
        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        $post->delete();
        return response()->json([
            'deletemessage' => 'Post deleted successfully'
            // 'imageUrl'=>$imageUrl
        ]);
        //return redirect()->back()->with('deletemessage', 'Post deleted successfully');
    }
    public function deleteuserpost(int $id): JsonResponse
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $post->delete();
        return response()->json(['deletemessage' => 'Post deleted successfully']);
    }
    public function edituserpost(int $id): JsonResponse
    {
        $post = Post::find($id);
        return response()->json([
            'post' => $post
            // 'imageUrl'=>$imageUrl
        ]);
        //return view ('home.edituserpost', compact('post'));
    }

    public function updateuserpost(Request $request, $id): JsonResponse
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
        //return redirect()->back();
        return response()->json([
            'message' => 'updated'
            // 'imageUrl'=>$imageUrl
        ]);
    }

    public function postLike(Request $request): JsonResponse
    {
        $post_id = $request->input('postid');
        $user_id = $request->input('user_id');
        $value = $request->input('value');

        // Check if the user has already liked the post
        $existingLike = Postlike::where('post_id', $post_id)
            ->where('user_id', $user_id)
            ->first();

        if ($existingLike) {
            // If the user has already liked the post, delete the like
            $existingLike->delete();

            return response()->json([
                'success' => true,
                'message' => 'Post unliked successfully.',
                'haslike' => false // Return false as the post is unliked
            ]);
        } else {
            // Create a new PostLike instance and fill it with the provided data
            $postlikes = new Postlike();
            $postlikes->post_id = $post_id;
            $postlikes->user_id = $user_id;
            $postlikes->is_liked = $value;
            $postlikes->save();

            return response()->json([
                'success' => true,
                'message' => 'Post liked successfully.',
                'haslike' => true // Return true as the post is liked
            ]);
        }
    }
}
