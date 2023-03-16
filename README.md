# api-throttler
Simple code to handle api call throttling in php 

Requirements
-------------

Php version 5 or above

cUrl library for php


index.php
-------------------

Entry script  , which will configures the api call rate and trigger api call until the call gets throttled.

A sample api end point is used to show the get response.

APIRateLimiter.php
-------------------

Simple php code to calculate calls excecution count and calculates the consumed call count out of allocated configurable rate per second.


