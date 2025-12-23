<?php

namespace App\Http\Controllers;

use App\Models\news;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = news::all();
        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'excerpt'   => 'required|integer',
            'date'      => 'required|string',
            'writer'    => 'required|string|max:255',
            'thumbnail' => 'nullable|string',
        ]);

        news::create($validated);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(news $news)
    {
        return response()->json(news::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(news $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, news $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(news $news)
    {
        $news = news::findOrFail($id);
        $news->delete();

        return back();
    }
}
