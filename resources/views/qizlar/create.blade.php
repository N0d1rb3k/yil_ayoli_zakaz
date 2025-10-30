@extends('layouts.app')

@section('content')
    <h2>Yangi qiz qo‘shish</h2>

    <form action="{{ route('qizlar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>FIO:</label><br>
        <input type="text" name="fio" required><br><br>

        <label>Sinf:</label><br>
        <input type="text" name="sinfi"><br><br>

        <label>Yosh:</label><br>
        <input type="text" name="yoshi"><br><br>

        <label>Manzil:</label><br>
        <input type="text" name="manzili" required><br><br>

        <label>Rasm:</label><br>
        <input type="file" name="rasm"><br><br>


        <button type="submit">Saqlash</button>
    </form>
@endsection
