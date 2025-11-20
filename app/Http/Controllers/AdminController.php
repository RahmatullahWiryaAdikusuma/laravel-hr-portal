<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterLowongan;
use App\Models\TransaksiPendaftar;
use App\Models\MasterDepartemen;

class AdminController extends Controller
{
     public function pendaftarIndex()
    {
        $pendaftar = TransaksiPendaftar::with('lowongan')->latest()->get();
        return view('admin.pendaftar.index', compact('pendaftar'));
    }

    public function approval(Request $request, $id)
    {
         
        $status = $request->input('status'); 
        TransaksiPendaftar::where('id', $id)->update(['status' => $status]);
        return back()->with('success', 'Status updated!');
    }

     
    public function report()
    {
        
        $reports = MasterDepartemen::with(['lowongan.pendaftar'])->get()->map(function($dept) {
             
            $totalQuota = $dept->lowongan->sum('quota');
            
             
            $diterima = $dept->lowongan->flatMap->pendaftar->where('status', 'A')->count();
            $ditolak = $dept->lowongan->flatMap->pendaftar->where('status', 'R')->count();
            
            return [
                'departemen' => $dept->name,
                'total_quota' => $totalQuota,
                'diterima' => $diterima,
                'ditolak' => $ditolak,
                'sisa_quota' => $totalQuota - $diterima  
            ];
        });

        
        $summaryStatus = [
            'diterima' => TransaksiPendaftar::where('status', 'A')->count(),
            'ditolak' => TransaksiPendaftar::where('status', 'R')->count(),
            'total' => TransaksiPendaftar::whereIn('status', ['A', 'R'])->count()
        ];

        return view('admin.report.index', compact('reports', 'summaryStatus'));
    }
}
