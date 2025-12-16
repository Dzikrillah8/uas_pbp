<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Beranda - PustakaRia</title>
    
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- icons -->
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
                        // Palet Warna
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
                    },
                    boxShadow: {
                        'header-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.02)',
                    },
                    aspectRatio: {
                        '2/3': '2 / 3', 
                    }
                }
            },
            corePlugins: {
                aspectRatio: false,
            },
            plugins: [
                function ({ addUtilities }) {
                    const newUtilities = {
                        '.no-scrollbar': {
                            '-ms-overflow-style': 'none',
                            'scrollbar-width': 'none',
                        },
                        '.no-scrollbar::-webkit-scrollbar': {
                            'display': 'none',
                        }
                    }
                    addUtilities(newUtilities, ['responsive'])
                }
            ]
        }
    </script>
</head>

<body class="bg-gray-50 dark:bg-dark-bg font-sans min-h-screen transition-colors duration-300"> 
    
    <script>
        // dark mode
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
    
    <main class="min-h-screen">
        <div class="welcome flex flex-col relative mb-8 sm:mb-12">
        <div class="sambutan bg-primary-color dark:bg-white pt-12 pb-24 sm:pt-20 sm:pb-32 px-10 sm:px-24 text-white dark:text-primary-text font-sans">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight">Selamat Datang, </h2>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight">{{ auth()->user()->name }}</h2>
        </div>
        <div class="wave absolute bottom-0 left-0 w-full h-20 sm:h-24 md:h-28 overflow-hidden z-10">
            <svg class="fill-gray-50 dark:fill-dark-bg w-full h-full" viewBox="0 0 500 80" preserveAspectRatio="none">
                <path d="M 0,50 C 120,70 380,0 500,40 L 500,80 L 0,80"></path>
            </svg>
        </div>
    </div>
        <div class="iklan container mx-auto px-4 sm:px-16 mb-10">
            <div id="tailwindCarousel" class="relative rounded-xl overflow-hidden shadow-lg border border-border-default dark:border-dark-border/50">
                <div class="carousel-inner flex transition-transform duration-500 ease-in-out">
                    <div class="carousel-item w-full flex-shrink-0">
                        <img src="img/carousel 1.jpeg" class="w-full h-40 sm:h-56 object-cover" alt="Iklan 1">
                    </div>
                    <div class="carousel-item w-full flex-shrink-0">
                        <img src="img/carousel 2.jpeg" class="w-full h-40 sm:h-56 object-cover" alt="Iklan 2">
                    </div>
                </div>
                
                <button class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-black/30 text-white p-2 rounded-full hover:bg-black/50 transition duration-200" onclick="prevSlide('tailwindCarousel')">
                    <i class="bi bi-chevron-left text-lg"></i>
                </button>
                <button class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-black/30 text-white p-2 rounded-full hover:bg-black/50 transition duration-200" onclick="nextSlide('tailwindCarousel')">
                    <i class="bi bi-chevron-right text-lg"></i>
                </button>
            </div>
        </div>
        <div class="container mx-auto px-4 sm:px-8 pb-10">

            <div class="rank-penulis mb-10">
                <h2 class="text-xl font-bold text-primary-text dark:text-dark-text mb-3 flex items-center justify-between">
                    <span><i class="fa-solid fa-crown mr-2 text-cta-main"></i> Rank Penulis</span>
                </h2>
                <div class="grid grid-cols-1 divide-y divide-border-default dark:divide-dark-border/50 bg-white dark:bg-dark-card rounded-xl shadow-md border border-border-default dark:border-dark-border/50">
                    @foreach ($topAuthors as $index => $author)
                    @php
                        $topStory = $author->stories->first();
                    @endphp
                    <a href="#" class="flex items-center p-3 hover:bg-gray-100 dark:hover:bg-dark-border/50 transition duration-150">
                        <span class="text-lg font-extrabold text-cta-main w-8 flex-shrink-0">#{{ $index + 1 }}</span>
                        <img src="img/profile.jpg" alt="P1" class="w-10 h-10 rounded-full object-cover mr-3 border-2 
                        {{ $index === 0 ? 'border-cta-main' : 'border-border-default' }}">
                        <div class="flex-grow">
                            <p class="font-semibold text-primary-text dark:text-dark-text">{{ $author->username }}</p>
                            <p class="text-xs text-secondary-text dark:text-dark-secondary-text">{{ $topStory?->title ?? 'Belum ada cerita' }} | {{ $author->total_likes }} Disukai</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="rekomendasi mb-10">
                <h4 class="text-2xl font-bold text-primary-text dark:text-dark-text mb-4 ml-1">
                    Peringkat Teratas
                </h4>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach ($topStories as $index => $story)
                    <a href="/detail/{{ $story->slug }}"
                    class="hasil flex items-start p-3 bg-white dark:bg-dark-card rounded-xl shadow-md border border-border-default dark:border-dark-border/50 transition-all duration-200 hover:shadow-xl hover:scale-[1.02] hover:border-primary-color dark:hover:border-primary-color cursor-pointer">

                        <div class="cover relative w-[100px] sm:w-[120px] flex-shrink-0 mr-3">
                            @if(!empty($story->cover))
                            <img src="{{ asset('storage/' . $story->cover) }}"
                                class="w-full aspect-2/3 object-cover rounded-md shadow-lg"
                                alt="{{ $story->title }}">
                            @else
                            <img src="{{ asset('img/no_cover.jpeg') }}"
                                class="w-full aspect-2/3 object-cover rounded-md shadow-lg"
                                alt="{{ $story->title }}">
                            @endif
                            <div class="peringkat absolute top-0 left-0 h-6 w-6 bg-primary-color text-white text-xs font-bold flex items-center justify-center rounded-tl-xl rounded-br-xl z-10">
                                #{{ $index + 1 }}
                            </div>
                        </div>

                        <div class="isi flex flex-col justify-between pt-1">
                            <div class="judul text-base font-bold text-primary-text dark:text-dark-text mb-1 line-clamp-2">
                                {{ $story->title }}
                            </div>

                            <p class="penulis text-xs text-secondary-text dark:text-dark-secondary-text mb-2">
                                @<span></span>{{ $story->user->username }}
                            </p>

                            <div class="status inline-flex items-center justify-center px-3 py-0.5 bg-gray-300 dark:bg-dark-border text-primary-text dark:text-dark-text text-xs font-semibold rounded-full w-fit">
                                #{{ $story->genre->name }}
                            </div>
                        </div>
                    </a>
                @endforeach
                </div>
            </div>
            
            <div class="semua-cerita mb-10">
                <h4 class="text-2xl font-bold text-primary-text dark:text-dark-text mb-4 ml-1">Semua Cerita</h4>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                    @foreach ($stories as $story)
                    <a href="/detail/{{ $story->slug }}" class="card-grid bg-white dark:bg-dark-card rounded-xl shadow-md border border-border-default dark:border-dark-border/50 transition-all duration-300 hover:shadow-xl hover:border-primary-color dark:hover:border-primary-color hover:scale-105 cursor-pointer">
                        <div class="cover1 w-full rounded-t-xl overflow-hidden aspect-2/3 bg-gray-200 dark:bg-gray-700">
                            @if(!empty($story->cover))
                            <img src="{{ asset('storage/' . $story->cover) }}" alt="Cover Cerita">
                            @else
                            <img src="{{ asset('img/no_cover.jpeg') }}" alt="Cover Cerita">
                            @endif    
                        </div>

                        <div class="p-3">
                            <h3 class="text-base font-bold text-primary-text dark:text-dark-text mb-1 line-clamp-2">{{ $story->title }}</h3>
                            <p class="text-xs text-secondary-text dark:text-dark-secondary-text mb-2">@<span></span>{{ $story->user->username }}</p>
                            <div class="status inline-flex px-2 py-0.5 bg-gray-300 dark:bg-dark-border text-primary-text dark:text-dark-text text-xs font-semibold rounded-full">
                                #{{ $story->genre->name }}
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            
            <div class="genre mb-6">
                <h4 class="text-2xl font-bold text-primary-text dark:text-dark-text mb-4 ml-1">Jelajahi Genre</h4>
                
                <!-- random icon -->
                @php
                    $icons = [
                        'fas fa-hat-wizard text-indigo-600',
                        'bi bi-person-lines-fill text-teal-600',
                        'fas fa-ghost text-purple-600',
                        'bi bi-heart-fill text-pink-600',
                        'fas fa-brain text-yellow-600',
                        'bi bi-cup-hot-fill text-red-600',
                        'fas fa-face-laugh-squint text-green-600',
                        'fas fa-graduation-cap text-blue-600',
                    ];
                @endphp

                <div class="baris grid grid-cols-2 gap-3">
                    @foreach ($genres as $genre)
                    @php
                        $randomIcon = $icons[array_rand($icons)];
                    @endphp
                    <a href="/genre/{{ $genre->slug }}" class="hashtag group flex-shrink-0 flex items-center bg-gray-200 dark:bg-dark-border px-4 py-2 text-primary-text dark:text-dark-text font-semibold text-lg rounded-lg transition duration-200 
                        hover:bg-primary-color hover:text-white active:bg-primary-color active:text-white 
                        dark:hover:bg-primary-color dark:hover:text-white dark:active:bg-primary-color dark:active:text-white">
                        <i class="{{ $randomIcon }} fas fa-hat-wizard text-xl text-indigo-600 dark:text-indigo-400 mr-2 group-hover:text-white group-active:text-white"></i>
                        <span>{{ $genre->name }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-8 pb-10"> 
            <div class="lainnya-section">
                <h4 class="text-2xl font-bold text-primary-text dark:text-dark-text mb-4 ml-1">Lainnya</h4>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                    @foreach ($stories as $story)
                    <a href="/detail/{{ $story->slug }}" class="card-grid group bg-white dark:bg-dark-card rounded-xl shadow-md border border-border-default dark:border-dark-border/50 transition-all duration-300 hover:shadow-xl hover:border-primary-color dark:hover:border-primary-color hover:scale-105 cursor-pointer">
                        
                        <div class="cover1 w-full rounded-t-xl overflow-hidden aspect-2/3 bg-gray-200 dark:bg-gray-700">
                            @if(!empty($story->cover))
                            <img src="{{ asset('storage/' . $story->cover) }}" class="w-full h-full object-cover" alt="Cover Cerita">
                            @else
                            <img src="{{ asset('img/no_cover.jpeg') }}" class="w-full h-full object-cover" alt="Cover Cerita">
                            @endif    
                        </div>

                        <div class="p-3">
                            <div class="status inline-flex px-2 py-0.5 bg-gray-300 dark:bg-dark-border text-primary-text dark:text-dark-text text-xs font-semibold rounded-full transition-colors duration-300
                                group-hover:bg-primary-color group-hover:text-white dark:group-hover:bg-primary-color dark:group-hover:text-white">
                                #{{ $story->genre->name }}
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <script>
        const profileLink = document.querySelector('.profile');
        const dropdownMenu = document.querySelector('[data-dropdown]');

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

        const html = document.documentElement; 
        const toggleButton = document.getElementById('darkModeToggle');

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
        
        function getCarouselElements(id) {
            const container = document.getElementById(id);
            const inner = container.querySelector('.carousel-inner');
            const items = container.querySelectorAll('.carousel-item');
            return { inner, items, total: items.length };
        }

        let currentIndices = { 'tailwindCarousel': 0 };

        function updateCarousel(id) {
            const { inner, total } = getCarouselElements(id);
            if (!inner) return;
            inner.style.transform = `translateX(-${currentIndices[id] * 100}%)`;
        }

        window.prevSlide = function(id) {
            currentIndices[id] = (currentIndices[id] === 0) ? getCarouselElements(id).total - 1 : currentIndices[id] - 1;
            updateCarousel(id);
        }

        window.nextSlide = function(id) {
            currentIndices[id] = (currentIndices[id] === getCarouselElements(id).total - 1) ? 0 : currentIndices[id] + 1;
            updateCarousel(id);
        }
    </script>   
</body>
</html>