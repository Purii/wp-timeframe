# wp-timeframe
A tiny WordPress plugin to show or hide certain parts of any page at a defined range of time.

## Shortcode `[timeframe]`

**Show a certain part in a specific timeframe:**   
  ```
  [timeframe showfrom="04-05-2015 09:00:00" showuntil="04-05-2015 09:30:00"]
    Hey! Seems as if you are at the right place in the right time!
  [/timeframe]
  ```

**Hide a certain part in a specific timeframe:**   
  ```
  [timeframe hidefrom="04-05-2015 09:00:00" hideuntil="04-05-2015 09:30:00"]
    I will be away next Monday!
  [/timeframe]
  ```

#### Parameters
Parameter | Description | Required | Default | Format
--- | --- | --- | --- | ---
hidefrom | DateTime when content should start to be hidden | optional | *empty* | *valid DateTime*
hideuntil | DateTime when content should end to be hidden | optional | *empty* | *valid DateTime*
showfrom | DateTime when content should start to be shown | optional | *empty* | *valid DateTime*
showuntil | DateTime when content should end to be shown | optional | *empty* | *valid DateTime*
alternativecontent | String to show, when content is not displayed | optional | *empty* | *any string*

## Hints
#### Use with caches
This plugin doesn't support any caches.

## Installation

1. Checkout the contents of ``/src``
2. Upload them to your plugin directory (..and maybe into a subfolder, like: ``/wp-content/plugins/timeframe/``)
