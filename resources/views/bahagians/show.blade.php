@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">{{ $bahagian->name }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('bahagians.edit', $bahagian) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                Edit
            </a>
            <form action="{{ route('bahagians.destroy', $bahagian) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <h3 class="text-gray-600 font-semibold mb-2">Nama Bahagian</h3>
                <p class="text-lg">{{ $bahagian->name }}</p>
            </div>
            <div>
                <h3 class="text-gray-600 font-semibold mb-2">Kode</h3>
                <p class="text-lg">{{ $bahagian->code ?? '-' }}</p>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-gray-600 font-semibold mb-2">Deskripsi</h3>
            <p class="text-lg">{{ $bahagian->description ?? '-' }}</p>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <h3 class="text-gray-600 font-semibold mb-2">Status</h3>
                <span class="px-3 py-1 rounded text-sm font-semibold
                    @if ($bahagian->status === 'active')
                        bg-green-200 text-green-800
                    @else
                        bg-red-200 text-red-800
                    @endif
                ">
                    {{ ucfirst($bahagian->status) }}
                </span>
            </div>
            <div>
                <h3 class="text-gray-600 font-semibold mb-2">Dibuat Pada</h3>
                <p class="text-lg">{{ $bahagian->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <div class="mt-6">
            <h3 class="text-gray-600 font-semibold mb-2">Terakhir Diperbarui</h3>
            <p class="text-lg">{{ $bahagian->updated_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('bahagians.index') }}" class="text-blue-500 hover:underline">
            ← Kembali ke Daftar
        </a>
    </div>
</div>
@endsection
