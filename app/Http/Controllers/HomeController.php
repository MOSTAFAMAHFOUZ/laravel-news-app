<?php

namespace App\Http\Controllers;

use App\Events\SendMailEvent;
use App\Models\Post;
use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // try{
        //     throw new Exception("exception in debugbar package");
        // }catch(Exception $e){
        //     Debugbar::addException($e);
        // }
        $posts = Post::with('user')->orderBy("created_at", "desc")->paginate(20);
        return view("posts.home", ['posts' => $posts]);
    }


    public function contactUs(){
        return view('front.contact');
    }
    public function sendMessage(Request $request){

        event(new SendMailEvent($request->all()));
        return back()->with('success','Message Have Been Sent Successfully !');
    }


}



// Debugbar::warning("hi barryvdh");
// Debugbar::startMeasure("first message" , "end message");
//
