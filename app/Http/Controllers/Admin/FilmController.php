<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::with('genre')->orderByDesc('id')->paginate(10);

        return view('admin.films.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::orderBy('name')->get();

        return view('admin.films.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFilmRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('poster')) {
            $data['poster'] = 'storage/' . $request->file('poster')->store('images', 'public');
        }

        Film::create($data);

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        $genres = Genre::orderBy('name')->get();

        return view('admin.films.edit', compact('film', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFilmRequest $request, Film $film)
    {
        $data = $request->validated();

        if ($request->hasFile('poster')) {
            // Store the new poster...
            $data['poster'] = 'storage/' . $request->file('poster')->store('images', 'public');

            // ...and remove the old one if it lives in our storage.
            if (str_starts_with($film->poster, 'storage/images/')) {
                Storage::disk('public')->delete(substr($film->poster, strlen('storage/')));
            }
        }

        $film->update($data);

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        if (str_starts_with($film->poster, 'storage/images/')) {
            Storage::disk('public')->delete(substr($film->poster, strlen('storage/')));
        }

        $film->delete();

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil dihapus.');
    }
}
