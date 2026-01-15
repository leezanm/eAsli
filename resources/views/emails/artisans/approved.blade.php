@php(/** @var \App\Models\Artisan $artisan */ null)
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Artisan Account Approved</title>
</head>
<body style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background-color:#f5f5f4; padding:24px;">
    <table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px; margin:0 auto; background:white; border-radius:12px; overflow:hidden; border:1px solid #e5e5e5;">
        <tr>
            <td style="background:#14532d; color:white; padding:20px 24px;">
                <h1 style="margin:0; font-size:22px;">Your artisan account is approved</h1>
            </td>
        </tr>
        <tr>
            <td style="padding:24px; color:#1f2933; font-size:14px; line-height:1.6;">
                <p>Hi {{ $artisan->name }},</p>
                <p>Your registration as an artisan on the eAsli marketplace has been <strong>approved</strong>.</p>
                <p>You can now sign in to your artisan account, create your shop, and start adding products under your shop.</p>
                <p style="margin-top:20px; text-align:center;">
                    <a href="{{ route('artisans.login') }}" style="display:inline-block; padding:10px 18px; background:#16a34a; color:white; text-decoration:none; border-radius:999px; font-weight:600;">Login to Artisan Portal</a>
                </p>
                <p style="margin-top:24px;">If you did not request this account, please ignore this email.</p>
                <p style="margin-top:16px;">Thank you,<br>eAsli Team</p>
            </td>
        </tr>
    </table>
</body>
</html>
