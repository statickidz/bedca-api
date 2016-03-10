<?php

namespace StaticKidz\BedcaAPI;

use StaticKidz\BedcaAPI\Request\BedcaXMLRequests;

/**
 * API client for Spanish Food Composition Database (BEDCA)
 *
 * @author      StaticKidz <statickidz@gmail.com>
 * @link        https://statickidz.com/
 * @license     MIT
 */
class BedcaClient
{
    private $apiBase = 'http://www.bedca.net/bdpub/procquery.php';

    /**
     * @param $foodId
     * @param bool $rawXML
     * @return mixed
     */
    public function getFood($foodId, $rawXML = false)
    {
        $foodGroupXML = BedcaXMLRequests::getFoodXML($foodId);

        if ($rawXML) {
            return $this->curlXMLRequest($this->apiBase, $foodGroupXML);
        } else {
            return $this->XMLToStdClass($this->curlXMLRequest($this->apiBase, $foodGroupXML));
        }
    }

    /**
     * @param bool $rawXML
     * @return mixed
     */
    public function getFoodGroups($rawXML = false)
    {
        $foodGroupXML = BedcaXMLRequests::getFoodGroupsXML();

        if ($rawXML) {
            return $this->curlXMLRequest($this->apiBase, $foodGroupXML);
        } else {
            return $this->XMLToStdClass($this->curlXMLRequest($this->apiBase, $foodGroupXML));
        }
    }

    /**
     * @param $foodGroupId
     * @param bool $rawXML
     * @return mixed
     */
    public function getFoodsInGroup($foodGroupId, $rawXML = false)
    {
        $foodGroupXML = BedcaXMLRequests::getFoodGroupXML($foodGroupId);

        if ($rawXML) {
            return $this->curlXMLRequest($this->apiBase, $foodGroupXML);
        } else {
            return $this->XMLToStdClass($this->curlXMLRequest($this->apiBase, $foodGroupXML));
        }
    }

    /**
     * @param $xml
     * @return mixed
     */
    private function XMLToStdClass($xml)
    {
        $resultXML = simplexml_load_string($xml);
        $foodStdClass = json_decode(json_encode($resultXML));
        return $foodStdClass;
    }

    /**
     * @param $url
     * @param $xml
     * @return mixed
     */
    private function curlXMLRequest($url, $xml)
    {
        $headers = array(
            "Content-Type: text/xml",
            "Connection: close",
        );

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // Execute post
        $result = curl_exec($ch);

        // Close connection
        curl_close($ch);

        return $result;
    }
}
