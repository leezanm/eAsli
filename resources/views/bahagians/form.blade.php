@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">
        @isset($bahagian)
            Edit Bahagian
        @else
            Tambah Bahagian Baru
        @endisset
    </h1>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="@isset($bahagian){{ route('bahagians.update', $bahagian) }}@else{{ route('bahagians.store') }}@endisset" method="POST" class="max-w-2xl">
        @csrf
        @isset($bahagian)
            @method('PUT')
        @endisset

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">
                Nama Bahagian <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded
                @error('name') border-red-500 @else border-gray-300 @enderror"
                value="{{ isset($bahagian) ? $bahagian->name : old('name') }}" required>
            @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="code" class="block text-gray-700 font-bold mb-2">
                Kode Bahagian
            </label>
            <input type="text" name="code" id="code" class="w-full px-4 py-2 border rounded
                @error('code') border-red-500 @else border-gray-300 @enderror"
                value="{{ isset($bahagian) ? $bahagian->code : old('code') }}">
            @error('code')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">
                Deskripsi
            </label>
            <textarea name="description" id="description" rows="5" class="w-full px-4 py-2 border rounded
                @error('description') border-red-500 @else border-gray-300 @enderror">{{ isset($bahagian) ? $bahagian->description : old('description') }}</textarea>
            @error('description')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="status" class="block text-gray-700 font-bold mb-2">
                Status <span class="text-red-500">*</span>
            </label>
            <select name="status" id="status" class="w-full px-4 py-2 border rounded
                @error('status') border-red-500 @else border-gray-300 @enderror" required>
                <option value="">Pilih Status</option>
                <option value="active" @selected(isset($bahagian) && $bahagian->status === 'active' || old('status') === 'active')>
                    Aktif
                </option>
                <option value="inactive" @selected(isset($bahagian) && $bahagian->status === 'inactive' || old('status') === 'inactive')>
                    Nonaktif
                </option>
            </select>
            @error('status')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                @isset($bahagian)
                    Perbarui
                @else
                    Simpan
                @endisset
            </button>
            <a href="{{ route('bahagians.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
