<?php
// Created by dealloc, All rights reserved.

namespace Dealloc\FCM\Contracts;

/**
 * Interface FirebaseNotification represents a generic contract to a Firebase Cloud Message.
 * @package Dealloc\FCM\Contracts
 */
interface FirebaseNotification
{
    /**
     * Get the title of the notification.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Get the body of the notification.
     *
     * @return string
     */
    public function getBody();

    /**
     * Get the meta data of the array (data payload)
     *
     * @return array
     */
    public function getMetadata();

    /**
     * Get the receivers for this notification.
     *
     * @return string|array
     */
    public function getTopic();
}