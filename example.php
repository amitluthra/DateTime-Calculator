<?php
require_once( './app/datetime_calculator.php' );

use \App\Calculator\DateTimeCalculator;

$startDate = new \DateTime( '2017-07-01', new \DateTimeZone( 'Australia/Adelaide' ) );
$endDate = new \DateTime( '2017-07-8', new \DateTimeZone( 'Australia/Adelaide' ) );

$weekAheadStartDate = ( clone $startDate )->modify( '+1 Week' );
$yearAheadOfStartDate = ( clone $startDate )->modify( '+1 year' );

echo '<PRE>'.$startDate->format('d-M-Y'). ' to '.$endDate->format( 'd-M-Y' );


$arrFunctions = [
    'days' => 'getNumberOfDays',
    'weeks' => 'getNumberOfWeeks',
    'week-Days' => 'getNumberOfWeekDays'

];

foreach ($arrFunctions as $key => $function) {
   $numberOfDays[$key] = DateTimeCalculator::$function( $startDate, $endDate, '' );
}
echo '<BR><h3>Output</h3>';
print_r($numberOfDays);

