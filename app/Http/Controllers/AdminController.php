<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Post;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;
use Laravel\Fortify\Actions\CanonicalizeUsername;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;
use App\Actions\Fortify\AttemptToAuthenticate;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;
use App\Http\Responses\LoginResponse;

class AdminController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function loginForm(){
        return view('auth.login', ['guard' => 'admin']);
    }

    /**
     * Show the login view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LoginViewResponse
     */
    public function create(Request $request): LoginViewResponse
    {
        return app(LoginViewResponse::class);
    }

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        return $this->loginPipeline($request)->then(function ($request) {
            return app(LoginResponse::class);
        });
    }

    /**
     * Get the authentication pipeline instance.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Pipeline\Pipeline
     */
    protected function loginPipeline(LoginRequest $request)
    {
        if (Fortify::$authenticateThroughCallback) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                call_user_func(Fortify::$authenticateThroughCallback, $request)
            ));
        }

        if (is_array(config('fortify.pipelines.login'))) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                config('fortify.pipelines.login')
            ));
        }

        return (new Pipeline(app()))->send($request)->through(array_filter([
            config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
            config('fortify.lowercase_usernames') ? CanonicalizeUsername::class : null,
            Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return app(LogoutResponse::class);
    }


    public function post_page(){

        return view('admin.post_page');
    }

    public function add_post(Request $request){

        $admin = Auth::guard('admin')->user();

        $user_id = $admin->id;
        $name = $admin ->name;
        $usertype = $admin -> usertype;



        $post=new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->date = $request->date;
        $post->creator = $request->creator;
        $post->post_status = 'active';
        $post->usertype=$usertype;
        $post->user_id=$user_id;
       // $post->name = $name;
        $post->description = $request->description;

        $image=$request->image;

        if($image){

            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('postimage',$imagename);

            $post->image = $imagename;
        }



        $post->save();

        return redirect()->back()->with('message','Post Added Successfully');

    }


    public function show_post(){

        $post = Post::all();

        return view('admin.show_post', compact('post'));
    }

    public function searchdata(Request $request)
    {
        $searchText=$request->search;
        $post=post::where('title','LIKE',"%$searchText%")->orWhere('name','LIKE',"%$searchText%")->get();
        return view('admin.show_post',compact('post'));
    }

    public function delete_post($id){

        $post = Post::find($id);
        $post->delete();
        return redirect()->back()->with('message','Post Deleted Successfully');
    }

    public function edit_post($id){

        $post = Post::find($id);
        return view('admin.edit_post', compact('post'));

     }

    public function update_post(Request $request,$id){

        $data= Post::find($id);
        $data->title=$request->title;
        $data->description=$request->description;
        $data->creator=$request->creator;
        $image=$request->image;

        if($image){

            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('postimage',$imagename);

            $data->image = $imagename;
        }


        $data->save();
        return redirect()->back()->with('message','Post Updated Successfully');

    }


    public function post_details($id){
        $post = Post::find($id);
        return view('home.home.post_details', compact('post'));
    }

    public function accept_post($id){

        $data = Post::find($id);
        $data ->post_status='active';
        $data ->save();
        return redirect()->back()->with('message', 'Post Status update to Active');
    }

    public function reject_post($id){

        $data = Post::find($id);
        $data ->post_status='rejected';
        $data ->save();
        return redirect()->back()->with('message', 'Post Status changed to Rejected');
    }


}
