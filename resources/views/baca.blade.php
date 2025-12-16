<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membaca - Judul Cerita</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            darkMode: 'class', 
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'], 
                   
                    },
                    colors: {
                        // Palet Warna Utama  
                        'primary-color': '#FA812F',     
                        'primary-text': '#241b00',      
                        'secondary-text': '#797772',    
                        'border-default': '#e2e2e2',    
                        'cta-main': '#FA812F', 
                        'cta-hover': '#e6742a', 
                        
                        // Dark Mode Colors
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
</head>

<body class="bg-gray-50 dark:bg-dark-bg font-sans min-h-screen transition-colors duration-300">
    
    <script>
        // Logika Tema Gelap (Dark Mode)
        const html = document.documentElement;
        if (localStorage.getItem('theme') === 'dark' || 
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
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

    <div class="w-full">
        <div class="sticky top-[68px] z-30 bg-white dark:bg-dark-card flex justify-between items-center px-4 sm:px-8 py-2 border-b-2 border-border-default dark:border-dark-border transition-colors duration-300">
            <div class="flex items-center" id="chapter-dropdown-container">
                <div class="relative">
                    <button class="dropdown-toggle flex flex-col items-start p-1 border-none bg-transparent cursor-pointer relative" id="chapter-toggle">
                        <span class="judul text-sm font-bold text-primary-text dark:text-dark-text">{{ $story->title }}</span>
                        <span class="penulis text-xs text-secondary-text dark:text-dark-secondary-text font-medium">Oleh {{ $story->user->username }}</span>
                        
                        <i class="fa-solid fa-chevron-down absolute right-[-20px] top-1/2 transform -translate-y-1/2 text-xs text-primary-text dark:text-dark-text"></i>
                    </button>
                    <div class="absolute hidden top-full left-0 mt-3 w-56 sm:w-64 bg-white dark:bg-dark-card border border-border-default dark:border-dark-border rounded-lg shadow-xl p-3 z-50 mx-5" id="chapter-list">
                      @foreach($story->chapters()->where('visibility','public')->orderBy('urutan')->get() as $c)  
                        <div class="chapter-item flex justify-between items-center py-2 px-1 border-b border-border-default dark:border-dark-border/50 text-sm font-semibold text-primary-text dark:text-dark-text hover:bg-gray-100 dark:hover:bg-dark-border/50 rounded-md transition duration-150 cursor-pointer">
                          <a href="{{ $c->urutan == 1 
                            ? route('baca', $story->slug) 
                            : route('baca.chapter', [$story->slug, $c->slug]) }}" style="text-decoration: none; color: black;">
                            <span>{{ $c->chap_title ?? 'Bab Tak Berjudul '.$c->urutan }}</span>
                          </a>
                        </div>
                      @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="tengah max-w-2xl mx-auto my-10 p-4 sm:p-0 text-primary-text dark:text-dark-text">
            <div class="text-center pb-5 border-b border-border-default dark:border-dark-border/50">
              <h2 class="text-3xl font-bold mb-1">
                {{ $chapter->chap_title ?? 'Bab belum tersedia' }}
              </h2>
              <p class="text-sm font-medium text-secondary-text dark:text-dark-secondary-text">oleh @<span></span>{{ $story->user->username }}</p>
            </div>
            <div class="isi-cerita mt-8 text-lg leading-relaxed font-medium">
              @if($chapter)
                {{ trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($chapter->content)))) }}
              @else
                <p class="text-muted text-center">
                  Isi bab belum tersedia.
                </p>
              @endif
            </div>
            @if($nextChapter)
            <div class="mt-12 text-center bg-primary-color h-10 rounded-full flex items-center justify-center transition duration-200 hover:bg-cta-hover">
                <a href="{{ route('baca.chapter', [$story->slug, $nextChapter->slug]) }}" class="text-white font-bold text-lg no-underline hover:text-white transition duration-200">
                    Bab selanjutnya
                </a>
            </div>
            @else
            @endif
        </div>

        <div class="bawah border-t border-border-default dark:border-dark-border bg-white dark:bg-dark-card p-4">
            <div class="komentar max-w-2xl mx-auto">
              <form action="{{ route('chapter.comment', $chapter) }}" method="post" class="tuliskomen flex space-x-2 items-center mt-4">
                  @csrf
                  <textarea name="content" placeholder="Tulis komentar..." class="komen w-full h-10 px-4 py-2 border border-border-default dark:border-dark-border/50 rounded-full resize-none overflow-hidden text-sm dark:bg-dark-bg dark:text-dark-text focus:outline-none focus:ring-1 focus:ring-primary-color" rows="1"></textarea>
                  <button type="submit" class="w-11 h-10 p-2 border-none rounded-full bg-primary-color text-white font-semibold transition duration-200 hover:bg-cta-hover">
                    <i class="fa-solid fa-paper-plane"></i>
                  </button>
              </form>
              <div class="listkomen mt-6 ml-1 flex flex-col space-y-4">
                @forelse($chapter?->comments ?? collect() as $comment)
                <div class="isikomen">
                  <div class="username">
                    <p class="font-bold text-primary-text dark:text-dark-text text-sm">
                      {{ $comment->user->username }}
                    </p>
                  </div>
                  <div>
                    <p class="comment text-sm font-medium text-primary-text dark:text-dark-text">
                      {{ $comment->content }}
                    </p>
                  </div>
                </div>
                @empty
                <p class="text-sm text-secondary-text dark:text-dark-secondary-text italic text-center">
                  {{ $chapter ? 'Belum ada komentar. Jadilah yang pertama berkomentar!' : 'Komentar belum tersedia karena bab belum ada.' }}
                </p>
                @endforelse
              </div>
              <br>
            </div>
        </div>
    </div>

    <script>
        // JavaScript untuk Dropdown Chapter
        const chapterToggle = document.getElementById('chapter-toggle');
        const chapterList = document.getElementById('chapter-list');
        const chapterContainer = document.getElementById('chapter-dropdown-container');

        // Toggle saat tombol diklik
        chapterToggle.addEventListener('click', (e) => {
            e.stopPropagation(); 
            chapterList.classList.toggle('hidden');
        });

        // Tutup saat mengklik di luar area dropdown
        document.addEventListener('click', (e) => {
            if (!chapterContainer.contains(e.target)) {
                chapterList.classList.add('hidden');
            }
        });

        // JavaScript untuk Dropdown Profil (di header)
        const profileToggle = document.getElementById('profile-toggle');
        const profileMenu = document.getElementById('profile-menu');
        profileToggle.addEventListener('click', function(e) {
            e.preventDefault(); 
            profileMenu.classList.toggle('hidden');
            profileMenu.classList.toggle('flex-col');
        });
        document.addEventListener('click', function(e) {
            if (!profileToggle.contains(e.target) && !profileMenu.contains(e.target)) {
                profileMenu.classList.add('hidden');
                profileMenu.classList.remove('flex-col');
            }
        });
        
        // JavaScript untuk Dark Mode (Diambil dari halaman sebelumnya)
        const darkModeToggle = document.getElementById('darkModeToggle');
        function applyDarkMode(isDark) {
            if (isDark) {
                html.classList.add('dark');
                darkModeToggle.classList.remove('bi-moon');
                darkModeToggle.classList.add('bi-sun');
                localStorage.setItem('theme', 'dark');
            } else {
                html.classList.remove('dark');
                darkModeToggle.classList.remove('bi-sun');
                darkModeToggle.classList.add('bi-moon');
                localStorage.setItem('theme', 'light');
            }
        }
        
        applyDarkMode(html.classList.contains('dark'));
        darkModeToggle.addEventListener('click', function() {
            const isCurrentlyDark = html.classList.contains('dark');
            applyDarkMode(!isCurrentlyDark);
        });
        
        // Auto-resize textarea untuk komentar
        const textarea = document.querySelector('.komen');
        textarea.addEventListener('input', function() {
            this.style.height = '40px'; 
            this.style.height = (this.scrollHeight) + 'px';
        });
    </script>
</body>
</html>