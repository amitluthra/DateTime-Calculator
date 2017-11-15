<?php

namespace App\Calculator;

/**
 * Class DateTimeCalculator
 * version: 2.0 
 * @package Calculator
 */
class DateTimeCalculator{

    const SECONDS   = 60;
    const MINUTES   = 60;
    const HOURS     = 24;
    const YEARS     = 365;

    /**
    * @param \DateTime   $startDate
    * @param \DateTime   $endDate
    * @param String      $convertTo //s Seconds, m Miunutes, h Hours, y Years
    *
    * @return int        Number of days
    */
    public static function getNumberOfDays( \DateTime $startDate, \DateTime $endDate, $convertTo = null ){
        return self::convertToFormat( $startDate, $endDate, null, $convertTo );
        
    }

    /**
    * @param \DateTime   $startDate
    * @param \DateTime   $endDate
    * @param String      $convertTo //s Seconds, m Miunutes, h Hours, y Years
    *
    * @return int        Number of Weeks
    */
    public static function getNumberOfWeeks( \DateTime $startDate, \DateTime $endDate, $convertTo = null ){
          return self::convertToFormat( $startDate, $endDate, 'week', $convertTo );
        
    }

    /**
    * @param \DateTime   $startDate
    * @param \DateTime   $endDate
    * @param String      $convertTo //s Seconds, m Miunutes, h Hours, y Years
    *
    * @return int        Number of Week Days
    */
    public static function getNumberOfWeekDays( \DateTime $startDate, \DateTime $endDate, $convertTo = null ){
        $numberOfWeekDays = 0;

        while( $endDate->diff( $startDate )->days > 0 ) {
            $numberOfWeekDays += self::isWeekday( $startDate ) ? 1 : 0;
            $startDate = $startDate->add( new \DateInterval( "P1D" ) );
        }
        //including the last day
        $numberOfWeekDays += self::isWeekday( $endDate ) ? 1 : 0;
        

        return self::convertDays($numberOfWeekDays, $convertTo);   
    }
    /**
    * @param \DateTime   $date
    *
    * @return bool
    */
    private static function isWeekDay ( \DateTime $date ) {

        return $date->format('N' ) < 6;
    }

    /**
    * @param int        $days
    * @param String     $format
    *
    * @return int       Formatted Number
    */
    private static function convertToFormat( \DateTime $startDate, \DateTime $endDate, $type = null,  $format = null ){
        $diff = $endDate->diff( $startDate );
        //print_r($diff);
        $days = $diff->format( '%a' );
        $daysIncludingEndDate = $days + 1;
        //echo '<BR>Days-- '.$days;
        if( $type === 'week' && empty( $format ) ){
            $return = floor( $daysIncludingEndDate / 7 );
        }else if( $days < 1 ){
            $offsetSeconds = self::getOffsetDifference( $startDate, $endDate );    
            //echo '<BR>offsetSeconds- '.$offsetSeconds;
            $return = self::formateTime( $diff, $offsetSeconds, $format );            
        }else{

            $return = self::convertDays( $daysIncludingEndDate, $format ); 
        }
        return round( $return, 2);
    }
    
    /**
    * @param \DateTime   $startDate
    * @param \DateTime   $endDate
     *
    * @return int        Number of seconds
    */
    
    private static function getOffsetDifference( \DateTime $startDate, \DateTime $endDate ){
        $offsetDiff = $endDate->getOffset() - $startDate->getOffset();        
        
        return $offsetDiff;  
    }

    private static function getTotalSeconds( $diff, $offsetSeconds ){

        $totalSeconds =  ( $diff->format( '%h' )  * self::MINUTES * self::SECONDS ) + ( $diff->format( '%i' )  * self::SECONDS ) + ( $diff->format( '%s' ) );
        $totalSeconds += $offsetSeconds;

        return $totalSeconds;
    }

    private static function convertDays( $days, $format ){
        if( $format == 's' ){
            $return = $days * self::HOURS * self::MINUTES * self::SECONDS;
        }else if( $format == 'm' ){
            $return = $days * self::HOURS * self::MINUTES;
        }else if( $format == 'h' ){
            $return = $days * self::HOURS;
        }else if( $format == 'y' ){
                $return = $days / self::YEARS;
        }else{
            $return = $days;
        }
        return round( $return, 2);
    }

    private static function formateTime($diff, $offsetSeconds, $format){
        $seconds = self::getTotalSeconds( $diff, $offsetSeconds );
        //echo '<BR>seconds- '.$seconds;
        if( $format == 's' ){
            $return = $seconds;
        }else if( $format == 'm' ){
            $return = $seconds / self::SECONDS;
        }else if( $format == 'h' ){
            $return = ( $seconds / self::SECONDS ) / self::MINUTES;
        }
        return $return;
    }


}
