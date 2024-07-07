<!doctype html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Data Penduduk</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>
    <body class="bg-light">
        <main class="container">
            
    @if (Session::has('success'))
    <div class="pt-3">
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    </div>
    @endif
    
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="pb-3">
            <form class="d-flex" action="{{ route('penduduks.index') }}" method="GET">
                <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                <button class="btn btn-secondary" type="submit">Cari</button>
            </form>
        </div>
        
        <div class="pb-3">
            <a href="{{ route('penduduks.create') }}" class="btn btn-primary">+ Tambah Data Penduduk</a>
        </div>
        
        <table class="table table-striped">
            <thead>
          <tr>
            <th class="col-md-1">No</th>
            <th class="col-md-3">Nama</th>
            <th class="col-md-4">Alamat</th>
            <th class="col-md-2">Jenis Kelamin</th>
            <th class="col-md-2">Tanggal Lahir</th>
            <th class="col-md-2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $penduduk)
          <tr>
            <td>{{ $loop->iteration + $data->firstItem() - 1 }}</td>
            <td>{{ $penduduk->nama }}</td>
            <td>{{ $penduduk->alamat }}</td>
            <td>{{ $penduduk->jenis_kelamin }}</td>
            <td>{{ $penduduk->tanggal_lahir }}</td>
            <td>
              <div class="btn-group" role="group">
                <a href="{{ route('penduduks.show', $penduduk->id) }}" class="btn btn-info btn-sm">Lihat</a>
                <a href="{{ route('penduduks.edit', $penduduk->id) }}" class="btn btn-warning btn-sm mx-1">Edit</a>  <form action="{{ route('penduduks.destroy', $penduduk->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data penduduk ini?');">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $data->links() }}
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
