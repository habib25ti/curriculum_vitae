<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CVController extends Controller
{
    public function index()
    {
        $cvs = Cv::latest()->paginate(15);
        return view('cv.index', compact('cvs'));
    }

    public function create()
    {
        return view('cv.form', ['cv' => new Cv(), 'mode' => 'create']);
    }

    public function store(Request $request)
    {
        $validated = $this->validateCv($request);

        if ($request->hasFile('foto_profil')) {
            $validated['foto_profil'] = $request->file('foto_profil')->store('cv/foto', 'public');
        }

        if ($request->hasFile('video_file')) {
            $validated['video_url'] = $request->file('video_file')->store('cv/video', 'public');
        } elseif (!empty($validated['video_url'])) {
            $validated['video_url'] = $this->normalizeVideoUrl($validated['video_url']);
        }

        unset($validated['video_file']);
        $cv = Cv::create($validated);

        return redirect()->route('cv.show', $cv)->with('success', 'CV berhasil dibuat.');
    }

    public function show(Cv $cv)
    {
        return view('cv.show', compact('cv'));
    }

    public function edit(Cv $cv)
    {
        return view('cv.form', ['cv' => $cv, 'mode' => 'edit']);
    }

    public function update(Request $request, Cv $cv)
    {
        $validated = $this->validateCv($request, $cv);

        if ($request->hasFile('foto_profil')) {
            if ($cv->foto_profil) Storage::disk('public')->delete($cv->foto_profil);
            $validated['foto_profil'] = $request->file('foto_profil')->store('cv/foto', 'public');
        } else {
            unset($validated['foto_profil']);
        }

        if ($request->hasFile('video_file')) {
            if ($cv->video_url && !filter_var($cv->video_url, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($cv->video_url);
            }
            $validated['video_url'] = $request->file('video_file')->store('cv/video', 'public');
        } elseif (!empty($validated['video_url'])) {
            $validated['video_url'] = $this->normalizeVideoUrl($validated['video_url']);
        } else {
            $validated['video_url'] = $cv->video_url;
        }

        unset($validated['video_file']);
        $cv->update($validated);

        return redirect()->route('cv.show', $cv)->with('success', 'CV berhasil diperbarui.');
    }

    public function destroy(Cv $cv)
    {
        if ($cv->foto_profil) Storage::disk('public')->delete($cv->foto_profil);
        if ($cv->video_url && !filter_var($cv->video_url, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($cv->video_url);
        }
        $cv->delete();

        return redirect()->route('cv.index')->with('success', 'CV berhasil dihapus.');
    }

    private function validateCv(Request $request, ?Cv $cv = null): array
    {
        return $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:150'],
            'profesi' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email:rfc', 'max:100', Rule::unique('tbl_cv', 'email')->ignore($cv?->id)],
            'no_telp' => ['required', 'regex:/^[0-9+\-\s()]{8,20}$/', 'max:20'],
            'tentang_saya' => ['required', 'string', 'max:5000'],
            'riwayat_pendidikan' => ['nullable', 'string', 'max:5000'],
            'keahlian' => ['nullable', 'string', 'max:3000'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'video_file' => ['nullable', 'file', 'mimes:mp4,webm,mov', 'max:5120'],
            'video_url' => ['nullable', 'string', 'max:255'],
        ], [
            'foto_profil.max' => 'Ukuran foto maksimal 2 MB.',
            'foto_profil.mimes' => 'Foto harus berformat JPG, JPEG, atau PNG.',
            'video_file.max' => 'Ukuran video maksimal 5 MB.',
            'email.unique' => 'Email tersebut sudah digunakan oleh CV lain.',
            'no_telp.regex' => 'Nomor telepon hanya boleh berisi angka dan tanda +, -, spasi, atau kurung.',
        ]);
    }

    private function normalizeVideoUrl(string $url): string
    {
        $url = trim($url);
        if (preg_match('~(?:youtube\.com/watch\?v=|youtu\.be/|youtube\.com/embed/)([A-Za-z0-9_-]{6,})~', $url, $match)) {
            return 'https://www.youtube-nocookie.com/embed/' . $match[1];
        }
        return $url;
    }
}
