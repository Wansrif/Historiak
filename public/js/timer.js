function startTimer(duration, display) {
  var timer = duration, minutes, seconds;

  setInterval(function () {
    minutes = parseInt(timer / 60, 10)
    seconds = parseInt(timer % 60, 10);

    if (minutes === 0 && seconds === 0) {
      document.querySelector('form').submit()
    }

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    display.textContent = minutes + " " + " " + seconds;

    if (--timer < 0) {
      timer = duration;
    }

    // console.log(parseInt(seconds))
    sessionStorage.setItem("seconds", seconds)
    sessionStorage.setItem("minutes", minutes)
  }, 1000);
}

window.onload = function () {
  sec = parseInt(sessionStorage.getItem("seconds"))
  min = parseInt(sessionStorage.getItem("minutes"))

  if (parseInt(min * sec)) {
    var kuisTimes = (parseInt(min * 60) + sec);
  } else {
    var kuisTimes = 60 * 20;
  }

  display = document.querySelector('#timer');
  startTimer(kuisTimes, display);
}

function deleteSession() {
  sessionStorage.clear();
}