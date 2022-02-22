<?php

namespace App\Http\Controllers;

use App\Area;
use App\Article;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $articles =
            Article::when(isset(request()->search), function ($q) {
                $search = request()->search;
                return $q->orwhere("title", "like", "%$search%");

            })->with(['user', 'category','areas'])->latest('id')->paginate(7);

        return view('juswisearticle.index')->with(['articles'=>$articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $areas = Area::get();

        // dd($categories);
        // dd($areas);
        return view('juswisearticle.create')->with(['categories'=>$categories,'areas'=>$areas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            "title" => "required|min:5|max:255",
            "questionforstudentreader" => "required|min:5|max:100",
            "categoryidselector" => "required|exists:categories,id",
            "articlebody" => "required|min:5",
            "areaidcarrier" => "required|min:1",
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);
  
        $imageName = time().'.'.$request->image->extension();  
   
        $request->image->move(public_path('uploads'), $imageName);

        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->articlebody;
        $article->question_for_student_reader = $request->questionforstudentreader;
        $article->user_id = Auth::id();
        $article->category_id = $request->categoryidselector;
        $article->image = $imageName;
        $article->save();

        $areaIds = explode(",",$request->areaidcarrier);
        $article->areas()->attach($areaIds);

        return redirect()->route('article.create')->with('toast', ['icon' => 'success', 'title' => 'New Category Created']);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $categories = Category::get();
        $areas = Area::get();
        return view('juswisearticle.show', compact('article','categories','areas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = Category::get();
        $areas = Area::get();
        return view('juswisearticle.edit', compact('article','categories','areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    { 
        $imageName = "";
        if($request->image == null)
        {
            $request->validate([
                "title" => "required|min:5|max:255",
                "questionforstudentreader" => "required|min:5|max:100",
                "categoryidselector" => "required|exists:categories,id",
                "articlebody" => "required|min:5",
                "areaidcarrier" => "required|min:1",
            ]);
        }
        else{
            $request->validate([
                "title" => "required|min:5|max:255",
                "questionforstudentreader" => "required|min:5|max:100",
                "categoryidselector" => "required|exists:categories,id",
                "articlebody" => "required|min:5",
                "areaidcarrier" => "required|min:1",
                "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            ]);
            $imageName = time().'.'.$request->image->extension();  
   
            $request->image->move(public_path('uploads'), $imageName);    
            if(\File::exists(public_path('uploads/'.$article->image))){
                \File::delete(public_path('uploads/'.$article->image));
              }
        }
        
        $newarticle = $article;
        $newarticle->title = $request->title;
        $newarticle->description = $request->articlebody;
        $newarticle->question_for_student_reader = $request->questionforstudentreader;
        $newarticle->user_id = Auth::id();
        $article->category_id = $request->categoryidselector;

        if($request->image!=null)
        {
            $article->image = $imageName;   
        }
        $newarticle->update();

        $areaIds = explode(",",$request->areaidcarrier);
        $newarticle->areas()->sync($areaIds);

        return redirect()->route('article.index')->with('toast', ['icon' => 'success', 'title' => 'New Category Created']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->back()->with('toast', ['icon' => 'success', 'title' => "Case is deleted."]);
    }
}
