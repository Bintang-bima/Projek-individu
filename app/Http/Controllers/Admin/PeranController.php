<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePeranRequest;
use App\Http\Requests\UpdatePeranRequest;
use App\Models\Cast;
use App\Models\Film;
use App\Models\Peran;

class PeranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perans = Peran::with(['film', 'cast'])->orderBy('id')->paginate(10);

        return view('admin.perans.index', compact('perans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $films = Film::orderBy('title')->get();
        $casts = Cast::orderBy('name')->get();

        return view('admin.perans.create', compact('films', 'casts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePeranRequest $request)
    {
        Peran::create($request->validated());

        return redirect()->route('admin.perans.index')->with('success', 'Peran berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peran $peran)
    {
        $films = Film::orderBy('title')->get();
        $casts = Cast::orderBy('name')->get();

        return view('admin.perans.edit', compact('peran', 'films', 'casts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePeranRequest $request, Peran $peran)
    {
        $peran->update($request->validated());

        return redirect()->route('admin.perans.index')->with('success', 'Peran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peran $peran)
    {
        $peran->delete();

        return redirect()->route('admin.perans.index')->with('success', 'Peran berhasil dihapus.');
    }
}
