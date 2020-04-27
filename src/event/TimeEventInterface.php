<?php


namespace App\event;


interface TimeEventInterface
{
    public function createdAt();
    public function updatedAt();
}