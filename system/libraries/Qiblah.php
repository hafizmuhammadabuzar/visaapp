<?php
// ----------------------------------------------------------------------
//Copyrights © 2009 Mewsoft Corp. All rights reserved.
//Program Author   : Dr. Ahmed Amin Elsheshtawy, Ph.D
//Home Page          : http://www.islamware.com, http://www.mewsoft.com
//Contact Email      : support@mewsoft.com
//Products               : Auction, Classifieds, Directory, PPC, Forums, Snapshotter
// ----------------------------------------------------------------------
// LICENSE
// This program is open source product; you can redistribute it and/or
// modify it under the terms of the GNU Lesser General Public License (LGPL)
// as published by the Free Software Foundation; either version 3
// of the License, or (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU Lesser General Public License for more details.

// You should have received a copy of the GNU Lesser General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
// ----------------------------------------------------------------------

  /**
	* Qiblah class Calculates the Muslim Qiblah Direction From North Clocklwise, Great Circle Distance, and Great Circle Direction.
		Calculates the Qibla direction From North Clocklwise.
		Calculates the distance between any two points on the Earth.
		Calculates the direction from one point to another on the Earth. Great Circle Bearing.
   * @package Qiblah
   * @link http://www.islamware.com, http://www.mewsoft.com
   * @author Dr. Ahmed Amin Elsheshtawy, Ph.D <support@mewsoft.com>
   * @version 1.0
   * @license LGPL
   */

class Qiblah {

	// Default destination point is the  Kabah Lat=21 Deg N, Long 40 Deg E
	private $destination_latitude = 21;
	private $destination_longitude = 40;
	//cairo: $latitude = 30.1, $longitude = 31.3

	public function __construct ($destination_latitude = 21, $destination_longitude = 40)
	{
		$this->destination_latitude = floatval ($destination_latitude);
		$this->destination_longitude = floatval ($destination_longitude);
	}
	
	/**
	 The shortest distance between points 1 and 2 on the earth's surface is
	 d = arccos{cos(Dlat) - [1 - cos(Dlong)]cos(lat1)cos(lat2)}
	 Dlat = lab - lat2
	 Dlong = 10ng• - long2
	 lati, = latitude of point i
	 longi, = longitude of point i

	Conversion of grad to degrees is as follows:
	Grad=400-degrees/0.9 or Degrees=0.9x(400-Grad)

	Latitude is determined by the earth's polar axis. Longitude is determined
	by the earth's rotation. If you can see the stars and have a sextant and
	a good clock set to Greenwich time, you can find your latitude and longitude.

	 one nautical mile equals to:
	   6076.10 feet
	   2027 yards
	   1.852 kilometers
	   1.151 statute mile

	*/
	
	/**
		Calculates the distance between any two points on the Earth
	*/

	public function GreatCircleDistance ($OrigLat , $DestLat, $OrigLong, $DestLong)
	{
		$L1 = deg2rad($OrigLat);
		$L2 = deg2rad($DestLat);
		$I1 = deg2rad($OrigLong);
		$I2 = deg2rad($DestLong);
		
		$D = acos(cos($L1 - $L2) - (1 - cos($I1 - $I2)) * cos($L1) * cos($L2));
		# One degree of such an arc on the earth's surface is 60 international nautical miles NM
		return rad2deg($D * 60);
	}
	
	/**
		GreatCircleDirection Great Circle Bearing
		Calculates the direction from one point to another on the Earth
		a = arccos{[sin(lat2) - cos(d + lat1 - 1.5708)]/cos(lat1)/sin(d) + 1}

	*/
	public function GreatCircleDirection ($OrigLat, $DestLat, $OrigLong, $DestLong, $Distance)
	{
		$Result = 0.0;

		$L1 = deg2rad($OrigLat);
		$L2 = deg2rad($DestLat);
		$D = deg2rad($Distance / 60); # divide by 60 for nautical miles NM to degree

		$I1 = deg2rad($OrigLong);
		$I2 = deg2rad($DestLong);
		$Dlong = $I1 - $I2;

		$A = sin($L2) - cos($D + $L1 - pi() / 2);
		$B = acos($A / (cos($L1) * sin($D)) + 1);
		
		if ((abs($Dlong) < pi() and $Dlong < 0) or (abs($Dlong) > pi() and $Dlong > 0))
		{
			//$B = (2 * pi()) - $B;
		}
		
		$Result = $B;
		return rad2deg($Result);
	}
	
	public function GreatCircleDirection1 ($lat1, $lon1, $lat2, $lon2)
	{
		$result = 0.0;

		$ilat1 = intval(0.50 + $lat1 * 360000.0);
		$ilat2 = intval(0.50 + $lat2 * 360000.0);
		$ilon1 = intval(0.50 + $lon1 * 360000.0);
		$ilon2 = intval(0.50 + $lon2 * 360000.0);

		$lat1 = deg2rad($lat1);
		$lon1 = deg2rad($lon1);
		$lat2 = deg2rad($lat2);
		$lon2 = deg2rad($lon2);

		if (($ilat1 == $ilat2) && ($ilon1 == $ilon2)) {
					return $result;
		}
		else if ($ilat1 == $ilat2) {
				  if ($ilon1 > $ilon2)
						$result = 90.0;
				  else
						$result = 270.0;
		}
		else if ($ilon1 == $ilon2) {
				if ($ilat1 > $ilat2)
					$result = 180.0;
		}
		else {
				$c = acos(sin($lat2)*sin($lat1) + cos($lat2)*cos($lat1)*cos(($lon2-$lon1)));
				$A = asin(cos($lat2)*sin(($lon2-$lon1))/sin($c));
				$result = rad2deg($A);

				if (($ilat2 > $ilat1) && ($ilon2 > $ilon1)) {
					$result = $result;
				}
				else if (($ilat2 < $ilat1) && ($ilon2 < $ilon1)) {
					$result = 180.0 - $result;
				}
				else if (($ilat2 < $ilat1) && ($ilon2 > $ilon1)) {
					$result = 180.0 - $result;
				}
				else if (($ilat2 > $ilat1) && ($ilon2 < $ilon1)) {
					$result += 360.0;
				}
		}

		return $result;
	}

	/**
		Calculates the direction of the Qibla from any point on
		the Earth From North Clocklwise
	*/
	public function getDirection ($OrigLat, $OrigLong)
    {
		# Kabah Lat=21 Deg N, Long 40 Deg E
		$distance = $this->GreatCircleDistance($OrigLat, $this->destination_latitude, $OrigLong, $this->destination_longitude );
		$bearing = $this->GreatCircleDirection($OrigLat, $this->destination_latitude, $OrigLong, $this->destination_longitude , $distance);
		return $bearing;
	}

}
?>