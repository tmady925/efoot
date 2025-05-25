<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Stream;
use App\Models\Result;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;

class LandingPageController extends Controller
{
    public function index(){

        $latest_posts=Post::where('status','published')->orderBy('created_at','DESC')->take(4)->get();
        $upcoming_results=Result::orderBy('created_at','DESC')->where('status','upcoming')->take(3)->get();
        $finished_results=Result::orderBy('created_at','DESC')->where('status','finished')->take(3)->get();
        $players=Player::orderBy('created_at','DESC')->take(6)->get();
        $testimonials=Testimonial::orderBy('created_at','DESC')->where('status','published')->take(3)->get();
        $streams=Stream::orderBy('created_at','DESC')->take(6)->get();
        return view('landing-page',compact('latest_posts','upcoming_results','finished_results','players','testimonials','streams'));
    }

}
