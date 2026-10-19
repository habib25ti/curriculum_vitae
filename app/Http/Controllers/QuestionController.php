<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // 1. Validasi input
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'pertanyaan' => 'required'
        ]);

        // 2. Redirect kembali ke Home untuk memunculkan alert (Mencegah submit ulang)
        return redirect()->back()->with([
            'success' => true,
            'nama' => $request->nama,
            'email' => $request->email,
            'pertanyaan' => $request->pertanyaan
        ]);
    }

    /**
     * Menampilkan halaman respon (home-question-respon)
     */
    public function response()
    {
        // Cegah akses langsung jika tidak ada session data (misal saat user iseng reload halaman ini)
        if (!session()->has('success')) {
            return redirect()->back();
        }

        return view('home-question-respon', [
            'nama' => session('nama'),
            'email' => session('email'),
            'pertanyaan' => session('pertanyaan')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
