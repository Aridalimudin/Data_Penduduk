<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Penduduk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body class="bg-light">
    <main class="container">
      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h2>Detail Penduduk</h2>
        <div class="mb-3">
          <label class="form-label"><strong>Nama:</strong></label>
          <p>{{ $penduduk->nama }}</p>
        </div>
        <div class="mb-3">
          <label class="form-label"><strong>Alamat:</strong></label>
          <p>{{ $penduduk->alamat }}</p>
        </div>
        <div class="mb-3">
          <label class="form-label"><strong>Jenis Kelamin:</strong></label>
          <p>{{ $penduduk->jenis_kelamin }}</p>
        </div>
        <div class="mb-3">
          <label class="form-label"><strong>Tanggal Lahir:</strong></label>
          <p>{{ $penduduk->tanggal_lahir }}</p>
        </div>
        <div class="mb-3">
          <a href="{{ url('penduduks') }}" class="btn btn-secondary">&lt;&lt; Kembali</a>
        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>
