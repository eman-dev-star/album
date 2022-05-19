<?php

namespace App\Http\Controllers;
use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
class AlbumController extends Controller
{
    public function index()
    {
        $albums=Album::get();
        return view('dashbord.albums.index',compact('albums'));
    }
    public function create()
    {
        return view('dashbord.albums.create');

    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data=$request->validate([
            'namealbum'=>'required',
            'nameimage'=>'required',
            // 'picture '=>'required'
        ]);
        $nameone=$request->namealbum;
        if ($request->picture) {
            $image = $request->picture;
            $name = Carbon::now()->toDateString();
            $nameImage = $name . " _ " . uniqid() . "." . $image->getClientOriginalExtension();
            $new='uploads/albums/'.$nameone;
            // dd($new);
            $image->move($new,$nameImage);
            // Image::make($request->picture)->resize(300, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->save(public_path('uploads/albums/'.$request->namealbum.'/'.
            //  $request->picture->hashName()));
        } //end of if

        $album=new Album();
        $album->name=$request->namealbum;
        $album->save();
        // $id=City::latest()->first()->id;
        $id = DB::table('albums')->get()->last()->id;

        // dd($id);
        Picture::create([
            'name'=>$request->nameimage,
            'picture'=>$nameImage,
            'album_id'=>$id,
        ]);

        // }
        session()->flash('success','added successfuly');
        return redirect()->route('albums.index');
    }

    public function show(Album $album)
    {
        return view('dashbord.albums.show',compact('album'));

    }
    public function addimage(Request $request){
        // dd($request->all());
        $request->validate([
            'nameimage'=>'required',
            'image'=>'required'
        ]);
        $album=Album::where('id',$request->album_id)->first();
        $nameone=$album->name;
        // dd($nameone);
        if ($request->image) {
            $image = $request->image;
            $name = Carbon::now()->toDateString();
            $nameImage = $name . " _ " . uniqid() . "." . $image->getClientOriginalExtension();
            $new='uploads/albums/'.$nameone;
            // dd($new);
            $image->move($new,$nameImage);
            // Image::make($request->image)->resize(300, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->save(public_path('uploads/albums/' . $request->image->hashName()));
        } //end of if
        Picture::create([
            'name'=>$request->nameimage,
            'picture'=>$nameImage,
            'album_id'=>$request->album_id,
        ]);
        session()->flash('success','added successfuly');
        return redirect()->route('albums.index');
    }

    public function editalbum(Request $request)
    {
        $album=Album::where('id',$request->id)->first();
        return view('dashbord.albums.editalbum',compact('album'));

    }

    public function edit(Album $album,Picture $picture)
    {
        $albums=Album::all();
        $picture=Picture::where('albumid_id',$album)->first();
        return view('dashbord.albums.edit',compact('albums','album','picture'));

    }
    public function allimage(Request $request)
    {
        $albums=Album::where('id',$request->id)->first();
        // dd($albums);
        $pictures=Picture::where('album_id',$request->id)->get();
        return view('dashbord.albums.allimage',compact('pictures','albums'));
    }
    public function editimage(Request $request)
    {
        // dd($request->id);
        $id=$request->id;
        $albums=Album::all();
        // $all=album::where('id',$id)->first();

        $picture=Picture::where('id',$id)->first();
        return view('dashbord.albums.editimage',compact('picture','albums'));



    }
    public function image(Request $request)
    {
        $data=$request->validate([
            'name'=>'required',
            // 'picture'=>'required',
            'album_id'=>'required',
        ]);
        $data=$request->except('picture');
        // $name=$request->namealbum;
        $pic=Picture::where('id',$request->id)->first();
        // dd($pic);
        // $pic->update($data)
        if ($request->picture) {

            // if ($pic->picture != 'album.png') {

            //     Storage::disk('public_uploads')->delete('/uploads/albums/' . $pic->picture);

            // }//end of if
            $name=$pic->album->name;
            // dd($name);
            $image = $request->picture;
            $namedate = Carbon::now()->toDateString();
            $nameImage = $namedate . " _ " . uniqid() . "." . $image->getClientOriginalExtension();
            $new='uploads/albums/'.$name;
            // dd($new);
            $image->move($new,$nameImage);
            $data['picture']=$nameImage;
        } //end of if
        $pic->update($data);
        // dd($pic);
        session()->flash('success','edit successfuly');
        return redirect()->back();
    }

    public function update(Request $request, Album $album)
    {
        $data=$request->validate(['name'=>'required']);
        if($album->Pictures){
        foreach($album->Pictures as $photo){
        Storage::disk('public_uploads')->move(
            ('/albums' .'/'.$album->name. '/' . $photo->picture),
            ('/albums'.'/'.$request->name . '/' . $photo->picture)
        );
      }
      Storage::disk('public_uploads')->deleteDirectory('/albums'."/". $album->name);
    }
        $album->update($data);
        session()->flash('success','edit successfuly');
        return redirect()->route('albums.index');

    }
    public function destroy(Album $album)
    {
        $image=$album->Pictures();
           foreach($album->Pictures as $photo)
           {
               unlink(public_path('uploads/albums/'. $album->name.'/'.$photo->picture));
           }
           Storage::disk('public_uploads')->deleteDirectory('/albums'."/". $album->name);
           $image->delete();
           $album->delete();
          session()->flash('success','delete successfuly');
          return redirect()->back();
    }
    public function anotheralbum(Request $request)
    {
        $album=Album::where('id',$request->id)->first();
        // $picture=picture::where('album_id',$request->id)->first();
        $image=$album->Pictures();
        // dd($album);
        $newdate = Carbon::now()->toDateString();
           foreach($album->Pictures as $photo)
           {
            Storage::disk('public_uploads')->move(
                ('/albums' .'/'.$album->name. '/' . $photo->picture),
                ('/albums'.'/'.$newdate.'-'.$album->name . '/' . $photo->picture)
            );
           }
           Storage::disk('public_uploads')->deleteDirectory('/albums'."/". $album->name);
           $image->delete();
           $album->delete();
          session()->flash('success','delete successfuly');
          return redirect()->back();
    }
}
