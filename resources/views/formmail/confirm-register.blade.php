<body style="background-color: gainsboro">
    <div style="margin: 0 auto; width: 60%">
        <h3>Hi, {{$username}}!</h3>
        <h3>Thanks for using MintColor!</h3>
        <p >
            Please confirm your email address by clicking on the link below. 
            We'll communicate with you from time to time via email so it's important that we have an up-to-date email address on file.
        </p> 
        <div style="width: 100%; background-color: blue">
            <button style="width: 20%; margin: 20px 40%; border-radius: 10px; background-color: red; padding: 5px"><a href="{{url('cus/confirm').'/'.$token.'/'.$id}}">Confrim</a></button>
        </div>
        <p>    
            If you did not sign up for a MintColor account please disregard this email.
            
            Happy emailing!
        </p>
        <div><i>The MintColor!</i></div>
    </div>
</body>