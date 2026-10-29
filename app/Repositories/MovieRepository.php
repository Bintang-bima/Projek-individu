<?php

namespace App\Repositories;
use App\Models\{
    Film,
};
use App\Interfaces\MovieRepositoryInterface;

class MovieRepository implements MovieRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return Film::with('genre')->get();
    }

    public function getById($id)
    {
        return Film::with('genre')->findOrFail($id);
    }

    public function store(array $data)
    {
        return Film::create($data);
    }

    public function update(array $data, $id)
    {
        return Film::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Film::destroy($id);
    }
}
