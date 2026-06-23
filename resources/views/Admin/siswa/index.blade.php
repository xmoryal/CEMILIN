@extends('Layouts.admin.app')

@section('content')
    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Data Siswa</h3>
            <a href="{{ route('admin.siswa.add') }}" class="btn btn-outline-primary">+ Tambah Siswa</a>
        </div>

        <div class="card mb-4 p-2">

            <!-- Kolom pencarian -->
            <div class="card-header">
                <form class="d-flex" role="search" method="GET" action="{{ route('admin.siswa.index') }}">
                    <input class="form-control me-2" type="search" name="search" placeholder="Cari Siswa"
                        aria-label="Search" value="{{ request('search') }}" />
                    <button class="btn btn-outline-success me-2" type="submit">Cari</button>

                    @if (request()->filled('search'))
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </form>
            </div>

            <!-- table siswa -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Username</th>
                                <th>Dibuat pada</th>
                                <th>Diedit pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($siswa as $murid)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if(!empty($murid->foto) && file_exists(public_path('assets/img/profile/' . $murid->foto)))
                                        <img src="{{ asset('assets/img/profile/' . $murid->foto) }}" width="50" height="65">
                                        @else
                                        <img src="{{ asset('assets/img/profile/siswa.png') }}" width="50" height="65">
                                        @endif   
                                    </td>
                                    <td>{{ $murid->nama }}</td>
                                    <td>{{ $murid->kelas }}</td>
                                    <td>{{ $murid->username }}</td>
                                    <td>{{ $murid->created_at }}</td>
                                    <td>{{ $murid->updated_at }}</td>
                                    <td>
                                        <!-- Edit dan Hapus akan diarahkan ke route Laravel masing-masing -->
                                        <a href="{{ route('admin.siswa.edit', $murid->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.siswa.delete', $murid->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('yakin mau hapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            {{-- pagination --}}
            <div class="justify-content-center">
                {{ $siswa->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </main>
@endsection
