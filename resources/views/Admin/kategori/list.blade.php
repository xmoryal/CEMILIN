@extends('Layouts.admin.app')

@section('content')
    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>List Kategori</h3>
            <a href="{{ route('admin.kategori.add') }}" class="btn btn-outline-primary">+ Tambah Kategori</a>
        </div>

        <div class="card mb-4 p-2">

            <!-- Kolom pencarian -->
            <div class="card-header">
                <form class="d-flex" role="search" method="GET" action="{{ route('admin.kategori.list') }}">
                    <input class="form-control me-2" type="search" name="search" placeholder="Cari kategori"
                        aria-label="Search" value="{{ request('search') }}" />
                    <button class="btn btn-outline-success me-2" type="submit">Cari</button>

                    @if (request()->filled('search'))
                        <a href="{{ route('admin.kategori.list') }}" class="btn btn-outline-secondary">Reset</a>
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
                                <th>Kategori</th>
                                <th>Dibuat pada</th>
                                <th>Diedit pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($kategori as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <!-- Edit dan Hapus akan diarahkan ke route Laravel masing-masing -->
                                        <a href="{{ route('admin.kategori.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.kategori.delete', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('yakin mau hapus? ntar ilang loh..')">Hapus</button>
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
                {{ $kategori->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </main>
@endsection
