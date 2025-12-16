<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Selamat Datang di PustakaRia</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <script>
        tailwind.config = {
            darkMode: 'class', 
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'], 
                    },
                    colors: {
                        // Palet Warna Konsisten
                        'primary-text': '#241b00',      
                        'secondary-text': '#797772',    
                        'border-default': '#e2e2e2',    
                        
                        // Palet Tombol/Aksen
                        'cta-main': '#FA812F',           // Orange / Aksen Utama
                        'cta-hover': '#FFB22C',          
                        'header-bg': '#ffffff',          
                        
                        // Palet Warna Dark Mode 
                        'dark-bg': '#121212',
                        'dark-card': '#1f1f1f',
                        'dark-text': '#f0f0f0',
                        'dark-secondary-text': '#b3b3b3',
                        'dark-border': '#333333',
                    },
                    boxShadow: {
                        'header-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.02)',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-white dark:bg-dark-bg font-sans min-h-screen transition-colors duration-300">
    
    <script>
        // Logika sederhana untuk membaca mode dan menerapkan kelas 'dark'
        // Membaca preferensi dari localStorage atau sistem
        const theme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (theme === 'dark' || (!theme && prefersDark)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        
        // Fungsi untuk mengganti mode (akan dipanggil nanti)
        function toggleDarkMode() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            // Memperbarui ikon
            updateDarkModeIcon(isDark);
        }

        // Fungsi untuk memperbarui ikon berdasarkan mode
        function updateDarkModeIcon(isDark) {
            const icon = document.getElementById('darkModeToggleIcon');
            if (icon) {
                if (isDark) {
                    icon.classList.remove('bi-moon');
                    icon.classList.add('bi-sun');
                } else {
                    icon.classList.remove('bi-sun');
                    icon.classList.add('bi-moon');
                }
            }
        }

        // Jalankan saat DOMContentLoaded atau segera
        document.addEventListener('DOMContentLoaded', () => {
            const currentIsDark = document.documentElement.classList.contains('dark');
            updateDarkModeIcon(currentIsDark);

            const toggleButton = document.getElementById('darkModeToggle');
            if (toggleButton) {
                toggleButton.addEventListener('click', toggleDarkMode);
            }
        });
    </script>

    <header class="sticky top-0 z-40 bg-header-bg dark:bg-dark-card w-full shadow-header-shadow flex items-center justify-between px-4 sm:px-8 py-3 border-b border-border-default dark:border-dark-border transition-colors duration-300">
      
      <a href="index.html" class="flex items-center space-x-2">
        <i class="bi bi-book-half text-2xl text-cta-main"></i>
        <span class="text-xl font-extrabold text-primary-text dark:text-dark-text transition-colors duration-300">PustakaRia</span>
      </a>

      <div class="flex items-center space-x-3">
        
        <button id="darkModeToggle" class="p-2 rounded-full text-primary-text dark:text-dark-text hover:bg-gray-100 dark:hover:bg-dark-border/50 transition duration-200" aria-label="Toggle Dark Mode">
            <i id="darkModeToggleIcon" class="bi text-xl"></i>
        </button>
        <a href="/login" class="px-4 py-2 text-sm font-semibold rounded-full border border-border-default dark:border-dark-border text-primary-text dark:text-dark-text hover:bg-gray-100 dark:hover:bg-dark-border transition duration-200">
          Masuk
        </a>
        
        <a href="/register" class="px-4 py-2 text-sm font-bold rounded-full bg-cta-main text-primary-text hover:bg-cta-hover transition duration-200 shadow-md">
          Daftar Gratis
        </a>
      </div>
    </header>

    <main class="container mx-auto px-4 sm:px-8 py-20 sm:py-32 flex flex-col items-center text-center">
        
        <i class="bi bi-feather text-6xl text-cta-main mb-6 animate-pulse"></i>

        <h1 class="text-4xl sm:text-6xl font-extrabold text-primary-text dark:text-dark-text leading-tight mb-4 transition-colors duration-300">
            Temukan Cerita <span class="text-cta-main">Tak Terbatas</span>
        </h1>
        
        <p class="text-lg sm:text-xl text-secondary-text dark:text-dark-secondary-text max-w-2xl mb-10 transition-colors duration-300">
            Baca ribuan kisah, novel, dan cerita pendek dari berbagai genre, atau mulai tulis kisahmu sendiri sekarang juga.
        </p>

        <div class="space-y-4 w-full max-w-sm">
            <a href="/register" class="w-full inline-block px-8 py-3 text-lg font-bold rounded-full bg-cta-main text-primary-text hover:bg-cta-hover transition duration-300 shadow-lg transform hover:scale-105">
                Mulai Menulis dan Membaca
            </a>

            <a href="/login" class="w-full inline-block text-md font-semibold text-secondary-text dark:text-dark-secondary-text hover:text-cta-main transition duration-200">
                Sudah punya akun? Masuk di sini.
            </a>
        </div>
        
    </main>

    <footer class="w-full py-6 text-center border-t border-border-default dark:border-dark-border/50 text-secondary-text dark:text-dark-secondary-text text-sm transition-colors duration-300">
        &copy; 2025 PustakaRia. Hak Cipta Dilindungi.
    </footer>
    
</body>
</html>