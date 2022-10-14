<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<!-- popper -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<!-- BS4 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!-- back to top -->
<script>
  var mybutton = document.getElementById("myBtn");
  var headerNav = document.getElementsByTagName('header');
  console.log(headerNav);
  window.onscroll = function() {
    scrollFunction()
  };

  function scrollFunction() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }

  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
</script>
<!-- <script>
  let __protocol = document.location.protocol;
  let __baseUrl = __protocol + '//livechat.fpt.ai/v35/src';

  let prefixNameLiveChat = 'ClickBuy';
  let objPreDefineLiveChat = {
      appCode: 'db2dec3b52085173c55fbc40ab6821ba',
      themes: '',
      appName: prefixNameLiveChat ? prefixNameLiveChat : 'Live support',
      thumb: '',
      icon_bot: ''
    },
    appCodeHash = window.location.hash.substr(1);
  if (appCodeHash.length == 32) {
    objPreDefineLiveChat.appCode = appCodeHash;
  }

  let fpt_ai_livechat_script = document.createElement('script');
  fpt_ai_livechat_script.id = 'fpt_ai_livechat_script';
  fpt_ai_livechat_script.src = __baseUrl + '/static/fptai-livechat.js';
  document.body.appendChild(fpt_ai_livechat_script);

  let fpt_ai_livechat_stylesheet = document.createElement('link');
  fpt_ai_livechat_stylesheet.id = 'fpt_ai_livechat_script';
  fpt_ai_livechat_stylesheet.rel = 'stylesheet';
  fpt_ai_livechat_stylesheet.href = __baseUrl + '/static/fptai-livechat.css';
  document.body.appendChild(fpt_ai_livechat_stylesheet);

  fpt_ai_livechat_script.onload = function() {
    fpt_ai_render_chatbox(objPreDefineLiveChat, __baseUrl, 'livechat.fpt.ai:443');
  }
</script> -->
<script>
  let __protocol = document.location.protocol;
  let __baseUrl = __protocol + '//livechat.fpt.ai/v35/src';

  let prefixNameLiveChat = 'ClickBuy 18t5';
  let objPreDefineLiveChat = {
      appCode: 'dc580c83bc544c90057385fb39f35406',
      themes: '',
      appName: prefixNameLiveChat ? prefixNameLiveChat : 'Live support',
      thumb: '',
      icon_bot: ''
    },
    appCodeHash = window.location.hash.substr(1);
  if (appCodeHash.length == 32) {
    objPreDefineLiveChat.appCode = appCodeHash;
  }

  let fpt_ai_livechat_script = document.createElement('script');
  fpt_ai_livechat_script.id = 'fpt_ai_livechat_script';
  fpt_ai_livechat_script.src = __baseUrl + '/static/fptai-livechat.js';
  document.body.appendChild(fpt_ai_livechat_script);

  let fpt_ai_livechat_stylesheet = document.createElement('link');
  fpt_ai_livechat_stylesheet.id = 'fpt_ai_livechat_script';
  fpt_ai_livechat_stylesheet.rel = 'stylesheet';
  fpt_ai_livechat_stylesheet.href = __baseUrl + '/static/fptai-livechat.css';
  document.body.appendChild(fpt_ai_livechat_stylesheet);

  fpt_ai_livechat_script.onload = function() {
    fpt_ai_render_chatbox(objPreDefineLiveChat, __baseUrl, 'livechat.fpt.ai:443');
  }
</script>
<!-- MAIN JS -->
<script src="./FE/js/validation.js"></script>
<script src="./FE/js/main.js"></script>