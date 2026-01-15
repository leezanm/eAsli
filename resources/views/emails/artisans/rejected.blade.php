@php(/** @var \App\Models\Artisan $artisan */ null)
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Artisan Registration Not Approved</title>
</head>
<body style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background-color:#f5f5f4; padding:24px;">
    <table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px; margin:0 auto; background:white; border-radius:12px; overflow:hidden; border:1px solid #e5e5e5;">
        <tr>
            <td style="background:#7c2d12; color:white; padding:20px 24px;">
                <h1 style="margin:0; font-size:22px;">Artisan registration not approved</h1>
            </td>
        </tr>
        <tr>
            <td style="padding:24px; color:#1f2933; font-size:14px; line-height:1.6;">
                <p>Hi {{ $artisan->name }},</p>
                <p>Thank you for your interest in becoming an artisan on the eAsli marketplace.</p>
                <p>After reviewing your registration, we are not able to approve your account at this time. Your artisan account is currently set to <strong>inactive</strong> and you will not be able to log in.</p>
                <p style="margin-top:16px;">If you believe this is a mistake or would like to provide more information, please contact the eAsli administrator.</p>
                <p style="margin-top:16px;">Thank you for your understanding,<br>eAsli Team</p>
            </td>
        </tr>
    </table>
</body>
</html>
