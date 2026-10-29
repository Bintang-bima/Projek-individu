<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateKritikRequest;
use App\Models\Kritik;

class KritikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kritiks = Kritik::with(['user', 'film'])->orderBy('id')->paginate(10);

        return view('admin.kritiks.index', compact('kritiks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kritik $kritik)
    {
        return view('admin.kritiks.edit', compact('kritik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKritikRequest $request, Kritik $kritik)
    {
        $kritik->update($request->validated());

        return redirect()->route('admin.kritiks.index')->with('success', 'Kritik berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kritik $kritik)
    {
        $kritik->delete();

        return redirect()->route('admin.kritiks.index')->with('success', 'Kritik berhasil dihapus.');
    }
}
