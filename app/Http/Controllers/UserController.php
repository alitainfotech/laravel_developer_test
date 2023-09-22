<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Plan;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\UserStatus;
use App\Mail\orderSuccessfull;

class UserController extends Controller
{
    /**
     * Function to show all products on home page
     */
    public function index()
    {
        $products = Product::all();
        return view('user.home', compact('products'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function show(Product $product, Request $request)
    {
        $user = Auth::user();
        $price = $product->price;
        $intent = auth()->user()->createSetupIntent();
        return view('payment_form', [
            'user' => $user,
            'intent' => $intent,
            'product' => $product,
            'price' => $price
        ]);
    }

    /**
     * Function to process payment using stripe
     *
     * @return response()
     */
    public function processPayment(Request $request, $product, $price)
    {
        $user = Auth::user();
        $paymentMethod = $request->input('payment_method');
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);

        try {

            $user->charge($price * 100, $paymentMethod);
        } catch (Exception $e) {

            throw $e->getMessage();
            return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }

        $product = Product::where('id', $request->product)->first();

        if ($product->type === '0') {
            $user->assignRole('b2b-customer');
        } elseif ($product->type === '1') {
            $user->assignRole('b2c-customer');
        }

        $order_id = Str::random(8);

        Order::create([
            'order_id' => $order_id,
            'user_id' => Auth::Id(),
            'product_id' => $request->product,
            'quantity' => 1,
            'price' => $price,
            'status' => '0'
        ]);

        $mailData = [
            'title' => 'Order Successfull',
            'body' => 'This Mail to inform that Your order is successfull and yout order id is ' . $order_id
        ];

        Mail::to(Auth::user()->enail)->send(new orderSuccessfull($mailData));

        return redirect()->route('home')->with('success', 'Order placed successfully');
    }

    /**
     * Function to show User Dahbord
     *
     * @return responce()
     */
    public function dashbord()
    {

        if (Auth::user()->hasRole(['b2b-customer', 'b2c-customer'])) {

            $order = Order::where('user_id', Auth::id())->first();
            return view('dashboard', compact('order'));
        } elseif (Auth::user()->hasRole('admin')) {

            $users = User::where('id', Auth::id())->get();
            return view('dashboard', compact('users'));
        } else {
            return view('dashboard');
        }
    }

    /**
     * Function to cancle order
     */
    public function cancleOrder(Request $request, Order $order)
    {

        $order->update(['status' => '1']);
        return redirect()->route('dashboard')->with('success', 'Order Cancled');
    }

    /**
     * Function to change user's status
     */
    public function changeStatus(User $user)
    {

        if ($user->status === '0') {
            $user->update(['status' => '1']);

            $mailData = [
                'title' => 'User Account Deactivated',
                'body' => 'This Mail to inform that Account is Deactivated'
            ];

            Mail::to($user->email)->send(new UserStatus($mailData));
        } elseif ($user->status === '1') {
            $user->update(['status' => '0']);

            $mailData = [
                'title' => 'User Account Activated',
                'body' => 'This Mail to inform that Account is Activated',
            ];

            Mail::to($user->email)->send(new UserStatus($mailData));
        }

        return redirect()->route('dashboard');
    }
}
