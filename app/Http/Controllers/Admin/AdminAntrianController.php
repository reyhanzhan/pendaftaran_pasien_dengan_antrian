<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Dokter;

class AdminAntrianController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('antrians')
            ->join('users', 'antrians.user_id', '=', 'users.id')
            ->leftJoin('dokters', 'antrians.dokter_id', '=', 'dokters.id')
            ->select(
                'antrians.*',
                'users.name as pasien_name',
                'users.nik as pasien_nik',
                'dokters.nama_dokter'
            );

        // Filter by date
        if ($request->tanggal) {
            $query->whereDate('antrians.tanggal', $request->tanggal);
        } else {
            $query->whereDate('antrians.created_at', today());
        }

        // Filter by status
        if ($request->status) {
            $query->where('antrians.status', $request->status);
        }

        $antrians = $query->orderBy('antrians.nomor', 'asc')->paginate(20);

        return view('admin.antrian.index', compact('antrians'));
    }

    public function create()
    {
        $dokters = Dokter::orderBy('nama_dokter')->get();
        return view('admin.antrian.create', compact('dokters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'dokter_id' => ['nullable', 'exists:dokters,id'],
            'tanggal' => ['required', 'date'],
            'jam_mulai' => ['nullable', 'date_format:H:i'],
            'jam_selesai' => ['nullable', 'date_format:H:i'],
        ]);

        // Generate nomor antrian
        $maxNomor = DB::table('antrians')->max('nomor') ?? 0;
        
        DB::table('antrians')->insert([
            'user_id' => $validated['user_id'],
            'dokter_id' => $validated['dokter_id'] ?? null,
            'nomor' => $maxNomor + 1,
            'hari' => \Carbon\Carbon::parse($validated['tanggal'])->isoFormat('dddd'),
            'tanggal' => $validated['tanggal'],
            'jam_mulai' => $validated['jam_mulai'] ?? null,
            'jam_selesai' => $validated['jam_selesai'] ?? null,
            'status' => 'menunggu',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.antrian.index')
            ->with('success', 'Antrian berhasil ditambahkan!');
    }

    public function show($id)
    {
        $antrian = DB::table('antrians')
            ->join('users', 'antrians.user_id', '=', 'users.id')
            ->leftJoin('dokters', 'antrians.dokter_id', '=', 'dokters.id')
            ->select(
                'antrians.*',
                'users.name as pasien_name',
                'users.email as pasien_email',
                'users.nik as pasien_nik',
                'users.no_telp as pasien_telp',
                'dokters.nama_dokter',
                'dokters.spesialisasi'
            )
            ->where('antrians.id', $id)
            ->first();

        if (!$antrian) {
            abort(404);
        }

        return view('admin.antrian.show', compact('antrian'));
    }

    public function edit($id)
    {
        $antrian = DB::table('antrians')->where('id', $id)->first();
        
        if (!$antrian) {
            abort(404);
        }

        $dokters = Dokter::orderBy('nama_dokter')->get();
        return view('admin.antrian.edit', compact('antrian', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'dokter_id' => ['nullable', 'exists:dokters,id'],
            'tanggal' => ['required', 'date'],
            'jam_mulai' => ['nullable', 'date_format:H:i'],
            'jam_selesai' => ['nullable', 'date_format:H:i'],
            'status' => ['required', 'in:menunggu,dipanggil,selesai,tidak_hadir'],
        ]);

        DB::table('antrians')
            ->where('id', $id)
            ->update([
                'dokter_id' => $validated['dokter_id'] ?? null,
                'hari' => \Carbon\Carbon::parse($validated['tanggal'])->isoFormat('dddd'),
                'tanggal' => $validated['tanggal'],
                'jam_mulai' => $validated['jam_mulai'] ?? null,
                'jam_selesai' => $validated['jam_selesai'] ?? null,
                'status' => $validated['status'],
                'updated_at' => now(),
            ]);

        return redirect()->route('admin.antrian.index')
            ->with('success', 'Antrian berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('antrians')->where('id', $id)->delete();

        return redirect()->route('admin.antrian.index')
            ->with('success', 'Antrian berhasil dihapus!');
    }

    // Additional method to call next patient
    public function callNext(Request $request)
    {
        $nextAntrian = DB::table('antrians')
            ->whereDate('created_at', today())
            ->where('status', 'menunggu')
            ->orderBy('nomor', 'asc')
            ->first();

        if ($nextAntrian) {
            // Set current "dipanggil" to "selesai"
            DB::table('antrians')
                ->whereDate('created_at', today())
                ->where('status', 'dipanggil')
                ->update(['status' => 'selesai', 'updated_at' => now()]);

            // Call next patient
            DB::table('antrians')
                ->where('id', $nextAntrian->id)
                ->update(['status' => 'dipanggil', 'updated_at' => now()]);

            return back()->with('success', 'Pasien nomor ' . $nextAntrian->nomor . ' dipanggil!');
        }

        return back()->with('info', 'Tidak ada antrian yang menunggu.');
    }
}
