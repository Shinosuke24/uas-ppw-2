@extends('base')
@section('title','Edit Pegawai')
@section('menupegawai', 'underline decoration-4 underline-offset-7')
@section('content')
<section class="p-4 bg-white rounded-lg min-h-[50vh]">
    <h1 class="text-3xl font-bold text-[#C0392B] mb-6 text-center">Edit Pegawai</h1>
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

        <form action="{{ route('pegawai.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $data->nama) }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $data->email) }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>Gender</label>
                <select name="gender" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Pilih Gender --</option>
                    <option value="Male" {{ old('gender', $data->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $data->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div class="mb-4">
                <label>Pekerjaan</label>
                <select name="pekerjaan_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Pilih Pekerjaan --</option>
                    @foreach($pekerjaan as $p)
                        <option value="{{ $p->id }}" {{ old('pekerjaan_id', $data->pekerjaan_id) == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <button type="reset" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Reset</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
            </div>
        </form>
    </div>
</section>
@endsection
