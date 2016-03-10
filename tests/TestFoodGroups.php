<?php
namespace StaticKidz\BedcaAPI\Tests;

use PHPUnit_Framework_TestCase;
use StaticKidz\BedcaAPI\BedcaClient;

/**
 * @property BedcaClient api
 */
class TestFoodGroups extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->api = new BedcaClient();
    }
}