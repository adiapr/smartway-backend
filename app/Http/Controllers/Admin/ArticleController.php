<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $article = Article::latest()->paginate(20);

        return view('admin.article.index', compact('article'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'method' => 'POST',
            'url' => route('article.store'),
        ];
        return view('admin.article._form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:articles',
            'category' => 'required',
            'cover' => 'required',
            'caption' => 'required|min:250|max:500',
            'body' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['publishment'] = 'draft';
        $data['user_id'] = auth()->user()->id;

        $article = Article::create($data);
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $article->addMediaFromRequest('cover')->toMediaCollection('article');
        }
        toastr('Artikel tersimpan dalam draft', 'success');
        return redirect()->route('article.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'method' => 'put',
            'article' => Article::whereSlug($id)->firstOrFail(),
            'url' => route('article.update', $id),
        ];
        return view('admin.article._form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::whereSlug($id)->firstOrFail();
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        // $data['publishment'] = 'draft';
        $data['user_id'] = auth()->user()->id;
        $article->update($data);

        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $article->clearMediaCollection('cover');
            $article->addMediaFromRequest('cover')->toMediaCollection('cover');
        }

        toastr('Artikel telah terdedit', 'success');
        return redirect()->route('article.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Article::find($id); 
        $payment->delete();

        if ($payment) {
            return response()->json([
                "status" => "success"
            ]);
        } else {
            return response()->json([
                "status" => "error"
            ]);
        }
    }

    public function publish($id){
        $data = Article::findOrFail($id);
        $data->publishment = 'published';
        $data->update();

        toastr('Artikel berhasil di publish', 'success');
        return back();
    }

    public function reject($id){
        $data = Article::findOrFail($id);
        $data->publishment = 'rejected';
        $data->update();

        toastr('Artikel berhasil di tolak', 'success');
        return back();
    }
}
