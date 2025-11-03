@extends('layouts.layout')

@section('title', 'Tadbirni tahrirlash')

@section('content')
@auth
<div class="edit-container">
    <h2 class="page-title">🌸 Tadbirni tahrirlash</h2>

    @if($errors->any())
        <div class="alert alert-danger custom-alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tadbir.update', $tadbir->id) }}" method="POST" enctype="multipart/form-data" class="edit-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nomi</label>
            <input type="text" name="nomi" value="{{ old('nomi', $tadbir->nomi) }}" required>
        </div>

        <div class="form-group">
            <label>Sanasi</label>
            <input type="date" name="sanasi" value="{{ old('sanasi', $tadbir->sanasi) }}" required>
        </div>

        <div class="form-group">
            <label>Tavsifi</label>
            <textarea name="tavsifi" rows="3">{{ old('tavsifi', $tadbir->tavsifi) }}</textarea>
        </div>

        <div class="form-group">
            <label>Rasmi</label>
            @if($tadbir->rasmi)
                <div class="current-image">
                    <img src="{{ asset('storage/'.$tadbir->rasmi) }}" alt="rasm">
                </div>
            @endif
            <input type="file" name="rasmi">
        </div>

        <div class="form-group">
            <label>Yo‘nalishi</label>
            <input type="text" name="yonalishi" value="{{ old('yonalishi', $tadbir->yonalishi) }}">
        </div>

        <div class="form-group">
            <label>Tashkilotchi</label>
            <input type="text" name="tashkilotchi" value="{{ old('tashkilotchi', $tadbir->tashkilotchi) }}">
        </div>

        <div class="form-actions">
            <button class="save-btn" type="submit">💗 Yangilash</button>
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

/* Mobile-first responsive tweaks */
@media (max-width: 576px) {
    .edit-container {
        margin: 15px auto;
        padding: 16px;
        border-radius: 14px;
    }

    .page-title {
        font-size: 1.1rem;
        margin-bottom: 12px;
    }

    .edit-form input,
    .edit-form textarea {
        font-size: 16px; /* prevent mobile zoom on focus */
        padding: 10px 12px;
    }

    .current-image img {
        width: 100%;
        max-width: 100%;
    }

    .form-actions {
        flex-direction: column;
        gap: 10px;
    }

    .save-btn,
    .back-btn {
        width: 100%;
        text-align: center;
        padding: 12px 16px;
    }
}

@media (min-width: 577px) and (max-width: 768px) {
    .edit-container {
        max-width: 520px;
        padding: 20px 22px;
    }
}

</style>