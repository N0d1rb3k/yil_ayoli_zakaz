@extends('layouts.layout')

@section('title', 'Tadbir tafsilotlari')

@section('content')
    <div class="announcement-detail-container">
        <a href="{{ route('tadbir.index') }}" class="btn btn-back-to-list mb-4">
            ← Barcha Tadbir E'lonlariga Qaytish
        </a>

        <div class="detail-card">
            @if($tadbir->rasmi)
                <div class="detail-img-wrapper">
                    <img src="{{ asset('storage/'.$tadbir->rasmi) }}" class="detail-img-top" alt="{{ $tadbir->nomi }}">
                </div>
            @endif

            <div class="detail-body">
                <h1 class="detail-title">{{ $tadbir->nomi }}</h1>

                <div class="detail-meta-list">
                    <p class="meta-item">
                        <span class="meta-label">📅 Sanasi:</span>
                        <span class="meta-value">{{ \Carbon\Carbon::parse($tadbir->sanasi)->translatedFormat('d F, Y yil') }}</span>
                    </p>
                    <p class="meta-item">
                        <span class="meta-label">🧭 Yo‘nalishi:</span>
                        <span class="meta-value">{{ $tadbir->yonalishi ?? 'Kiritilmagan' }}</span>
                    </p>
                    <p class="meta-item">
                        <span class="meta-label">🤝Tashkilotchi:</span>
                        <span class="meta-value">{{ $tadbir->tashkilotchi ?? 'Aniqlanmagan' }}</span>
                    </p>
                </div>

                <hr class="detail-divider">

                <div class="detail-description">
                    <h4 class="description-header">Tadbir Tavsifi</h4>
                    <p>{{ $tadbir->tavsifi }}</p>
                </div>
            </div>

            @auth
                <div class="detail-footer">
                    <a href="{{ route('tadbir.edit', $tadbir->id) }}" class="btn btn-edit-detail">Tahrirlash</a>
                    <form action="{{ route('tadbir.destroy', $tadbir->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete-detail"
                                onclick="return confirm('Haqiqatan ham o‘chirmoqchimisiz?')">O‘chirish</button>
                    </form>
                </div>
            @endauth
        </div>

    </div>
@endsection

<style>
    /* Color Palette (Consistent with previous styles) */
    :root {
        --news-pink-primary: #D6336C;
        --news-pink-secondary: #FFC0CB;
        --news-gray-text: #4a4a4a;
        --news-border-color: #E0E0E0;
        --news-background: #FFFFFF;
        --light-pink-bg: #FFE4EC; /* Very light pink for page background */
    }

    /* Page container and centering */
    body {
        background-color: var(--light-pink-bg);
    }
    .announcement-detail-container {
        max-width: 900px;
        margin: 50px auto;
        padding: 0 20px;
    }

    /* ---------------------------------- */
    /* Detail Card Styling                */
    /* ---------------------------------- */
    .detail-card {
        background: var(--news-background);
        border-radius: 8px; /* Slightly softer corners for the detail view */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    /* Image Styling */
    .detail-img-wrapper {
        width: 100%;
        max-height: 450px; /* Max height for large header image */
        overflow: hidden;
        border-bottom: 5px solid var(--news-pink-primary); /* Strong primary line below image */
    }
    .detail-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensures image covers the space without distortion */
    }

    /* Body Content */
    .detail-body {
        padding: 30px;
    }

    .detail-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--news-pink-primary);
        margin-bottom: 1.5rem;
    }

    /* Metadata List */
    .detail-meta-list {
        margin-bottom: 20px;
        border-left: 5px solid var(--news-pink-secondary);
        padding-left: 15px;
    }
    .meta-item {
        margin-bottom: 8px;
        font-size: 1rem;
        color: var(--news-gray-text);
    }
    .meta-label {
        font-weight: 600;
        color: var(--news-pink-primary); /* Pink for labels */
        display: inline-block;
        width: 120px; /* Aligning labels */
    }
    .meta-value {
        font-weight: 400;
    }

    /* Divider */
    .detail-divider {
        border: 0;
        height: 1px;
        background-color: var(--news-border-color);
        margin: 25px 0;
    }

    /* Description */
    .description-header {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--news-pink-primary);
        margin-bottom: 15px;
    }
    .detail-description p {
        line-height: 1.7;
        font-size: 1rem;
        color: var(--news-gray-text);
    }

    /* ---------------------------------- */
    /* Footer and Buttons                 */
    /* ---------------------------------- */

    .detail-footer {
        padding: 20px 30px;
        border-top: 1px solid var(--news-border-color);
        display: flex;
        gap: 15px;
    }

    /* Back button (outside the card) */
    .btn-back-to-list {
        background: none;
        color: var(--news-pink-primary);
        border: 1px solid var(--news-pink-primary);
        padding: 10px 15px;
        font-weight: 600;
        transition: all 0.3s;
        border-radius: 5px;
        text-decoration: none;
    }
    .btn-back-to-list:hover {
        background: var(--news-pink-primary);
        color: white;
    }

    /* Admin Buttons */
    .btn-edit-detail {
        background: var(--news-pink-secondary);
        color: var(--news-pink-primary);
        border: 1px solid var(--news-pink-secondary);
        font-weight: 600;
        padding: 8px 20px;
    }
    .btn-edit-detail:hover {
        background: #F0B3C4;
    }

    .btn-delete-detail {
        background: #DC3545;
        color: white;
        border: 1px solid #DC3545;
        font-weight: 600;
        padding: 8px 20px;
    }
    .btn-delete-detail:hover {
        background: #B02A37;
    }
</style>
