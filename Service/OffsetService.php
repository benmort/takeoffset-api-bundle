<?php

namespace HappyR\Google\ApiBundle\Services;

/**
 * Class YoutubeService
 *
 * This is the class that communicates with YouTube api
 */
class OffsetService
{
    /**
     * @var TakeOffsetClientRest client
     */
    public $client;

    /**
     * Constructor
     * @param TakeOffsetClientRest $client
     */
    public function __construct(TakeOffsetClientRest $client)
    {
        $this->client = $client;
        parent::__construct($client->getTakeOffsetClientRest());
    }

    /**
     * Get status of a video
     * Return an array like this one:
     * array(
     *    "uploadStatus"        => "processed",
     *    "privacyStatus"       => "public",
     *    "license"             => "youtube",
     *    "embeddable"          => true,
     *    "publicStatsViewable" => true
     * )
     *
     * @param  string $videoId
     * @return array
     */
    public function getStatus($videoId)
    {
        $listResponse = $this->videos->listVideos('status', array('id' => $videoId));
        if (empty($listResponse)) {
            throw new \RuntimeException(sprintf('Could not find video with id %s', $videoId));
        }

        return $listResponse['modelData']['items'][0]['status'];
    }

        return $videoSnippet['thumbnails'][$format];
    }

}
