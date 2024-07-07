<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    /**
     * Menampilkan daftar resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 10;

        if (strlen($katakunci)) {
            $data = Penduduk::where('nama', 'like', "%{$katakunci}%")
                ->orWhere('alamat', 'like', "%{$katakunci}%")
                ->orWhere('jenis_kelamin', 'like', "%{$katakunci}%")
                ->orWhere('tanggal_lahir', 'like', "%{$katakunci}%")
                ->paginate($jumlahbaris);
        } else {
            $data = Penduduk::orderBy('id', 'desc')->paginate($jumlahbaris);
        }

        return view('penduduks.index')->with('data', $data);
    }

    /**
     * Menampilkan form untuk membuat resource baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penduduks.create');
    }

    /**
     * Menyimpan resource baru ke dalam storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('nama', $request->nama);
        Session::flash('alamat', $request->alamat);
        Session::flash('jenis_kelamin', $request->jenis_kelamin);
        Session::flash('tanggal_lahir', $request->tanggal_lahir);

        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid',
        ]);

        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
        ];
        Penduduk::create($data);

        return redirect()->to('penduduks')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Menampilkan resource yang ditentukan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        return view('penduduks.show', compact('penduduk'));
    }

    /**
     * Menampilkan form untuk mengedit resource yang ditentukan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Penduduk::where('id', $id)->first();
        return view('penduduks.edit')->with('data', $data);
    }

    /**
     * Memperbarui resource yang ditentukan dalam storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid',
        ]);

        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
        ];
        Penduduk::where('id', $id)->update($data);

        return redirect()->to('penduduks')->with('success', 'Berhasil mengupdate data');
    }

    /**
     * Menghapus resource yang ditentukan dari storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Penduduk::where('id', $id)->delete();
        return redirect()->to('penduduks')->with('success', 'Berhasil menghapus data');
    }

    /**
     * Mengekspor data ke PDF.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportPdf()
    {
        $data = Penduduk::all();
        $pdf = Pdf::loadView('penduduks.pdf', compact('data'));
        return $pdf->download('data_penduduk.pdf');
    }
}
