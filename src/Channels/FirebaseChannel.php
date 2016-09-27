<?php
// Created by dealloc, All rights reserved.

namespace Dealloc\FCM\Channels;

use Illuminate\Contracts\Config\Repository as Config;
use Dealloc\FCM\FirebaseTopicsBuilder;
use GuzzleHttp\Client;
use Dealloc\FCM\Contracts\FirebaseNotification as Notification;

/**
 * Class FirebaseChannel integrates the Laravel notification system with Firebase cloud messaging.
 * @package Dealloc\FCM\Channels
 */
class FirebaseChannel
{
    use FirebaseTopicsBuilder;

    const API_URI = 'https://fcm.googleapis.com/fcm/send';
    /**
     * @var Client
     */
    private $client;
    /**
     * @var Config
     */
    private $config;

    /**
     * FirebaseChannel constructor.
     * @param Client $client
     * @param Config $config
     */
    public function __construct(Client $client, Config $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * Send a notification to the Firebase servers.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $this->client->post(FirebaseChannel::API_URI, [
            'headers' => [
                'Authorization' => 'key=' . $this->getApiKey(),
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($this->getPayload($notification)),
        ]);
    }

    /**
     * Get the API key to connect to Firebase
     *
     * @return string
     */
    private function getApiKey()
    {
        return $this->config->get('services.firebase.api_key');
    }

    /**
     * Build the payload to send to the Firebase servers.
     *
     * @param Notification $notification
     * @return array
     */
    private function getPayload(Notification $notification)
    {
        $receivers = $notification->getTopic();

        $payload = [
            'to' => ( is_array($receivers) ? $this->chainTopics($receivers) : $receivers ),
            'notification' => [
                'title' => $notification->getTitle(),
                'body' => $notification->getBody(),
            ],
            'data' => $notification->getMetadata(),
        ];

        if ( empty($payload['data']) ) {
            unset($payload['data']);
        }

        return $payload;
    }
}