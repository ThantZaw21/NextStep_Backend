```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - NextStep</title>
</head>

<body style="margin:0; padding:0; background-color:#F4F6FA; font-family:Arial, Helvetica, sans-serif; color:#0B1F3A;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0"
           style="background-color:#F4F6FA; padding:40px 15px;">
        <tr>
            <td align="center">

                <!-- Main Container -->
                <table width="100%" cellpadding="0" cellspacing="0" border="0"
                       style="max-width:560px; background-color:#FFFFFF;">

                    <!-- Brand Header -->
                    <tr>
                        <td style="padding:32px 40px 25px; border-bottom:1px solid #E9EDF3;">

                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td valign="middle">
                                        <div style="width:36px; height:36px; background-color:#0B1F3A; text-align:center; line-height:36px;">
                                            <span style="font-size:18px; font-weight:bold; color:#F97316;">
                                                N
                                            </span>
                                        </div>
                                    </td>

                                    <td valign="middle" style="padding-left:12px;">
                                        <span style="font-size:19px; font-weight:bold; letter-spacing:-0.5px; color:#0B1F3A;">
                                            NextStep
                                        </span>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Main Content -->
                    <tr>
                        <td style="padding:40px 40px 35px;">

                            <!-- Label -->
                            <p style="margin:0 0 16px; font-size:11px; font-weight:bold; letter-spacing:2px; text-transform:uppercase; color:#F97316;">
                                EMAIL VERIFICATION
                            </p>

                            <!-- Heading -->
                            <h1 style="margin:0; font-size:30px; line-height:1.3; font-weight:bold; letter-spacing:-1px; color:#0B1F3A;">
                                Welcome to<br>your next step.
                            </h1>

                            <!-- Description -->
                            <p style="margin:20px 0 0; font-size:14px; line-height:1.8; color:#64748B;">
                                Thank you for joining NextStep. We're excited to help you
                                discover opportunities and build your future.
                            </p>

                            <p style="margin:15px 0 0; font-size:14px; line-height:1.8; color:#64748B;">
                                To complete your registration, enter the verification
                                code below.
                            </p>

                            <!-- OTP Section -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                   style="margin-top:30px;">
                                <tr>
                                    <td align="center"
                                        style="background-color:#F4F6FA; border:1px solid #E2E8F0; padding:28px 15px;">

                                        <p style="margin:0 0 14px; font-size:10px; font-weight:bold; letter-spacing:2px; text-transform:uppercase; color:#64748B;">
                                            YOUR VERIFICATION CODE
                                        </p>

                                        <h1 style="margin:0; font-size:36px; line-height:1.4; letter-spacing:10px; font-weight:bold; color:#0B1F3A;">
                                            {{ $otp }}
                                        </h1>

                                        <p style="margin:14px 0 0; font-size:12px; color:#64748B;">
                                            Enter this code on the verification page.
                                        </p>

                                    </td>
                                </tr>
                            </table>

                            <!-- Expiry Notice -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                   style="margin-top:24px;">
                                <tr>
                                    <td valign="top" width="30">
                                        <div style="width:24px; height:24px; background-color:#FFF1E8; text-align:center; line-height:24px;">
                                            <span style="font-size:13px; color:#F97316;">
                                                !
                                            </span>
                                        </div>
                                    </td>

                                    <td style="padding-left:10px;">
                                        <p style="margin:0; font-size:12px; line-height:1.7; color:#64748B;">
                                            <strong style="color:#0B1F3A;">Expires in 5 minutes.</strong>
                                            For your security, this verification code can only be used within this time.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Security -->
                            <p style="margin:28px 0 0; font-size:12px; line-height:1.8; color:#94A3B8;">
                                If you didn't create a NextStep account, you can safely
                                ignore this email. Please don't share your verification
                                code with anyone.
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#0B1F3A; padding:25px 40px;">

                            <p style="margin:0; font-size:13px; font-weight:bold; color:#FFFFFF;">
                                Your future starts here.
                            </p>

                            <p style="margin:8px 0 0; font-size:11px; line-height:1.7; color:#A9BBD0;">
                                Connecting talent, opportunities and ambition.
                            </p>

                            <div style="margin-top:20px; border-top:1px solid rgba(255,255,255,0.15); padding-top:16px;">

                                <p style="margin:0; font-size:10px; line-height:1.7; color:#8FA3BD;">
                                    &copy; {{ date('Y') }} NextStep. All rights reserved.
                                </p>

                            </div>

                        </td>
                    </tr>

                </table>

                <!-- Bottom Text -->
                <table width="100%" cellpadding="0" cellspacing="0" border="0"
                       style="max-width:560px;">
                    <tr>
                        <td align="center" style="padding:20px 10px;">
                            <p style="margin:0; font-size:10px; line-height:1.7; color:#94A3B8;">
                                This is an automated email from NextStep.
                                Please do not reply to this message.
                            </p>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>
</html>
```