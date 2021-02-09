<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Movie $movies)
    {
        $q = $request->input('q');

        $active = 'Movies';

        $movies = $movies->when($q, function ($query) use ($q) {
            return $query->where('title', 'like', '%' . $q . '%');
        })
            ->paginate(10);

        $request = $request->all();

        return view('dashboard.movie.list', [
            'movies' => $movies,
            'request' => $request,
            'active' => $active
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'Movies';

        return view('dashboard.movie.form', [
            'active' => $active
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Movie $movie)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:Movie, title',
            'description' => 'required',
            'thumbnail' => 'required|image'
        ]);

        if ($validator->failed()) {
            return redirect()
                ->route('dashboard.movies.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $image = $request->file('thumbnail');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // save file ke dalam folder
            Storage::putFileAs('public/movies', $image, $filename);

            $movie->title = $request->input('title');
            $movie->description = $request->input('description');
            $movie->thumbnail = $filename;
            $movie->save();

            return redirect()
                ->route('dashboard.movies');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
