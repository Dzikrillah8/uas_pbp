<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password Baru - CeritaQu</title>
    
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
            
            <h2 class="text-3xl font-bold text-center mb-6 text-primary-text">Ganti Password</h2>
            <p class="text-center text-secondary-text mb-6">Masukkan password baru Anda di bawah ini.</p>
            
            <form id="resetPasswordForm" action="reset-password-action" method="POST">
                <div class="mb-4">
                    <label for="new_password" class="block text-primary-text font-semibold mb-2">Password Baru</label>
                    <input 
                        type="password" 
                        id="new_password" 
                        name="new_password" 
                        placeholder="Minimal 8 karakter" 
                        class="w-full p-3 border border-border-default rounded-lg transition duration-300 hover:border-cta-main hover:ring hover:ring-cta-hover/50 focus:outline-none focus:border-primary-text focus:border-2" 
                        required>
                </div>
                
                <div class="mb-6">
                    <label for="confirm_password" class="block text-primary-text font-semibold mb-2">Konfirmasi Password Baru</label>
                    <input 
                        type="password" 
                        id="confirm_password" 
                        name="confirm_password" 
                        placeholder="Ulangi password di atas" 
                        class="w-full p-3 border border-border-default rounded-lg transition duration-300 hover:border-cta-main hover:ring hover:ring-cta-hover/50 focus:outline-none focus:border-primary-text focus:border-2" 
                        required>
                </div>
                
                <button type="submit" class="w-full bg-cta-main text-primary-text p-3 rounded-lg font-bold hover:bg-cta-hover transition duration-200 cursor-pointer shadow-md hover:shadow-lg">
                    Simpan Password Baru
                </button>
            </form>

            <div class="mt-4 text-center text-base text-secondary-text">
                Kembali ke 
                <a href="login.html" class="text-cta-main hover:text-primary-text hover:underline font-medium transition duration-200">Halaman Login</a>
            </div>
        </div>
    </div>

    <script>
        // sweet alert
        const form = document.getElementById('resetPasswordForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if(newPassword !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password dan konfirmasi tidak sama!',
                    width: '350px',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'bg-cta-main text-white px-5 py-2 rounded-lg hover:bg-cta-hover'
                    }
                });
                return;
            }

            // Simulasi sukses
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Password Anda berhasil diganti.',
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
