<script>
  function telegramApp() {
    return {
      status: 'Loading...',
      initialize() {
        const tg = window.Telegram.WebApp;
        tg.expand();

        const startParam = tg.initDataUnsafe.start_param;
        this.status = "Start Param: " + startParam;

        // Send to your Laravel backend using Fetch API
        fetch("{{ route('telegram.startapp') }}", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
          },
          body: JSON.stringify({
            start_param: startParam,
            user: tg.initDataUnsafe.user
          })
        })
        .then(response => response.json())
        .then(data => {
          alert("Backend response: " + JSON.stringify(data));
        })
        .catch(err => {
          alert("Failed to send data: " + err);
        });
      }
    };
  }
</script>
