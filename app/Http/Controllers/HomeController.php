<?php

namespace App\Http\Controllers;

use App\Models\Cart;

use App\Models\Post;

use App\Models\User;

use App\Models\Event;
use App\Models\Order;


use App\Models\Product;

use App\Models\Category;

use App\Models\Post_Details;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $post = Post::where('post_status', '=', 'active')->get();
        return view('home.home.userpage', compact('post'));
    }

    public function productpage()
    {
        $product = product::paginate(20);
        return view('home.home.product', compact('product'));
    }


    public function userpage()
    {
        $post = Post::where('post_status', '=', 'active')->get();
        return view('home.home.userpage');
    }

    public function contact()
    {
        return view('home.contact.contact');
    }



    public function blog()
    {
        $post = post::paginate(20);

        return view('home.home.blog', compact('post'));
    }

    public function productdetail($id)
    {
        $product = product::find($id);
        return view('home.productdetail.productdetail', compact('product'));
    }

    public function about()
    {
        return view('home.about.about');
    }

    public function payment()
    {
        return view('home.payment.payment');
    }

    public function remove_cart($id)
    {
        $cart = cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function order()
    {
        return view('home.order.place_order');
    }

    public function cash_order()
    {
        $user = Auth::user();
        $userid = $user->id;
        $data = cart::where('user_id', '=', $userid)->get();

        foreach ($data as $data) {
            $order = new order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->street = $data->street;
            $order->city = $data->city;
            $order->country = $data->country;
            $order->user_id = $data->user_id;

            $order->product_name = $data->product_name;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->size = $data->size;
            $order->image = $data->image;
            $order->product_id = $data->product_id;

            $order->payment_status = 'Cash On Delivery';
            $order->delivery_status = 'Processing';

            $order->save();
            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message', 'Order Placed Successfully. We Will Contact You Soon!');
    }

    public function card_order()
    {
        $user = Auth::user();
        $userid = $user->id;
        $data = cart::where('user_id', '=', $userid)->get();

        foreach ($data as $data) {
            $order = new order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->street = $data->street;
            $order->city = $data->city;
            $order->country = $data->country;
            $order->user_id = $data->user_id;

            $order->product_name = $data->product_name;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->size = $data->size;
            $order->image = $data->image;
            $order->product_id = $data->product_id;

            $order->payment_status = 'Card Payment';
            $order->delivery_status = 'Processing';

            $order->save();
            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message', 'Order Placed Successfully. We Will Contact You Soon!');
    }

    public function view_order()
    {
        $user = Auth::user();
        $userid = $user->id;
        $order = order::where('user_id', '=', $userid)->get();
        return view('home.order.view_order', compact('order'));
    }

    public function cancel_order($id)
    {
        $order = order::find($id);
        $order->delivery_status = 'Order Cancelled';
        $order->save();
        return redirect()->back();
    }

    public function create_post()
    {
        return view('home.home.create_post');
    }

    public function user_post(Request $request)
    {

        // Get the currently authenticated user
        $user = Auth::user();

        $usertype = $user->usertype;
        $userid = $user->id;


        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->post_status = 'pending';
        $post->user_id = $userid;
        $post->creator = $user->name;
        // $post->creator=$creator;


        $post->date = $request->date;

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $request->image->move('postimage', $imagename);
            $post->image = $imagename;
        }
        $post->save();

        Alert::success('Congrats', 'You have Added the Blog Post Successfully');
        return redirect()->back();
    }

    public function my_post(Request $request)
    {
        $user = Auth::user();
        $userid = $user->id;

        $data = Post::where('user_id', '=', $userid)->get();
        $data->date = $request->date;

        return view('home.home.my_post', compact('data'));
    }

    public function my_post_delete($id)
    {
        $data = Post::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Post deleted Sucessfully');
    }


    public function post_update_page($id)
    {
        $data = Post::find($id);
        return view('home.home.post_update_page', compact('data'));
    }


    public function post_update_page_data(Request $request, $id)
    {
        $data = Post::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->date = $request->date;
        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $request->image->move('postimage', $imagename);
            $data->image = $imagename;
        }
        $data->save();
        return redirect()->back()->with('message', 'Post Updated Successfully.');
    }

    
}
