<?php

namespace App\Http\Controllers\Landings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Landing\Banner;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $banners = Banner::orderBy('title','asc')->get();
        return view('landings.banner.index', compact('banners'));
    }
    public function add(Request $request)
    {
       return view('landings.banner.add');
    }
    public function edit(Request $request,$id)
    {
        $banner = Banner::where('id',$id)->first();
        return view('landings.banner.edit',compact('banner'));
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required'
        ]);
        $request->merge(['creator_id'=>auth()->user()->id]);
        $banner = Banner::create($request->all());
        logCreate(auth()->user()->id,$request->title,'Banner');

        if ($request->hasFile('image')) {
             $request->file('image')->move('images/banner/'.$banner->id,$request->file('image')->getClientOriginalName());
             $banner->image = $request->file('image')->getClientOriginalName();
             $banner->save();
        }
        return redirect()->route('banner.index')->with('sukses','Data Berhasil disimpan');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
             'title' => 'required',
             'image' => 'required'
        ]);
        $update = Banner::findOrFail($id)->update($request->all());
        logUpdate(auth()->user()->id,$request->title,'Banner');
        return redirect()->route('banner.index')->with('sukses','Data Berhasil disimpan');
    }

    public function delete($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete($banner);
        logDelete(auth()->user()->id,$banner->title,'Banner');
        return redirect()->route('banner.index')->with('sukses','Data Berhasil dihapus');
    }
}
