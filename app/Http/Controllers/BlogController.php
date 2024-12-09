<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function blog(Request $request){

        $query = Blog::query();

        if (request('search')) {
            $query->where('title', 'like', '%' . request('search') . '%');
        }

        $blogs = $query->latest()->paginate(8);

        return view('donation.blog', compact('blogs'));
    }

    public function create(Blog $blog){

        return view('donation.create', compact('blog'));
    }

    public function show(Blog $blog){
        return view('donation.show', compact('blog'));
    }

    public function store(Request $request){

        $validated = $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|max:255',
            'photo' => 'image|file|max:1024',
            'body' => 'required|max:65535'
        ]);

        if($request->file('photo')){
            $validated['photo'] = $request->file('photo')->store('blog-photos');
        }

        $validated['body'] = strip_tags($request->body);

        Blog::create($validated);

        return redirect()->route('donations.blog')->with('success', 'New Blog has been added!');
    }

    public function edit(Blog $blog){
        return view('donation.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog){
        $validated = $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|max:255',
            'photo' => 'image|file|max:1024',
            'body' => 'required|max:65535'
        ]);

        if($request->file('photo')){
            if($request->oldPhoto){
                Storage::delete($request->oldPhoto);
            }
            $validated['photo'] = $request->file('photo')->store('blog-photos');
        }

        $validated['body'] = strip_tags($request->body);

        Blog::where('id', $blog->id)
            ->update($validated)
        ;

        return redirect()->route('donations.blog')->with('success', 'Update Blog Success');
    }

    public function destroy(Blog $blog){

        if($blog->photo){
            Storage::disk('public')->delete($blog->photo);
        }

        $blog->delete();

        return redirect()->route('donations.blog')->with('success', 'Blog has been deleted');
    }


}
