@extends('Layouts.admin.app')

@section('content')
    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Data Kantin</h3>
            <a href="{{ route('admin.kantin.add') }}" class="btn btn-outline-primary">+ Tambah Kantin</a>
        </div>

        <div class="card mb-4 p-2">

            <!-- Kolom pencarian -->
            <div class="card-header">
                <form class="d-flex" role="search" method="GET" action="{{ route('admin.kantin.index') }}">
                    <input class="form-control me-2" type="search" name="search" placeholder="Cari Kantin"
                        aria-label="Search" value="{{ request('search') }}" />
                    <button class="btn btn-outline-success me-2" type="submit">Cari</button>

                    @if (request()->filled('search'))
                        <a href="{{ route('admin.kantin.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </form>
            </div>

            <!-- table kantin -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama Kantin</th>
                                <th>Email</th>
                                <th>Dibuat pada</th>
                                <th>Diedit pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($kantin as $kantins)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if(!empty($kantins->foto) && file_exists(public_path('assets/img/profile/' . $kantins->foto)))
                                        <img src="{{ asset('assets/img/profile/' . $kantins->foto) }}" width="100">
                                        @else
                                        <img src="{{ asset('assets/img/profile/toko.jpeg') }}" width="100">
                                        @endif   
                                    </td>
                                    <td>{{ $kantins->nama_kantin }}</td>
                                    <td>{{ $kantins->email }}</td>
                                    <td>{{ $kantins->created_at }}</td>
                                    <td>{{ $kantins->updated_at }}</td>
                                    <td> 
                                        <form action="{{ route('admin.kantin.delete', $kantins->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('yakin mau hapus?')">Hapus</button>
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
                {{ $kantin->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </main>
@endsection
