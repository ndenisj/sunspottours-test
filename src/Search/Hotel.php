<?php

namespace MercuryHolidays\Search;

class Hotel
{
    //Attributes
    public $name;
    public $available;
    public $floor;
    public $room_no;
    public $price;
 
 
    //Constructor
    function __construct($name, $available, $floor, $room_no, $price)
    {
        $this->name = $name;
        $this->available = $available;
        $this->floor = $floor;
        $this->room_no = $room_no;
        $this->price = $price;
    }
 
    //Get Methods 
    function get_name()
    {
        return $this->name;
    }

    function get_available()
    {
        return $this->available;
    }

    function get_floor()
    {
        return $this->floor;
    }

    function get_room_no()
    {
        return $this->room_no;
    }

    function get_price()
    {
        return $this->price;
    }
}