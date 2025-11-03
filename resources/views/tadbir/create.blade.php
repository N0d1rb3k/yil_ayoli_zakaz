@extends('layouts.layout')

@section('title', 'Yangi tadbir qo‘shish')

@section('content')
@auth
<div class="edit-container">
    <h2 class="page-title">🌸 Yangi tadbir qo‘shish</h2>

    @if($errors->any())
        <div class="alert alert-danger custom-alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tadbir.store') }}" method="POST" enctype="multipart/form-data" class="edit-form">
        @csrf

        <div class="form-group">
            <label>Nomi</label>
            <input type="text" name="nomi" value="{{ old('nomi') }}" required>
        </div>

        <div class="form-group">
            <label>Sanasi</label>
            <input type="date" name="sanasi" value="{{ old('sanasi') }}" required>
        </div>

        <div class="form-group">
            <label>Tavsifi</label>
            <textarea name="tavsifi" rows="3">{{ old('tavsifi') }}</textarea>
        </div>

        <div class="form-group">
            <label>Rasmi</label>
            <input type="file" name="rasmi">
        </div>

        <div class="form-group">
            <label>Yo‘nalishi</label>
            <input type="text" name="yonalishi" value="{{ old('yonalishi') }}">
        </div>

        <div class="form-group">
            <label>Tashkilotchi</label>
            <input type="text" name="tashkilotchi" value="{{ old('tashkilotchi') }}">
        </div>

        <div class="form-actions">
            <button class="save-btn" type="submit">💗 Saqlash</button>
            <a href="{{ route('tadbir.index') }}" class="back-btn">Ortga</a>
        </div>
    </form>
</div>
@endauth
@endsection

<style>
    .edit-container {
    max-width: 650px;
    margin: 30px auto;
    background: #fff5fa;
    padding: 25px 35px;
    border-radius: 18px;
    box-shadow: 0 4px 15px rgba(255, 182, 193, 0.4);
    animation: fadeIn 0.4s ease-in-out;
}

.page-title {
    text-align: center;
    color: #d63384;
    font-weight: 700;
    margin-bottom: 18px;
}

.edit-form .form-group {
    margin-bottom: 15px;
}

.edit-form label {
    font-weight: 600;
    color: #c2185b;
    margin-bottom: 5px;
    display: block;
}

.edit-form input,
.edit-form textarea {
    width: 100%;
    border: 1px solid #f8c6d8;
    border-radius: 12px;
    padding: 10px 14px;
    background: #fff;
    transition: 0.3s;
}

.edit-form input:focus,
.edit-form textarea:focus {
    border-color: #ff77b7;
    box-shadow: 0 0 8px rgba(255, 119, 183, 0.4);
}

.current-image img {
    width: 150px;
    border-radius: 10px;
    margin-bottom: 8px;
    border: 2px solid #ffcce3;
}

.form-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.save-btn,
.back-btn {
    padding: 10px 22px;
    border-radius: 25px;
    border: none;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}

.save-btn {
    background: #ff69b4;
    color: white;
}

.save-btn:hover {
    background: #e75494;
}

.back-btn {
    background: #ffd6e8;
    color: #c2185b;
}

.back-btn:hover {
    background: #f7b9d1;
}

/* Fade animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

</style>