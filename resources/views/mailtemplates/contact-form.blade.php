<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=no">
        <title></title>
    </head>
    <body style="margin: 0;background-color: rgba(0,0,0,0.1);">
        <div class="wrapper" style="padding: 2em;background-color: white;">
            <div class="l-logo">
                <img src="{{$message->embed(config("myparametersconfig.pathimg")."logo.png")}}" style=" width: 121px;height: 33.6px;">
            </div>
            <div class="line-header" style="border-bottom: 1px solid #e4250d;margin-top: 0.5em;"></div>
            <p style="margin-top: 2em;"><b>Name:</b> {{$data->Name}}</p>
            <p class="l-phone"><b>Phone:</b> {{$data->Phone}}</p>
            <p class=""><b>Email:</b> {{$data->Email}}</p>
            <p class="l-message" style="margin-top: 2em;"><b>Message:</b></p>
            <p class="l-message-text" style="text-align: justify;">{{$data->Message}}</p>
            <div class="line-header" style="border-bottom: 1px solid rgba(128,128,128,0.3);margin-top: 5em;"></div>
             <div style="margin-top: 1em;">
                <p style="margin-top:0;color:rgb(128, 128, 128);font-size: 0.8em">+44 (0)1244 35000000</p>
                <p style="color:rgb(128, 128, 128);font-size: 0.8em">+44 (0)1244 350311</p>
                <p style="color:rgb(128, 128, 128);font-size: 0.8em">info@passionforproperty.com</p>
            </div>
        </div>
    </body>
</html>