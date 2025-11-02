@extends('layouts.layout')

@section('title', 'Qizlar ro‘yxati')

@section('content')
    <div class="qizlar-page">
        <h2>🌸 Qizlar ro‘yxati 🌸</h2>

        <form method="GET" action="{{ route('qizlar.index') }}" class="search-form">
            <div class="search-container">
                <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text"
                       name="search"
                       value="{{ $search ?? '' }}"
                       class="search-input"
                       placeholder="Qizlarni qidirish (FIO, sinf, yosh, telefon, manzil bo'yicha)..."
                       autocomplete="off">
                @if($search ?? '')
                    <button type="button"
                            onclick="window.location='{{ route('qizlar.index') }}'"
                            class="clear-search-btn"
                            title="Tozalash">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                @endif
                <button type="submit" class="search-btn">
                    <span>Qidirish</span>
                </button>
            </div>
        </form>

        @if(session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif

        <div class="qizlar-list">
            @foreach($qizlar as $qiz)
                <div class="qiz-card">
                    @if($qiz->rasmi)
                        <img src="{{ asset('storage/' . $qiz->rasmi) }}" alt="{{ $qiz->fio }}">
                    @else
                        <img src="{{ asset('/images/default.jpg') }}" alt="No Image">
                    @endif

                    <h3><strong>FIO:</strong> {{ $qiz->fio }}</h3>
                    <p><strong>Sinf:</strong> {{ $qiz->sinfi }}</p>
                    <p><strong>Yoshi:</strong> {{ $qiz->yoshi }}</p>

                    {{-- 🔐 Shaxsiy ma'lumotlar faqat auth foydalanuvchi uchun --}}
                    @auth
                        <p><strong>Telefon:</strong> {{ $qiz->telefon_raqami }}</p>
                        <p><strong>Manzil:</strong> {{ $qiz->manzili }}</p>
                    @endauth

                    @auth
                        <button type="button" class="edit-btn" onclick="window.location='{{ route('qizlar.edit', $qiz->id) }}'">
                            Tahrirlash
                        </button>

                        <form action="{{ route('qizlar.destroy', $qiz) }}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('Rostdan o‘chirmoqchimisiz?')">
                                O‘chirish
                            </button>
                        </form>
                    @endauth

                </div>
            @endforeach
        </div>
    </div>
@endsection


<style>
    /* 🌸 Page Wrapper */
    .qizlar-page {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 1rem;
        font-family: "Poppins", sans-serif;
    }

    /* 🌸 Page Title */
    .qizlar-page h2 {
        text-align: center;
        color: #b31f6f;
        font-size: 2rem;
        margin-bottom: 2rem;
    }

    /* 🌸 Success Message */
    .success-message {
        text-align: center;
        color: green;
        background: #eaffea;
        padding: 0.8rem 1rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    /* 🌸 Search Form */
    .search-form {
        max-width: 700px;
        margin: 0 auto 2rem;
    }

    .search-container {
        position: relative;
        display: flex;
        align-items: center;
        background: #fff;
        border-radius: 50px;
        box-shadow: 0 4px 15px rgba(139, 0, 93, 0.1);
        padding: 0.5rem;
        transition: all 0.3s ease;
    }

    .search-container:focus-within {
        box-shadow: 0 6px 20px rgba(179, 31, 111, 0.25);
        transform: translateY(-2px);
    }

    .search-icon {
        width: 20px;
        height: 20px;
        color: #b31f6f;
        margin-left: 1rem;
        flex-shrink: 0;
    }

    .search-input {
        flex: 1;
        border: none;
        outline: none;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        color: #333;
        background: transparent;
    }

    .search-input:focus {
        outline: none;
        border: none;
        box-shadow: none;
    }

    .search-input:-webkit-autofill,
    .search-input:-webkit-autofill:hover,
    .search-input:-webkit-autofill:focus {
        -webkit-box-shadow: 0 0 0 30px white inset !important;
        box-shadow: 0 0 0 30px white inset !important;
        outline: none;
        border: none;
    }

    .search-input::placeholder {
        color: #999;
    }

    .clear-search-btn {
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
        margin-right: 0.5rem;
        color: #999;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.2s ease;
    }

    .clear-search-btn:hover {
        background: #f8c8dc;
        color: #b31f6f;
    }

    .clear-search-btn svg {
        width: 18px;
        height: 18px;
    }

    .search-btn {
        background: linear-gradient(135deg, #d63384, #b31f6f);
        color: #fff;
        border: none;
        border-radius: 40px;
        padding: 0.75rem 2rem;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(179, 31, 111, 0.2);
        white-space: nowrap;
    }

    .search-btn:hover {
        background: linear-gradient(135deg, #b31f6f, #d63384);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(179, 31, 111, 0.3);
    }

    .search-btn:active {
        transform: translateY(0);
    }

    /* 🌸 Responsive Search */
    @media (max-width: 768px) {
        .search-container {
            border-radius: 30px;
            padding: 0.4rem;
        }

        .search-input {
            padding: 0.6rem 0.8rem;
            font-size: 0.9rem;
        }

        .search-icon {
            width: 18px;
            height: 18px;
            margin-left: 0.8rem;
        }

        .search-btn {
            padding: 0.6rem 1.5rem;
            font-size: 0.9rem;
        }

        .search-input::placeholder {
            font-size: 0.85rem;
        }
    }

    @media (max-width: 480px) {
        .search-btn span {
            display: none;
        }

        .search-btn {
            padding: 0.6rem;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-btn::after {
            content: "🔍";
            font-size: 1.1rem;
        }
    }

    /* 🌸 Cards Container */
    .qizlar-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, 300px);
        gap: 1.5rem;
        justify-content: center;
    }


    /* 🌸 Individual Card */
    .qiz-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(139, 0, 93, 0.08);
        padding: 1.5rem;
        text-align: center;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .qiz-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 22px rgba(139, 0, 93, 0.15);
    }

    /* 🌸 Card Image */
    .qiz-card img {
        width: 100%;
        height: 230px;
        object-fit: cover;
        border-radius: 14px;
        margin-bottom: 1rem;
    }

    /* 🌸 Card Info */
    .qiz-card h3 {
        color: #8b005d;
        margin-bottom: 0.5rem;
    }

    .qiz-card p {
        color: #555;
        font-size: 0.95rem;
        margin: 0.3rem 0;
    }

    .qiz-card p strong {
        color: #b31f6f;
    }

    /* 🌸 Accent line */
    .qiz-card::after {
        content: "";
        display: block;
        width: 60px;
        height: 3px;
        background: #f8c8dc;
        margin: 1rem auto 0;
        border-radius: 3px;
    }

    /* 🌸 Buttons Container */
    .qiz-card form,
    .qiz-card .edit-btn {
        display: inline-block;
    }

    /* 🌸 Edit Button */
    /* 🌸 Edit Button */
    .edit-btn {
        background: linear-gradient(135deg, #d63384, #b31f6f);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 8px 16px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        margin-top: 0.8rem;
        margin-right: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 3px 8px rgba(179, 31, 111, 0.15);
    }

    .edit-btn:hover {
        background: linear-gradient(135deg, #b31f6f, #d63384);
        transform: translateY(-2px);
    }

    /* 🌸 Delete Button */
    .delete-btn {
        background: linear-gradient(135deg, #ff4d4f, #d9363e);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 8px 16px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        margin-top: 0.8rem;
        transition: all 0.3s ease;
        box-shadow: 0 3px 8px rgba(217, 54, 62, 0.15);
    }

    .delete-btn:hover {
        background: linear-gradient(135deg, #d9363e, #ff4d4f);
        transform: translateY(-2px);
    }

    /* 🌸 Responsive Adjustments */
    @media (max-width: 600px) {
        .qiz-card img {
            height: 180px;
        }

        .qiz-card {
            padding: 1rem;
        }

        .edit-btn, .delete-btn {
            width: 48%;
            margin-top: 0.5rem;
        }
    }
    /* 🌸 Search Form */
    /* ... existing search-container styles ... */

    .search-input {
        flex: 1;
        border: none;
        outline: none;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        color: #333;
        background: transparent;
    }

    .search-input:focus {
        outline: none;
        border: none;
        box-shadow: none !important; /* FIX: Removes the blue border/ring on focus */**
    }

    /* ... rest of the CSS ... */
</style>

