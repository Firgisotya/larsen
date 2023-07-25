<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 0;">

    <table style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #f7f7f7; border-collapse: collapse;">
        <tr>
            <td style="padding: 20px;">
                <h2 style="margin-bottom: 30px;">Password Reset</h2>
                <p>Hello,</p>
                <p>You are receiving this email because we received a password reset request for your account.</p>
                <p>Please click the button below to reset your password:</p>
                <p style="text-align: center;">
                    <a href="{{ $data['link'] }}" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 4px;">Reset Password</a>
                </p>
                <p>If you didn't request a password reset, no further action is required.</p>
                <p>Regards,<br>Your Website Team</p>
            </td>
        </tr>
    </table>

</body>
</html>
