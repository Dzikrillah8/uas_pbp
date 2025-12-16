<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css"> 

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'primary-text': '#241b00',      
                        'secondary-text': '#797772',    
                        'border-default': '#e2e2e2',    
                        'cta-main': '#FA812F',          
                        'cta-hover': '#FFB22C',         
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-white flex items-center justify-center font-sans **p-4** min-h-screen"> 
    <div class="w-full max-w-xl **my-auto shrink-0**">
        <br> 
        <div class="bg-white px-8 py-6 rounded-2xl shadow-xl border border-border-default"> 
            <h2 class="text-3xl font-extrabold text-center mb-5 text-primary-text">Profil Saya</h2>
            <div class="flex flex-col items-center mb-5 border-b pb-5 border-border-default">
                <form action="{{ route('profile.addPhoto') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="relative w-32 h-32 mb-3">
                @if($user->pic)
                    <img id="profilePreview" 
                    src="{{ $user->pic ? asset('storage/' . $user->pic->pic_path) : asset('images/default.png') }}" 
                    alt="Foto Profil" 
                    class="w-32 h-32 rounded-full object-cover border border-border-default shadow-sm transition-all duration-200">
                @else
                    <img id="profilePreview" src="" alt="Foto Profil" 
                        class="w-32 h-32 rounded-full object-cover hidden border border-border-default shadow-sm transition-all duration-200">
                    <div id="noPhoto" class="w-32 h-32 bg-border-default rounded-full flex items-center justify-center text-secondary-text">
                        Tidak ada foto
                    </div>
                @endif
                <input type="file" name="pic_path" id="photoUpload" accept="image/*" class="hidden">
                    <button type="button" id="photoButton" onclick="document.getElementById('photoUpload').click()" 
                        class="absolute bottom-0 right-0 bg-cta-main p-2 rounded-full text-white hover:bg-cta-hover transition duration-200 shadow-lg border border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.218A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.218A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </button>
                </div>
                </form>
                <h3 class="text-2xl font-bold text-primary-text">{{ $user->name }}</h3>
                <p class="text-secondary-text text-base">@<span></span>{{ $user->username }}</p>
            </div>

            <div class="space-y-3 mb-6"> 
                
                <div class="**py-1** border-b border-border-default">
                    <span class="text-secondary-text text-base font-semibold flex items-center mb-1">
                        <svg class="w-5 h-5 mr-2 text-cta-main" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Email:
                    </span>
                    <span class="text-primary-text font-medium ml-7 block text-base">{{ $user->email }}</span>
                </div>

                <div class="**py-1** border-b border-border-default">
                    <span class="text-secondary-text text-base font-semibold flex items-center mb-1">
                        <svg class="w-5 h-5 mr-2 text-cta-main" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h.01M19 19H5a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2z"></path></svg>
                        Bergabung Sejak:
                    </span>
                    <span class="text-primary-text ml-7 block text-base">{{ $user->created_at->translatedFormat('d M Y') }}</span>
                </div>

                <div class="pt-3">
                    <span class="block text-primary-text font-bold mb-2 text-base">Tentang Saya:</span>
                    <p class="text-secondary-text p-3 rounded-lg border border-border-default text-base italic bg-border-default">
                        {{ $user->bio }}
                    </p>
                </div>
            </div>

            <div class="space-y-3">
                <a href="/myprofile/edit" class="w-full bg-cta-main text-primary-text p-3 rounded-lg font-semibold hover:bg-cta-hover transition duration-200 flex items-center justify-center shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit Profil
                </a>
                
                <button type="button" onclick="window.location.href='login.html'" class="w-full bg-border-default text-primary-text p-3 rounded-lg font-semibold hover:bg-secondary-text hover:text-white transition duration-200 flex items-center justify-center border border-border-default">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </div>
        </div>
        <br>    
    </div>

    <script>
        const photoInput = document.getElementById('photoUpload');
        const profilePreview = document.getElementById('profilePreview');
        const noPhotoDiv = document.getElementById('noPhoto');
        const photoButton = document.getElementById('photoButton');
        const form = photoButton.closest('form');

        photoInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
            if(file) {
                // Preview foto
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePreview.src = e.target.result;
                    profilePreview.classList.remove('hidden');
                    if(noPhotoDiv) noPhotoDiv.classList.add('hidden');
                }
                reader.readAsDataURL(file);

                // Ubah tombol menjadi "Save"
                photoButton.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 21v-8H7v8"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 3v5h8V3H7z"/>
                    </svg>
                `;
                photoButton.onclick = function() { form.submit(); }; // klik langsung submit
            }
        });
    </script>
</body>
</html>