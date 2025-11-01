@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Malumotlarni Qo‘shish</h1>

        <form action="{{ route('qizlar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">F.I.O</label>
                <input type="text" name="fio" class="form-control" value="{{ old('fio') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Yoshi</label>
                <input type="number" name="yoshi" class="form-control" value="{{ old('yoshi') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Sinf</label>
                <input type="text" name="sinfi" class="form-control" value="{{ old('sinfi') }}" placeholder="Masalan: 7-A">
            </div>

            @auth  {{-- Faqat login bo‘lganlar ko‘radi --}}
            <div class="mb-3">
                <label class="form-label">Telefon raqami</label>
                <input type="text" name="telefon_raqami" class="form-control" value="{{ old('telefon_raqami') }}" placeholder="+998">
            </div>

            <div class="mb-3">
                <label class="form-label">Manzili</label>
                <input type="text" name="mazili" class="form-control" value="{{ old('mazili') }}">
            </div>
            @endauth

            <div class="mb-3">
                <label class="form-label">Rasm (ixtiyoriy)</label>
                <input type="file" name="rasmi" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Saqlash</button>
        </form>
    </div>
@endsection


<style>
    /* === Form Page Styling === */
    body {
        font-family: "Poppins", sans-serif;
        background: #fefafc;
        color: #333;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        color: #c2185b;
        padding-top: 20px;
        margin-top: 80px;
        font-size: 2000px;
    }

    form {
        background: #fff;
        max-width: 500px;
        margin: 30px auto;
        padding: 30px 40px;
        border-radius: 16px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    form:hover {
        transform: translateY(-2px);
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 6px;
        color: #7b1fa2;
    }

    input[type="text"],
    input[type="file"] {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #ccc;
        border-radius: 10px;
        font-size: 15px;
        outline: none;
        transition: 0.2s;
    }

    input[type="text"]:focus,
    input[type="file"]:focus {
        border-color: #c2185b;
        box-shadow: 0 0 4px rgba(194, 24, 91, 0.4);
    }

    button[type="submit"] {
        background: linear-gradient(135deg, #c2185b, #7b1fa2);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 12px 20px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
        margin-top: 10px;
        transition: 0.3s;
    }

    button[type="submit"]:hover {
        background: linear-gradient(135deg, #7b1fa2, #c2185b);
        transform: scale(1.03);
    }

    @media (max-width: 600px) {
        form {
            padding: 20px;
        }

        h2 {
            font-size: 1.5rem;
        }
    }

</style>
