function dbinstall() {
    window.location.replace(
        "installdb.php"
    );
}

function updateClock() {
    var clockElement = document.getElementById('fullclock');
    var now = new Date();
  
    var day = now.getDate();
    var month = now.getMonth() + 1; // Mese inizia da 0
    var year = now.getFullYear();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
  
    // Aggiunge lo zero iniziale se necessario
    day = addLeadingZero(day);
    month = addLeadingZero(month);
    hours = addLeadingZero(hours);
    minutes = addLeadingZero(minutes);
    seconds = addLeadingZero(seconds);
  
    var clockText = day + '/' + month + '/' + year + ' - ' + hours + ':' + minutes + ':' + seconds;
    clockElement.textContent = clockText;
  }
  
  function addLeadingZero(number) {
    return (number < 10) ? '0' + number : number;
  }
  
  // Aggiorna l'orologio ogni secondo
  setInterval(updateClock, 1000);
  