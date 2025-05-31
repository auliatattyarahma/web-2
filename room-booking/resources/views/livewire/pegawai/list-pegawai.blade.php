<div class="container mx-auto p-4">
    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <h1 class="text-2xl font-bold mb-4">List Pegawai</h1>

    {{-- New Pegawai Button --}}
    <div class="mb-4">
        <a href="{{ route('pegawai.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            New Pegawai
        </a>
    </div>

    {{-- Tabel Data Pegawai --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">No.</th>
                    <th class="py-2 px-4 border-b">NIP</th>
                    <th class="py-2 px-4 border-b">Nama</th>
                    <th class="py-2 px-4 border-b">Unit Kerja</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1; // Untuk nomor urut
                @endphp
                @foreach ($pegawais as $pegawai)
                    <tr>
                        <td class="py-2 px-4 border-b text-center">{{ $no++ }}</td>
                        <td class="py-2 px-4 border-b">{{ $pegawai->nip }}</td>
                        <td class="py-2 px-4 border-b">{{ $pegawai->nama }}</td>
                        <td class="py-2 px-4 border-b">
                            {{ $pegawai->unitKerja ? $pegawai->unitKerja->nama_unit : 'N/A' }}
                            {{-- Pastikan relasi unitKerja di model Pegawai sudah benar
                                dan kolom nama_unit ada di tabel unit_kerjas --}}
                        </td>
                        <td class="py-2 px-4 border-b text-center">
                            {{-- Tombol Edit dan Delete (perlu disesuaikan dengan Livewire) --}}
                            <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-xs">Edit</a>
                            <button wire:click="delete({{ $pegawai->id }})" wire:confirm="Are you sure you want to delete this Pegawai?" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>