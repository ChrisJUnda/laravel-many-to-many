<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $posts = Post::where('user_id', Auth::user()->id)->get();
        $posts = Post::all();


        // dd($posts);
        return view('admin.posts.index', compact('posts'));

        // return 'sono io';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $types = Type::all();

        $technologies = Technology::all();

        // dd($technolgies);

        return view('admin.posts.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        // dd($request->all());

        $current_user = Auth::user()->id;
        // dd($current_user);





        //Gestione Slug
        $data['slug'] = Str::of($data['title'])->slug();

        // $img_path = $request->hasFile('cover_image') ? $request->cover_image->store('uploads') : NULL;

        $img_path = $request->hasFile('cover_image') ? Storage::put('uploads', $data['cover_image']) : NULL;





        //Gestione immagine
        // $img_path = Storage::put('uploads', $data['cover_image']);

        $post = new Post();



        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->slug = $data['slug'];
        $post->cover_image = $img_path;
        $post->type_id = $data['type_id'];
        $post->user_id = $current_user;
        // $post->type_id = $request->input('type_id');
        $post->save();

        if ($request->has('technologies')) {
            $post->technologies()->attach($request->technologies);
        }


        return redirect()->route('admin.posts.index')->with('message', 'Progetto creato correttamente');
        // $post->slug = Str::of($post->title)->slug();
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $slug)
    public function show(Post $post)
    {
        // $post = Post::where('slug', $slug)->first();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $types = Type::all();

        $technologies = Technology::all();

        return view('admin.posts.edit', compact('post', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // dd($request->all());

        $data = $request->validated(); //se non validate,redirect a risorsa precedente



        $data['slug'] = Str::of($data['title'])->slug();
        $img_path = $request->hasFile('cover_image') ? $request->cover_image->store('uploads') : NULL;



        // $post->title = $data['title'];
        // $post->content = $data['content'];
        // $post->slug = $data['slug'];

        // $post->save();
        $post->update($data);
        $post->cover_image = $img_path;

        $post->save();

        if ($request->has('technologies')) {
            $post->technologies()->sync($request->technologies);
        } else {
            $post->technologies()->detach();
        }


        return redirect()->route('admin.posts.index')->with('message', $post->id . ' - Post aggiornato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        //se presente immagine la cancello
        $post->technologies()->detach();
        // $post->technologies()->sync([]);


        if ($post->cover_image) {
            //cancello immagine
            Storage::delete($post->cover_image);
        }

        $post_id = $post->id;


        // return 'Stai cancellando';
        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', $post_id . ' - Post aggiornato correttamente');
    }
}
