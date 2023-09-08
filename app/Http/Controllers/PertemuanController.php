<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use App\Models\Matkul;
use App\Models\Mtr_file;
use App\Models\Mtr_video;
use App\Models\Pertemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PertemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        //
    }


    public function indexPertemuan($id)
    {
        //$id di dapat dari route {{ route('pertemuan.indexPertemuan', ['id' => $matkul->id]) }} yang ada di Edit matkul
        // Find the Matkul model by ID di pass ke view untuk kembali ke Edit matkul page
        $id_matkul = Matkul::with('semester', 'prodi')->findOrFail($id);
        // Index semua pertemuan berdasarkan id yang di dapat dari page Edit matkul
        $pertemuans = Pertemuan::where('matkul_id', $id)->get();

        checkPermission($id_matkul->dosen_id, Auth::user()->dosen->id);
        return view('frontend/pages/dosen/pertemuan/view-pertemuan', compact('pertemuans', 'id_matkul'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id_matkul)
    {
        $matkul_id = $id_matkul;
        $matkul = Matkul::where('id', $matkul_id)->firstOrFail();
        return view('frontend/pages/dosen/pertemuan/tambah-pertemuan', compact('matkul_id', 'matkul'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Judul_pertemuan' => 'required',
            'instruksi' => 'required',
            'id_matkul' => 'required'
        ]);

        $matkul_id = $request->input('id_matkul');
        $pertemuan = new Pertemuan;
        $pertemuan->matkul_id = $matkul_id;
        $pertemuan->judul_pertemuan = $request->input('Judul_pertemuan');
        $pertemuan->instruksi = $request->input('instruksi');
        $pertemuan->save();

        return redirect()->route('pertemuan.indexPertemuan', ['id' => $matkul_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pertemuan = Pertemuan::findOrFail($id); // Assuming Resource is your model=
        $matkul_id = $pertemuan->matkul_id;
        $user = Auth::user();
        $youtubes = Mtr_video::where('pertemuan_id', $pertemuan->id)->get();
        $files = Mtr_file::where('pertemuan_id', $pertemuan->id)->get();
        $videos = Mtr_file::where('pertemuan_id', $pertemuan->id)->where('extensi', ['mp4', 'avi', 'mov', 'mkv'])->get();
        $images = Mtr_file::where('pertemuan_id', $pertemuan->id)->where('extensi', ['jpg', 'jpeg', 'png', 'gif', 'webp'])->get();

        if ($user->dosen) {
            $dosen_matkul = Matkul::where('id', $matkul_id)->first();
            return view('frontend.pages.mahasiswa.belajar.mahasiswa-belajar', compact('pertemuan', 'dosen_matkul', 'youtubes', 'files', 'videos', 'images'));
        } else {
            $mhs_matkul = Enroll::where('matkul_id', $pertemuan->matkul_id)->first();
            if ($mhs_matkul) {
                return view('frontend.pages.mahasiswa.belajar.mahasiswa-belajar', compact('pertemuan', 'mhs_matkul', 'youtubes', 'files', 'videos', 'images'));
            } else {
                abort(403, 'Anda belum terdaftar pada mata kuliah ini');
            }
        }
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
