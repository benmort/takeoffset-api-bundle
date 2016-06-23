<?php

namespace TakeOffset\ApiBundle\Client;

use Guzzle\Plugin\History\HistoryPlugin;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;

/**
 * Middleware between the BookingEngine and the data model
 * Communicate with the API hosted on a Phoenix instance running on a local or distant server.
 */
interface TakeOffsetClientInterface
{
    /**
     * Create new Prodigy Rest client.
     * service definition 'prodigy_rest_client' which defines default connection details.
     *
     * @param string        $host      Hostname of the server hosting the Phoenix instance
     * @param string        $port      Port number to listen to on the server
     * @param string        $basePath  Url path to Phoenix
     * @param bool          $authority Whether to use ssl certificate or not
     * @param Logger        $logger    Monolog log channel
     */
    public function __construct($host, $port, $basePath, $authority, Logger $logger);

    /**
     * Find flights for given search options.
     *
     * @param Search $search
     *
     * @return array
     */
    public function get(Search $search);

}
