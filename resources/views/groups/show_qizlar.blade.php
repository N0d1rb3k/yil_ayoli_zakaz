@extends('layouts.layout')

@section('title', $group->name . ' - A\'zolar')

@section('content')
<div class="groups-qizlar-page">
    <div class="page-header">
        <h1 class="page-title">{{ $group->name }}</h1>
        @if($group->description)
            <p class="group-description">{{ $group->description }}</p>
        @endif
    </div>

    @auth
    <div class="text-center mb-6">
        <button type="button" id="add-qiz-btn"
                class="btn-add-qiz">
            + Qo'shish
        </button>
    </div>
    @endauth

    <div id="qizlar-grid" class="qizlar-grid">
        @forelse($group->qizlar as $qiz)
            <div class="qiz-card">
                @if($qiz->rasmi)
                    <img src="{{ asset('storage/' . $qiz->rasmi) }}" alt="{{ $qiz->fio }}">
                @else
                    <img src="{{ asset('/images/default.jpg') }}" alt="No Image">
                @endif

                <div class="qiz-info">
                    <h3 class="qiz-name">{{ $qiz->fio }}</h3>
                    <p class="qiz-detail"><strong>Sinf:</strong> {{ $qiz->sinfi ?? 'N/A' }}</p>
                    <p class="qiz-detail"><strong>Yoshi:</strong> {{ $qiz->yoshi ?? 'N/A' }}</p>

                    @auth
                        <p class="qiz-detail"><strong>Telefon:</strong> {{ $qiz->telefon_raqami ?? 'N/A' }}</p>
                        <p class="qiz-detail"><strong>Manzil:</strong> {{ $qiz->manzili ?? 'N/A' }}</p>
                        <form action="{{ route('groups.remove-qiz', [$group->id, $qiz->id]) }}" method="POST" class="remove-qiz-form" onsubmit="return confirm('"{{ $qiz->fio }}" guruhdan o\'chirilsinmi?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-remove-qiz">Guruhdan o'chirish</button>
                        </form>
                    @endauth
                </div>
            </div>
        @empty
            <div class="empty-state">
                <p>Bu guruhda hozircha a'zolar yo'q.</p>
                @auth
                    <p class="mt-2">Yuqoridagi "Qiz Qo'shish" tugmasidan foydalaning.</p>
                @endauth
            </div>
        @endforelse
    </div>
</div>

<!-- Add Qiz Modal -->
@auth
<div id="add-qiz-modal" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white mt-10 rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b px-6 py-4 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-pink-600">Qo'shish</h2>
            <button onclick="document.getElementById('add-qiz-modal').style.display='none'" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>

        <div class="p-6">
            <div id="qizlar-select-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Qizlar will be loaded here -->
                <p class="text-center text-gray-500">Yuklanmoqda...</p>
            </div>
        </div>
    </div>
</div>
@endauth
@endsection

@auth
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addQizBtn = document.getElementById('add-qiz-btn');
    const addQizModal = document.getElementById('add-qiz-modal');
    const qizlarSelectList = document.getElementById('qizlar-select-list');
    const groupId = {{ $group->id }};

    // Open modal
    addQizBtn.addEventListener('click', function() {
        addQizModal.style.display = 'flex';
        loadQizlarForAdd();
    });

    // Close modal on backdrop click
    addQizModal.addEventListener('click', function(e) {
        if (e.target === addQizModal) {
            addQizModal.style.display = 'none';
        }
    });

    // Load qizlar for adding
    async function loadQizlarForAdd() {
        try {
            const response = await fetch('{{ route("groups.qizlar-for-add") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            });

            if (!response.ok) throw new Error('Network response was not ok');

            const result = await response.json();
            if (result.success && result.data) {
                displayQizlarForAdd(result.data);
            }
        } catch (error) {
            console.error('Error loading qizlar:', error);
            qizlarSelectList.innerHTML = '<p class="text-center text-red-500 p-4">Xatolik yuz berdi.</p>';
        }
    }

    // Display qizlar as selectable cards
    function displayQizlarForAdd(qizlar) {
        // Get already added qiz IDs
        const addedQizIds = Array.from(document.querySelectorAll('.qiz-card')).map(card => {
            // Extract qiz ID from card if available
            return null; // We'll check server-side instead
        });

        if (qizlar.length === 0) {
            qizlarSelectList.innerHTML = '<p class="text-center text-gray-500 p-4">Qo\'shish uchun qizlar topilmadi.</p>';
            return;
        }

        qizlarSelectList.innerHTML = qizlar.map(qiz => {
            const defaultImage = '{{ asset("/images/default.jpg") }}';
            const qizImage = qiz.rasmi ? `{{ asset('storage/') }}/${qiz.rasmi}` : defaultImage;

            return `
                <div class="qiz-select-card" data-qiz-id="${qiz.id}">
                    <img src="${qizImage}" alt="${qiz.fio}" class="qiz-select-image">
                    <div class="qiz-select-info">
                        <h4 class="qiz-select-name">${qiz.fio}</h4>
                        <p class="qiz-select-detail">Sinf: ${qiz.sinfi || 'mavjud emas'}</p>
                        <p class="qiz-select-detail">Yosh: ${qiz.yoshi || 'mavjud emas'}</p>
                        <button onclick="addQizToGroup(${qiz.id})"
                                class="btn-add-to-group">
                            Qo'shish
                        </button>
                    </div>
                </div>
            `;
        }).join('');
    }

    // Add qiz to group
    window.addQizToGroup = async function(qizId) {
        try {
            const response = await fetch(`/groups/${groupId}/add-qiz/${qizId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                credentials: 'same-origin'
            });

            const result = await response.json();

            if (result.success) {
                alert('Qiz muvaffaqiyatli qo\'shildi!');
                location.reload(); // Reload page to show updated list
            } else {
                alert('Xatolik: ' + (result.message || 'Noma\'lum xatolik'));
            }
        } catch (error) {
            console.error('Error adding qiz:', error);
            alert('Xatolik yuz berdi. Qayta urinib ko\'ring.');
        }
    };
});
</script>
@endauth

<style>
.groups-qizlar-page {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 1rem;
    font-family: "Poppins", sans-serif;
}

.page-header {
    text-align: center;
    margin-bottom: 2rem;
}

.remove-qiz-form {
    margin-top: 0.75rem;
}
.btn-remove-qiz {
    display: inline-block;
    background: #DC3545;
    color: #fff;
    border: 1px solid #DC3545;
    border-radius: 8px;
    padding: 0.5rem 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.1s ease;
}
.btn-remove-qiz:hover { background: #B02A37; }
.btn-remove-qiz:active { transform: translateY(1px); }

.page-title {
    color: #b31f6f;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.group-description {
    color: #666;
    font-size: 1.1rem;
    max-width: 600px;
    margin: 0 auto;
}

.btn-add-qiz {
    background: linear-gradient(135deg, #d63384, #b31f6f);
    color: #fff;
    border: none;
    border-radius: 50px;
    padding: 12px 32px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(179, 31, 111, 0.3);
}

.btn-add-qiz:hover {
    background: linear-gradient(135deg, #b31f6f, #d63384);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(179, 31, 111, 0.4);
}

.qizlar-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
    align-items: stretch;
}

.qiz-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 15px rgba(139, 0, 93, 0.08);
    overflow: hidden;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.qiz-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 22px rgba(139, 0, 93, 0.15);
}

.qiz-card img {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.qiz-info {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.qiz-name {
    color: #8b005d;
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.qiz-detail {
    color: #555;
    font-size: 0.95rem;
    margin: 0.4rem 0;
}

.qiz-detail strong {
    color: #b31f6f;
}

.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 3rem;
    color: #999;
    font-size: 1.1rem;
}

/* Add Qiz Modal Styles */
.qiz-select-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.2s ease;
}

.qiz-select-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.qiz-select-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.qiz-select-info {
    padding: 1rem;
}

.qiz-select-name {
    color: #8b005d;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.qiz-select-detail {
    color: #666;
    font-size: 0.85rem;
    margin: 0.3rem 0;
}

.btn-add-to-group {
    width: 100%;
    background: #b31f6f;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 0.5rem;
    transition: background 0.2s ease;
}

.btn-add-to-group:hover {
    background: #8b005d;
}

@media (max-width: 768px) {
    .qizlar-grid {
        grid-template-columns: 1fr;
    }

    .page-title {
        font-size: 2rem;
    }
}

/* Force exactly 3 cards per row on large screens and equal heights */
@media (min-width: 992px) {
    .qizlar-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}
</style>

