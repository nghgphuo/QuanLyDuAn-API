@component('mail::message')

    # Xin chào {{ $user->name }},

    Đây là tài khoản của bạn trên hệ thống

    **Email:** {{ $user->email }}
    **Mật khẩu:** {{ $password }}

    @component('mail::button', ['url' => $resetUrl])
    Thay đổi mật khẩu 
    @endcomponent

Cảm ơn bạn đã đồng hành cùng chúng tôi!  
Trân trọng,  
@endcomponent
