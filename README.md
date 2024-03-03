# Weather Updates

Search for City and Country Names to Retrieve Current Weather Status and Conditions.  

## Usage

- OpenWeathermap Free API (1000 request per day) - **<https://openweathermap.org/api>**
- PHP for API proxy **(ZERO Query Logs)**
- Bulma CSS
- Fetch API
- LocalStorage for storing the API Key in your Browser
- Automatically Copied the Weather data in your Clipboard using `navigator.clipboard` API

## Setup

- Create an Free account from **`https://home.openweathermap.org/users/sign_up`**
- After sign up verify your account via Email
- you will receive an API Key in your Email inbox
- wait for 10 to 15 minutes for API full activation from there side
- Done, Now open the site on Browser
- Enter your API Key and Country/City Name to get current weather status and conditions

> Still it's on ⚠ WIP if you have any ideas your PR's are Welcome 😊  

## API

```sh
curl --request POST \
  --url http://localhost:6008/api/weather.php \
  --header 'Content-Type: application/json' \
  --data '{"location": "india", "apiKey": "xxxxxxxxxxxxxxxxxxxxxxxxx"}'
```

## Localhost

```sh

# Localhost server using PHP

php -S localhost:6008

```

- Now open your browser with the following URL

```sh

http://localhost:6008

```

## LICENSE

MIT
