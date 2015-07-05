<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Measrement
 *
 * @ORM\Entity
 * @ORM\Table(name="measurements")
 */
class Measurement {

	/**
	 *	 @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetime")
	 */
	protected $measurementTime;

	/**
	 * @var float
	 * @ORM\Column(type="float", nullable=true)
	 */
	protected $temperatureOutside;

	/**
	 * @var float
	 * @ORM\Column(type="float", nullable=true)
	 */
	protected $humidityOutside;

	/**
	 * @var float
	 * @ORM\Column(type="float", nullable=true)
	 */
	protected $temperatureInside;

	/**
	 * @var float
	 * @ORM\Column(type="float", nullable=true)
	 */
	protected $humidityInside;


	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 * @return void
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return \DateTime
	 */
	public function getMeasurementTime() {
		return $this->measurementTime;
	}

	/**
	 * @param \DateTime $measurementTime
	 * @return void
	 */
	public function setMeasurementTime($measurementTime) {
		$this->measurementTime = $measurementTime;
	}

	/**
	 * @return float
	 */
	public function getTemperatureInside() {
		return $this->temperatureInside;
	}

	/**
	 * @param float $temperatureInside
	 * @return void
	 */
	public function setTemperatureInside($temperatureInside) {
		$this->temperatureInside = $temperatureInside;
	}

	/**
	 * @return float
	 */
	public function getTemperatureOutside() {
		return $this->temperatureOutside;
	}

	/**
	 * @param float $temperatureOutside
	 * @return void
	 */
	public function setTemperatureOutside($temperatureOutside) {
		$this->temperatureOutside = $temperatureOutside;
	}

	/**
	 * @return float
	 */
	public function getHumidityOutside() {
		return $this->humidityOutside;
	}

	/**
	 * @param float $humidityOutside
	 * @return void
	 */
	public function setHumidityOutside($humidityOutside) {
		$this->humidityOutside = $humidityOutside;
	}

	/**
	 * @return float
	 */
	public function getHumidityInside() {
		return $this->humidityInside;
	}

	/**
	 * @param float $humidityInside
	 * @return void
	 */
	public function setHumidityInside($humidityInside) {
		$this->humidityInside = $humidityInside;
	}

}
