<?php

namespace Travis;

class FCC
{
	/**
     * Magic method for handling API calls.
     *
     * @param   string  $method
     * @param   array   $args
     * @return  object
     */
    public static function __callStatic($method, $args)
    {
    	// capture arguments
        $args = isset($args[0]) ? $args[0] : array();

        // set endpoint
        $endpoint = null;
        if ($method === 'facility_search')
        {
        	$endpoint = 'http://data.fcc.gov/mediabureau/v01/tv/facility/search/'.$args.'.json';
        }
        elseif ($method === 'facility_details')
        {
        	$endpoint = 'http://data.fcc.gov/mediabureau/v01/tv/facility/id/'.$args.'.json';
        }

        // Note that the endpoint shown on the FCC API documentation page is wrong.
        // The above is what is actually in use as of 2014-10-23.

        // catch error...
        if (!$endpoint) trigger_error('Invalid method.');

        // setup curl request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        // if errors...
        if (curl_errno($ch))
        {
            #$errors = curl_error($ch);
            curl_close($ch);

            // return false
            return false;
        }

    	// close
        curl_close($ch);

        // return
        return json_decode($response);
    }
}