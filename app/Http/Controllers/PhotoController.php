<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{   
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function create()
    {   
        $photos = Photo::all();
        return view('upload', compact('photos'));
    }

    public function store(Request $request)
    {   
        $this ->validate($request, [
            'image' => 'required'
        ]); 

        $size = $request->file('image')->getSize();
        $name = $request->file('image')->getClientOriginalName();

        $request->file('image')->storeAs('public/iamges/', $name);
        $photo = new Photo();
        $photo->name = $name;
        $photo->size = $size;
        $photo->save();
        return redirect()->back();    
    }

    public function destroy(Photo $photos)
    {   
        $this->authorize('delete', $photos);
        $photos->delete();

        return back();
    }
}
