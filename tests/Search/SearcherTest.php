<?php 

namespace Tests\Search;

use MercuryHolidays\Search\Hotel;
use MercuryHolidays\Search\Searcher;
use PHPUnit\Framework\TestCase;

class SearcherTest extends TestCase
{
    public function testSearchDoesReturnEmptyArray(): void
    {
        $searcher = new Searcher(); // instantiate Searcher class

        $this->assertEmpty($searcher->search(0, 0, 0)); // assert that search method returns empty array
    }

    public function testSearchReturnArray(): void
    {
        $searcher = new Searcher(); // instantiate Searcher class

        $this->assertIsArray($searcher->search(2, 20, 30)); // assert that search method returns array
    }

    /** @test */
    public function count_number_of_array()
    {
        $searcher = new Searcher(); // instantiate Searcher class

        $this->assertCount(3, $searcher->search(1, 25, 40)); // assert that search method returns array with 3 elements
    }

    /** @test */
    public function check_if_array_contains_hotel_object()
    {
        $searcher = new Searcher(); // instantiate Searcher class

        $this->assertContainsOnlyInstancesOf(Hotel::class, $searcher->search(1, 25, 40)); // assert that search method returns array with Hotel objects
    }

    /** @test */
    public function check_if_array_is_empty_when_required_rooms_is_above_2_in_sample_data()
    {
        $searcher = new Searcher(); // instantiate Searcher class

        $this->assertEmpty($searcher->search(3, 25, 40)); // assert that search method returns empty array when required rooms is above 2 in sample data
    }


    /** @test */
    public function check_if_array_contains_hotel_object_with_correct_sample_data_1()
    {
        $searcher = new Searcher(); // instantiate Searcher class

        $hotels = $searcher->search(2, 20, 30); // get hotels array from search method

        $this->assertEquals('Hotel A', $hotels[0]->get_name()); // assert that hotel name is Hotel A
        $this->assertEquals('True', $hotels[0]->get_available()); // assert that hotel is available
        $this->assertEquals(1, $hotels[0]->get_floor()); // assert that hotel floor is 1
        $this->assertEquals(3, $hotels[0]->get_room_no()); // assert that hotel room number is 3
        $this->assertEquals(25.80, $hotels[0]->get_price()); // assert that hotel price is 25.80

        $this->assertEquals('Hotel A', $hotels[1]->get_name()); // assert that hotel name is Hotel A
        $this->assertEquals('True', $hotels[1]->get_available()); // assert that hotel is available
        $this->assertEquals(1, $hotels[1]->get_floor()); // assert that hotel floor is 1
        $this->assertEquals(4, $hotels[1]->get_room_no()); // assert that hotel room number is 4
        $this->assertEquals(25.80, $hotels[1]->get_price()); // assert that hotel price is 25.80

    }

    /** @test */
    public function check_if_array_contains_hotel_object_with_correct_sample_data_2()
    {
        $searcher = new Searcher(); // instantiate Searcher class

        $hotels = $searcher->search(2, 30, 50); // get hotels array from search method

        $this->assertEquals('Hotel B', $hotels[0]->get_name()); // assert that hotel name is Hotel B
        $this->assertEquals('True', $hotels[0]->get_available()); // assert that hotel is available
        $this->assertEquals(1, $hotels[0]->get_floor()); // assert that hotel floor is 1
        $this->assertEquals(3, $hotels[0]->get_room_no()); // assert that hotel room number is 3
        $this->assertEquals(45.80, $hotels[0]->get_price()); // assert that hotel price is 45.80

        $this->assertEquals('Hotel B', $hotels[1]->get_name()); // assert that hotel name is Hotel B
        $this->assertEquals('True', $hotels[1]->get_available()); // assert that hotel is available
        $this->assertEquals(1, $hotels[1]->get_floor()); // assert that hotel floor is 1
        $this->assertEquals(4, $hotels[1]->get_room_no()); // assert that hotel room number is 4
        $this->assertEquals(45.80, $hotels[1]->get_price()); // assert that hotel price is 45.80

    }

    /** @test */
    public function check_if_array_contains_hotel_object_with_correct_sample_data_3()
    {
        $searcher = new Searcher(); // instantiate Searcher class

        $hotels = $searcher->search(1, 25, 40); // get hotels array from search method

        $this->assertEquals('Hotel A', $hotels[2]->get_name()); // assert that hotel name is Hotel A
        $this->assertEquals('True', $hotels[2]->get_available()); // assert that hotel is available
        $this->assertEquals(1, $hotels[2]->get_floor()); // assert that hotel floor is 1
        $this->assertEquals(3, $hotels[2]->get_room_no()); // assert that hotel room number is 3
        $this->assertEquals(25.80, $hotels[2]->get_price()); // assert that hotel price is 25.80

        $this->assertEquals('Hotel A', $hotels[3]->get_name()); // assert that hotel name is Hotel A
        $this->assertEquals('True', $hotels[3]->get_available()); // assert that hotel is available
        $this->assertEquals(1, $hotels[3]->get_floor()); // assert that hotel floor is 1
        $this->assertEquals(4, $hotels[3]->get_room_no()); // assert that hotel room number is 4
        $this->assertEquals(25.80, $hotels[3]->get_price()); // assert that hotel price is 25.80

        $this->assertEquals('Hotel A', $hotels[6]->get_name()); // assert that hotel name is Hotel A
        $this->assertEquals('True', $hotels[6]->get_available()); // assert that hotel is available
        $this->assertEquals(2, $hotels[6]->get_floor()); // assert that hotel floor is 2
        $this->assertEquals(7, $hotels[6]->get_room_no()); // assert that hotel room number is 7
        $this->assertEquals(35.00, $hotels[6]->get_price()); // assert that hotel price is 35.00
    }
}
