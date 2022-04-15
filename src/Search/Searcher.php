<?php

namespace MercuryHolidays\Search;

use MercuryHolidays\Search\Hotel;

class Searcher
{
    public $properties = array();

    public function add(array $properties): void
    {
        // Add hotels to the properties array using the Hotel class
        foreach ($properties as $property) {
            array_push($this->properties, new Hotel(
                $property['name'],
                $property['available'],
                $property['floor'],
                $property['room_no'],
                $property['price']
            ));
        }
    }

    public function search(int $roomsRequired, $minimum, $maximum): array
    {
        // populate sample data
        $this->add($this->get_data());

        $filtered_hotels = [];
      
        if($roomsRequired > 1){
            
            $hotels = [];
            
            // Filter hotels by price and availability and add to array $hotels
            foreach($this->properties as $property) {
                // Check if price is between $minimum and $maximum and available is true and add to array $hotels
                if($this->check_price_and_availability($property, $minimum, $maximum)) {
                    array_push($hotels,$property);
                }
            }
            // Reorder hotels by room number
            usort($hotels, [Searcher::class, "cmp_room_no"]);
            array_values($hotels);
            
            $count_hotel_iteration = 0;
            // Add hotels to $filtered_hotels array
            foreach ($hotels as $hotel) { 
                $count_hotel_iteration++;

                if(empty($filtered_hotels)){ // if $filtered_hotels is empty
                    // Add hotel to $filtered_hotels array 
                    array_push($filtered_hotels, $hotel);
                } else{
                    // Get last hotel in $filtered_hotels array
                    $last_element = end($filtered_hotels);
                    
                    // determine if room number is adjacent to last hotel room number. Add hotel to $filtered_hotels array
                    if( ($hotel->room_no - $last_element->room_no) === 1 ){ 
                        array_push($filtered_hotels, $hotel);
                    } else{
                    
                        // check last iteration, the number of rooms available is less than number of rooms required
                        if($count_hotel_iteration == count($hotels) && count($filtered_hotels) != $roomsRequired){
                            unset($filtered_hotels); // unset $filtered_hotels
                            $filtered_hotels = array(); // reset $filtered_hotels
                        } else{
                            // Check number of hotels available is equal to number of rooms required, break loop
                            if(count($filtered_hotels) == $roomsRequired){
                                break;
                            } else{
                                // If hotel is not adjacent to last hotel, remove last hotel from $filtered_hotels array then add the current hotel iteration to $filtered_hotels array
                                array_pop($filtered_hotels);
                                array_push($filtered_hotels, $hotel);
                            }
                        }

                    }
                }
            }
             
        } else{ // filter hotels if room required is 1
            $filtered_hotels = array_filter($this->properties,function($property) use ($minimum, $maximum) { 
                // price is between minimum and maximum and available is true
                return $this->check_price_and_availability($property, $minimum, $maximum);
            });
        }
    
        return $filtered_hotels;
    }

    public function check_price_and_availability($property,$minimum, $maximum) : bool
    {
        // Check if price is between $minimum and $maximum and available is true
        return (
            ($property->get_price() >= $minimum && $property->get_price() <= $maximum) 
            && 
            $property->get_available() == 'True'
        );
    }

    static function cmp_room_no($a, $b)
    {
        return $a->room_no <=> $b->room_no;
    }

    public function get_data(): array
    {
        // create and return sample data based on Readme.md
        $prop1 = array(
            'name' => 'Hotel A',
            'available' => 'False',
            'floor' => 1,
            'room_no' => 1,
            'price' => 25.80,
        );
        $prop2 = array(
            'name' => 'Hotel A',
            'available' => 'False',
            'floor' => 1,
            'room_no' => 2,
            'price' => 25.80,
        );
        $prop3 = array(
            'name' => 'Hotel A',
            'available' => 'True',
            'floor' => 1,
            'room_no' => 3,
            'price' => 25.80,
        );
        $prop4 = array(
            'name' => 'Hotel A',
            'available' => 'True',
            'floor' => 1,
            'room_no' => 4,
            'price' => 25.80,
        );
        $prop5 = array(
            'name' => 'Hotel A',
            'available' => 'False',
            'floor' => 1,
            'room_no' => 5,
            'price' => 25.80,
        );
        $prop6 = array(
            'name' => 'Hotel A',
            'available' => 'False',
            'floor' => 2,
            'room_no' => 6,
            'price' => 30.10,
        );
        $prop7 = array(
            'name' => 'Hotel A',
            'available' => 'True',
            'floor' => 2,
            'room_no' => 7,
            'price' => 35.00,
        );
        $prop8 = array(
            'name' => 'Hotel B',
            'available' => 'True',
            'floor' => 1,
            'room_no' => 1,
            'price' => 45.80,
        );
        $prop9 = array(
            'name' => 'Hotel B',
            'available' => 'False',
            'floor' => 1,
            'room_no' => 2,
            'price' => 45.80,
        );
        $prop10 = array(
            'name' => 'Hotel B',
            'available' => 'True',
            'floor' => 1,
            'room_no' => 3,
            'price' => 45.80,
        );
        $prop11 = array(
            'name' => 'Hotel B',
            'available' => 'True',
            'floor' => 1,
            'room_no' => 4,
            'price' => 45.80,
        );
        $prop12 = array(
            'name' => 'Hotel B',
            'available' => 'False',
            'floor' => 1,
            'room_no' => 5,
            'price' => 45.80,
        );
        $prop13 = array(
            'name' => 'Hotel B',
            'available' => 'False',
            'floor' => 1,
            'room_no' => 6,
            'price' => 49.00,
        );
        $prop14 = array(
            'name' => 'Hotel B',
            'available' => 'False',
            'floor' => 1,
            'room_no' => 7,
            'price' => 49.00,
        );
        
        return array($prop1,$prop2,$prop3,$prop4,$prop5,$prop6,$prop7,$prop8,$prop9,$prop10,$prop11,$prop12,$prop13,$prop14);
    }
}
