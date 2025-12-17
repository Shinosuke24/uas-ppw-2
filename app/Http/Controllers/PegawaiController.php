<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');

        $data = Pegawai::with('pekerjaan')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('email', 'like', "%{$keyword}%");
            })
            ->paginate(10);

        return view('pegawai.index', compact('data'));
    }

    public function add()
    {
        $pekerjaan = Pekerjaan::all();
        return view('pegawai.add', compact('pekerjaan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|email|unique:shinosuke_534826ugm_pegawai,email',
            'pekerjaan_id' => 'required|exists:shinosuke_534826ugm_pekerjaan,id',
            'gender' => 'required|in:Male,Female',
            'captcha' => 'required|captcha'
        ], [
            'captcha.captcha' => 'Kode captcha yang Anda masukkan tidak sesuai.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Pegawai::create($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Data Pegawai berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Pegawai::findOrFail($id);
        $pekerjaan = Pekerjaan::all();
        return view('pegawai.edit', compact('data', 'pekerjaan'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|email|unique:shinosuke_534826ugm_pegawai,email,' . $id,
            'pekerjaan_id' => 'required|exists:shinosuke_534826ugm_pekerjaan,id',
            'gender' => 'required|in:Male,Female'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Data Pegawai berhasil diupdate');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete(); // Soft delete

        return redirect()->route('pegawai.index')->with('success', 'Data Pegawai berhasil dihapus');
    }
}
