<?php
// Created by dealloc, All rights reserved.

namespace Dealloc\FCM\Channels;

use Dealloc\FCM\Messages\FirebaseMessage;
use Illuminate\Contracts\Config\Repository as Config;
use GuzzleHttp\Client;
use Dealloc\FCM\Contracts\FirebaseNotification as Notification;

/**
 * Class FirebaseChannel integrates the Laravel notification system with Firebase cloud messaging.
 * @package Dealloc\FCM\Channels
 */
class FirebaseChannel
{
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
        $message = $notification->toFCM($notifiable, new FirebaseMessage);

        $this->client->post(FirebaseChannel::API_URI, [
            'headers' => [
                'Authorization' => 'key=' . $this->getApiKey(),
                'Content-Type' => 'application/json',
            ],
            'body' => $message->serialize(),
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
}