<?php

namespace App\Http\Controllers;

use App\Models\Qiz;
use Illuminate\Http\Request;

class QizController extends Controller
{
    public function index()
    {
        $qizlar = Qiz::all();
        return view('qizlar.index', compact('qizlar'));
    }

    public function create()
    {
        return view('qizlar.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ism' => 'required|string|max:255',
            'sinfi' => 'nullable|string|max:50',
            'tavsif' => 'nullable|string',
            'rasm' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('rasm')) {
            $data['rasm'] = $request->file('rasm')->store('qizlar', 'public');
        }

        Qiz::create($data);

        return redirect()->route('qizlar.index')->with('success', 'Qiz muvaffaqiyatli qo‘shildi!');
    }
}
