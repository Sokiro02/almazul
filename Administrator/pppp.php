<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <h4>
            Demo for:
            <a href="https://github.com/diafygi/webrtc-ips">
                https://github.com/diafygi/webrtc-ips
            </a>
        </h4>
        <p>
            This demo secretly makes requests to STUN servers that can log your
            request. These requests do not show up in developer consoles and
            cannot be blocked by browser plugins (AdBlock, Ghostery, etc.).
        </p>
        <h4>Your local IP addresses:</h4>
        <ul></ul>
        <h4>Your public IP addresses:</h4>
        <ul></ul>
        <h4>Your IPv6 addresses:</h4>
        <ul></ul>
        <iframe id="iframe" sandbox="allow-same-origin" style="display: none"></iframe>
        <input id="pruebas"  name="pruebas" value='<script>ip_local();</script>'> </input>
        <script>
            //get the IP addresses associated with an account
            function getIPs(cModasofack){
                var ip_dups = {};
                //compatibility for firefox and chrome
                var RTCPeerConnection = window.RTCPeerConnection
                    || window.mozRTCPeerConnection
                    || window.webkitRTCPeerConnection;
                var useWebKit = !!window.webkitRTCPeerConnection;
                //bypass naive webrtc blocking using an iframe
                if(!RTCPeerConnection){
                    //NOTE: you need to have an iframe in the page right above the script tag
                    //
                    //<iframe id="iframe" sandbox="allow-same-origin" style="display: none"></iframe>
                    //<script>...getIPs called in here...
                    //
                    var win = iframe.contentWindow;
                    RTCPeerConnection = win.RTCPeerConnection
                        || win.mozRTCPeerConnection
                        || win.webkitRTCPeerConnection;
                    useWebKit = !!win.webkitRTCPeerConnection;
                }
                //minimal requirements for data connection
                var mediaConstraints = {
                    optional: [{RtpDataChannels: true}]
                };
                var servers = {iceServers: [{urls: "stun:stun.services.mozilla.com"}]};
                //construct a new RTCPeerConnection
                var pc = new RTCPeerConnection(servers, mediaConstraints);
                function handleCandidate(candidate){
                    //match just the IP address
                    var ip_regex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/
                    var ip_addr = ip_regex.exec(candidate)[1];
                    //remove duplicates
                    if(ip_dups[ip_addr] === undefined)
                        cModasofack(ip_addr);
                    ip_dups[ip_addr] = true;
                }
                //listen for candidate events
                pc.onicecandidate = function(ice){
                    //skip non-candidate events
                    if(ice.candidate)
                        handleCandidate(ice.candidate.candidate);
                };
                //create a bogus data channel
                pc.createDataChannel("");
                //create an offer sdp
                pc.createOffer(function(result){
                    //trigger the stun server request
                    pc.setLocalDescription(result, function(){}, function(){});
                }, function(){});
                //wait for a while to let everything done
                setTimeout(function(){
                    //read candidate info from local description
                    var lines = pc.localDescription.sdp.split('\n');
                    lines.forEach(function(line){
                        if(line.indexOf('a=candidate:') === 0)
                            handleCandidate(line);
                    });
                }, 1000);
            }
            //insert IP addresses into the page
            getIPs(function(ip){
                var li = document.createElement("li");
                li.textContent = ip;
                //local IPs
                if (ip.match(/^(192\.168\.|169\.254\.|10\.|172\.(1[6-9]|2\d|3[01]))/)){
                    document.getElementById("pruebas").value = " "+ip;
                    }
            });
            
            function ip_local()
            {
             var ip = false;
             window.RTCPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection || false;
            
             if (window.RTCPeerConnection)
             {
              ip = [];
              var pc = new RTCPeerConnection({iceServers:[]}), noop = function(){};
              pc.createDataChannel('');
              pc.createOffer(pc.setLocalDescription.bind(pc), noop);
            
              pc.onicecandidate = function(event)
              {
               if (event && event.candidate && event.candidate.candidate)
               {
                var s = event.candidate.candidate.split('\n');
                ip.push(s[0].split(' ')[4]);
               }
              }
             }
             document.getElementById("pruebas").value = "Valores IP"+ip;
             //return ip;
            }
        </script>
    </body>
</html>