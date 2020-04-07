<body style="background-color: gainsboro; padding: 50px 0px">
    <div style="margin: 0 auto; width: 60%">
        <h3>Hi, {{$username}}!</h3>
        <h3>Thanks for using MintColor!</h3>
        <p >
            Someone requested a password reset for your account. If this was not you, please disregard this email. If you'd like to continue click the link below.
            This link will expire in 30 minutes.
        </p> 
        <div style="width: 100%; background-color: blue">
            <button style="width: 20%; margin: 20px 40%; border-radius: 10px; background-color: red; padding: 5px"><a href="{{url($url)}}">Reset Your Mailgun Password</a></button>
        </div>
        <div><i>The MintColor!</i></div>
    </div>
</body>