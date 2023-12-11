<!DOCTYPE html>
<html>
<head>
    <title>{{ __('Change Password') }}</title>
</head>
<body>
    <h1>{{ __('Reset Password') }}</h1>
    <p>{{ __('You are receiving this email because we received a password reset request for your account') }}.</p>
    <p>{{ __('Click the following link to reset your password') }} :</p>
    <a href="{{ route('password.reset',$resetLink) }}">{{ __('Reset Password') }}</a>
    <p>{{ __('If you did not request a password reset, no further action is required') }} .</p>
</body>
</html>
