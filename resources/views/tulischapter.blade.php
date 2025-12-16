<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menulis - Cerita</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- trix editor -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
   
    <!-- trix editor custom css -->
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display:none;
        }
    </style>

    <script>
        tailwind.config = {
            darkMode: 'class', 
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'], 
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
                        'dark-gray-bg': '#1e1e1e', // Untuk body di dark mode
                        'dark-editor-bg': '#1f1f1f' // Untuk area menulis di dark mode
                    },
                    boxShadow: {
                         'default-shadow': '0 0 15px rgba(0,0,0,0.15)',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 dark:bg-dark-gray-bg font-sans min-h-screen transition-colors duration-300">
    
    <script>
        // Logika Tema Gelap (Dark Mode)
        if (localStorage.getItem('theme') === 'dark' || 
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <div>
        <div class="sticky top-0 z-40 bg-white dark:bg-dark-card flex justify-between items-center p-4 border-b border-border-default dark:border-dark-border shadow-sm transition-colors duration-300">
            <div class="flex items-center space-x-6 sm:space-x-10">
                <div>
                    <a href="/story/{{ $story->slug }}/lanjut" class="text-primary-text dark:text-dark-text text-xl hover:text-primary-color transition duration-200">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                </div>

                <div class="relative max-w-xs sm:max-w-sm" id="chapter-dropdown-container">
                    <button class="flex flex-col items-start p-1 border-none bg-transparent cursor-pointer relative" id="chapter-toggle">
                        <span class="judul-cerita text-xs sm:text-sm text-secondary-text dark:text-dark-secondary-text font-medium">{{ $story->title }}</span>
                        <span class="judul-bab text-base sm:text-lg font-bold text-primary-text dark:text-dark-text">Bab Tak Berjudul</span>
                    </button>

                    <div class="absolute hidden top-full left-0 mt-3 w-56 sm:w-64 bg-white dark:bg-dark-card border border-border-default dark:border-dark-border rounded-lg shadow-xl p-3 z-50" id="chapter-list">
                        <div class="flex justify-between items-center py-2 px-1 border-b border-border-default dark:border-dark-border/50 text-sm font-semibold text-primary-text dark:text-dark-text hover:bg-gray-50 dark:hover:bg-dark-border/50 rounded-md transition duration-150 cursor-pointer">
                            <span>Bab Tak Berjudul 1</span>
                        </div>
                        <div class="flex justify-between items-center py-2 px-1 border-b border-border-default dark:border-dark-border/50 text-sm font-semibold text-primary-text dark:text-dark-text hover:bg-gray-50 dark:hover:bg-dark-border/50 rounded-md transition duration-150 cursor-pointer">
                            <span>Bab Baru 2</span>
                        </div>
                        <button type="button" class="mt-3 w-full bg-primary-color border-none py-2 rounded-lg text-white font-bold text-sm transition duration-200 hover:bg-cta-hover">
                            <i class="bi bi-plus-lg mr-1"></i> Bab Baru
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex space-x-3"> 
                <div>
                    <button type="button" class="publik bg-primary-color text-white font-bold text-sm h-9 px-5 rounded-full transition duration-200 hover:bg-cta-hover"
                    onclick="publishChapter()">
                        Publikasikan
                    </button>
                </div>

                <div>
                    <button type="button" class="simpan bg-white dark:bg-dark-card text-primary-text dark:text-dark-text font-bold text-sm h-9 px-4 rounded-full border border-primary-color transition duration-200 hover:border-cta-hover hover:text-cta-hover dark:hover:text-cta-hover"
                    onclick="saveDraft()">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
        <!-- nulis -->
        <div class="flex justify-center my-8 sm:my-10 px-4 lg:px-10 xl:px-20">
          <form method="post" action="/stories/{{ $story->slug }}/chapters" id="chapterForm" enctype="multipart/form-data" class="w-full max-w-2xl">
          @csrf
          <input type="hidden" name="visibility" id="visibility" value="draft">
          <div class="bg-white dark:bg-dark-card p-5 sm:p-7 rounded-lg shadow-xl border border-border-default dark:border-dark-border/50 flex flex-col space-y-5">
            <div class="pb-3 border-b-2 border-border-default dark:border-dark-border">
                <h5 class="text-xl font-bold text-primary-text dark:text-dark-text">Tulis Bab</h5>
            </div>
            <div>
              <label for="chap_title" class="block text-sm font-medium text-primary-text dark:text-dark-text mb-1">Judul Bab</label>
              <input type="text" id="judul" name="chap_title" placeholder="Cerita Tak Berjudul" 
                class="w-full px-3 py-2 text-sm rounded-lg border border-border-default dark:border-dark-border/50 focus:ring-1 focus:ring-primary-color focus:border-primary-color dark:bg-dark-bg dark:text-dark-text dark:placeholder-dark-secondary-text transition duration-200"
                required value="{{ old('chap_title') }}" placeholder="Tambahkan Judul Bab">
                @error('chap_title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
              <label for="slug" class="block text-sm font-medium text-primary-text dark:text-dark-text mb-1">Slug</label>
              <input type="text" id="slug" name="slug" placeholder="Slug Otomatis" 
                class="w-full px-3 py-2 text-sm rounded-lg border border-border-default dark:border-dark-border/50 focus:ring-1 focus:ring-primary-color focus:border-primary-color dark:bg-dark-bg dark:text-dark-text dark:placeholder-dark-secondary-text transition duration-200"
                equired value="{{ old('slug') }}">
                @error('slug')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="content" class="block text-sm font-medium text-primary-text dark:text-dark-text mb-1">Isi Bab</label>
                @error('content')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                <!-- Trix Editor -->
                <trix-editor 
                    input="content"
                    class="trix-content border border-border-default dark:border-dark-border/50 rounded-lg p-3 bg-white dark:bg-dark-card text-primary-text dark:text-dark-text min-h-[180px] w-full
                        focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-primary-color transition-colors duration-200 overflow-y-auto"
                ></trix-editor>
            </div>
        </div>
    </form>
</div>
    </div>
    
    <script>
    document.addEventListener('trix-file-accept', function(e) { e.preventDefault(); });

    function previewImage() {
        const cover = document.querySelector('#cover');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const reader = new FileReader();
        reader.readAsDataURL(cover.files[0]);
        reader.onload = function(e) { imgPreview.src = e.target.result; }
    }

    const title = document.querySelector('#judul');
    const slug = document.querySelector('#slug');
    title.addEventListener('input', function() {
        fetch('/story/checkSlug?title=' + title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });
  </script>

  <script>
    function saveDraft() {
        document.getElementById('visibility').value = 'draft';
        document.getElementById('chapterForm').submit();
    }

    function publishChapter() {
        document.getElementById('visibility').value = 'public';
        document.getElementById('chapterForm').submit();
    }
    </script>
</body>
</html>