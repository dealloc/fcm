<?php
// Created by dealloc, All rights reserved.

namespace Dealloc\FCM;

/**
 * Class FirebaseTopicsBuilder chains a set of topics together so that FCM can understand them
 *
 * @package Dealloc\FCM
 */
trait FirebaseTopicsBuilder
{
    public function chainTopics($topics = []) {
        return $topics; // TODO change to Firebase topics form
    }
}