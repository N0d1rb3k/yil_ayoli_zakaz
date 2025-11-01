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
                    ->orWhere('yoshi', 'like', "%{$search}%");
            })
            ->orderBy('fio')
            ->paginate(10); // optional pagination

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
            'sinfi' => 'nullable|string|max:50',
            // FIX 1: Added 'nullable'
            'yoshi' => 'nullable|integer|max:50',
            // FIX 2: Changed max:50 to max:255 for consistency and practicality
            'rasmi' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('rasmi')) {
            $data['rasmi'] = $request->file('rasmi')->store('qizlar', 'public');
        }

        Qiz::create($data);

        return redirect()->route('qizlar.index')->with('success', 'muvaffaqiyatli qo‘shildi!');
    }

    public function edit(Qiz $qiz){
        return view('qizlar.edit', compact('qiz'));
    }

    public function update(Request $request, Qiz $qiz)
    {
        $data = $request->validate([
            'fio' => 'required|string|max:255',
            'sinfi' => 'nullable|string|max:50',
            'yoshi' => 'nullable|integer|max:50',
            'rasmi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('rasmi')) {
            // Delete old image if exists
            if ($qiz->rasmi && Storage::disk('public')->exists($qiz->rasmi)) {
                Storage::disk('public')->delete($qiz->rasmi);
            }
            $data['rasmi'] = $request->file('rasmi')->store('qizlar', 'public');
        }

        $qiz->update($data);

        return redirect()->route('qizlar.index')->with('success', "{$qiz->fio} maʼlumotlari yangilandi!");
    }

    // FIX 3: Added destroy method for deletion
    public function destroy(Qiz $qiz)
    {
        // Delete image from storage
        if ($qiz->rasmi && Storage::disk('public')->exists($qiz->rasmi)) {
            Storage::disk('public')->delete($qiz->rasmi);
        }

        $qiz->delete();

        return redirect()->route('qizlar.index')->with('success', "{$qiz->fio} muvaffaqiyatli o‘chirildi!");
    }
}
