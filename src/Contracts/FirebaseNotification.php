<?php
// Created by dealloc, All rights reserved.

namespace Dealloc\FCM\Contracts;
use Dealloc\FCM\Messages\FirebaseMessage;

/**
 * Interface FirebaseNotification represents a generic contract to a Firebase Cloud Message.
 * @package Dealloc\FCM\Contracts
 */
interface FirebaseNotification
{
    /**
     * Form the notification into the form of a Firebase Cloud Message.
     *
     * @param $notifiable
     * @param FirebaseMessage $message
     * @return FirebaseMessage
     */
    public function toFCM($notifiable, FirebaseMessage $message);
}