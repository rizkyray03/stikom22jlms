<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class DosenController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        if ($dosen->user_id != auth()->id()) {
            abort(403, 'Tidak boleh mengintip');
        }
        return view('frontend.pages.dosen.profile.view-profile', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        if ($dosen->user_id != auth()->id()) {
            abort(403, 'Tidak boleh mengintip');
        }
        return view('frontend.pages.dosen.profile.update-profile', compact('dosen'));
    }


    public function update(Request $request, Dosen $dosen)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Validate the input data
        $request->validate([
            'nama' => 'required',
            'foto' => 'nullable|file',
            // Add more validation rules for other fields if needed
        ]);

        // Find the corresponding Dosen record
        $dosen = Dosen::where('user_id', $user->id)->first();

        if (!$dosen) {
            // Handle the case where Mahasiswa record doesn't exist for the user
            // Redirect or display an error message as needed
        }

        // Update the Mahasiswa record
        $dosen->nama = $request->input('nama');

        // Handle the file upload and update the "foto" field if a new file is uploaded
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('public/fotos');
            $dosen->foto = $fotoPath;
        }

        $dosen->save();

        return redirect()->route('dosen.show', ['dosen' => $dosen->id])->with('success', 'Profile updated successfully.');
    }


    public function editPassword(User $user)
    {
        // if ($dosen->user_id != auth()->id()) {
        //     abort(403, 'Tidak boleh mengintip');
        // }
        return view('frontend.pages.dosen.profile.update-password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8',
        ]);

        // Check if the provided current password matches the user's actual password
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }


        $password = $request->input('password');

        // // Use setAttribute to set the password attribute directly
        // $user->setAttribute('password', $password);

        $user->password = Hash::make($password);

        // Save the updated user record to the database
        $user->save();

        return redirect()->route('dosen.editPassword', $user->id)->with('success', 'Password updated successfully.');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
