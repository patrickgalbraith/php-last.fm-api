<?php

/** Provides different methods to query geo based information.
 *
 * @package	php-lastfm-api
 * @author  Felix Bruns <felixbruns@web.de>
 * @version	1.0
 */
class LastFM_Geo {
	/** Get all events in a specific location by country or city name.
	 *
	 * @param	string	$location	Specifies a location to retrieve events for (service returns nearby events by default). (Optional)
	 * @param	float	$lat		Specifies a latitude value to retrieve events for (service returns nearby events by default). (Optional)
	 * @param	float	$long		Specifies a longitude value to retrieve events for (service returns nearby events by default). (Optional)
	 * @param	integer	$distance	Find events within a specified distance. (Optional)
	 * @param	integer	$page		Display more results by pagination. (Optional)
	 * @return	PaginatedResult		A PaginatedResult object.
	 *
	 * @static
	 * @access	public
	 * @throws	Error
	 */
	public static function getEvents($location = null, $lat = null, $long = null,
									 $distance = null, $page = null){
		$xml = LastFM_Caller_CallerFactory::getDefaultCaller()->call('geo.getEvents', array(
			'location' => $location,
			'lat'      => $lat,
			'long'     => $long,
			'distance' => $distance,
			'page'     => $page
		));

		$events = array();

		foreach($xml->children() as $event){
			$events[] = LastFM_Event::fromSimpleXMLElement($event);
		}

		$perPage = intval(ceil(
			LastFM_Util::toInteger($xml['total']) / LastFM_Util::toInteger($xml['totalpages'])
		));

		return new LastFM_PaginatedResult(
			LastFM_Util::toInteger($xml['total']),
			(LastFM_Util::toInteger($xml['page']) - 1) * $perPage,
			$perPage,
			$events
		);
	}

	/** Get the most popular artists on last.fm by country.
	 *
	 * @param	string	country		A country name, as defined by the ISO 3166-1 country names standard. (Required)
	 * @return	array				An array of Artist objects.
	 *
	 * @static
	 * @access	public
	 * @throws	Error
	 */
	public static function getTopArtists($country){
		$xml = LastFM_Caller_CallerFactory::getDefaultCaller()->call('geo.getTopArtists', array(
			'country' => $country
		));

		$artists = array();

		foreach($xml->children() as $artist){
			$artists[] = LastFM_Artist::fromSimpleXMLElement($artist);
		}

		return $artists;
	}

	/** Get the most popular tracks on last.fm by country.
	 *
	 * @param	string	country		A country name, as defined by the ISO 3166-1 country names standard. (Required)
	 * @param	string	location	A metro name, to fetch the charts for (must be within the country specified). (Optional)
	 * @return	array				An array of Track objects.
	 *
	 * @static
	 * @access	public
	 * @throws	Error
	 */
	public static function getTopTracks($country, $location = null){
		$xml = LastFM_Caller_CallerFactory::getDefaultCaller()->call('geo.getTopTracks', array(
			'country'  => $country,
			'location' => $location
		));

		$tracks = array();

		foreach($xml->children() as $track){
			$tracks[] = LastFM_Track::fromSimpleXMLElement($track);
		}

		return $tracks;
	}
}


