<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Pengguna - $user->username</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'], 
                    },
                    colors: {
                        'primary-color': '#FA812F',
                        'primary-hover': '#e6742a',
                        'primary-text': '#241b00',
                        'secondary-text': '#797772',
                        'border-default': '#e2e2e2',
                        'dark-bg': '#121212',
                        'dark-card': '#1f1f1f',
                        'dark-text': '#f0f0f0',
                        'dark-secondary-text': '#b3b3b3',
                        'dark-border': '#333333',
                    },
                    boxShadow: {
                        'header-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.02)',
                    },
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 dark:bg-dark-bg font-sans min-h-screen transition-colors duration-300"> 
    
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
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
          <img src="{{ $user->pic ? asset('storage/' . $user->pic->pic_path) : asset('images/default.png') }}" alt="user" class="w-full h-full object-cover">
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

    <main class="container mx-auto px-4 sm:px-8 py-10">
        <div class="max-w-4xl mx-auto bg-white dark:bg-dark-card rounded-xl shadow-2xl p-6 sm:p-10 border border-border-default dark:border-dark-border/50">
            <div class="profil-header flex flex-col md:flex-row items-center md:items-start gap-6 border-b border-border-default dark:border-dark-border pb-6 mb-6">
                
                <div class="foto-profil flex-shrink-0">
                    <img src="{{ $user->pic ? asset('storage/' . $user->pic->pic_path) : asset('images/default.png') }}" alt="Foto Profil" class="w-32 h-32 sm:w-40 sm:h-40 rounded-full object-cover border-4 border-primary-color dark:border-primary-color shadow-lg">
                </div>

                <div class="info-dasar flex-grow text-center md:text-left">
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-primary-text dark:text-dark-text mb-1">
                        {{ $user->name }}
                    </h1>
                    <p class="text-lg text-secondary-text dark:text-dark-secondary-text mb-4">
                        @<span></span>{{ $user->username }}
                    </p>
                </div>
            </div>

            <div class="profil-body">

                <h2 class="text-xl font-semibold text-primary-text dark:text-dark-text mb-3 border-b border-gray-100 dark:border-dark-border pb-2">
                    Tentang Penulis
                </h2>

                <div class="bio bg-gray-100 dark:bg-dark-card/70 p-4 rounded-lg">
                    <p class="text-primary-text dark:text-dark-text text-base leading-relaxed">
                        {{ $user->bio }}
                    </p>
                </div>
                
                <h2 class="text-xl font-semibold text-primary-text dark:text-dark-text mt-8 mb-4 border-b border-gray-100 dark:border-dark-border pb-2">
                    Karya
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($stories as $story)
                    <div class="bg-white dark:bg-dark-card rounded-xl shadow-lg dark:shadow-xl border border-border-default dark:border-dark-border overflow-hidden flex flex-col">
                        <div class="w-full aspect-[2/3] overflow-hidden">
                            <img src="{{ $story->cover ? asset('storage/' . $story->cover) : asset('img/no_cover.jpeg') }}" 
                                alt="{{ $story->title }}" 
                                class="w-full h-full object-cover transition-transform duration-200 hover:scale-105">
                        </div>
                        <div class="p-3 flex flex-col gap-2 flex-1">
                            <h3 class="text-sm md:text-base font-semibold text-primary-text dark:text-dark-text truncate">
                                {{ $story->title }}
                            </h3>
                            <div class="flex items-center justify-between text-xs md:text-sm text-secondary-text dark:text-dark-secondary-text">
                                <span>{{ $story->status }}</span> | <span>{{ $story->chapters->count() }} Chapter</span>
                            </div>
                            <a href="/baca/{{ $story->slug }}" class="mt-auto bg-primary-color hover:bg-cta-hover text-white text-center text-xs md:text-sm font-bold py-1 rounded-lg transition duration-200">
                                Baca Sekarang
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>  
        </div>
    </main>

    <script>
        const html = document.documentElement; 
        const toggleButton = document.getElementById('darkModeToggle');

        // Dark Mode Toggle Logic (disimpan di sini karena tidak ada dropdown profile)
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

        // Terapkan mode saat load 
        applyDarkMode(html.classList.contains('dark'));

        // Listener untuk tombol Dark Mode
        toggleButton.addEventListener('click', function() {
            const isCurrentlyDark = html.classList.contains('dark');
            applyDarkMode(!isCurrentlyDark);
        });
    </script>
</body>
</html>