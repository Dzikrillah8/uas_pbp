<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - CeritaQu</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'], // Gunakan Inter
                    },
                    colors: {
                        // Palet Warna Konsisten
                        'primary-text': '#241b00',      
                        'secondary-text': '#797772',    
                        'border-default': '#e2e2e2',    
                        
                        // Palet Tombol/Aksen
                        'cta-main': '#FA812F',          // Oranye Gelap
                        'cta-hover': '#FFB22C',         // Oranye Kuning Terang
                        // Warna Hijau untuk 'Simpan' diubah ke CTA utama (Oranye)
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-white flex items-center justify-center min-h-screen font-sans p-8"> 

    <div class="w-full max-w-xl"> 
        <div class="bg-white p-8 rounded-2xl shadow-xl border border-border-default">
            
            <h2 class="text-3xl font-extrabold text-center mb-2 text-primary-text">Edit Profil</h2>
            <p class="text-center text-secondary-text mb-6">Perbarui informasi akun Anda di sini.</p>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-6 flex flex-col items-center">
                <label for="pic_path" class="block text-primary-text font-semibold mb-2">Foto Profil</label>
                    <div class="relative">
                        @if($user->pic)
                            <img id="profilePreview" src="{{ asset('storage/' . $user->pic->pic_path) }}" 
                                alt="Foto Profil" class="w-24 h-24 rounded-full object-cover border border-border-default shadow-sm mb-2">
                        @else
                            <img id="profilePreview" src="" alt="Foto Profil" 
                                class="w-24 h-24 rounded-full object-cover border border-border-default shadow-sm mb-2 hidden">
                            <div id="noPhoto" class="w-24 h-24 bg-border-default rounded-full flex items-center justify-center text-secondary-text mb-2">
                                Tidak ada foto
                            </div>
                        @endif
                        <input 
                            type="file" 
                            id="photoUpload" 
                            name="pic_path" 
                            accept="image/*" 
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer rounded-full"
                        >
                        <button type="button" id="photoButton" onclick="document.getElementById('photoUpload').click()" 
                        class="absolute bottom-0 right-0 bg-cta-main p-2 rounded-full text-white hover:bg-cta-hover transition duration-200 shadow-lg border border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.218A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.218A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </button>
                    </div>
                    @error('pic_path')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="name" class="block text-primary-text font-semibold mb-2">Nama</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        placeholder="Masukkan nama Anda" 
                        value="{{ old('name', $user->name) }}"
                        class="w-full p-3 border border-border-default rounded-lg 
                                transition duration-300 
                                hover:border-cta-main 
                                hover:ring hover:ring-cta-hover/50
                                focus:outline-none 
                                focus:border-primary-text
                                focus:border-2 
                        " >
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                </div>

                <div class="mb-4">
                    <label for="username" class="block text-primary-text font-semibold mb-2">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        placeholder="Masukkan username Anda" 
                        value="{{ old('username', $user->username) }}"
                        class="w-full p-3 border border-border-default rounded-lg 
                                transition duration-300 
                                hover:border-cta-main 
                                hover:ring hover:ring-cta-hover/50
                                focus:outline-none 
                                focus:border-primary-text
                                focus:border-2 
                        " >
                        @error('username')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                </div>
                
                <div class="mb-6">
                    <label for="bio" class="block text-primary-text font-semibold mb-2">Tentang Saya</label>
                    <textarea 
                        id="bio" 
                        name="bio" 
                        rows="4" 
                        placeholder="Tulis sedikit tentang diri Anda..." 
                        class="w-full p-3 border border-border-default rounded-lg 
                                transition duration-300 resize-none
                                hover:border-cta-main
                                hover:ring hover:ring-cta-hover/50
                                focus:outline-none 
                                focus:border-primary-text
                                focus:border-2 
                        ">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                </div>
                            
                <button type="submit" class="w-full bg-cta-main text-primary-text p-3 rounded-lg font-bold hover:bg-cta-hover transition duration-200 cursor-pointer shadow-md flex items-center justify-center">
                     Simpan Perubahan
                </button>
            </form>

            <div class="mt-4 text-center text-sm">
                <a href="/myprofile" class="text-cta-main hover:text-primary-text font-medium hover:underline transition duration-200">
                    Batalkan dan Kembali ke Profil
                </a>
            </div>
            
        </div>
    </div>

    <script>
        const photoInput = document.getElementById('photoUpload');
        const profilePreview = document.getElementById('profilePreview');
        const noPhotoDiv = document.getElementById('noPhoto');

        photoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePreview.src = e.target.result;
                    profilePreview.classList.remove('hidden');
                    if(noPhotoDiv) noPhotoDiv.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>