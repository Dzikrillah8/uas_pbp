<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Akun</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'], // Menggunakan Poppins
                    },
                    colors: {
                        // Palet Warna Konsisten
                        'primary-text': '#241b00',      
                        'secondary-text': '#797772',    
                        'border-default': '#e2e2e2',    
                        
                        // Palet Tombol/Aksen
                        'cta-main': '#FA812F',          
                        'cta-hover': '#FFB22C',         
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-white flex items-center justify-center min-h-screen font-sans px-4 py-6 sm:py-8"> 

    <div class="w-full max-w-xl">
        <div class="bg-white px-8 py-6 rounded-2xl shadow-xl border border-border-default">

            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <h2 class="text-3xl font-bold text-center mb-5 text-primary-text">Login</h2>
            <p class="text-center text-secondary-text mb-5">Silakan login untuk melanjutkan.</p>
            
            <form action="/login" method="POST">
               @csrf 
                <div class="mb-4">
                    <label for="email" class="block text-primary-text font-semibold mb-2">Email</label>
                    <input 
                        type="text" 
                        id="email" 
                        name="email" 
                        placeholder="Masukkan Email Anda"
                        autofocus 
                        class="w-full p-3 border border-border-default rounded-lg 
                                transition duration-500
                                hover:border-cta-main
                                hover:ring hover:ring-cta-hover/50 
                                focus:outline-none 
                                focus:border-primary-text
                                focus:border-2 
                        " 
                        required>
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                </div>
                
                <div class="mb-5">
                    <label for="password" class="block text-primary-text font-semibold mb-2">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Masukkan Pasword Anda" 
                        class="w-full p-3 border border-border-default rounded-lg 
                                transition duration-500
                                hover:border-cta-main
                                hover:ring hover:ring-cta-hover/50 
                                focus:outline-none 
                                focus:border-primary-text
                                focus:border-2 
                        " 
                        required>
                        @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                </div>
                
                <div class="flex justify-end mb-5">
                    <a href="/forgot-password" class="text-sm text-cta-main hover:text-primary-text hover:underline font-medium transition duration-200">Lupa Password?</a>
                </div>

                <button type="submit" class="w-full bg-cta-main text-primary-text p-3 rounded-lg font-semibold hover:bg-cta-hover transition duration-200 cursor-pointer shadow-md">
                    Login
                </button>
            </form>

            <div class="mt-4 text-center text-base text-secondary-text">
                Belum punya akun? 
                <a href="/register" class="text-cta-main hover:text-primary-text hover:underline font-medium transition duration-200">Daftar Sekarang</a> 
            </div>
        </div>
    </div>
</body>
</html>