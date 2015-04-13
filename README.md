# wp-timeframe
A tiny WordPress plugin to show or hide certain parts of any page at a defined range of time.

## Shortcode `[timeframe]`

**Show a certain part in a specific timeframe:**   
  ```
  [timeframe showfrom="04-05-2015 09:00:00" showuntil="04-05-2015 09:00:00"]
    Hey! Seems as if you are at the right place in the right time!
  [/timeframe]
  ```

**Hide a certain part in a specific timeframe:**   
  ```
  [timeframe hidefrom="04-05-2015 09:00:00" hideuntil="04-05-2015 09:00:00"]
    I will be away next Monday!
  [/timeframe]
  ```

#### Parameters
Parameter | Description | Required | Default | Format
--- | --- | --- | --- | ---
hidefrom | DateTime when content should start to be hidden | optional | *empty* | ``d-m-Y h:m:s``
hideuntil | DateTime when content should end to be hidden | optional | *empty* | ``d-m-Y h:m:s``
showfrom | DateTime when content should start to be shown | optional | *empty* | ``d-m-Y h:m:s``
showuntil | DateTime when content should end to be shown | optional | *empty* | ``d-m-Y h:m:s``
alternativecontent | String to show, when content is not displayed | optional | *empty* | *any string*

**Currently** only the described format of DateTime is supported. More formats are supported in some time.

## Hints
#### Use with caches
This plugin doesn't support any caches.

## Installation

1. Checkout the contents of the folder ``/src``
2. Upload the contents to your plugin directory of WordPress (..and maybe into a subfolder: ``/wp-content/plugins/timeframe/``)
