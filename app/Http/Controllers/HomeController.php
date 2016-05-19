<?php

namespace App\Http\Controllers;

use App\Domain\Content\Model\Content;
use App\Domain\Content\Model\Gallery;
use App\Domain\Content\Model\Order;
use App\Domain\Content\Model\Page;
use App\Domain\Content\Model\Product;
use App\Domain\Content\Model\Slide;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $more;
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $slides = Slide::all();
        $images   = Gallery::all();

        $news   = Content::all();
        $page = view('frontend.index', [ 'describeUs' => '','images' => $images, 'news' => $news, 'welcome' => '']);
        return view('frontend.home',['slides' => $slides, 'content' => $page, 'active' => 'index']);
    }

    public function getProjects()
    {
        $images   = Gallery::all();
        $page = view('frontend.section.gallery',['images' => $images]);
        return view('frontend.home',['content' => $page, 'active' => 'projects']);
    }

    public function getContactus()
    {
        $page = view('frontend.contact');
        return view('frontend.home',['content' => $page, 'active' => 'contactus']);
    }

    public function getArticles()
    {
        $news   = Content::all();
        $page = view('frontend.section.news', ['news' => $news]);
        return view('frontend.home',['content' => $page, 'active' => 'articles']);
    }

    public function getOrder()
    {
        $products = '';
        $page = view('frontend.order',['products' => $products]);
        return view('frontend.home',['content' => $page, 'active' => 'order']);
    }

    public function postOrder(Request $request)
    {
        $orderController = new OrderController(new Order(),new \App\Domain\Content\Form\Order());
        return $orderController->store($request);
    }

    public function getAboutus()
    {
        $product = '';
        $page = view('frontend.basic',['description' => 'متن درباره ما', 'title' => 'درباره ما']);
        return view('frontend.home',['content' => $page, 'active' => 'aboutus']);
    }

    public function getContact(){
        $content = '';
        $page = view('frontend.contact',['page' => '', 'title' => '']);
        return view('frontend.home',['content' => $page, 'active' => 'inconrdex']);
    }

    public function getOrdering(){
        $product = '';
        $page = view('frontend.ordering',['product' => $product]);
        return view('frontend.home',['content' => $page, 'more' => $this->more]);
    }

    public function getArticle($id){
        $news = Content::find($id);
        $page = view('frontend.basic',['content' => $news, 'title' => 'مقالات']);
        return view('frontend.home',['content' => $page, 'active' => 'articles']);
    }


}
