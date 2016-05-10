<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public $peginate_pages_count = 5;
    public function __construct()
    {
        session_start();
    }

    public function test(Request $request)
    {
        dd($request);
    }

    public function index(Request $request)
    {
        $posts = \App\Post::orderBy('updated_at', 'desc')->paginate($this->peginate_pages_count);
        $users = \App\User::all();
        return view('pages.home')
            ->with('posts', $posts)
            ->with('users', $users)
            ->with('user_id', \Session::get('user_id'))
            ->with('message', $request->message);
    }

    /**
     * Создаем новую запись
     *
     * @param Request $request fgdgdfgd
     * @return static
     */
    public function create (Request $request) {
        return Post::create($request->all());
    }

    public function login(Request $request)
    {
        $posts = \App\Post::orderBy('updated_at', 'desc')->paginate($this->peginate_pages_count);
        $users = \App\User::all();
        $message = '';
        $user = User::whereLogin($request->login)->get()->first();


        if (!$user) {
            $message = "User not found";
        } else {
            $password = $request->get('password');
            if ($request->has('password') && \Hash::check($password, $user->password)) {
                \Session::put('user_id', $user->id);
            } else {
                $message = 'Incorrect password';
            }
        }


        return redirect('/')->with('message', $message);
    }

    public function logout(Request $request)
    {
        $posts = \App\Post::orderBy('updated_at', 'desc')->paginate($this->peginate_pages_count);
        $users = \App\User::all();
        \Session::forget('user_id');

        return Redirect::action('ExampleController@index');
    }

    public function newpost(Request $request)
    {
        $file = $request->file('poster');
        $image_name = time()."-".md5($file->getClientOriginalName());
        $small_image_name = "big_".$image_name;
        $file->move('uploads', $image_name);
        $image = Image::make(sprintf('uploads/%s', $image_name))->fit(300, 300)->save();
        $big_path = $image->basePath();

        \File::copy($big_path, 'uploads/'.$small_image_name);
        $image = Image::make(sprintf('uploads/%s', $small_image_name))->fit(100, 100)->save();
        $small_path = $image->basePath();

        $posts = \App\Post::orderBy('updated_at', 'desc')->paginate($this->peginate_pages_count);
        $users = \App\User::all();
        Post::create(['title'=>$request->get('title'), 'content'=>$request->get('content'), 'user_id'=>\Session::get('user_id'), 'small_image' => $small_path, 'big_image' => $big_path]);
        return Redirect::action('ExampleController@index');
    }

    public function editPost($id)
    {
        return view("pages.edit_post")
            ->with('user_id', \Session::get('user_id'))
            ->with('post', Post::find($id));
    }

    public function updatepost(Request $request, $id)
    {
        $file = $request->file('poster');
        if($file != null) {
            $image_name = time() . "-" . md5($file->getClientOriginalName());
            $small_image_name = "big_" . $image_name;
            $file->move('uploads', $image_name);
            $image = Image::make(sprintf('uploads/%s', $image_name))->fit(300, 300)->save();
            $big_path = $image->basePath();

            \File::copy($big_path, 'uploads/' . $small_image_name);
            $image = Image::make(sprintf('uploads/%s', $small_image_name))->fit(100, 100)->save();
            $small_path = $image->basePath();
            Post::updateOrCreate(
                ['id' => $id],
                ['title' => $request["title"], 'content' => $request["content"],
                 'small_image' => $small_path, 'big_image' => $big_path]
            );
        }
        else {
            Post::updateOrCreate(
                ['id' => $id],
                ['title' => $request["title"], 'content' => $request["content"]]
            );
        }

        return Redirect::back();
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function signup(Request $request)
    {
        if($request->get('password') == $request->get('passwordSubmit')) {
            $user = User::whereLogin($request->login)->get()->first();

            if(!$user) {
                $user = new User();
                $user->password = $request->get('password');
                $user->login = $request->get('login');
                $user->name = $request->get('name');
                $user->surname = $request->get('surname');
                $user->save();


                $posts = \App\Post::orderBy('updated_at', 'desc')->paginate($this->peginate_pages_count);
                $users = \App\User::all();

                \Session::put('user_id',$user->id);

                return Redirect::action('ExampleController@index');
            }
            else
            {
                $messageSignup = 'This login is already exist';
            }
        }
        else
        {
            $messageSignup = 'Different passwords';
        }
        return view('pages.signup')
            ->with('messageSignup',$messageSignup);
    }

    public function post($id)
    {
        $post = Post::find($id);
        return view('pages.post')
            ->with('post', $post)
            ->with('user_id', \Session::get('user_id'))
            ->with('comments', Comment::orderBy('created_at', 'desc')->where(['post_id'=>$id])->get());
    }
    public function makeComment(Request $request, $id)
    {
        $post = Post::find($id);
        $user_id = \Session::get('user_id');
        $result = ['post_id' => (int)$id, 'user_id' => $user_id, 'content'=>$request->get('content')];
//        $comment = new Comment();
//        $comment->post_id = $post->id;
//        $comment->user_id = $user_id;
//        $comment->content = $request->get('content');
//        dd($result);
        Comment::create($result);
        return Redirect::back();
    }
    public function user($id)
    {
        $user = User::find($id);
        return view('pages.user')
            ->with('user',$user)
            ->with('user_id', \Session::get('user_id'));
    }

    public function comments()
    {
        $comments = Comment::all();
        return view('pages.comments')
            ->with('comments', $comments)
            ->with('user_id', \Session::get('user_id'));
    }

    public function users (Request $request) {
        $users = \App\User::all();

        return view('pages.users')
            ->with('users', $users)
            ->with('user_id', \Session::get('user_id'));
    }

    public function deletePost(Request $request, $id)
    {
        $post = Post::find($id);
        $post->delete();
        return Redirect::action('ExampleController@index');
    }
    public function deleteComment(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return Redirect::back();
    }
}