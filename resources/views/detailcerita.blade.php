<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Cerita</title>
    
    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .vertical-divider {
            width: 1.5px;
            height: 25px;
            background-color: rgb(156 163 175); 
        }
        .dark .vertical-divider {
             background-color: rgb(82 82 91); 
        }
    </style>

    <script>
        tailwind.config = {
            darkMode: 'class', 
            theme: {
                extend: {
                    fontFamily: {
                      
                        sans: ['Poppins', 'sans-serif'], 
                        
                        header: ['Poppins', 'sans-serif'], 
                    },
                    colors: {
                        'primary-color': '#FA812F',     
                        'primary-text': '#241b00',      
                        'secondary-text': '#797772',    
                        'border-default': '#e2e2e2',    
                        'cta-main': '#FA812F', 
                        'cta-hover': '#e6742a', 
                        
                        'dark-bg': '#121212',
                        'dark-card': '#1f1f1f', 
                        'dark-text': '#f0f0f0',
                        'dark-secondary-text': '#b3b3b3',
                        'dark-border': '#333333',
                        'dark-red-status': '#b30000', 
                    },
                    boxShadow: {
                        'header-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.02)',
                        'story-card': '0 8px 20px -10px rgba(0,0,0,0.15)',
                    },
                }
            },
        }
    </script> 
</head>

<body class="bg-gray-50 dark:bg-dark-bg font-sans min-h-screen transition-colors duration-300">
    
    <script>
        if (localStorage.getItem('theme') === 'dark' || 
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <header class="header sticky top-0 z-40 bg-white dark:bg-dark-card w-full shadow-header-shadow flex items-center justify-between px-4 sm:px-8 py-3 border-b border-border-default dark:border-dark-border">
      <div class="kiri flex items-center">
        <nav class="menu flex text-lg sm:text-base font-medium">
            <a class="nav-link text-primary-color transition duration-200 flex items-center space-x-1 p-2 rounded-lg" href="/home"><i class="bi bi-house-door-fill text-xl sm:text-lg"></i><span class="hidden sm:inline font-semibold text-sm">BERANDA</span></a>
            <a class="nav-link text-secondary-text dark:text-dark-secondary-text hover:text-primary-color dark:hover:text-primary-color transition duration-200 flex items-center space-x-1 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-dark-border/50" href="/search">
                <i class="bi bi-search text-xl sm:text-lg"></i>
                <span class="hidden sm:inline font-semibold text-sm">CARI</span></a>
            <a class="nav-link text-secondary-text dark:text-dark-secondary-text hover:text-primary-color dark:hover:text-primary-color transition duration-200 flex items-center space-x-1 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-dark-border/50" href="/perpus"><i class="bi bi-book text-xl sm:text-lg"></i><span class="hidden sm:inline font-semibold text-sm">KOLEKSI</span></a>
        </nav>
      </div>
      <div class="kanan relative flex items-center space-x-4 sm:space-x-6"> 
        <i id="darkModeToggle" class="bi bi-moon text-2xl text-primary-text dark:text-dark-text cursor-pointer hover:text-primary-color transition duration-200 p-2 rounded-full hover:bg-gray-100 dark:hover:bg-dark-border/50"></i>
        <a class="profile w-10 h-10 sm:w-[43px] sm:h-[43px] rounded-full overflow-hidden border-2 border-gray-300 hover:border-primary-color transition duration-200 block dark:border-dark-border dark:hover:border-primary-color" href="#">
          <img src="{{ $user->pic ? asset('storage/' . $user->pic->pic_path) . '?t=' . time() : asset('images/default.png') }}" alt="user" class="w-full h-full object-cover">
        </a>
        <div class="dropdown-menu absolute bg-white dark:bg-dark-card mt-1 w-48 rounded-lg shadow-2xl border border-border-default dark:border-dark-border overflow-hidden top-[60px] right-0 z-50 transition-all duration-200 hidden flex-col" data-dropdown>
          <a href="/myprofile" class="block p-3 text-primary-text dark:text-dark-text hover:bg-gray-100 dark:hover:bg-dark-border transition duration-150 text-sm font-medium">
            <i class="bi bi-person-circle mr-2"></i> Lihat Profil
          </a>
          <hr class="my-0 border-border-default dark:border-dark-border">
          <a href="/story/create" class="block p-3 text-primary-text dark:text-dark-text hover:bg-gray-100 dark:hover:bg-dark-border transition duration-150 text-sm font-medium">
            <i class="bi bi-pencil-square mr-2"></i> Buat Cerita
          </a>
          <a href="/mystory" class="block p-3 text-primary-text dark:text-dark-text hover:bg-gray-100 dark:hover:bg-dark-border transition duration-150 text-sm font-medium">
            <i class="bi bi-journal-text mr-2"></i> Cerita Saya
          </a>
          <form action="/logout" method="post">
            @csrf
            <button type="submit"
              class="w-full text-left block p-3 text-primary-text dark:text-dark-text hover:bg-gray-100 dark:hover:bg-dark-border transition duration-150 text-sm font-medium">
              <i class="bi bi-box-arrow-right mr-2"></i> Logout
            </button>
          </form>
        </div>
      </div>
    </header>

    <div class="cerita max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="card bg-white dark:bg-dark-card rounded-lg shadow-story-card border border-border-default dark:border-dark-border/50">
            <div class="atas flex flex-col items-center p-6 md:p-10 gap-8"> 
                
                <div class="buku flex flex-col items-center md:flex-row gap-6 md:gap-10 w-full md:w-auto"> 
                    
                    <div class="cover flex-shrink-0">
                      @if(!empty($story->cover))
                      <img src="{{ asset('storage/' . $story->cover) }}" alt="no_cover.jpeg" class="w-full max-w-[220px] h-auto object-cover rounded-lg mx-auto shadow-lg">
                      @else
                      <img src="{{ asset('img/no_cover.jpeg') }}" alt="no_cover.jpeg" class="w-full max-w-[220px] h-auto object-cover rounded-lg mx-auto shadow-lg">
                      @endif
                    </div>

                    <div class="samping flex flex-col justify-center items-center w-full max-w-md md:max-w-none gap-5 md:gap-8">
                        
                        <div class="judul w-full">
                            <h4 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-primary-text dark:text-dark-text text-center leading-tight">
                                {{ $story->title }}
                            </h4>
                        </div>

                        <div class="jumlah flex justify-center items-center gap-6 text-primary-text dark:text-dark-text">
                          <div class="per flex flex-col items-center">
                            @auth
                                @php
                                    $isLiked = $story->likes->contains('user_id', auth()->id());
                                @endphp
                                <form action="/stories/{{ $story->slug }}/like" method="post">
                                @csrf
                                <button type="submit" class="icon flex flex-col items-center text-xs 
                                    {{ $isLiked ? 'text-red-500' : 'text-gray-400 dark:text-dark-secondary-text' }}">
                                        <i class="fa-solid fa-heart mb-1 text-base"></i>
                                        <span>{{ $isLiked ? 'Disukai' : 'Suka' }}</span>
                                    </button>
                                </form>
                            @endauth
                            <div class="angka text-base font-bold">
                                <p>{{ $story->likes->count() }}</p>
                            </div>
                        </div>

                        <div class="vertical-divider"></div>

                      <div class="per flex flex-col items-center">
                          <div class="icon flex flex-col items-center text-xs text-gray-400 dark:text-dark-secondary-text">
                              <i class="fa-solid fa-lines-leaning mb-1 text-base"></i>
                              <span>Chapter</span>
                          </div>
                          <div class="angka text-base font-bold">
                              <p>{{ $story->chapters->count() }}</p>
                          </div>
                      </div>
                    </div>
                      <div class="button flex w-full max-w-xs sm:max-w-sm mx-auto mt-4"> 
                        <a href="/baca/{{ $story->slug }}" class="btn flex-grow-[10] flex justify-center items-center bg-primary-color text-white font-bold h-10 px-6 rounded-l-full transition duration-200 hover:bg-cta-hover hover:text-white hover:shadow-lg text-base">
                          Mulai Baca
                        </a>
                      <div class="relative flex-grow-[1]">
                        <button id="bookmarkBtn" class="btn-2 flex justify-center items-center bg-primary-color text-white font-bold h-10 px-4 rounded-r-full transition duration-200 hover:bg-cta-hover hover:text-white hover:shadow-lg">
                          <i class="fa-regular fa-bookmark text-lg"></i>
                        </button>
                        <!-- dropdown -->
                        <div id="bookmarkDropdown" class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg hidden z-10">
                          @forelse($userBookmarks as $bookmark)
                          <form action="/bookmark/{{ $bookmark->slug }}/add-story" method="post">
                          @csrf
                          <input type="hidden" name="story_id" value="{{ $story->id }}">
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                              {{ $bookmark->name }}
                            </button>
                          </form>
                          @empty
                            <p class="px-4 py-2 text-gray-500">Belum ada koleksi</p>
                          @endforelse
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="bawah flex flex-col lg:flex-row mt-6 gap-6">
            
            <div class="ini w-full lg:w-3/5">
                <div class="flex flex-col gap-4">
                    <a href="{{ url('/authors/' . $story->user->username) }}" class="penulis text-primary-text dark:text-dark-text font-bold text-lg hover:text-primary-color transition duration-150">
                        <span class="font-bold">@</span><span>{{ $story->user->username }}</span>
                    </a>
                    <div class="status inline-block bg-red-600 dark:bg-dark-red-status text-white font-bold text-sm px-3 py-1 rounded-md max-w-fit">
                        <p>{{ $story->status }}</p>
                    </div>
                </div>

                <div class="deskripsi mt-1 text-primary-text dark:text-dark-text font-medium text-base leading-relaxed whitespace-pre-line">
                    <p>
                      {{ trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($story->sinopsis)))) }}
                    </p>
                </div>
            </div>

            <div class="itu w-full lg:w-2/5 flex-shrink-0">
                <div class="isi flex flex-col p-5 bg-white dark:bg-dark-card shadow-lg dark:shadow-xl border border-border-default dark:border-dark-border/50 rounded-xl">
                    <h5 class="text-xl font-bold text-primary-text dark:text-dark-text mb-4">Daftar Isi</h5>
                    
                    @forelse ($story->chapters()->where('visibility', 'public')
                    ->orderBy('urutan')->get() as $chapter)

                    <a href="{{ $chapter->urutan == 1 ? route('baca', $story->slug) : route('baca.chapter', [$story->slug, $chapter->slug]) }}" class="chap block py-2 px-3 -mx-3 rounded-lg hover:bg-primary-color/10 dark:hover:bg-primary-color/20 transition duration-150 group">
                        <div class="flex justify-between items-center">
                            <div class="detail">
                                <span class="text-primary-text dark:text-dark-text font-semibold group-hover:text-primary-color transition duration-150">
                                  {{ $chapter->chap_title ?? 'Chapter ' . $chapter->urutan }}
                                </span>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-dark-secondary-text">
                                <p>{{ $chapter->created_at->translatedFormat('d M Y') }}</p>
                            </div>
                        </div>
                    </a>
                    @if (!$loop->last)
                    <hr class="my-0 border-gray-100 dark:border-dark-border/50">
                    @endif
                    @empty
                      <p class="text-gray-500 dark:text-dark-secondary-text text-sm">
                        Belum ada chapter
                      </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
        // Ambil elemen
        const profileLink = document.querySelector('[data-dropdown-toggle]');
        const dropdownMenu = document.querySelector('[data-dropdown]');
        const html = document.documentElement; 
        const toggleButton = document.getElementById('darkModeToggle');

        // 1. Dropdown Menu
        profileLink.addEventListener('click', function(e) {
            e.preventDefault(); 
            const isHidden = dropdownMenu.classList.contains('hidden');
            if (isHidden) {
                dropdownMenu.classList.remove('hidden');
                dropdownMenu.classList.add('flex');
            } else {
                dropdownMenu.classList.add('hidden');
                dropdownMenu.classList.remove('flex');
            }
        });

        document.addEventListener('click', function(e) {
            if (!profileLink.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
                dropdownMenu.classList.remove('flex');
            }
        });
        
        // 2. Dark Mode Toggle
        function applyDarkMode(isDark) {
            if (isDark) {
                html.classList.add('dark');
                toggleButton.classList.remove('bi-moon');
                toggleButton.classList.add('bi-sun');
                localStorage.setItem('theme', 'dark');
            } else {
                html.classList.remove('dark');
                toggleButton.classList.remove('bi-sun');
                toggleButton.classList.add('bi-moon');
                localStorage.setItem('theme', 'light');
            }
        }
        
        // Terapkan tema saat memuat halaman
        applyDarkMode(html.classList.contains('dark'));

        // Listener untuk tombol toggle
        toggleButton.addEventListener('click', function() {
            const isCurrentlyDark = html.classList.contains('dark');
            applyDarkMode(!isCurrentlyDark);
        });

        const btn = document.getElementById('bookmarkBtn');
        const dropdown = document.getElementById('bookmarkDropdown');

        btn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
        });

        // Tutup dropdown saat klik di luar
        window.addEventListener('click', function(e) {
            if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });   
    </script>

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('added'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
                icon: 'success',
                title: 'Ditambahkan ke koleksi',
                width: '300px',
                timer: 1500,
                showConfirmButton: false,
            });
    });
    </script>
    @endif

    @if(session('liked'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Disukai',
                width: '300px',
                timer: 1500,
                showConfirmButton: false,
            });
        });
    </script>
    @endif

    @if(session('alr_liked'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Sudah menyukai',
                width: '300px',
                timer: 1500,
                showConfirmButton: false,
            });
        });
    </script>
    @endif   
</body>
</html>