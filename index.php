<?php

header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=63072000');
header('X-Robots-Tag: noindex, nofollow', true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="HandheldFriendly" content="True" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0088cc">
    <link rel="shortcut icon" href="data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAACXBIWXMAAA7EAAAOxAGVKw4bAAABqklEQVQ4jZ2Tv0scURDHP7P7SGWh14mkuXJZEH8cgqUWcklAsLBbCEEJSprkD7hD/4BUISHEkMBBiivs5LhCwRQBuWgQji2vT7NeYeF7GxwLd7nl4knMwMDMfL8z876P94TMLt+8D0U0EggQSsAjwMvga8ChJAqxqjTG3m53AQTg4tXHDRH9ABj+zf6oytbEu5d78nvzcyiivx7QXBwy46XOi5z1jbM+Be+nqVfP8yzuD3FM6rzIs9YE1hqGvDf15cVunmdx7w5eYJw1pcGptC9CD4gBUuef5Ujq/BhAlTLIeFYuyfmTZgeYv+2nPt1a371P+Hm1WUPYydKf0lnePwVmh3hnlcO1uc7yvgJUDtdG8oy98kduK2KjeHI0fzCQINSXOk/vlXBUOaihAwnGWd8V5r1uhe1VIK52V6JW2D4FqHZX5lphuwEE7ooyaN7gjLMmKSwYL+pMnV+MA/6+g8RYa2Lg2RBQbj4+rll7uymLy3coiuXb5PdQVf7rKYvojAB8Lf3YUJUHfSYR3XqeLO5JXvk0dhKqSqQQoCO+s5AIxCLa2Lxc6ALcAPwS26XFskWbAAAAAElFTkSuQmCC" />

    <title>Weather Updates</title>
    <meta name="description" content="Search for City and Country Names to Retrieve Current Weather Status and Conditions."/>
    <?php $current_page = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; echo '<link rel="canonical" href="'.$current_page.'" />'; ?>


    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css" integrity="sha512-IgmDkwzs96t4SrChW29No3NXBIBv8baW490zk5aXvhCD8vuZM3yUSkbyTBcXohkySecyzIrUwiF/qV0cuPcL3Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Fira Code', monospace;
        background-color: #eff1f3;
        color: #333;
        min-height: 100vh;
        font-weight: 600;
    }
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .card-container {
        width: 90%;
        max-width: 600px;
        border-radius: 10px;
        background-color: #ffffff;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .input-container {
        margin-bottom: 20px;
    }
    #inputLocation, #apiKey, .button {
        border-radius: 20px;
        font-family: 'Fira Code', monospace;
        width: 100%;
    }
    #inputLocation, #apiKey {
        background-color: #f5f5f5;
        color: #333;
        border: 1px solid #dcdcdc;
        word-wrap: break-word;
        padding: 10px;
        margin-bottom: 10px;
    }
    #inputLocation::placeholder, #apiKey::placeholder {
        color: #aaa;
        opacity: 1;
        word-wrap: break-word;
    }
    #inputLocation:focus, #apiKey:focus {
        border-color: #0088cc;
        box-shadow: 0 0 0 0.125em rgba(0, 136, 204, 0.25);
    }
    .content {
        word-wrap: break-word;
    }
    #chat-box {
        border: none;
        border-radius: 5px;
        overflow-y: auto;
        margin-bottom: 20px;
        background-color: #ffffff;
        padding: 10px;
    }
    .chat-message {
        padding: 10px;
        margin-bottom: 10px;
    }
    .user-message {
        background-color: #e7f3fe;
        border-radius: 5px;
    }
    .bot-message {
        background-color: #edf2f7;
        border-radius: 5px;
    }
    .message-content {
        word-wrap: break-word;
        white-space: normal;
    }
    .success-message {
        color: #0088cc;
        font-weight: bold;
    }
    .error-message {
        color: #ff3860;
        font-weight: bold;
    }
    .hidden {
        display: none;
    }
</style>

</head>
<body>
<section class="section">
<div class="container">
    <div class="card-container">
        <div id="chat-box">
            <div class="chat-message bot-message">
                <div class="message-content success-message">
                    <p>Enter a city or country name to get weather data.</p><br>
                    <p>Your API Key Has been Stored on your Brower LocalStorage We Never Logged or Stored your Sensitive Data in our Server | ZERO LOGS Query.</p>
                </div>
            </div>
        </div>
        <div class="field input-container">
            <div class="control">
                <input class="input" type="text" id="inputLocation" placeholder="city or country">
            </div>
        </div>
        <div class="field input-container">
            <div class="control">
                <input class="input" type="text" id="apiKey" placeholder="Your API key">
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button class="button is-primary is-fullwidth" onclick="getWeatherData()">Get Data</button>
            </div>
        </div>
        <hr>
        <div class="field">
            <div class="control">
                <button class="button is-danger is-fullwidth" onclick="clearLocalStorage()">Clear LocalStorage</button>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button class="button is-info is-fullwidth" onclick="resetForm()">Reset Form</button>
            </div>
        </div>
    </div>
</div>
</section>

<script>
function storeApiKey() {
    const apiKey = document.getElementById("apiKey").value.trim();
    if (apiKey) {
        localStorage.setItem("apiKey", apiKey);
        document.getElementById("apiKey").classList.add("hidden");
    }
}

function getApiKey() {
    return localStorage.getItem("apiKey");
}

document.addEventListener("DOMContentLoaded", function() {
    const apiKey = getApiKey();
    if (apiKey) {
        document.getElementById("apiKey").classList.add("hidden");
    }
});

function verifyApiKey(apiKey) {
    return true;
}

function getWeatherData() {
    storeApiKey();

    const apiKey = getApiKey();
    const location = document.getElementById("inputLocation").value.trim();
    const chatBox = document.getElementById("chat-box");

    if (!verifyApiKey(apiKey)) {
        addBotMessage("Failed to verify API key. Please check your API key and try again.", "error-message");
        return;
    }

    chatBox.innerHTML = '';

    if (!location) {
        addBotMessage("Please enter a city or country name.", "error-message");
        return;
    }

    const options = {
       method: 'POST',
       headers: {'Content-Type': 'application/json'},
       body: `{"location":"${location}","apiKey":"${apiKey}"}`
    };

    fetch('/api/weather.php', options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch data from the server. Please try again later.');
            }
            return response.json();
        })
        .then(data => {
            if (data.cod === '404') {
                addBotMessage("Location not found. Please enter a valid city or country name.", "error-message");
            } else {
                const temperature = data.main.temp;
                const humidity = data.main.humidity;
                const pressure = data.main.pressure;
                const airQuality = data.weather[0].description;
                const windSpeed = data.wind.speed;

                const windSpeedKmh = (windSpeed * 3.6).toFixed(2);

                const temperatureEmoji = getTemperatureEmoji(temperature);
                const humidityEmoji = getHumidityEmoji(humidity);
                const pressureEmoji = getPressureEmoji(pressure);
                const airQualityEmoji = getAirQualityEmoji(airQuality);
                const windSpeedEmoji = getWindSpeedEmoji(windSpeedKmh);
                const sunriseUTC = new Date(data.sys.sunrise * 1000);
                const sunsetUTC = new Date(data.sys.sunset * 1000);
                const timezoneOffset = data.timezone;
                const sunriseLocal = new Date(sunriseUTC.getTime() + timezoneOffset * 1000).toLocaleTimeString('en-US', { timeZone: 'UTC' });
                const sunsetLocal = new Date(sunsetUTC.getTime() + timezoneOffset * 1000).toLocaleTimeString('en-US', { timeZone: 'UTC' });

                addBotMessage("Temperature: " + temperature + "°C " +  temperatureEmoji, "success-message");
                addBotMessage("Humidity: " + humidity + "%" + "\t" + humidityEmoji, "success-message");
                addBotMessage("Air Pressure: " + pressure + " hPa " +  pressureEmoji, "success-message");
                addBotMessage("Weather Condition: " + airQuality + " " +  airQualityEmoji, "success-message");
                addBotMessage("Wind Speed: " + windSpeedKmh + " km/h " +  windSpeedEmoji, "success-message");
                addBotMessage("Sunrise: " + sunriseLocal, "success-message");
                addBotMessage("Sunset: " + sunsetLocal, "success-message")

                const output = chatBox.innerText.trim();
                navigator.clipboard.writeText(output)
                    .then(() => {
                        addBotMessage("Weather data has been copied to clipboard.", "success-message");
                })
                    .catch(err => {
                        console.error('Error copying weather data');
                        addBotMessage("Failed to copy weather data to clipboard. Please try again.", "error-message");
                 });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            addBotMessage(error.message || "An error occurred while fetching data. Please try again later.", "error-message");
        });
}

function addBotMessage(message, className) {
    const chatBox = document.getElementById("chat-box");
    const messageElement = document.createElement("div");
    messageElement.className = "chat-message bot-message";
    messageElement.innerHTML = '<div class="message-content ' + className + '">' + message + '</div>';
    chatBox.appendChild(messageElement);
}

function getTemperatureEmoji(temperature) {
    if (temperature < 0) {
        return '❄️';
    } else if (temperature >= 0 && temperature < 15) {
        return '🥶';
    } else if (temperature >= 15 && temperature < 25) {
        return '😊';
    } else if (temperature >= 25 && temperature < 35) {
        return '😎';
    } else {
        return '🔥';
    }
}

function getHumidityEmoji(humidity) {
    if (humidity < 30) {
        return '💨';
    } else if (humidity >= 30 && humidity < 60) {
        return '😊';
    } else {
        return '💦';
    }
}

function getPressureEmoji(pressure) {
    if (pressure < 1000) {
        return '🌀';
    } else if (pressure >= 1000 && pressure < 1020) {
        return '🙂';
    } else {
        return '⛈️';
    }
}

function getAirQualityEmoji(airQuality) {
    if (airQuality.includes('rain')) {
        return '🌧️';
    } else if (airQuality.includes('cloud')) {
        return '☁️';
    } else if (airQuality.includes('clear')) {
        return '☀️';
    } else {
        return '';
    }
}

function getWindSpeedEmoji(windSpeed) {
    if (windSpeed < 10) {
        return '🍃';
    } else if (windSpeed >= 10 && windSpeed < 20) {
        return '💨';
    } else {
        return '🌬️';
    }
}

function clearLocalStorage() {
    localStorage.removeItem("apiKey");
    document.getElementById("apiKey").classList.remove("hidden");
    window.location.reload();
}

function resetForm() {
    document.getElementById("inputLocation").value = "";
    document.getElementById("chat-box").innerHTML = '';
    window.location.reload();
}
</script>
</body>
</html>