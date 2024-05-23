<p>
    This is your NRPAS email comfirmation.
</p>
<p>
    Please, click on the link below to activate your account:
</p>
<p>
    <a href="{{ route('register.confirmation', $tempuser->confirm_code) }}">
        {{ route('register.confirmation', $tempuser->confirm_code) }}
    </a>
</p>
<p>
    Warm regards,<br>
    NRPAS
</p>