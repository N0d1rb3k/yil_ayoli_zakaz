@extends('layouts.layout')

@section('title', 'Tadbirlar ro‘yxati')

@section('content')
    <h2 class="text-center mb-5 page-title">Tadbirlar ro‘yxati</h2>
    @auth
        <div class="text-center m-5 mb-8">
            <a href="{{ route('tadbir.create') }}" class="btn btn-add-announcement">Yangi tadbir qo‘shish</a>
        </div>
    @endauth
    <div class="announcement-grid">
        @foreach($tadbirlar as $tadbir)
            <div class="news-card">
                <div class="news-header">
                    @if($tadbir->rasmi)
                        <div class="news-img" style="background-image: url('{{ asset('storage/'.$tadbir->rasmi) }}')"></div>
                    @else
                        <div class="news-img-placeholder">
                            <span class="placeholder-icon">📢</span>
                        </div>
                    @endif
                    <div class="news-meta">
                        <span class="meta-date">{{ \Carbon\Carbon::parse($tadbir->sanasi)->translatedFormat('F d, Y') }}</span>
                        <span class="meta-direction">{{ $tadbir->yonalishi ?? 'Umumiy' }}</span>
                    </div>
                </div>

                <div class="news-body">
                    <h5 class="news-title">{{ $tadbir->nomi }}</h5>
                    <p class="news-description">{{ Str::limit($tadbir->tavsifi, 100) }}</p>

                    <div class="news-actions">
                        {{-- Tugmalar bir xil o'lchamda bo'lishi uchun, barchasi .news-actions .btn dan paddingni meros qilib oladi --}}
                        <a href="{{ route('tadbir.show', $tadbir->id) }}" class="btn btn-read-more">Batafsil</a>
                        @auth
                            <a href="{{ route('tadbir.edit', $tadbir->id) }}" class="btn btn-edit-small">Tahrirlash</a>
                            <form action="{{ route('tadbir.destroy', $tadbir->id) }}" method="POST" onsubmit="return confirm('Haqiqatan ham o‘chirmoqchimisiz?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete-small">O‘chirish</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>




@endsection

<style>
    /* Color Palette */
    :root {
        --news-pink-primary: #D6336C;
        --news-pink-secondary: #FFC0CB;
        --news-gray-text: #4a4a4a;
        --news-border-color: #E0E0E0;
        --news-background: #FFFFFF;
    }

    .page-title {
        font-family:  sans-serif;
        color: var(--news-pink-primary);
        font-weight: 700;
    }

    /* ---------------------------------- */
    /* Grid Layout for Single Column      */
    /* ---------------------------------- */

    .announcement-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
        padding: 20px 20px;
        max-width: 900px;
        margin: 0 auto;
    }

    /* ---------------------------------- */
    /* News Card Styling                  */
    /* ---------------------------------- */
    .news-card {
        background: var(--news-background);
        border-radius: 4px;
        overflow: hidden;
        border: 1px solid var(--news-border-color);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s, box-shadow 0.3s;
        display: flex;
        flex-direction: column;
    }

    /* HOVER EFFECT: Lift the card slightly */
    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(214, 51, 108, 0.25);
    }

    /* Image/Header Area */
    .news-header {
        position: relative;
    }

    .news-img {
        width: 100%;
        padding-bottom: 50%;
        background-size: cover;
        background-position: center;
        border-bottom: 3px solid var(--news-pink-primary);
    }

    .news-img-placeholder {
        height: 120px;
        background-color: var(--news-pink-secondary);
        display: flex;
        justify-content: center;
        align-items: center;
        border-bottom: 3px solid var(--news-pink-primary);
    }
    .placeholder-icon {
        font-size: 3rem;
        color: var(--news-pink-primary);
    }

    .news-meta {
        position: absolute;
        top: 0;
        right: 0;
        background: rgba(214, 51, 108, 0.9);
        color: white;
        padding: 10px 20px 10px 25px;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        clip-path: polygon(0 0, 100% 0, 100% 100%, 15% 100%, 0 0);
    }
    .meta-date {
        display: block;
        margin-bottom: 4px;
        font-size: 1rem;
    }
    .meta-direction {
        font-size: 0.85rem;
        opacity: 0.9;
        white-space: nowrap;
    }

    /* Body */
    .news-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .news-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--news-pink-primary);
        margin-bottom: 0.8rem;
        line-height: 1.3;
        text-align: left;
    }
    .news-description {
        font-size: 0.95rem;
        color: var(--news-gray-text);
        margin-bottom: 1.2rem;
        line-height: 1.5;
        flex-grow: 1;
        text-align: left;
    }

    /* Actions */
    .news-actions {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 0.8rem;
        margin-top: 1rem;
        flex-wrap: wrap;
    }
    .news-actions .btn {
        font-size: 0.85rem;
        padding: 0.6rem 1.1rem; /* Barcha tugmalar uchun asosiy padding */
        border-radius: 4px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
    }

    /* Buttons */
    .btn-read-more {
        background: var(--news-pink-primary);
        color: #fff;
        border: 1px solid var(--news-pink-primary);
    }
    .btn-read-more:hover { background: #A02251; border-color: #A02251; }
    .btn-edit-small {
        background: transparent;
        color: var(--news-pink-primary);
        border: 1px solid var(--news-pink-primary);
    }
    .btn-edit-small:hover { background: var(--news-pink-secondary); }
    .btn-delete-small {
        background: #DC3545;
        color: #fff;
        border: 1px solid #DC3545;
        margin-top: 16px;
    }
    .btn-delete-small:hover { background: #B02A37; }

    .btn-add-announcement {
        background: var(--news-pink-primary);
        color: #fff;
        font-size: 1rem;
        padding: 0.8rem 2rem;
        border-radius: 50px;
        font-weight: 700;
        transition: all 0.3s;
        box-shadow: 0 4px 10px rgba(214, 51, 108, 0.4);
    }
    .btn-add-announcement:hover {
        background: #A02251;
        transform: translateY(-2px);
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .page-title {
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .news-actions {
            flex-direction: column;
            gap: 0.5rem;
        }
        .news-actions .btn {
            width: 100%;
        }

        .news-meta {
            padding: 8px 14px 8px 18px;
            font-size: 0.7rem;
        }
        .meta-date {
            font-size: 0.9rem;
        }
        .news-body {
            padding: 1rem;
        }
    }


</style>
