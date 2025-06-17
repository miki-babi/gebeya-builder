<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Telegram Mini App</title>
  <script src="https://telegram.org/js/telegram-web-app.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <h2>Welcome to Gebeya Mini App</h2>
  <div id="status">Loading...</div>

  <script>
    window.addEventListener("load", () => {
      const tg = window.Telegram.WebApp;
      tg.expand();

      const startParam = tg.initDataUnsafe?.start_param || "none";
      const user = tg.initDataUnsafe?.user || {};

      document.getElementById("status").innerText = "Start Param: " + startParam;

      fetch("{{ route('telegram.startapp') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        body: JSON.stringify({
          start_param: startParam,
          user: user
        })
      })
      .then(res => res.json())
      .then(data => {
        alert("Backend response: " + JSON.stringify(data));
      })
      .catch(err => {
        alert("Failed to send data: " + err);
      });
    });
  </script>
</body>
</html>
