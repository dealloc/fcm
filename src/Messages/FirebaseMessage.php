<?php
// Created by dealloc, All rights reserved.

namespace Dealloc\FCM\Messages;

/**
 * Class FirebaseMessage represents a message to send to the Firebase Cloud Message server.
 * @package Dealloc\FCM\Messages
 */
class FirebaseMessage
{
    private $to = null;
    private $notification = null;
    private $data = null;

    /**
     * Set the topic(s) to send the message to.
     *
     * @param string|array $topic
     * @return $this
     */
    public function toTopic($topic)
    {
        if ( is_array($topic) ) {
            return null;
        } else {
            $this->to = '/topics/' . $topic;
        }

        return $this;
    }

    /**
     * Set the notification body for the message.
     *
     * @param string $title
     * @param string $body
     * @return $this
     */
    public function setContent($title, $body)
    {
        $this->notification = compact('title', 'body');

        return $this;
    }

    /**
     * Set custom meta data to be send to the server.
     * This *MUST* be an associative array.
     *
     * @param null $payload
     * @return $this
     */
    public function setMeta($payload = null)
    {
        $this->data = $payload;

        return $this;
    }

    public function serialize()
    {
        $filtered = array_filter([
            'to' => $this->to,
            'notification' => $this->notification,
            'data' => $this->data,
        ]);

        return json_encode($filtered);
    }
}