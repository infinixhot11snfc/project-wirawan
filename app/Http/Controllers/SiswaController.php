<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index()
    {
        $data_siswa = DB::table('data_siswa')->get();
        return view('siswa.index', ['data_siswa' => $data_siswa]);
    }

    public function tambah()
    {
        return view('siswa.tambah');
    }

    public function simpan(Request $request)
{
    $birthDate = $request->birth_date;
    $dateArray = explode('-', $birthDate);
    
    // Memeriksa apakah format tanggal sesuai dengan mm-dd-yyyy
    if (count($dateArray) === 3) {
        $month = $dateArray[0];
        $day = $dateArray[1];
        $year = $dateArray[2];

        // Memastikan bulan, hari (hingga 32), dan tahun berada dalam rentang yang valid
        if ($month >= 1 && $month <= 12 && $day >= 1 && $day <= 32 && $year > 0) {
            $birthDate = "{$year}-{$month}-{$day}";
        } else {
            return redirect('/siswa/tambah')
                ->with('error', 'Tanggal tidak valid. Harap pastikan formatnya mm-dd-yyyy dan tanggalnya antara 1 hingga 32.')
                ->withInput();
        }
    } else {
        return redirect('/siswa/tambah')
            ->with('error', 'Format tanggal salah. Harus mm-dd-yyyy.')
            ->withInput();
    }

    // Validasi input form
    $validator = Validator::make($request->all(), [
        'name' => 'required|regex:/^[a-zA-Z\s\']+$/',
        'email' => 'required|email|regex:/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/|unique:data_siswa,email',
        'address' => 'required',
        // Menghapus validasi 'date' untuk birth_date karena kita sudah memvalidasi manual
        'birth_date' => 'required|before_or_equal:today'
    ]);

    if ($validator->fails()) {
        return redirect('/siswa/tambah')
            ->withErrors($validator)
            ->withInput();
    }

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address,
        'birth_date' => $birthDate
    ];

    $simpan = DB::table('data_siswa')->insert($data);

    if ($simpan) {
        return redirect('/aplikasisekolah')->with('success', 'Data berhasil disimpan!');
    } else {
        return redirect('/siswa/tambah')->with('error', 'Gagal menyimpan data!')->withInput();
    }
}

    public function detail($id)
    {
        $siswa = DB::table('data_siswa')->where('id', $id)->first();
        return view('siswa.detail', ['siswa' => $siswa]);
    }

    public function ubah($id)
    {
        $siswa = DB::table('data_siswa')->where('id', $id)->first();
        return view('siswa.ubah', ['siswa' => $siswa]);
    }

    public function hapus($id)
    {
        DB::table('data_siswa')->where('id', $id)->delete();
        return redirect('/aplikasisekolah')->with('success', 'Data berhasil dihapus!');
    }
    public function update(Request $request, $id)
    {
        $birthDate = $request->birth_date;
        $dateArray = explode('-', $birthDate);

        if (count($dateArray) === 3) {
            $month = $dateArray[0];
            $day = $dateArray[1];
            $year = $dateArray[2];

            if ($month >= 1 && $month <= 12 && $day >= 1 && $day <= 32 && $year > 0) {
                $birthDate = "{$year}-{$month}-{$day}";
            } else {
                return redirect('/siswa/ubah/' . $id)
                    ->with('error', 'Tanggal tidak valid. Harap pastikan formatnya mm-dd-yyyy dan tanggalnya antara 1 hingga 32.')
                    ->withInput();
            }
        } else {
            return redirect('/siswa/ubah/' . $id)
                ->with('error', 'Format tanggal salah. Harus mm-dd-yyyy.')
                ->withInput();
        }

        // Ambil email saat ini dari database
        $currentEmail = DB::table('data_siswa')->where('id', $id)->value('email');

        // Tentukan aturan validasi untuk email
        $emailRules = 'required|email|regex:/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/';
        if ($request->email != $currentEmail) {
            // Jika email diubah, tambahkan validasi unique
            $emailRules .= '|unique:data_siswa,email';
        }

        // Validasi form input
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z\s\']+$/',
            'email' => $emailRules,
            'address' => 'required',
            'birth_date' => 'required|before_or_equal:today'
        ]);

        if ($validator->fails()) {
            return redirect('/siswa/ubah/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'birth_date' => $birthDate
        ];

        DB::table('data_siswa')->where('id', $id)->update($data);

        return redirect('/aplikasisekolah')->with('success', 'Data berhasil diperbarui!');
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $data_siswa = DB::table('data_siswa')
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('address', 'LIKE', "%{$query}%")
            ->get();

        return view('siswa.index', ['data_siswa' => $data_siswa]);
    }



}