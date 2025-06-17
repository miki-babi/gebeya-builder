<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Telegram Mini App</title>
  <script src="https://telegram.org/js/telegram-web-app.js"></script>
</head>
<body>
  <h2>Welcome to Gebeya Mini App</h2>
  <div id="status">Loading...</div>

  <script>
    window.addEventListener("load", () => {
      const tg = window.Telegram.WebApp;
      tg.expand();

      const startParam = tg.initDataUnsafe.start_param;
      document.getElementById("status").innerText = "Start Param: " + startParam;

      // Send to your Laravel backend
      fetch("{{ route('telegram.startapp') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          // Optional: Add auth token or API key
        },
        body: JSON.stringify({
          start_param: startParam,
          user: tg.initDataUnsafe.user
        })
      })
      .then(res => res.json())
      .then(data => {
        console.log("Backend response:", data);
      })
      .catch(err => {
        console.error("Failed to send data", err);
      });
    });
  </script>
</body>
</html>
