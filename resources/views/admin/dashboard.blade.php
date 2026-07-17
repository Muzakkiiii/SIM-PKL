<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIM PKL</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">

    <div class="min-h-screen flex flex-col">
        <!-- Top Navigation / Navbar -->
        <nav class="bg-gray-900 border-b border-gray-800 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                    <span class="text-lg font-bold text-white">Administrator Hubin</span>
                </a>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-300">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="mb-0">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 text-sm font-medium text-white bg-transparent border border-gray-600 rounded hover:bg-gray-800 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Content Area -->
        <main class="flex-1 max-w-7xl w-full mx-auto p-4 sm:p-6 lg:p-8 space-y-6">
            
            <!-- Session Alerts -->
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-md shadow-sm">
                    <div class="flex">
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md shadow-sm">
                    <div class="flex">
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Statistic Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                
                <!-- Card 1: Total Pendaftar -->
                <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Total Pendaftar</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $totalStudents }}</h3>
                    </div>
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Card 2: Menunggu Verifikasi -->
                <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-yellow-500">Menunggu</p>
                        <h3 class="text-2xl font-bold text-yellow-600 mt-1">{{ $pendingPlacements }}</h3>
                    </div>
                    <div class="p-3 bg-yellow-50 text-yellow-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Card 3: Disetujui -->
                <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-green-500">Disetujui</p>
                        <h3 class="text-2xl font-bold text-green-600 mt-1">{{ $approvedPlacements }}</h3>
                    </div>
                    <div class="p-3 bg-green-50 text-green-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Card 4: Ditolak -->
                <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-red-500">Ditolak</p>
                        <h3 class="text-2xl font-bold text-red-600 mt-1">{{ $rejectedPlacements }}</h3>
                    </div>
                    <div class="p-3 bg-red-50 text-red-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Card 5: Perusahaan Mitra -->
                <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-indigo-500">Mitra</p>
                        <h3 class="text-2xl font-bold text-indigo-600 mt-1">{{ $totalCompanies }}</h3>
                    </div>
                    <div class="p-3 bg-indigo-50 text-indigo-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Tabel Data Masuk Penempatan Siswa -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden mt-8">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800">Data Masuk Penempatan Siswa</h2>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                                <th class="px-6 py-4">Tanggal Daftar</th>
                                <th class="px-6 py-4">Nama Siswa / Kelas</th>
                                <th class="px-6 py-4">Perusahaan Pilihan</th>
                                <th class="px-6 py-4">Kontak Siswa</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm">
                            @forelse($placements as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                    {{ $item->created_at->format('d-m-Y') }}
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-800">{{ $item->student->name }}</div>
                                    <div class="text-gray-500 text-xs">{{ $item->student->nis }} - {{ $item->student->class_name }}</div>
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-800">{{ $item->company->name }}</div>
                                    <div class="text-gray-500 text-xs line-clamp-1">{{ $item->company->address }}</div>
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $item->student->phone }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($item->status == 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Menunggu
                                        </span>
                                    @elseif($item->status == 'approved')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Disetujui
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex gap-2 justify-center">
                                        <a href="{{ route('admin.edit', $item->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded shadow-sm transition">
                                            Verifikasi
                                        </a>

                                        @if($item->status == 'approved')
                                            <a href="{{ route('admin.print', $item->id) }}" target="_blank" class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded shadow-sm transition">
                                                Cetak PDF
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500 text-sm">
                                    Belum ada data pendaftaran siswa.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

</body>
</html>