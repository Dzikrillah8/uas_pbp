<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    
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
                        'dark-button-bg': '#241b00',    
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-white flex items-center justify-center min-h-screen font-sans p-4 sm:p-8">

    <div class="w-full max-w-xl">
        <div class="bg-white p-8 rounded-2xl shadow-xl border border-border-default">
            <h2 class="text-3xl font-bold text-center mb-6 text-primary-text">Register</h2>
            <p class="text-center text-secondary-text mb-6">Daftar sekarang dan mulai tulis atau baca ceritamu.</p>
            
            <form action="register" method="POST">
                @csrf 
                <div class="mb-4">
                    <label for="name" class="block text-primary-text font-semibold mb-2">Nama</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        placeholder="Masukkan nama Anda" 
                        value="{{ old('name') }}"
                        class="w-full p-3 border border-border-default rounded-lg 
                                transition duration-300 
                                hover:border-cta-main 
                                hover:ring hover:ring-cta-hover/50
                                focus:outline-none 
                                focus:border-primary-text
                                focus:border-2 
                        " 
                        required>
                </div>

                <div class="mb-4">
                    <label for="name" class="block text-primary-text font-semibold mb-2">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        placeholder="Masukkan username Anda"
                        value="{{ old('username') }}" 
                        class="w-full p-3 border border-border-default rounded-lg 
                                transition duration-300 
                                hover:border-cta-main 
                                hover:ring hover:ring-cta-hover/50
                                focus:outline-none 
                                focus:border-primary-text
                                focus:border-2 
                        " 
                        required>
                </div>
                
                <div class="mb-4">
                    <label for="email" class="block text-primary-text font-semibold mb-2">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="contoh@email.com"
                        value="{{ old('email') }}" 
                        class="w-full p-3 border border-border-default rounded-lg 
                                transition duration-300
                                hover:border-cta-main
                                hover:ring hover:ring-cta-hover/50
                                focus:outline-none 
                                focus:border-primary-text
                                focus:border-2 
                        " 
                        required>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="block text-primary-text font-semibold mb-2">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Minimal 8 karakter"
                        value="{{ old('password') }}" 
                        class="w-full p-3 border border-border-default rounded-lg 
                                transition duration-300
                                hover:border-cta-main
                                hover:ring hover:ring-cta-hover/50
                                focus:outline-none 
                                focus:border-primary-text
                                focus:border-2 
                        " 
                        required>
                </div>
                
                <button type="submit" class="w-full bg-cta-main text-primary-text p-3 rounded-lg font-bold hover:bg-cta-hover transition duration-200 cursor-pointer shadow-md hover:shadow-lg">
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-4 text-center text-base text-secondary-text">
                Sudah punya akun? 
                <a href="/login" class="text-cta-main hover:text-primary-text hover:underline font-medium transition duration-200">Login</a>
            </div>
        </div>
    </div>
</body>
</html>