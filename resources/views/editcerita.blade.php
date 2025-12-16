<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Cerita Baru</title>
    
    <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <!-- font -->
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
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
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
                    },
                }
            }
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

<header class="sticky top-0 z-40 bg-white dark:bg-dark-card w-full shadow-md px-4 py-3 border-b border-border-default dark:border-dark-border flex justify-between items-center transition-colors duration-300">
    <div class="flex items-center space-x-2 sm:space-x-4">
        <a href="/home" class="text-primary-text dark:text-dark-text hover:text-primary-color transition duration-200">
            <i class="bi bi-chevron-left text-2xl"></i>
        </a>
        <div class="text-primary-text dark:text-dark-text">
            <p class="text-sm sm:text-base leading-tight dark:text-dark-secondary-text">Tambahkan detail cerita</p>
            <p class="text-base sm:text-lg font-bold leading-tight">Cerita Tak Berjudul</p>
        </div>
    </div>

    <div class="flex items-center">
        <a href="/home" class="bg-primary-color text-white font-semibold text-sm h-9 w-24 flex items-center justify-center rounded-md transition duration-200 hover:bg-cta-hover">
            Batalkan
        </a>
    </div>
</header>

<div class="flex justify-center my-8 sm:my-10 px-4 lg:px-10 xl:px-20">
    <form method="post" action="/story/{{ $story->slug }}" enctype="multipart/form-data" class="w-full max-w-2xl">
        @method('put')
        @csrf
        <div class="bg-white dark:bg-dark-card p-5 sm:p-7 rounded-lg shadow-xl border border-border-default dark:border-dark-border/50 flex flex-col space-y-5">

            <div class="pb-3 border-b-2 border-border-default dark:border-dark-border">
                <h5 class="text-xl font-bold text-primary-text dark:text-dark-text">Detail cerita</h5>
            </div>

            <div>
                <label for="cover" class="block text-sm font-medium text-primary-text dark:text-dark-text mb-1">
                    Tambahkan sampul buku
                </label>
                <input type="hidden" name="oldCover"  value="{{ $story->cover }}">
                @if($story->cover)
                <img src="{{ $story->cover ? asset('storage/' . $story->cover) : '' }}" 
                class="img-preview mb-3 rounded-md max-w-[120px] max-h-[170px] object-cover overflow-hidden {{ $story->cover ? 'block' : 'hidden' }}">
                @else
                <img class="img-preview img-fluid mb-3" style="display:none; max-width:120px; max-height: 170px; overflow: hidden;">
                @endif
                <input type="file" id="cover" name="cover" onchange="previewImage()" 
                    class="block w-full text-sm text-primary-text dark:text-dark-text 
                        file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 
                        file:text-sm file:font-semibold file:bg-primary-color file:text-white 
                        hover:file:bg-cta-hover file:transition file:duration-200 
                        dark:file:bg-primary-color dark:file:text-white dark:file:hover:bg-cta-hover 
                        cursor-pointer border border-border-default dark:border-dark-border/50 
                        rounded-lg p-2 bg-gray-100 dark:bg-dark-border/50">

                @error('cover')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div>
                <label for="title" class="block text-sm font-medium text-primary-text dark:text-dark-text mb-1">Judul</label>
                <input type="text" id="judul" name="title" placeholder="Cerita Tak Berjudul" 
                    class="form-control @error('title') is-invalid @enderror w-full px-3 py-2 text-sm rounded-lg border border-border-default dark:border-dark-border/50 focus:ring-1 focus:ring-primary-color focus:border-primary-color dark:bg-dark-bg dark:text-dark-text dark:placeholder-dark-secondary-text transition duration-200"
                    required value="{{ old('title', $story->title) }}">
                    @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-primary-text dark:text-dark-text mb-1">Slug</label>
                <input type="text" id="slug" name="slug" placeholder="Slug Otomatis" 
                    class="form-control @error('slug') is-invalid @enderror w-full px-3 py-2 text-sm rounded-lg border border-border-default dark:border-dark-border/50 focus:ring-1 focus:ring-primary-color focus:border-primary-color dark:bg-dark-bg dark:text-dark-text dark:placeholder-dark-secondary-text transition duration-200"
                    required value="{{ old('slug', $story->title) }}">
                @error('slug')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="genre" class="block text-sm font-medium text-primary-text dark:text-dark-text mb-1">Genre</label>
                <select name="genre_id" class="w-full text-sm rounded-lg border border-border-default dark:border-dark-border/50 bg-white dark:bg-dark-bg text-primary-text dark:text-dark-text p-2 focus:ring-1 focus:ring-primary-color focus:border-primary-color transition duration-200">
                    @foreach ($genres as $genre)
                            @if(old('genre_id', $story->genre_id) == $genre->id)
                                <option value="{{ $genre->id }}" selected>{{ $genre->name }}</option>
                            @else
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endif
                        @endforeach
                </select>
            </div>

            <div>
                <label for="visibility" class="block text-sm font-medium text-primary-text dark:text-dark-text mb-1">Visibilitas</label>
                <select name="visibility" class="w-full text-sm rounded-lg border border-border-default dark:border-dark-border/50 bg-white dark:bg-dark-bg text-primary-text dark:text-dark-text p-2 focus:ring-1 focus:ring-primary-color focus:border-primary-color transition duration-200">
                    <option value="public" @selected(old('visibility', $story->visibility) === 'public')>Public</option>
                    <option value="draft"  @selected(old('visibility', $story->visibility) === 'draft')>Draft</option>
                </select>
            </div>

            <div>
            <label for="sinopsis" class="block text-sm font-medium text-primary-text dark:text-dark-text mb-1">Deskripsi</label>
            @error('sinopsis')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            <input id="sinopsis" type="hidden" name="sinopsis" value="{{ old('sinopsis', $story->sinopsis) }}">
            <!-- trix editor -->
            <trix-editor 
                input="sinopsis"
                class="trix-content border border-border-default dark:border-dark-border/50 rounded-lg p-3 bg-white dark:bg-dark-card text-primary-text dark:text-dark-text min-h-[180px] w-full
                    focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-primary-color transition-colors duration-200 overflow-y-auto">
            </trix-editor>
        </div>
            <div class="pt-2">
                <button type="submit" class="bg-primary-color text-white font-semibold text-base h-9 w-full max-w-[150px] rounded-md transition duration-200 hover:bg-cta-hover">
                    Ubah
                </button>
            </div>
        </div>
    </form>
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
</body>
</html>
