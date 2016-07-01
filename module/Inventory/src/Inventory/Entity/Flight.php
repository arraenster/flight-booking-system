<?php
namespace Inventory\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Flight entity
 *
 * @ORM\Entity
 * @ORM\Table(name="flight")
 *
 * @author: Vladyslav Semerenko <vladyslav.semerenko@gmail.com>
 */
class Flight
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $origin;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $destination;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $flightDate;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $airline;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $aircraft;

    /**
     * @var int
     * @ORM\Column(type="integer", length=100, nullable=false)
     */
    protected $flightNumber;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $availability;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=false)
     */
    protected $price;

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $origin
     * @return $this
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param string $destination
     * @return mixed
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
        return $destination;
    }

    /**
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param string $flightDate
     * @return $this
     */
    public function setFlightDate($flightDate)
    {
        $this->flightDate = $flightDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getFlightDate()
    {
        return $this->flightDate;
    }

    /**
     * @param string $airline
     * @return $this
     */
    public function setAirline($airline)
    {
        $this->airline = $airline;
        return $this;
    }

    /**
     * @return string
     */
    public function getAirline()
    {
        return $this->airline;
    }

    /**
     * @param string $aircraft
     * @return $this
     */
    public function setAircraft($aircraft)
    {
        $this->aircraft = $aircraft;
        return $this;
    }

    /**
     * @param int $flightNumber
     * @return $this
     */
    public function setFlightNumber($flightNumber)
    {
        $this->flightNumber = $flightNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getFlightNumber()
    {
        return $this->flightNumber;
    }

    /**
     * @param int $availability
     * @return $this
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;
        return $this;
    }

    /**
     * @return int
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * @param float $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Helper function.
     */
    public function exchangeArray($data)
    {
        foreach ($data as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = ($val !== null) ? $val : null;
            }
        }
    }
    /**
     * Helper function
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}
