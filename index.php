<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<input type="text" id="username" placeholder="Username"><br>
<textarea id="message" rows="8" cols="80" placeholder="Message"></textarea><br>
<button onclick="send_chat()">Send</button>

<script type="text/javascript">


send_chat = function(){
  var username = $('#username').val();
  var message = $('#message').val();
  $('#message').val("");
  $.getJSON('api.php?username='+username+"&message="+message, function() {})
}


var dataout = 0;
setInterval(function() {

  $.getJSON( 'api.php', function( jsondata ) {


    if (jsondata.length != dataout) {
      for(index = dataout; index<jsondata.length; index++){
        var username = jsondata[index]["username"];
        var message = jsondata[index]["message"];
        console.log(message);
        $('#messages').append(
          '<hr>'+
          '<p><b>' + username + '</b></p>'+
          '<p>' + message + '</p>'
        );
        dataout++;
      }
    }

  })

},
500);
</script>

<div id="messages">

</div>
