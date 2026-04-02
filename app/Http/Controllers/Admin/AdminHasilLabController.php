<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilLab;
use App\Models\User;
use Illuminate\Http\Request;

class AdminHasilLabController extends Controller
{
    public function index(Request $request)
    {
        $query = HasilLab::with('user');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nomor_lab', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function($q2) use ($request) {
                      $q2->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $hasilLabs = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.hasil-lab.index', compact('hasilLabs'));
    }

    public function create()
    {
        $pasiens = User::where('is_admin', false)->orderBy('name')->get();
        return view('admin.hasil-lab.create', compact('pasiens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'tanggal_pemeriksaan' => ['required', 'date'],
            'jenis_pemeriksaan' => ['required', 'string', 'max:255'],
            'dokter_pengirim' => ['nullable', 'string', 'max:255'],
            'catatan' => ['nullable', 'string'],
            'status' => ['required', 'in:proses,selesai,diambil'],
        ]);

        // Generate nomor lab
        $date = now()->format('Ymd');
        $count = HasilLab::whereDate('created_at', today())->count() + 1;
        $validated['nomor_lab'] = 'LAB-' . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);

        // Parse hasil if provided
        if ($request->has('hasil_parameter')) {
            $hasil = [];
            $parameters = $request->input('hasil_parameter', []);
            $nilais = $request->input('hasil_nilai', []);
            $satuans = $request->input('hasil_satuan', []);
            $normals = $request->input('hasil_normal', []);
            $statuses = $request->input('hasil_status', []);

            for ($i = 0; $i < count($parameters); $i++) {
                if (!empty($parameters[$i])) {
                    $hasil[] = [
                        'parameter' => $parameters[$i],
                        'hasil' => $nilais[$i] ?? '',
                        'satuan' => $satuans[$i] ?? '',
                        'nilai_normal' => $normals[$i] ?? '',
                        'status' => $statuses[$i] ?? 'normal',
                    ];
                }
            }
            $validated['hasil'] = $hasil;
        }

        HasilLab::create($validated);

        return redirect()->route('admin.hasil-lab.index')
            ->with('success', 'Hasil lab berhasil ditambahkan!');
    }

    public function show(HasilLab $hasilLab)
    {
        $hasilLab->load('user');
        return view('admin.hasil-lab.show', compact('hasilLab'));
    }

    public function edit(HasilLab $hasilLab)
    {
        $pasiens = User::where('is_admin', false)->orderBy('name')->get();
        return view('admin.hasil-lab.edit', compact('hasilLab', 'pasiens'));
    }

    public function update(Request $request, HasilLab $hasilLab)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'tanggal_pemeriksaan' => ['required', 'date'],
            'jenis_pemeriksaan' => ['required', 'string', 'max:255'],
            'dokter_pengirim' => ['nullable', 'string', 'max:255'],
            'catatan' => ['nullable', 'string'],
            'status' => ['required', 'in:proses,selesai,diambil'],
        ]);

        // Parse hasil if provided
        if ($request->has('hasil_parameter')) {
            $hasil = [];
            $parameters = $request->input('hasil_parameter', []);
            $nilais = $request->input('hasil_nilai', []);
            $satuans = $request->input('hasil_satuan', []);
            $normals = $request->input('hasil_normal', []);
            $statuses = $request->input('hasil_status', []);

            for ($i = 0; $i < count($parameters); $i++) {
                if (!empty($parameters[$i])) {
                    $hasil[] = [
                        'parameter' => $parameters[$i],
                        'hasil' => $nilais[$i] ?? '',
                        'satuan' => $satuans[$i] ?? '',
                        'nilai_normal' => $normals[$i] ?? '',
                        'status' => $statuses[$i] ?? 'normal',
                    ];
                }
            }
            $validated['hasil'] = $hasil;
        }

        $hasilLab->update($validated);

        return redirect()->route('admin.hasil-lab.index')
            ->with('success', 'Hasil lab berhasil diperbarui!');
    }

    public function destroy(HasilLab $hasilLab)
    {
        $hasilLab->delete();

        return redirect()->route('admin.hasil-lab.index')
            ->with('success', 'Hasil lab berhasil dihapus!');
    }
}
