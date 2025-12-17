@extends('base')
@section('title','Tambah Pegawai')
@section('menupegawai', 'underline decoration-4 underline-offset-7')
@section('content')
<section class="p-4 bg-white rounded-lg min-h-[50vh]">
    <h1 class="text-3xl font-bold text-[#C0392B] mb-6 text-center">Tambah Pegawai</h1>
    <div class="mx-auto max-w-screen-xl">

        <!-- Notifikasi sukses -->
        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-100 px-4 py-2 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <!-- Notifikasi error -->
        @if($errors->any())
            <div class="mb-4 rounded-md bg-red-100 px-4 py-2 text-red-800">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pegawai.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label>Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>Gender</label>
                <select name="gender" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Pilih Gender --</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div class="mb-4">
                <label>Pekerjaan</label>
                <select name="pekerjaan_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Pilih Pekerjaan --</option>
                    @foreach($pekerjaan as $p)
                        <option value="{{ $p->id }}" {{ old('pekerjaan_id') == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class=block text-gray-700 font-bold mb-2>Keamanan (Captcha)</label>
                <div class="flex items-center gap-3 mb-2">
                  <spanclass="rounded-lg overflow-hidden border border-gray-300">
                    {!! captcha_img('flat') !!}
                  </span>
                  <button type="button" id="refresh-captcha" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Ganti Gambar</button>
            </div>
            <input type="text" name="captcha" class="w-full border rounded px-3 py-2" placeholder="Masukkan kode di atas" required>

            @error('captcha')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
        </form>
    </div>
</section>
@endsection
