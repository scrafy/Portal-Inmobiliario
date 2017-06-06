<?php
if (isset($_ENV['APP_URL'])) {
    if (strstr($_ENV['APP_URL'], "localhost")) {
        putenv('APP_ENV=local');
    } else {
        putenv('APP_ENV=production');
    }
}
$env = "";
if (getenv('APP_ENV') === "local") {
    $env = "env.local";
} else if (getenv('APP_ENV') === "production") {
    $env = "env.production";
}
$dotenv = new Dotenv\Dotenv(__DIR__ . '/../', "." . $env);
$dotenv->overload();

