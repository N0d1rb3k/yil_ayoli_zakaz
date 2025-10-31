@extends('layouts.layout')

@section('title', 'Qizlar ro‘yxati')


@section('content')
    <div class="qizlar-page">
        <h2>🌸 Qizlar ro‘yxati 🌸</h2>

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
                    <p><strong>Yashash manzili:</strong> {{ $qiz->manzili }}</p>
                    <p><strong>Ovozlar:</strong> {{ $qiz->ovoz }}</p>
                        @auth()
                            <button type="button" id="edit_btn" onclick="window.location='{{ route('qizlar.edit', $qiz->id) }}'">
                                ✏️ Tahrirlash
                            </button>

                        @endauth()
                </div>
            @endforeach
        </div>
    </div>
@endsection()

<style>

    /* 🌸 Page Wrapper */
    .qizlar-page {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 1rem;
        font-family: "Poppins", sans-serif;
    }

    /* 🌸 Title */
    .qizlar-page h2 {
        text-align: center;
        color: #b31f6f;
        font-size: 2rem;
        margin-bottom: 2rem;
    }

    /* 🌸 Success message */
    .success-message {
        text-align: center;
        color: green;
        background: #eaffea;
        padding: 0.8rem 1rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    /* 🌸 Qizlar list container */
    .qizlar-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.5rem;
    }

    /* 🌸 Qiz card */
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

    /* 🌸 Image */
    .qiz-card img {
        width: 100%;
        height: 230px;
        object-fit: cover;
        border-radius: 14px;
        margin-bottom: 1rem;
    }

    /* 🌸 Info text */
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

    /* 🌸 Edit button */
    .edit-btn {
        display: inline-block;
        background: linear-gradient(135deg, #d63384, #b31f6f);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 10px 16px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        margin-top: 0.8rem;
        transition: all 0.3s ease;
        box-shadow: 0 3px 8px rgba(179, 31, 111, 0.15);
    }

    .edit-btn:hover {
        background: linear-gradient(135deg, #b31f6f, #d63384);
        transform: translateY(-2px);
        box-shadow: 0 5px 14px rgba(179, 31, 111, 0.25);
    }

    .edit-btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 6px rgba(179, 31, 111, 0.2);
    }

    /* 🌸 Responsive tweaks */
    @media (max-width: 600px) {
        .qiz-card img {
            height: 180px;
        }

        .qiz-card {
            padding: 1rem;
        }
    }


</style>

