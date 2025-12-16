<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerita Saya - CeritaKu</title>

    <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            darkMode: 'class', 
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'], // Menggunakan Poppins
                    },
                    colors: {
                        // Palet Warna Utama (Oranye)
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
                    aspectRatio: {
                        '2/3': '2 / 3', 
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 dark:bg-dark-bg font-sans min-h-screen transition-colors duration-300">
    
    <script>
        // Logika Tema Gelap (Dark Mode)
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

    <div class="flex flex-col mx-auto px-4 sm:px-8 mt-6 sm:mt-8 pb-10 max-w-3xl">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h4 class="text-2xl sm:text-3xl font-bold text-primary-text dark:text-dark-text">Cerita Saya</h4>
            </div>
            <div>
                <a href="/story/create" class="flex items-center h-9 px-3 rounded-lg bg-primary-color text-white text-sm font-bold transition duration-200 hover:bg-cta-hover hover:scale-[1.03] space-x-1">
                    <i class="bi bi-plus text-xl"></i>
                    <span>Cerita Baru</span>
                </a>
            </div>
        </div>
        <div class="w-full shadow-lg rounded-xl bg-white dark:bg-dark-card border border-border-default dark:border-dark-border/50 p-4 sm:p-5"> 
          @if ($stories->isEmpty())
          <div class="row d-flex justify-content-center text-center">
              <div class="col-lg-8">
                  <div class="judul">
                      <h5 class="text-lg sm:text-xl font-bold text-primary-text dark:text-dark-text capitalize line-clamp-2">
                        Belum Ada Cerita Yang Dibuat</h5>
                  </div>
              </div>  
          </div>
          @else
          @foreach ($stories as $story)
            <div class="barisCerita flex items-start justify-between border-b border-border-default dark:border-dark-border/50 py-4 first:pt-0 last:pb-0 last:border-b-0">
                <div class="flex space-x-4 sm:space-x-8 flex-grow">
                    <div class="w-[80px] sm:w-[120px] flex-shrink-0">
                        <a href="/detail/{{ $story->slug }}" class="block w-full rounded-md overflow-hidden shadow-lg border-2 border-transparent transition-all duration-300 hover:border-primary-color dark:hover:border-primary-color focus:border-primary-color">
                        @if($story->cover)
                        <img src="{{ asset('storage/' . $story->cover) }}" class="w-full aspect-2/3 object-cover" alt="Cover Cerita">
                        @else
                        <img src="img/no_cover.jpeg" class="w-full aspect-2/3 object-cover" alt="Cover Cerita">
                        @endif    
                        </a>
                    </div>
                    <div class="flex flex-col justify-start pt-1 sm:pt-2">
                        <div class="mb-1">
                            <h5 class="text-lg sm:text-xl font-bold text-primary-text dark:text-dark-text capitalize line-clamp-2">{{ $story->title }}</h5>
                        </div>
                        <div class="flex items-center space-x-2 text-sm font-medium text-secondary-text dark:text-dark-secondary-text mt-1">
                            
                            <div class="bg-gray-400/70 dark:bg-dark-border/70 text-white px-2 py-0.5 rounded-md text-xs font-semibold">
                                {{ $story->public_chap_count }} bab terpublikasi
                            </div>

                            <div class="text-sm font-semibold text-secondary-text dark:text-dark-secondary-text">
                                {{ $story->draft_chap_count }} draft
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-1 sm:space-x-2 flex-shrink-0 ml-4">
                    <a href="/story/{{ $story->slug }}/lanjut" class="lanjutnulis bg-primary-color text-white font-bold text-sm h-9 px-3 sm:px-4 flex items-center justify-center rounded-lg transition duration-200 hover:bg-cta-hover hover:text-white">
                        <span class="hidden sm:inline">Lanjutkan Menulis</span>
                        <i class="bi bi-pencil-square sm:hidden text-lg"></i>
                    </a>
                    <form action="/story/{{ $story->slug }}" method="post" class="form-hapus">
                      @method('delete')
                      @csrf
                      <button type="submit" class="hapus bg-primary-color h-9 w-9 flex items-center justify-center rounded-lg transition duration-200 hover:bg-cta-hover hover:text-white text-white"
                      onclick="return confirm('Yakin ingin menghapus cerita?')">
                        <i class="fa-solid fa-trash text-sm"></i>
                    </button>
                    </form>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    
    <script>
        // dropdown profile
        const profileToggle = document.getElementById('profile-toggle');
        const dropdownMenu = document.getElementById('profile-menu');
        const html = document.documentElement; 
        const darkModeToggle = document.getElementById('darkModeToggle');

        profileToggle.addEventListener('click', function(e) {
            e.preventDefault(); 
            dropdownMenu.classList.toggle('hidden');
            dropdownMenu.classList.toggle('flex');
        });

        document.addEventListener('click', function(e) {
            if (!profileToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
                dropdownMenu.classList.remove('flex');
            }
        });
        
        // darkmode
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
    </script>

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('story_created'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Cerita berhasil dibuat',
            confirmButtonText: 'OK',
            width: '350px',
            customClass: {
                confirmButton: 'bg-primary-color text-white px-5 py-2 rounded-lg hover:bg-cta-hover'
            }
        });
    });
    </script>
    @endif

    @if (session('story_edited'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Cerita berhasil diedit',
            confirmButtonText: 'OK',
            width: '350px',
            customClass: {
                confirmButton: 'bg-primary-color text-white px-5 py-2 rounded-lg hover:bg-cta-hover'
            }
        });
    });
    </script>
    @endif

    @if (session('chap_created'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Bab baru berhasil dibuat',
            confirmButtonText: 'OK',
            width: '350px',
            customClass: {
                confirmButton: 'bg-primary-color text-white px-5 py-2 rounded-lg hover:bg-cta-hover'
            }
        });
    });
    </script>
    @endif

    @if (session('deleted'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'error',
            title: 'Dihapus!',
            text: 'Cerita berhasil dihapus',
            confirmButtonText: 'OK',
            width: '350px',
            customClass: {
                confirmButton: 'bg-primary-color text-white px-5 py-2 rounded-lg hover:bg-cta-hover'
            }
        });
    });
    </script>
    @endif

    @if (session('chap_deleted'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'error',
            title: 'Dihapus!',
            text: 'Bab berhasil dihapus',
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