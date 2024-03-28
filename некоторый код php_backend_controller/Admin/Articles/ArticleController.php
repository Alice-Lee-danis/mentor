<?php

namespace App\Http\Controllers\Admin\Articles;

use App\Http\Controllers\Admin\Authors\AdminAuthorController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Article\StoreArticleRequest;
use App\Models\Article;
use App\Models\Author;
use Illuminate\Http\Request;
use function Termwind\renderUsing;

class ArticleController extends Controller
{
    public function getArticles()
    {
        $Articles = Article::select('id','title')->get();

        return response()->json(['data'=>$Articles]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('id', 'desc')->paginate(30);
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = 'articles';
        $authors = Author::all();
        return view('admin.articles.create', compact('type', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $article = new Article();
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
        return redirect()->back()->withSuccess('Статья успешно добавлена');
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
        $article = Article::find($id);
        $type = 'articles';
        $authors = Author::all();
        return view('admin.articles.edit', compact('article', 'type', 'authors'));
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
        $article = Article::find($id);
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
        return redirect()->back()->withSuccess('Статья успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return response()->json([
            'status' => 'Delete article ' . $article->title,
            'success' => true,
            ]);
    }
}
