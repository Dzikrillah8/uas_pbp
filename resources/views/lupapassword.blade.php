<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
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
<body class="bg-white flex items-center justify-center min-h-screen font-sans px-4 py-6 sm:py-8">
    
    <div class="w-full max-w-xl">
        <div class="bg-white px-8 py-6 rounded-2xl shadow-xl border border-border-default">
            
            <h2 class="text-3xl font-bold text-center mb-5 text-primary-text">Lupa Password</h2>
            
            <p class="text-center text-secondary-text mb-6">Masukkan email Anda untuk mereset password.</p>
            
            <form id="forgotPasswordForm" action="lupapassword" method="POST">
                <div class="mb-6">
                    <label for="email" class="block text-primary-text font-semibold mb-2">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="contoh@gmail.com" 
                        class="w-full p-3 border border-border-default rounded-lg transition duration-500 hover:border-cta-main hover:ring hover:ring-cta-hover/50 focus:outline-none focus:shadow-none focus:border-primary-text focus:border-2" 
                        required>
                </div>
                
                <button type="submit" class="w-full bg-cta-main text-primary-text p-3 rounded-lg font-semibold hover:bg-cta-hover transition duration-200 cursor-pointer shadow-md">
                    Kirim Link Reset
                </button>
            </form>

            <div class="mt-4 text-center text-base text-secondary-text">
                Kembali ke login? 
                <a href="/login" class="text-cta-main hover:text-primary-text hover:underline font-medium transition duration-200">Login</a> 
            </div>
            
        </div>
    </div>

    <script>
        // sweet alert
        const form = document.getElementById('forgotPasswordForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // cegah reload

            const email = document.getElementById('email').value;

            if (!email) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Email tidak boleh kosong!',
                    width: '350px',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'bg-cta-main text-white px-5 py-2 rounded-lg hover:bg-cta-hover'
                    }
                });
                return;
            }

            // Simulasi sukses pengiriman link 
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Link reset password telah dikirim ke email Anda.',
                width: '350px',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'bg-cta-main text-white px-5 py-2 rounded-lg hover:bg-cta-hover'
                }
            }).then(() => {
                form.submit();
            });
        });
    </script>
</body>
</html>
