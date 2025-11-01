<?php

namespace App\Http\Controllers;

use App\Models\Tadbir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TadbirController extends Controller
{
    // Tadbirlar ro'yxati
    public function index()
    {
        $tadbirlar = Tadbir::all();
        return view('tadbir.index', compact('tadbirlar'));
    }

    // Yangi tadbir yaratish formasi
    public function create()
    {
        return view('tadbir.create');
    }

    // Yangi tadbirni saqlash
    public function store(Request $request)
    {
        $request->validate([
            'nomi' => 'required|string|max:255',
            'sanasi' => 'required|date',
            'tavsifi' => 'nullable|string',
            'rasmi' => 'nullable|image|mimes:jpg,jpeg,png',
            'yonalishi' => 'nullable|string|max:255',
            'tashkilotchi' => 'nullable|string|max:255',
        ]);

        $rasmPath = null;
        if ($request->hasFile('rasmi')) {
            $rasmPath = $request->file('rasmi')->store('tadbirs', 'public');
        }

        Tadbir::create([
            'nomi' => $request->nomi,
            'sanasi' => $request->sanasi,
            'tavsifi' => $request->tavsifi,
            'rasmi' => $rasmPath,
            'yonalishi' => $request->yonalishi,
            'tashkilotchi' => $request->tashkilotchi,
        ]);

        return redirect()->route('tadbir.index')->with('success', 'Tadbir muvaffaqiyatli qo‘shildi.');
    }

    // Tadbirni ko‘rsatish
    public function show(Tadbir $tadbir)
    {
        return view('tadbir.show', compact('tadbir'));
    }

    // Tadbirni tahrirlash formasi
    public function edit(Tadbir $tadbir)
    {
        return view('tadbir.edit', compact('tadbir'));
    }

    // Tadbirni yangilash
    public function update(Request $request, Tadbir $tadbir)
    {
        $request->validate([
            'nomi' => 'required|string|max:255',
            'sanasi' => 'required|date',
            'tavsifi' => 'nullable|string',
            'rasmi' => 'nullable|image|mimes:jpg,jpeg,png|',
            'yonalishi' => 'nullable|string|max:255',
            'tashkilotchi' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('rasmi')) {
            // eski rasmni o'chirish (agar kerak bo'lsa)
            if ($tadbir->rasmi) {
                Storage::disk('public')->delete($tadbir->rasmi);
            }
            $tadbir->rasmi = $request->file('rasmi')->store('tadbirs', 'public');
        }

        $tadbir->update([
            'nomi' => $request->nomi,
            'sanasi' => $request->sanasi,
            'tavsifi' => $request->tavsifi,
            'yonalishi' => $request->yonalishi,
            'tashkilotchi' => $request->tashkilotchi,
        ]);

        return redirect()->route('tadbir.index')->with('success', 'Tadbir muvaffaqiyatli yangilandi.');
    }

    // Tadbirni o‘chirish
    public function destroy(Tadbir $tadbir)
    {
        if ($tadbir->rasmi) {
            Storage::disk('public')->delete($tadbir->rasmi);
        }

        $tadbir->delete();

        return redirect()->route('tadbir.index')->with('success', 'Tadbir muvaffaqiyatli o‘chirildi.');
    }
}
