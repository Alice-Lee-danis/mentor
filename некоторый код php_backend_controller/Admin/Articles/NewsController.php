<?php

namespace App\Http\Controllers\Admin\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Article\StoreArticleRequest;
use App\Models\Author;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function getNews()
    {
        $News = News::select('id','title')->get();

        return response()->json(['data'=>$News]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('id', 'desc')->paginate(30);

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = 'news';
        $authors = Author::all();
        return view('admin.news.create', compact('type', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $article = new News();
        $article->title = $request->title;
        $article->mini_description = $request->mini_description;
        $article->meta_title = $request->meta_title;
        $article->meta_description = $request->meta_description;
        $article->content = $request->description;
        $article->slug = $request->slug;
        $article->author_id = $request->author_id && is_numeric($request->author_id) ?
            $request->author_id : null;
        $article->publication_date = $request->publication_date;
        $article->time_to_read = $request->time_to_read;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = trim($file->getClientOriginalName());
            $folder = date('Y-m-d');
            $file->storeAs("public/articles/{$folder}", $name);
            $article->image = "{$folder}/{$name}";
        }
        $article->save();
        return redirect()->back()->withSuccess('Новость успешно добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = News::find($id);
        $type = 'news';
        $authors = Author::all();
        return view('admin.news.edit', compact('article', 'type', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArticleRequest $request, $id)
    {
        $article = News::find($id);
        $article->title = $request->title;
        $article->mini_description = $request->mini_description;
        $article->meta_title = $request->meta_title;
        $article->meta_description = $request->meta_description;
        $article->content = $request->description;
        $article->slug = $request->slug;
        $article->author_id = $request->author_id && is_numeric($request->author_id) ?
            $request->author_id : null;
        $article->publication_date = $request->publication_date;
        $article->time_to_read = $request->time_to_read;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = trim($file->getClientOriginalName());
            $folder = date('Y-m-d');
            $file->storeAs("public/articles/{$folder}", $name);
            $article->image = "{$folder}/{$name}";
        }
        $article->save();
        return redirect()->back()->withSuccess('Новость успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();

        return response()->json([
            'status' => 'Delete news ' . $news->title,
            'success' => true,
            ]);
    }
}
