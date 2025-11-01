<?php

namespace App\Http\Controllers;

use App\Models\Qiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QizController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $qizlar = Qiz::query()
            ->when($search, function ($query, $search) {
                $query->where('fio', 'like', "%{$search}%")
                    ->orWhere('sinfi', 'like', "%{$search}%")
                    ->orWhere('yoshi', 'like', "%{$search}%")
                    ->orWhere('telefon_raqami', 'like', "%{$search}%")
                    ->orWhere('mazili', 'like', "%{$search}%");
            })
            ->orderBy('fio')
            ->paginate(10);

        return view('qizlar.index', compact('qizlar', 'search'));
    }

    public function create()
    {
        return view('qizlar.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fio' => 'required|string|max:255',
            'yoshi' => 'nullable|integer|min:6|max:25',
            'sinfi' => 'nullable|string|max:10',
            'telefon_raqami' => 'nullable|string|max:20',
            'mazili' => 'nullable|string|max:255',
            'rasmi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('rasmi')) {
            $data['rasmi'] = $request->file('rasmi')->store('qizlar', 'public');
        }

        Qiz::create($data);

        return redirect()->route('qizlar.index')->with('success', 'Muvaffaqiyatli qo‘shildi!');
    }

    public function edit(Qiz $qiz)
    {
        return view('qizlar.edit', compact('qiz'));
    }

    public function update(Request $request, Qiz $qiz)
    {
        $data = $request->validate([
            'fio' => 'required|string|max:255',
            'yoshi' => 'nullable|integer|min:6|max:25',
            'sinfi' => 'nullable|string|max:10',
            'telefon_raqami' => 'nullable|string|max:20',
            'mazili' => 'nullable|string|max:255',
            'rasmi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('rasmi')) {
            if ($qiz->rasmi && Storage::disk('public')->exists($qiz->rasmi)) {
                Storage::disk('public')->delete($qiz->rasmi);
            }
            $data['rasmi'] = $request->file('rasmi')->store('qizlar', 'public');
        }

        $qiz->update($data);

        return redirect()->route('qizlar.index')->with('success', "{$qiz->fio} maʼlumotlari yangilandi!");
    }

    public function destroy(Qiz $qiz)
    {
        if ($qiz->rasmi && Storage::disk('public')->exists($qiz->rasmi)) {
            Storage::disk('public')->delete($qiz->rasmi);
        }

        $qiz->delete();

        return redirect()->route('qizlar.index')->with('success', "{$qiz->fio} muvaffaqiyatli o‘chirildi!");
    }
}
