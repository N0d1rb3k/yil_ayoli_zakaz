<!-- Groups Modal -->
<div id="groups-modal" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full max-h-[80vh] overflow-y-auto mx-auto" onclick="event.stopPropagation();">
        <div class="sticky top-0 bg-white border-b px-4 py-3 flex justify-between items-center">
            <h2 class="text-lg font-bold text-pink-600">Guruhlar</h2>
            <button type="button" id="close-modal-btn" class="text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
        </div>
        
        <div class="p-4">
            <!-- Groups List -->
            <div id="groups-list" class="space-y-2 mb-4">
                <!-- Groups will be loaded here via JavaScript -->
            </div>
            
            <!-- Create Group Form (Auth Only) -->
            @auth
            <div class="border-t pt-4 mt-4">
                <h3 class="text-base font-semibold text-pink-600 mb-3">Yangi Guruh Yaratish</h3>
                <form id="create-group-form" class="space-y-4">
                    @csrf
                    <div>
                        <label for="group-name" class="block text-sm font-medium text-gray-700 mb-1">Guruh nomi *</label>
                        <input type="text" id="group-name" name="name" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                               placeholder="Masalan: Frontend developers">
                    </div>
                    <div>
                        <label for="group-description" class="block text-sm font-medium text-gray-700 mb-1">Tavsif</label>
                        <textarea id="group-description" name="description" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                  placeholder="Guruh haqida qisqacha ma'lumot..."></textarea>
                    </div>
                    <button type="submit" class="bg-pink-600 text-white px-6 py-2 rounded-lg hover:bg-pink-700 transition font-semibold">
                        Guruh Yaratish
                    </button>
                </form>
            </div>
            @endauth
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('groups-modal');
    const groupsList = document.getElementById('groups-list');
    const createGroupForm = document.getElementById('create-group-form');
    const closeBtn = document.getElementById('close-modal-btn');
    
    // Function to close modal
    function closeModal() {
        modal.style.display = 'none';
    }
    
    // Close button
    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }
    
    // Close modal on backdrop click
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
    
    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display === 'flex') {
            closeModal();
        }
    });
    
    // Open modal function
    function openModal() {
        modal.style.display = 'flex';
        // Load groups immediately without delay
        loadGroups();
    }
    
    // Override onclick handlers for modal opening
    document.querySelectorAll('a[onclick*="groups-modal"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            openModal();
        });
    });
    
    // Fetch and display groups
    async function loadGroups() {
        // Show loading state immediately
        groupsList.innerHTML = '<p class="text-center text-gray-500 p-2 text-sm">Yuklanmoqda...</p>';
        
        try {
            const response = await fetch('{{ route("groups.index") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',
                cache: 'no-cache'
            });
            
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            
            const result = await response.json();
            if (result.success && result.data) {
                displayGroups(result.data);
            }
        } catch (error) {
            console.error('Error loading groups:', error);
            groupsList.innerHTML = '<p class="text-center text-red-500 p-4 text-sm">Xatolik yuz berdi. Qayta urinib ko\'ring.</p>';
        }
    }
    
    // Display groups
    function displayGroups(groups) {
        if (groups.length === 0) {
            groupsList.innerHTML = '<p class="text-center text-gray-500 p-4">Hozircha guruhlar yo\'q.</p>';
            return;
        }
        
        const isAuth = {{ auth()->check() ? 'true' : 'false' }};
        
        groupsList.innerHTML = groups.map(group => {
            const name = (group.name || '').replace(/'/g, "\\'").replace(/"/g, '&quot;').replace(/\n/g, ' ');
            const desc = (group.description || '').replace(/'/g, "\\'").replace(/"/g, '&quot;').replace(/\n/g, ' ');
            
            return `
            <div class="border border-gray-200 rounded-lg p-3 hover:bg-pink-50 hover:border-pink-300 transition">
                <div class="flex items-center justify-between">
                    <a href="/groups/${group.id}/show-qizlar" 
                       onclick="document.getElementById('groups-modal').style.display='none';"
                       class="flex-1 cursor-pointer">
                        <h4 class="text-base font-semibold text-pink-600">${group.name}</h4>
                    </a>
                    ${isAuth ? `
                    <div class="flex items-center gap-2 ml-3">
                        <button onclick="editGroup(${group.id}, '${name}', '${desc}')" 
                                class="text-blue-600 hover:text-blue-700 text-sm px-2 py-1 rounded hover:bg-blue-50 transition"
                                title="Tahrirlash">
                            ✏️
                        </button>
                        <button onclick="deleteGroup(${group.id}, '${name}')" 
                                class="text-red-600 hover:text-red-700 text-sm px-2 py-1 rounded hover:bg-red-50 transition"
                                title="O'chirish">
                            🗑️
                        </button>
                    </div>
                    ` : ''}
                </div>
            </div>
            `;
        }).join('');
    }
    
    // Edit group function
    window.editGroup = function(groupId, currentName, currentDescription) {
        const newName = prompt('Yangi guruh nomi:', currentName);
        if (newName === null || newName.trim() === '') return;
        
        const newDescription = prompt('Yangi tavsif:', currentDescription || '');
        if (newDescription === null) return;
        
        fetch(`/groups/${groupId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            credentials: 'same-origin',
            body: JSON.stringify({
                name: newName.trim(),
                description: newDescription.trim()
            })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('Guruh muvaffaqiyatli yangilandi!');
                loadGroups();
            } else {
                alert('Xatolik: ' + (result.message || 'Noma\'lum xatolik'));
            }
        })
        .catch(error => {
            console.error('Error updating group:', error);
            alert('Xatolik yuz berdi. Qayta urinib ko\'ring.');
        });
    };
    
    // Delete group function
    window.deleteGroup = function(groupId, groupName) {
        if (!confirm(`"${groupName}" guruhini o'chirishni xohlaysizmi? Bu amalni qaytarib bo'lmaydi.`)) {
            return;
        }
        
        fetch(`/groups/${groupId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('Guruh muvaffaqiyatli o\'chirildi!');
                loadGroups();
            } else {
                alert('Xatolik: ' + (result.message || 'Noma\'lum xatolik'));
            }
        })
        .catch(error => {
            console.error('Error deleting group:', error);
            alert('Xatolik yuz berdi. Qayta urinib ko\'ring.');
        });
    };
    
    // Create group form submission
    @auth
    if (createGroupForm) {
        createGroupForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            try {
                const response = await fetch('{{ route("groups.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(data)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    createGroupForm.reset();
                    loadGroups(); // Reload groups
                    alert('Guruh muvaffaqiyatli yaratildi!');
                } else {
                    alert('Xatolik: ' + (result.message || 'Noma\'lum xatolik'));
                }
            } catch (error) {
                console.error('Error creating group:', error);
                alert('Xatolik yuz berdi. Qayta urinib ko\'ring.');
            }
        });
    }
    @endauth
});
</script>

<style>
#groups-modal {
    backdrop-filter: blur(4px);
    animation: fadeIn 0.15s ease-out;
}

#groups-modal > div {
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    pointer-events: auto;
    animation: slideUp 0.2s ease-out;
}

#groups-modal > div * {
    pointer-events: auto;
}

#close-modal-btn {
    cursor: pointer;
    user-select: none;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideUp {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>

