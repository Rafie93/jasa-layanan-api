<?php

namespace App\Http\Controllers\Landings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Landing\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $news = News::orderBy('title','asc')->get();
        return view('landings.news.index', compact('news'));
    }
    public function add(Request $request)
    {
       return view('landings.news.add');
    }
    public function edit(Request $request,$slug)
    {
        $news = News::where('slug',$slug)->first();
        return view('landings.news.edit',compact('news'));
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'thumbnail' => 'required'
        ]);
        $category_news = $request->category=="" ? 'N/A' : $request->category;
        $request->merge([
            'creator_id'=>auth()->user()->id,
            'slug' => $this->generateSlug($request->title,$category_news),
            'category_news'=> $category_news
            ]);
        $news = News::create($request->all());
        logCreate(auth()->user()->id,$request->title,'News');

        if ($request->hasFile('thumbnail')) {
             $request->file('thumbnail')->move('images/news/'.$news->id,$request->file('thumbnail')->getClientOriginalName());
             $news->thumbnail = $request->file('thumbnail')->getClientOriginalName();
             $news->save();
        }
        return redirect()->route('news.index')->with('sukses','Data Berhasil disimpan');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
             'title' => 'required',
        ]);
        $category_news = $request->category=="" ? 'N/A' : $request->category;
        $request->merge(['category_news'=> $category_news]);

        $update = News::findOrFail($id)->update($request->all());
        if ($request->hasFile('thumbnails')) {
            $request->file('thumbnails')->move('images/news/'.$id,$request->file('thumbnails')->getClientOriginalName());
            $update->thumbnail = $request->file('thumbnails')->getClientOriginalName();
            $update->save();
       }
        logUpdate(auth()->user()->id,$request->title,'News');
        return redirect()->route('news.index')->with('sukses','Data Berhasil disimpan');
    }

    public function delete($id)
    {
        $news = News::findOrFail($id);
        $news->delete($news);
        logDelete(auth()->user()->id,$news->title,'News');
        return redirect()->route('news.index')->with('sukses','Data Berhasil dihapus');
    }

    public function generateSlug($title,$category)
    {
        $news = News::orderBy('id','desc')->get();
        if($news->isEmpty()){
            $no = 1;
        }else{
            $no = $news->first()->id;
        }
        $title = str_replace(' ','-',$title);
        $slug = $title.'-'.$no;
        return $slug;
    }
}
