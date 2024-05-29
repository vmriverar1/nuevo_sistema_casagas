<?php

namespace App\Helpers;

use DateTime;
use DateTimeZone;
use App\Models\Branch;
use IntlDateFormatter;
use Illuminate\Support\Facades\Log;

class DateHelper
{
    /**
	 * @return array{year:int,month:int,date:int}
	 */
	public function getCurrentDate() : array {
		$timezone = new DateTimeZone( 'America/Lima' );
		$date     = new DateTime();
		$date->setTimezone( $timezone );

		return [
			'year'  => (int) $date->format( 'Y' ),
			'month' => (int) $date->format( 'n' ),
			'date'  => (int) $date->format( 'j' ),
		];
	}

	/**
	 * @return array{last_date_of_previous_month:int,first_day_of_month:int,last_day_of_month:int,last_date_of_month:int}
	 */
	public function getDaysAndDateFromMonth( int $selected_month, int $selected_year ) : array {
		$last_date_of_previous_month = gmdate( 'd', strtotime( 'last day of previous month', strtotime( "$selected_year-$selected_month-01" ) ?: null ) );
		$last_date_of_month          = gmdate( 't', mktime( 0, 0, 0, $selected_month, 1, $selected_year ) ?: null );

		$first_day_of_month = (int) gmdate( 'N', strtotime( "$selected_year-$selected_month-01" ) ?: null ) - 1;
		$last_day_of_month  = (int) gmdate( 'N', strtotime( "$selected_year-$selected_month-$last_date_of_month" ) ?: null ) - 1;

		return [
			'last_date_of_previous_month' => (int) $last_date_of_previous_month,
			'first_day_of_month'          => (int) $first_day_of_month,
			'last_day_of_month'           => (int) $last_day_of_month,
			'last_date_of_month'          => (int) $last_date_of_month,
		];
	}

	/**
	 * @return array<int,array{day:string,date:string,class:string}>
	 */
	public function getDatesCalendarByMonth( int|string $selected_month, int $selected_year ) : array {
		$current_date = $this->getCurrentDate();
		$year         = $current_date['year'];
		$month        = $current_date['month'];
		$date         = $current_date['date'];

		$month_user = intval( $selected_month );

		$days_and_date = $this->getDaysAndDateFromMonth( intval( $selected_month ), $selected_year );

		$first_day_of_month          = $days_and_date['first_day_of_month'];
		$last_date_of_previous_month = $days_and_date['last_date_of_previous_month'];
		$last_date_of_month          = $days_and_date['last_date_of_month'];
		$last_day_of_month           = $days_and_date['last_day_of_month'];

		$days = [];

		for ( $i = $first_day_of_month; $i > 0; $i-- ) {
			$previous_month = $month_user - 1;
			$previous_month = $previous_month < 1 ? 12 : $previous_month;
			$previous_month = sprintf( '%02d', $previous_month );

			$previous_day = $last_date_of_previous_month - $i + 1;
			$previous_day = sprintf( '%02d', $previous_day );

			$days[] = [
				'day'   => $previous_day,
				'date'  => $selected_year . '-' . $previous_month . '-' . $previous_day,
				'class' => 'inactive',
			];
		}

		for ( $i = 1; $i <= $last_date_of_month; $i++ ) {
			$is_today = $i === intval( $date ) && intval( $selected_month ) === intval( $month ) && intval( $selected_year ) === intval( $year ) ? 'active' : '';

			$month_active = sprintf( '%02d', $month_user );
			$day_active = sprintf( '%02d', $i );

			$days[] = [
				'day'   => $day_active,
				'date'  => $selected_year . '-' . $month_active . '-' . $day_active,
				'class' => $is_today,
			];
		}

		for ( $i = $last_day_of_month; $i < 6; $i++ ) {
			$next_month = $month_user + 1;
			$next_month = $next_month > 12 ? 1 : $next_month;
			$next_month = sprintf( '%02d', $next_month );

			$next_day = $i - $last_day_of_month + 1;
			$next_day = sprintf( '%02d', $next_day );

			$days[] = [
				'day'   => $next_day,
				'date'  => $selected_year . '-' . $next_month . '-' . ( $next_day ),
				'class' => 'inactive',
			];
		}

		return $days;
	}

	public function isDateInRange( string $date, string $start_date, string $end_date ) : bool {
		$date_obj       = DateTime::createFromFormat( 'Y-m-d H:i:s', $date . ' 00:00:00' );
		$start_date_obj = DateTime::createFromFormat( 'Y-m-d H:i:s', $start_date . ' 00:00:00' );
		$end_date_obj   = DateTime::createFromFormat( 'Y-m-d H:i:s', $end_date . ' 00:00:00' );

		return $date_obj >= $start_date_obj && $date_obj <= $end_date_obj;
	}

	public function getDateInText( string $date, bool $include_year = true ) : string {
		$timezone = new DateTimeZone( 'America/Lima' );
		$date_obj = new DateTime( $date, $timezone );

		$day   = $date_obj->format( 'j' );
		$month = $this->getNameMonthByNumber( (int) $date_obj->format( 'n' ) );
		$year  = $date_obj->format( 'Y' );

		$date_translated = "$day de $month";
		if ( $include_year ) {
			$date_translated = "$day de $month del $year";
		}

		return $date_translated;
	}

	public function getDateInTextSmall( string $date, bool $include_year = true ) : string {
		$timezone = new DateTimeZone( 'America/Lima' );
		$date_obj = new DateTime( $date, $timezone );

		$day   = $date_obj->format( 'j' );
		$month = substr( $this->getNameMonthByNumber( (int) $date_obj->format( 'n' ) ), 0, 3 );
		$year  = $date_obj->format( 'Y' );

		$date_translated = "$day $month";
		if ( $include_year ) {
			$date_translated = "$day $month $year";
		}

		return $date_translated;
	}

	public function getDateTextFromTwoDates( string $start_date, string $end_date ) : string {
		if ( $start_date === $end_date ) {
			return $this->getDateInTextSmall( $start_date );
		}

		$timezone = new DateTimeZone( 'America/Lima' );
		$date_obj_start = new DateTime( $start_date, $timezone );
		$date_obj_end = new DateTime( $end_date, $timezone );

		$year_start = $date_obj_start->format( 'Y' );
		$year_end = $date_obj_end->format( 'Y' );

		if ( $year_end > $year_start ) {
			return $this->getDateInTextSmall( $start_date ) . ' al ' . $this->getDateInTextSmall( $end_date );
		} else {
			return $this->getDateInTextSmall( $start_date, false ) . ' al ' . $this->getDateInTextSmall( $end_date, false ) . ' del ' . $year_end;
		}
	}

	public function getDateWithDayOfWeekInText( string $date ) : string {
		$date_obj = new DateTime( $date );

		$day   = $date_obj->format( 'j' );
		$month = $this->getNameMonthByNumber( (int) $date_obj->format( 'n' ) );
		$year  = $date_obj->format( 'Y' );
		$day_of_week = $this->formatDate( 'EEEE', $date );

		return sprintf( '%s %s de %s del %s', ucfirst( $day_of_week ), $day, $month, $year );
	}

	public function getPreviousMonth( int $month ) : int {
		$previous_month = $month - 1;
		return $previous_month < 1 ? 12 : $previous_month;
	}

	public function getNextMonth( int $month ) : int {
		$next_month = $month + 1;
		return $next_month > 12 ? 1 : $next_month;
	}

	public function getPreviousMonthAndYear( int $month, int $year ) : string {
		$previous_month = $this->getPreviousMonth( $month );
		$previous_year  = $previous_month === 12 ? $year - 1 : $year;
		return sprintf( '%04d-%02d', $previous_year, $previous_month );
	}

	public function getNextMonthAndYear( int $month, int $year ) : string {
		$next_month = $this->getNextMonth( $month );
		$next_year  = $next_month === 1 ? $year + 1 : $year;
		return sprintf( '%04d-%02d', $next_year, $next_month );
	}

	public function getNameMonthByNumber( int $month ) : string {
		$months = [
			'Enero',
			'Febrero',
			'Marzo',
			'Abril',
			'Mayo',
			'Junio',
			'Julio',
			'Agosto',
			'Septiembre',
			'Octubre',
			'Noviembre',
			'Diciembre',
		];

		return $months[ $month - 1 ];
	}

	public function formatDate( string $pattern, string $date ) : string {
		setlocale( LC_TIME, 'es_PE' );
		$formatter = new IntlDateFormatter( 'es_PE', IntlDateFormatter::NONE, IntlDateFormatter::NONE );
		$formatter->setPattern( $pattern );
		return $formatter->format( strtotime( $date ) ?: '' ) ?: '';
	}

	/**
	 * @param array<int,string> $dates Dates in 'Y-m-d' format
	 * @param string $current_date Current date in 'Y-m-d' format
	 * @return array<array{date_start: array{full_date: string, day: string, weekday: string, month: string}, is_active: string}>
	 */
	public function getFormatDates( array $dates, string $current_date ) : array {
		$formatted_dates = [];

		foreach ( $dates as $date ) {
			$weekday = $this->formatDate( 'EEEE', $date ); // lunes
			$month   = $this->formatDate( 'MMMM', $date ); // enero
			$day     = gmdate( 'j', strtotime( $date ) ?: null );     // 15

			$formatted_dates[] = [
				'date_start' => [
					'full_date' => $date,
					'day'       => $day,
					'weekday'   => $weekday,
					'month'     => $month,
				],
				'is_active'  => ( $date === $current_date ) ? 'active' : '', // Añade 'active' si es la fecha actual, de lo contrario, cadena vacía
			];
		}

		return $formatted_dates;
	}
}
