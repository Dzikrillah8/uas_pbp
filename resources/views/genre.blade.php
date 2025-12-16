<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Genre: {{ $title }} - CeritaKu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        tailwind.config = { darkMode: 'class', theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'], }, colors: { 'primary-color': '#FA812F', 'primary-text': '#241b00', 'secondary-text': '#797772', 'border-default': '#e2e2e2', 'cta-main': '#FA812F', 'cta-hover': '#e6742a', 'dark-bg': '#121212', 'dark-card': '#1f1f1f', 'dark-text': '#f0f0f0', 'dark-secondary-text': '#b3b3b3', 'dark-border': '#333333', }, boxShadow: { 'header-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.02)', }, aspectRatio: { '2/3': '2 / 3', } } } }
    </script>
</head>

<body class="bg-gray-50 dark:bg-dark-bg font-sans min-h-screen transition-colors duration-300"> 
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) { document.documentElement.classList.add('dark'); } else { document.documentElement.classList.remove('dark'); }
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

    <main class="min-h-screen container mx-auto px-4 sm:px-8 py-8">
        
        <div class="mb-4 text-sm text-secondary-text dark:text-dark-secondary-text">
            <a href="home.html" class="hover:text-primary-color transition duration-150">Jelajahi Genre</a> 
            <i class="bi bi-chevron-right mx-1 text-xs"></i> 
            <span class="font-semibold text-primary-text dark:text-dark-text">Fiksi Umum</span>
        </div>
        
        <div class="judul-genre flex items-center mb-8 bg-white dark:bg-dark-card p-6 rounded-xl shadow-lg border border-border-default dark:border-dark-border/50">
            <div class="ikon flex-shrink-0 mr-4">
                 <i class="bi bi-person-lines-fill text-5xl text-teal-600 dark:text-teal-400"></i>
            </div>
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-primary-text dark:text-dark-text mb-1">
                    Genre: {{ $genre }}
                </h1>
                <p class="text-secondary-text dark:text-dark-secondary-text text-base">
                    Temukan berbagai cerita di genre {{ $genre }}
                </p>
            </div>
        </div>

        <div class="daftar-cerita-genre mb-10">
            <h2 class="text-2xl font-bold text-primary-text dark:text-dark-text mb-5">
                Semua Cerita {{ $genre }}
            </h2>
            @if($stories->isEmpty())
              <h4 class="text-2xl font-bold text-primary-text dark:text-dark-text mb-5">
                Semua Cerita {{ $genre }}
              </h4>    
            @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
              @foreach ($stories as $story)
                <a href="cerita.html" class="card-grid group bg-white dark:bg-dark-card rounded-xl shadow-md border border-border-default dark:border-dark-border/50 transition-all duration-300 hover:shadow-xl hover:border-primary-color dark:hover:border-primary-color hover:scale-105 cursor-pointer">
                    <div class="cover1 w-full rounded-t-xl overflow-hidden aspect-2/3 bg-gray-200 dark:bg-gray-700">
                        <img src="{{ asset('storage/' . $story->cover) }}" class="w-full h-full object-cover" alt="Cover Cerita">
                    </div>
                    <div class="p-3">
                        <h3 class="text-base font-bold text-primary-text dark:text-dark-text mb-1 line-clamp-2">{{ $story->name }}</h3>
                        <p class="text-xs text-secondary-text dark:text-dark-secondary-text mb-2">@andrea_hirata</p>
                        <div class="status inline-flex px-2 py-0.5 bg-teal-200 dark:bg-teal-900 text-teal-800 dark:text-teal-200 text-xs font-semibold rounded-full">
                            #{{ $genre }}
                        </div>
                    </div>
                </a>
                @endforeach
              </div> 
            @endif
        </div>
    </main>

    <script>
        const profileLink = document.querySelector('[data-dropdown-toggle]');
        const dropdownMenu = document.querySelector('[data-dropdown]');
        const html = document.documentElement; 
        const toggleButton = document.getElementById('darkModeToggle');

        if (profileLink) {
            profileLink.addEventListener('click', function(e) {
                e.preventDefault(); 
                const isHidden = dropdownMenu.classList.contains('hidden');
                if (isHidden) { dropdownMenu.classList.remove('hidden'); dropdownMenu.classList.add('flex'); } else { dropdownMenu.classList.add('hidden'); dropdownMenu.classList.remove('flex'); }
            });
            document.addEventListener('click', function(e) {
                if (!profileLink.contains(e.target) && !dropdownMenu.contains(e.target)) { dropdownMenu.classList.add('hidden'); dropdownMenu.classList.remove('flex'); }
            });
        }
        
        function applyDarkMode(isDark) {
            if (isDark) { html.classList.add('dark'); toggleButton.classList.remove('bi-moon'); toggleButton.classList.add('bi-sun'); localStorage.setItem('theme', 'dark'); } 
            else { html.classList.remove('dark'); toggleButton.classList.remove('bi-sun'); toggleButton.classList.add('bi-moon'); localStorage.setItem('theme', 'light'); }
        }
        applyDarkMode(html.classList.contains('dark'));
        toggleButton.addEventListener('click', function() {
            const isCurrentlyDark = html.classList.contains('dark');
            applyDarkMode(!isCurrentlyDark);
        });
    </script>
</body>
</html>