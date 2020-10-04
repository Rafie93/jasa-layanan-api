<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sistems\Point;

class SistemPointController extends Controller
{
    public function index(Request $request)
    {
     $points = Point::orderBy('code','asc')->get();
     return view('master.point.index', compact('points'));
    }

    public function add(Request $request)
    {
        return view('master.point.add');
    }
    public function edit($id)
    {
        $point = Point::find($id);
        return view('master.point.edit',compact('point'));
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'code' => 'required|unique:point_sistem|max:4',
            'name' => 'required|unique:point_sistem|max:50',
            'point' => 'required',
        ]);
        $point = Point::create($request->all());
        logCreate(auth()->user()->id,$request->code.' - '.$request->point,'Point');
        return redirect()->route('point.index')->with('sukses','Data Berhasil disimpan');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
             'code' => 'required|max:4|unique:point_sistem,code,'.$id,
             'name' => 'required|max:50|unique:point_sistem,name,'.$id,
             'point' => 'required|numeric'
        ]);
        $update = Point::findOrFail($id)->update($request->all());
        logUpdate(auth()->user()->id,$request->code.' - '.$request->point,'Point');
        return redirect()->route('point.index')->with('sukses','Data Berhasil disimpan');
    }
    public function delete($id)
    {
        $point = Point::findOrFail($id);
        $point->delete($point);
        logUpdate(auth()->user()->id,$point->code.' - '.$point->name,'Point');
        return redirect()->route('point.index')->with('sukses','Data Berhasil dihapus');
    }
}
