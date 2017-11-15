# DateTime-Calculator

> DateTime calculations for a date range including the timezones

## Installation

```bash
$ composer install
```
## Objective
1. Find out the number of days between two datetime parameters.

2. Find out the number of weekdays between two datetime parameters.

3. Find out the number of complete weeks between two datetime parameters.

4. Accept a third parameter to convert the result of (s, m, h, y) into one of seconds, minutes, hours, years.

5. Allow the specification of a timezone for comparison of input parameters from different timezones.

6. Should Also consider Leap Year and DST

## Usage

First you need to use the required namespace and then get the two Dates for comparison:

```php
use \App\Calculator\DateTimeCalculator;


$startDate 	= new \DateTime( '2017-10-1 1:58:00', new \DateTimeZone( 'Australia/Adelaide' ) );
$endDate 	= new \DateTime( '2017-10-1 2:01:00', new \DateTimeZone( 'Australia/Adelaide' ) );

$arrFunctions = [
    'days' => 'getNumberOfDays',
    'weeks' => 'getNumberOfWeeks',
    'week-Days' => 'getNumberOfWeekDays'

];
foreach ($arrFunctions as $key => $function) {
   $numberOfDays[$key] = \App\Calculator\DateTimeCalculator::$function( $startDate, $endDate );
}
echo '<BR><h3>Output</h3>';
print_r($numberOfDays);

```



