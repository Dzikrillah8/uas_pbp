<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cari Cerita - PustakaRia</title>
    
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
                        // Menggunakan Poppins sebagai font utama (sans-serif)
                        sans: ['Poppins', 'sans-serif'], 
                    },
                    colors: {
                        // Definisikan warna-warna utama agar mudah diubah
                        'primary-color': '#FA812F',
                        'primary-text': '#241b00',
                        'secondary-text': '#797772',
                        'border-default': '#e2e2e2',
                        'cta-main': '#FA812F',
                        'cta-hover': '#e6742a',
                        // Warna Dark Mode
                        'dark-bg': '#121212',
                        'dark-card': '#1f1f1f',
                        'dark-text': '#f0f0f0',
                        'dark-secondary-text': '#b3b3b3',
                        'dark-border': '#333333',
                    },
                    boxShadow: {
                        'header-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.02)',
                        'search-shadow': '0 8px 20px -10px rgba(0, 0, 0, 0.15)',
                    },
                }
            }
        }
    </script>
    
    <style>
        /* Memastikan line-clamp berfungsi untuk deskripsi */
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

</head>

<body class="bg-gray-50 dark:bg-dark-bg font-sans min-h-screen transition-colors duration-300"> 
    
    <script>
        // Cek LocalStorage atau preferensi sistem untuk Dark Mode
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

    <div class="container mx-auto px-4 sm:px-8 py-8">
        <div class="search bg-white dark:bg-dark-card rounded-lg shadow-search-shadow max-w-7xl mx-auto p-4 sm:p-5 mb-8">
            <form action="/search" class="flex flex-col sm:flex-row items-center gap-3" role="search">
                <input class="form-control w-full h-11 px-4 py-2 border border-gray-300 dark:border-dark-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-color dark:bg-dark-bg dark:text-dark-text dark:placeholder-dark-secondary-text transition duration-200" 
                type="text" placeholder="Cari cerita" name="search" aria-label="Search" value="{{ request('search') }}" />
                
                <div class="bawah w-full flex justify-between items-center sm:w-auto sm:space-x-3">   
                    <div class="relative inline-block text-left" data-filter-toggle>
                        <button class="btn-filter inline-flex justify-center items-center h-11 px-4 py-2 text-sm font-medium text-primary-text dark:text-dark-text bg-white dark:bg-dark-card border border-gray-300 dark:border-dark-border rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-dark-border/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-color transition duration-200" type="button" aria-expanded="false" aria-haspopup="true">
                            Filter <i class="bi bi-chevron-down ml-2 -mr-1"></i>
                        </button>
                        <div class="dropdown-menu-filter absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-dark-card ring-1 ring-black ring-opacity-5 hidden z-10" data-filter-menu>
                          <div class="py-2" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <ul class="space-y-2 px-2">
                                <li>
                                  <select name="status" class="block w-full text-sm text-primary-text dark:text-dark-text bg-gray-100 dark:bg-dark-border border border-gray-300 dark:border-dark-border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-primary-color px-3 py-2">
                                    <option value="">Status</option>
                                    <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="finished" {{ request('status') == 'finished' ? 'selected' : '' }}>Finished</option>
                                  </select>
                                </li>
                                <li>
                                  <select name="genre" class="block w-full text-sm text-primary-text dark:text-dark-text bg-gray-100 dark:bg-dark-border border border-gray-300 dark:border-dark-border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-primary-color px-3 py-2">
                                    <option value="">Genre</option>
                                    @foreach ($genres as $genre)
                                    <option value="{{ $genre->slug }}" {{ request('genre') == $genre->slug ? 'selected' : '' }}>
                                      {{ $genre->name }}
                                    </option>
                                    @endforeach
                                  </select>
                                </li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <button type="submit" class="cari inline-flex items-center justify-center h-11 w-11 text-white bg-cta-main hover:bg-cta-hover rounded-lg transition duration-200 ml-2">
                        <i class="bi bi-search text-xl"></i>
                    </button>
                </div>
            </form>
        </div>

        @if(!request('search'))
        @else

        @if($stories->isEmpty())
        <br>
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-6">
              <div class="judul mb-2 sm:mb-4">
                <p class="text-xl sm:text-2xl font-bold text-primary-text dark:text-dark-text capitalize">Cerita tidak tersedia</p>
              </div>
            </div>
          </div>
        @else

        @foreach ($stories as $story)
        <a href="detail_cerita.html" class="hasil flex flex-col sm:flex-row items-start p-4 sm:p-5 rounded-xl shadow-lg border border-border-default dark:border-dark-border/50 bg-white dark:bg-dark-card transition-all duration-300 hover:shadow-xl hover:border-primary-color dark:hover:border-primary-color max-w-7xl mx-auto mb-6 cursor-pointer">
          <div class="cover flex-shrink-0 mb-4 sm:mb-0 sm:mr-6 mx-auto">
            @if(!empty($story->cover))
            <img src="{{ asset('storage/' . $story->cover) }}" class="w-32 sm:w-36 h-auto rounded-lg shadow-md" alt="{{ $story->title }}">
            @else
            <img src="{{ asset('img/no_cover.jpeg') }}" class="w-32 sm:w-36 h-auto rounded-lg shadow-md" alt="{{ $story->title }}">
            @endif 
          </div>     
          <div class="isi w-full"> 
            <div class="judul mb-2">
              <p class="text-xl sm:text-2xl font-bold text-primary-text dark:text-dark-text capitalize">{{ $story->title }}</p>
            </div>
            <div class="detail flex items-center space-x-4 sm:space-x-6 mb-3 sm:mb-5 border-b border-gray-200 dark:border-dark-border pb-3"> 
              <div class="status mb-3">
                <span class="angka font-bold text-primary-text dark:text-dark-text ml-1">@<span></span>{{ $story->user->username }}</span>
              </div>
            </div>
            <div class="mb-4 per flex items-center space-x-2 text-sm text-secondary-text dark:text-dark-secondary-text">
              <p class="inline-flex px-3 py-0.5 bg-green-500 dark:bg-green-700 text-white text-xs font-semibold rounded-full">
                {{ $story->status }}
              </p>
            </div>
            <div class="deskripsi">
              <p class="text-sm sm:text-base text-primary-text dark:text-dark-text line-clamp-3 leading-relaxed">
                {{ trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($story->sinopsis)))) }}
              </p>
            </div>
          </div>
        </a>
        @endforeach
      @endif
    @endif
  </div>

    <script>
        const profileLink = document.querySelector('[data-dropdown-toggle]');
        const dropdownMenu = document.querySelector('[data-dropdown]');
        const html = document.documentElement; 
        const toggleButton = document.getElementById('darkModeToggle');
        
        // filter dropdown
        const filterToggle = document.querySelector('[data-filter-toggle]');
        const filterMenu = document.querySelector('[data-filter-menu]');

        filterMenu.addEventListener('click', function(e) {
          e.stopPropagation();
        });

        // dropdown profile
        function setupProfileDropdown() {
            if (profileLink) {
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
            }
        }
        setupProfileDropdown();
        
        // dropdown menu filter
        function setupFilterDropdown() {
             if (filterToggle && filterMenu) {
                filterToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    filterMenu.classList.toggle('hidden');
                });
                
                document.addEventListener('click', function(e) {
                    if (!filterToggle.contains(e.target) && !filterMenu.contains(e.target)) {
                        filterMenu.classList.add('hidden');
                    }
                });
            }
        }
        setupFilterDropdown();

        // darkmode
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

        applyDarkMode(html.classList.contains('dark'));

        toggleButton.addEventListener('click', function() {
            const isCurrentlyDark = html.classList.contains('dark');
            applyDarkMode(!isCurrentlyDark);
        });
    </script>
</body>
</html>