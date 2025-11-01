<?php

namespace App\Http\Controllers;

use App\Mail\AloqaXabari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            'sinf' => 'required|string|max:10'
        ]);

        // Masalan: xabarni email orqali yuborish yoki bazaga saqlash
        Mail::to('ccnodirbekcc@gmail.com')->send(new AloqaXabari($data));

        return back()->with('success', 'Xabaringiz muvaffaqiyatli yuborildi!');
    }
}
