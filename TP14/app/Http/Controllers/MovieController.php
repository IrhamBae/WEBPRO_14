<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    private $apiUrl = 'http://localhost:3000/movies';

    // Store a new movie
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'tahun_rilis' => 'required|integer',
            'deskripsi' => 'required|string',
        ]);

        Http::post($this->apiUrl, $data);

        return redirect()
            ->route('movies.index')
            ->with('success', 'Movie added successfully!');
    }

    // Display all movies
    public function index()
    {
        $movies = Http::get($this->apiUrl)->json();

        return view('index', compact('movies'));
    }

    // Edit a movie by ID
    public function edit($id)
    {
        $response = Http::get("{$this->apiUrl}/{$id}");

        if ($response->failed() || empty($response->json())) {
            return redirect()
                ->route('movies.index')
                ->with('error', 'Movie not found or server error!');
        }

        $movie = $response->json();

        return view('edit', compact('movie'));
    }

    // Update a movie by ID
    public function update(Request $request, $id)
    {
        Http::put("{$this->apiUrl}/{$id}", $request->all());

        return redirect()->route('movies.index');
    }

    // Delete a movie by ID
    public function destroy($id)
    {
        Http::delete("{$this->apiUrl}/{$id}");

        return redirect()->route('movies.index');
    }
}
