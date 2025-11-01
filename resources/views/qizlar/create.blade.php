@extends('layouts.layout')

@section('content')

    <h1><bold>Ro`yxatga olish</bold></h1>
    <form action="{{ route('qizlar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>FIO:</label><br>
        <input type="text" name="fio" required><br><br>

        <label>Sinf:</label><br>
        <input type="text" name="sinfi"><br><br>

        <label>Yosh:</label><br>
        <input type="text" name="yoshi"><br><br>

        <label>Rasm:</label><br>
        <input type="file" name="rasmi"><br><br>


        <button type="submit">Saqlash</button>
    </form>
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
        font-size: 50px;
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
