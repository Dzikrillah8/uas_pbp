<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Cerita - Draft</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        // Skema Warna Terang
                        'primary-text': '#241b00',
                        'secondary-text': '#797772',
                        'border-default': '#e2e2e2',
                        'cta-main': '#FA812F', 
                        'cta-hover': '#FFB22C',
                        'card-bg': '#ffffff', 
                        
                        // Skema Warna Gelap
                        'dark-bg': '#121212',
                        'dark-card': '#1f1f1f',
                        'dark-text': '#f0f0f0',
                        'dark-secondary-text': '#b3b3b3',
                        'dark-border': '#333333',
                    },
                }
            }
        }
    </script>

    <style>
        /* Styling tambahan untuk Progress Bar */
        .progress-bar-container {
            display: flex;
            gap: 4px;
        }
        .progress-segment {
            height: 8px;
            width: 25%;
            background-color: #e2e2e2;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .dark .progress-segment {
            background-color: #333333;
        }
        .progress-segment.completed {
            background-color: #FA812F;
        }
        /* Hover state untuk teks bab */
        .group:hover .text-bab {
            color: #FA812F;
            transition: color 0.15s;
        }
        /* Custom styling untuk tombol batalkan outline di Dark Mode */
        .dark .btn-cancel-outline:hover {
            background-color: #333333; /* dark-border */
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-dark-bg min-h-screen font-sans transition-colors duration-300">

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    <header class="sticky top-0 z-40 bg-white dark:bg-dark-card w-full shadow-md px-4 py-3 border-b border-border-default dark:border-dark-border flex justify-between items-center transition-colors duration-300">
        <div class="flex items-center space-x-2 sm:space-x-4">
            <a href="/mystory" class="text-primary-text dark:text-dark-text hover:text-cta-main transition duration-200">
                <i class="bi bi-chevron-left text-2xl"></i>
            </a>
            <div class="text-primary-text dark:text-dark-text">
                <p class="text-sm sm:text-base leading-tight dark:text-dark-secondary-text">Lanjutkan Menulis</p>
                <p class="text-base sm:text-lg font-bold leading-tight">{{ $story->title }}</p>
            </div>
        </div>
        <div class="flex items-center">
            <a href="/mystory" class="btn-cancel-outline border border-cta-main text-cta-main dark:text-cta-main font-semibold text-sm h-9 w-24 flex items-center justify-center rounded-md transition duration-200 hover:bg-cta-main/10 hover:shadow-sm">
                Batalkan
            </a>
        </div>
    </header>
    
    <div class="w-full max-w-xl mx-auto p-4 sm:p-8">
        <div class="bg-card-bg dark:bg-dark-card p-6 sm:p-8 rounded-2xl shadow-xl border border-border-default dark:border-dark-border transition-colors duration-300">
            
            <div class="progress-bar-container mb-6">
                <div class="progress-segment completed"></div>
                <div class="progress-segment completed"></div>
                <div class="progress-segment"></div>
                <div class="progress-segment"></div>
            </div>

            <form action="update_story_details" method="POST"> 
                <div class="mb-6">
                    <label for="judul" class="block text-primary-text dark:text-dark-text font-semibold mb-2">Judul</label>
                    <input 
                        type="text" 
                        id="judul" 
                        name="judul"  
                        value="{{ $story->title }}"
                        class="w-full p-3 border border-border-default dark:border-dark-border dark:bg-dark-bg dark:text-dark-text rounded-lg 
                               transition duration-300 hover:border-cta-main dark:hover:border-cta-main focus:outline-none focus:border-primary-text dark:focus:border-cta-main focus:ring-2 focus:ring-cta-main/50" 
                        required readonly>
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-primary-text dark:text-dark-text font-semibold mb-2">Deskripsi</label>
                    <textarea 
                        id="deskripsi" 
                        name="deskripsi" 
                        rows="4" 
                        placeholder="Deskripsi singkat tentang cerita" 
                        class="w-full p-3 border border-border-default dark:border-dark-border dark:bg-dark-bg dark:text-dark-text rounded-lg 
                               transition duration-300 hover:border-cta-main dark:hover:border-cta-main focus:outline-none focus:border-primary-text dark:focus:border-cta-main focus:ring-2 focus:ring-cta-main/50" 
                        required readonly>{{ trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($story->sinopsis)))) }}
                    </textarea>
                </div>

                <div class="mb-10">
                    <a href="/story/{{ $story->slug }}/edit" class="text-orange-500 no-underline hover:text-orange-600">
                        Edit Detail Cerita
                    </a>
                </div>
            </form>
            
            <div class="border border-border-default dark:border-dark-border rounded-lg divide-y divide-border-default dark:divide-dark-border/70">
                
                <div class="flex justify-between items-center p-4 bg-gray-50 dark:bg-dark-border rounded-t-lg">
                    <h3 class="text-lg font-semibold text-primary-text dark:text-dark-text">Semua Bab</h3>
                    <a href="/stories/{{ $story->slug }}/chapters/create">
                        <button class="text-primary-text dark:text-dark-text hover:text-cta-main dark:hover:text-cta-main transition duration-200" title="Tambah Bab Baru">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </a>
                </div>

                @forelse($chapters as $chapter)
                <div class="flex justify-between items-center p-4 hover:bg-gray-50 dark:hover:bg-dark-border/70 transition duration-150">
                    <span class="text-primary-text dark:text-dark-text text-bab">Bab {{ $chapter->urutan }} : {{ $chapter->chap_title }}</span>
                    <div class="flex space-x-2">
                        <!-- tombol edit -->
                        <a href="/stories/{{ $story->slug }}/chapters/{{ $chapter->slug }}/edit" 
                        class="flex items-center justify-center w-8 h-8 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition duration-150"
                        title="Edit Bab">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </a>
                        <!-- Tombol Hapus -->
                        <form action="/stories/{{ $story->slug }}/chapters/{{ $chapter->slug }}" 
                            method="post" 
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus bab ini?')">
                            @method('delete')
                            @csrf
                            <button type="submit" class="flex items-center justify-center w-8 h-8 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4a1 1 0 011 1v1H9V4a1 1 0 011-1z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-4 text-center text-secondary-text dark:text-dark-secondary-text">
                    Belum ada bab untuk cerita ini. <a href="/stories/{{ $story->slug }}/chapters/create" class="text-cta-main hover:text-cta-hover underline">Tambah bab sekarang</a>.
                </div>
            @endforelse
            </div>
        </div>
    </div>
    
    <script>
        // dropdown
        document.querySelectorAll('[data-dropdown-bab]').forEach(container => {
            const button = container.querySelector('button');
            const menu = container.querySelector('.transition');
            
            if (button && menu) {
                button.addEventListener('click', (e) => {
                    e.stopPropagation();
                    
                    document.querySelectorAll('[data-dropdown-bab] .transition').forEach(m => {
                         if (m !== menu) {
                            m.classList.add('hidden');
                        }
                    });

                    menu.classList.toggle('hidden');
                });
                
                document.addEventListener('click', (event) => {
                    if (!container.contains(event.target)) {
                        menu.classList.add('hidden');
                    }
                });
            }
        });
    </script>

    @if (session('chap_edited'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Bab berhasil diubah',
            confirmButtonText: 'OK',
            width: '350px',
            customClass: {
                confirmButton: 'bg-primary-color text-white px-5 py-2 rounded-lg hover:bg-cta-hover'
            }
        });
    });
    </script>
    @endif
</body>
</html>