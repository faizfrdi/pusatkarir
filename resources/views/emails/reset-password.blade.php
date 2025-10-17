<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - Pusat Karier UIN Jakarta</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Poppins', sans-serif; background-color: #f5f5f9; padding: 40px; color: #333;">
    <div style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.08);">
        
        {{-- HEADER --}}
        @php
            $cid = $message->embed($logo);
        @endphp

        <div style="background-color: #34307A; padding: 24px; text-align: center;">
            <img src="{{ $cid }}" alt="Logo Pusat Karier" style="height: 55px;">
        </div>

        {{-- BODY --}}
        <div style="padding: 36px;">
            <h2 style="color: #34307A; font-weight: 700; margin-bottom: 12px;">
                Halo, {{ $name }}
            </h2>
            <p style="font-size: 15px; line-height: 1.7; margin-bottom: 20px;">
                Kami menerima permintaan untuk mengatur ulang kata sandi akun Anda di 
                <strong>Pusat Karier UIN Jakarta</strong>. 
                Silakan klik tombol di bawah ini untuk mengatur ulang kata sandi Anda.
            </p>

            <div style="text-align: center; margin: 36px 0;">
                <a href="{{ $url }}" 
                    style="background-color: #34307A; color: #fff; text-decoration: none; 
                    padding: 14px 32px; border-radius: 10px; font-weight: 600; 
                    transition: background-color 0.3s ease; display: inline-block;">
                    Reset Password Sekarang
                </a>
            </div>

            <p style="font-size: 14px; color: #555; line-height: 1.7;">
                Tautan ini hanya berlaku selama <strong>60 menit</strong>.
                Jika Anda tidak meminta reset kata sandi, abaikan email ini dan akun Anda akan tetap aman.
            </p>

            <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">

            <p style="font-size: 14px; color: #777;">
                Salam hangat,<br>
                <strong style="color: #34307A;">Pusat Karier UIN Jakarta</strong><br>
                <a href="https://uinjkt.ac.id" style="color: #34307A; text-decoration: none;">uinjkt.ac.id</a>
            </p>
        </div>

        {{-- FOOTER --}}
        <div style="background-color: #f3f3f6; text-align: center; padding: 18px; font-size: 13px; color: #777;">
            © {{ date('Y') }} Pusat Karier UIN Jakarta. All rights reserved.
        </div>
    </div>
</body>
</html>