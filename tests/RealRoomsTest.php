<?php
use Advent\RealRooms;

/**
 * RealRoomsTest -
 *
 */
class RealRoomsTest extends PHPUnit_Framework_TestCase
{
    // TC comes from the website examples. (TC = Test Case)
    public function testRealRoomTC1()
    {
        $realRooms = new RealRooms();
        $this->assertEquals(123, $realRooms->findRealRooms(['aaaaa-bbb-z-y-x-123[abxyz]']));
    }

    public function testRealRoomTC2()
    {
        $realRooms = new RealRooms();
        $this->assertEquals(987, $realRooms->findRealRooms(['a-b-c-d-e-f-g-h-987[abcde]']));
    }

    public function testRealRoomTC3()
    {
        $realRooms = new RealRooms();
        $this->assertEquals(404, $realRooms->findRealRooms(['not-a-real-room-404[oarel]']));
    }

    public function testRealRoomTC4()
    {
        $realRooms = new RealRooms();
        $this->assertEquals(0, $realRooms->findRealRooms(['totally-real-room-200[decoy]']));
    }

    public function testRealRoomOutOfOrder()
    {
        $realRooms = new RealRooms();
        $this->assertEquals(987, $realRooms->findRealRooms(['hh-gg-aaa-bbb-ccc-dd-ee-ff-987[abcde]']));
    }
}
