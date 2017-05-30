<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=no">
        <title></title>
    </head>
    <body style="background-color: rgba(0,0,0,0.1);overflow:hidden;">
        <div class="wrapper" style="background-color: white;width:80%;margin:3em auto;position:relative;">
            <div style="width:100%;height: 40px;background-color: #e4250d;"></div>
            <div style="padding:1em;">
                <div class="l-logo" style="overflow: hidden;">
                    <img src="{{$message->embed(config("myparametersconfig.pathimg")."logo.png")}}" style=" width: 121px;height: 33.6px;">
                </div>
                <div class="line-header" style="margin-top:1em;border-bottom: 1px solid #e4250d;"></div>
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
            <div style="width:100%;height:33.6px;background-color: rgba(0,0,0,0.1);">
            	<img src="{{$message->embed(config("myparametersconfig.pathimg")."shadow-bar.png")}}" style="width: 100%;">
            </div>
        </div>
    </body>
</html>