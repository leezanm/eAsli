@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Daftar Bahagian</h1>
        <a href="{{ route('bahagians.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Bahagian
        </a>
    </div>

    @if ($message = Session::get('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ $message }}
    </div>
    @endif

    @if ($bahagians->isEmpty())
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
        Tidak ada bahagian. <a href="{{ route('bahagians.create') }}" class="underline">Buat yang baru</a>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Kode</th>
                    <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bahagians as $bahagian)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">{{ $bahagian->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $bahagian->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $bahagian->code ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ Str::limit($bahagian->description, 50) ?? '-' }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="px-3 py-1 rounded text-sm font-semibold
                            @if ($bahagian->status === 'active')
                                bg-green-200 text-green-800
                            @else
                                bg-red-200 text-red-800
                            @endif
                        ">
                            {{ ucfirst($bahagian->status) }}
                        </span>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('bahagians.show', $bahagian) }}" class="text-blue-500 hover:underline mr-2">
                            Lihat
                        </a>
                        <a href="{{ route('bahagians.edit', $bahagian) }}" class="text-yellow-500 hover:underline mr-2">
                            Edit
                        </a>
                        <form action="{{ route('bahagians.destroy', $bahagian) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
