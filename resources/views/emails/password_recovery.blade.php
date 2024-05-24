<p>
    Hello,
</p>
<P>
    This is a password reset email requested on your NRPAS account. If you did not initiate this request, please ignore this email.
</P>
<p>
    Otherwise, click on the link below to change the password to your NRPAS account.
</p>
<p>
    <a href="{{ route('password.reset', $tempuser->confirm_code) }}">
        {{ route('password.reset', $tempuser->confirm_code) }}
    </a>
</p>
<p>
    Warm regards,<br>
    NRPAS
</p>