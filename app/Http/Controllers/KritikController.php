<?php

namespace App\Http\Controllers;

use App\Models\Kritik;
use App\Models\Film;
use App\Http\Requests\StoreKritikRequest;
use App\Http\Requests\UpdateKritikRequest;
use Illuminate\Support\Facades\Auth;

class KritikController extends Controller
{
    /**
     * Store a user critique for a film (public site).
     */
    public function store(StoreKritikRequest $request, Film $film)
    {
        $film->kritiks()->create([
            'user_id' => Auth::id(),
            ...$request->validated(),
        ]);

        return redirect()->route('movies.show', $film->id)->with('success', 'Kritik berhasil dikirim. Terima kasih!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kritik $kritik)
    {
        //
    }
}
