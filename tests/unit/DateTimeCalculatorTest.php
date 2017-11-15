
<?php
use \PHPUnit\Framework\TestCase;
use App\Calculator\DateTimeCalculator;

class DateTimeCalculatorTest extends TestCase {

	private $startDate;
	private $sameStartDate;
	private $weekAheadOfStartDate;
	private $yearAheadOfStartDate;
	private $endDate;
	//Leap year
	private $startLeapDate;
	private $endLeapDate;
	private $startNonLeapYearDate;
	private $endNonLeapYearDate;
	private $startDateForLeap;
	private $endDateAfterThreeYears;
	private $startDateNonLeapYear;
	private $endDateNonLeapYearAfterThreeYears;
	//DST
	private $startDateDST;
	private $endDateDST;

	public function setUp(){
		$this->startDate = new \DateTime( '2017-07-01', new \DateTimeZone( 'Australia/Adelaide' ) );
		$this->nextDate = new \DateTime( '2017-07-02', new \DateTimeZone( 'Australia/Adelaide' ) );
		$this->sameStartDate = clone $this->startDate;
		$this->weekAheadOfStartDate = new \DateTime( '2017-07-07', new \DateTimeZone( 'Australia/Adelaide' ) );
		$this->yearAheadOfStartDate = ( clone $this->startDate )->modify( '+1 year' );
		$this->endDate = new \DateTime( '2017-07-14', new \DateTimeZone( 'Australia/Adelaide' ) );

		//Leap Year
		$this->startLeapDate = new \DateTime( '2016-02-27', new \DateTimeZone( 'Australia/Adelaide' ) );
		$this->endLeapDate = new \DateTime( '2016-03-1', new \DateTimeZone( 'Australia/Adelaide' ) );
		$this->startNonLeapYearDate  = new \DateTime( '2011-02-27', new \DateTimeZone( 'Australia/Adelaide' ) );
		$this->endNonLeapYearDate = new \DateTime( '2011-03-1', new \DateTimeZone( 'Australia/Adelaide' ) );

		$this->startDateForLeap = new \DateTime( '2014-01-1', new \DateTimeZone( 'Australia/Adelaide' ) );
		$this->endDateAfterThreeYears = new \DateTime( '2016-12-31', new \DateTimeZone( 'Australia/Adelaide' ) );
		$this->startDateNonLeapYear = new \DateTime( '2013-01-1', new \DateTimeZone( 'Australia/Adelaide' ) );
		$this->endDateNonLeapYearAfterThreeYears = new \DateTime( '2015-12-31', new \DateTimeZone( 'Australia/Adelaide' ) );

		//DST
		$this->startDateDST = new \DateTime( '2017-10-1 1:58:00', new \DateTimeZone( 'Australia/Adelaide' ) );
		$this->endDateDST = new \DateTime( '2017-10-1 2:01:00', new \DateTimeZone( 'Australia/Adelaide' ) );
		$this->startDateDST1 = new \DateTime( '2017-03-1 1:58:00', new \DateTimeZone( 'Australia/Adelaide' ) );
		$this->endDateDST1 = new \DateTime( '2017-03-1 2:01:00', new \DateTimeZone( 'Australia/Adelaide' ) );


	}

	/**
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	*
	*/
	public function testStartDateIsLessThanEndDate(){
		
		$this->assertLessThanOrEqual( $this->endDate, $this->startDate );
	}

	/*public function testNoValidParametersSupplied(){
		$this->assertFalse( DateTimeCalculator::getNumberOfWeekDays( '01-07-2017', '01-07-2017') );
	}*/

	/**
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	*
	*/
	public function testNumberOfDaysBetweenTwoDateTimes(){
		$this->assertEquals( 14, DateTimeCalculator::getNumberOfDays( $this->startDate, $this->endDate ) );
	}

	/**
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	*
	*/
	public function testNumberOfWeekdayDaysBetweenTwoDateTimes(){
		$this->assertEquals( 10, DateTimeCalculator::getNumberOfWeekDays( $this->startDate, $this->endDate ) );
	}

	/**
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	*
	*/
	public function testNumberOfWeeksBetweenTwoDateTimes(){
		$this->assertEquals( 2, DateTimeCalculator::getNumberOfWeeks( $this->startDate, $this->endDate ) );
	}

	/** Seconds**/	
	/**
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	* @param String      s //Seconds
	*
	*/
	public function testNumberOfSecondsForDaysBetweenTwoDateTimes(){
		$this->assertEquals( 172800, DateTimeCalculator::getNumberOfDays( $this->startDate, $this->nextDate, 's' ) );
	}

	/**
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	* @param String      s //Seconds
	*
	*/
	public function testNumberOfSecondsForWeekdaysBetweenTwoDateTimes(){
		$this->assertEquals( 864000, DateTimeCalculator::getNumberOfWeekDays( $this->startDate, $this->endDate, 's' ) );
	}

	/**
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	* @param String      s //Seconds
	*
	*/
	public function testNumberOfSecondsForWeeksBetweenTwoDateTimes(){
		$this->assertEquals( 604800, DateTimeCalculator::getNumberOfWeeks( $this->startDate, $this->weekAheadOfStartDate, 's' ) );
	}

	/** Minutes **/

	/**
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	* @param String      m //Minutes
	*
	*/
	public function testNumberOfMinutesForDaysBetweenTwoDateTimes(){
		$this->assertEquals( 2880, DateTimeCalculator::getNumberOfDays( $this->startDate, $this->nextDate, 'm' ) );
	}

	/**
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	* @param String      m //Minutes
	*
	*/
	public function testNumberOfMinutesForWeekdaysBetweenTwoDateTimes(){
		$this->assertEquals( 7200, DateTimeCalculator::getNumberOfWeekDays( $this->startDate, $this->weekAheadOfStartDate, 'm' ) );
	}

	/**
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	* @param String      m //Minutes
	*
	*/
	public function testNumberOfMinutesForWeeksBetweenTwoDateTimes(){
		$this->assertEquals( 10080, DateTimeCalculator::getNumberOfWeeks( $this->startDate, $this->weekAheadOfStartDate, 'm' ) );
	}

	/** Hours **/
	/**
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	* @param String      h //Hours
	*
	*/
	public function testNumberOfHoursForDaysBetweenTwoDateTimes(){
		$this->assertEquals( 48, DateTimeCalculator::getNumberOfDays( $this->startDate, $this->nextDate, 'h' ) );
	}

	/**
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	* @param String      h //Hours
	*
	*/
	public function testNumberOfHoursForWeekdaysBetweenTwoDateTimes(){
		$this->assertEquals( 120, DateTimeCalculator::getNumberOfWeekDays( $this->startDate, $this->weekAheadOfStartDate, 'h' ) );
	}

	/**
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	* @param String      h //Hours
	*
	*/
	public function testNumberOfHoursForWeeksBetweenTwoDateTimes(){
		$this->assertEquals( 168, DateTimeCalculator::getNumberOfWeeks( $this->startDate, $this->weekAheadOfStartDate, 'h' ) );
	}

	/** Years **/
	/**
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	* @param String      y //Years
	*
	*/
	public function testNumberOfYearsForDaysBetweenTwoDateTimes(){
		$this->assertEquals( 1, DateTimeCalculator::getNumberOfDays( $this->startDate, $this->yearAheadOfStartDate, 'y' ) );
	}

	/**
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	* @param String      y //Years
	*
	*/
	public function testNumberOfYearsForWeekdaysBetweenTwoDateTimes(){
		$this->assertEquals( 0.71, DateTimeCalculator::getNumberOfWeekDays( $this->startDate, $this->yearAheadOfStartDate, 'y' ) );
	}

	/**
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	* @param String      y //Years
	*
	*/
	public function testNumberOfYearsForWeeksBetweenTwoDateTimes(){
		$this->assertEquals( 1, DateTimeCalculator::getNumberOfWeeks( $this->startDate, $this->yearAheadOfStartDate, 'y' ) );
	}

	//Leap Year Day 
	/**
	* Verifies the calculating the days between 2 dates from 27 Feb, 2016 to 1 March, 2016 
	* which should be 4 i.e.  3 + 1 day from leap year (2016)
	*
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	*
	*/
	public function testNumberOfDaysBetweenTwoDateTimesInLeapYear(){
		$this->assertEquals( 4, DateTimeCalculator::getNumberOfDays( $this->startLeapDate, $this->endLeapDate ) );
	}

	/**
	* Verifies the calculating the days between 2 dates  
	* 
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	*
	*/
	public function testNumberOfDaysBetweenSameDateTimesInNonLeapYear(){
		$this->assertEquals( 3, DateTimeCalculator::getNumberOfDays( $this->startNonLeapYearDate, $this->endNonLeapYearDate ) );
	}

	/**
	* Verifies the calculating the days between 3 years including a leap year 
	* which should be 1096 i.e. 365 * 3 + 1 day from leap year
	*
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	*
	*/
	public function testNumberOfDaysBetweenThreeYearsWithLeapYear(){
		$this->assertEquals( ( 365 * 3 ) + 1, DateTimeCalculator::getNumberOfDays( $this->startDateForLeap, $this->endDateAfterThreeYears ) );
	}

	/**
	* Verifies the calculating the days between 3 years without including any leap year 
	* which should be 1095 i.e. 365 * 3
	*
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	*
	*/
	public function testNumberOfDaysBetweenThreeYearsWithoutLeapYear(){
		$this->assertEquals( 365 * 3, DateTimeCalculator::getNumberOfDays( $this->startDateNonLeapYear, $this->endDateNonLeapYearAfterThreeYears ) );
	}

	/**
	* Verifies the calculating the minutes between start date '2017-3-1 1:58:00' 
	* to endDate '2017-3-1 2:01:00' which should be 3.
	*
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	*
	*/
	public function testNumberOfSecondsBetweenTwoDateTimesNonDST(){
		$this->assertEquals( 3, DateTimeCalculator::getNumberOfDays( $this->startDateDST1, $this->endDateDST1, 'm' ) );
	}
	/**
	* Verifies the DST Transition by calculating the minutes between start date '2017-10-1 1:58:00' 
	* to endDate '2017-10-1 2:01:00' which in normal date should be 3 As in the above Test
	* In this test as DST adds 1 hours it gives 60 + 3 = 63 Seconds.
	*
	* @param \DateTime   $startDate
	* @param \DateTime   $endDate
	*
	*/
	public function testNumberOfSecondsBetweenTwoDateTimesIncludingDST(){
		$this->assertEquals( 63, DateTimeCalculator::getNumberOfDays( $this->startDateDST, $this->endDateDST, 'm' ) );
	}
}

