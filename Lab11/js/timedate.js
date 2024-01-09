function getthedate()
{
    Todays = new Date();
    TheDate = "" + (Todays.getMonth()+ 1) +" / "+ Todays.getDate() +  " / " + (Todays.getYear()-100);
    document.getElementById("data").innerHTML = TheDate;
}

var timerID = null;
var timerRunning = false;

function stopclock()
{
    if (timerRunning) 
        clearTimeout(timerID);
    timerRunning = false;
}

function startclock()
{
    stopclock();
    getthedate();
    showtime();
}

function showtime()
{
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    var timeValue = '' + ((hours > 12) ? hours -12 : hours)
    timeValue += (minutes < 10) ? ":0" + minutes : ":" + minutes
    timeValue += (seconds < 10) ? ":0" + seconds : ":" + seconds
    timeValue += (hours >= 12) ? " PM" : " AM";
    document.getElementById('zegarek').innerHTML = timeValue;
    timerID = setTimeout("showtime()",1000);
    timerRunning = true;
}