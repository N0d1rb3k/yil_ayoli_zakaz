<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AloqaController extends Controller
{
    public function index()
    {
        return view('aloqa.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        // Masalan: xabarni email orqali yuborish yoki bazaga saqlash
        // Mail::to('admin@example.com')->send(new AloqaXabari($data));

        return back()->with('success', 'Xabaringiz muvaffaqiyatli yuborildi!');
    }
}
