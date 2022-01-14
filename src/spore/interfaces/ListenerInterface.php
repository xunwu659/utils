<?php


namespace interfaces;


interface ListenerInterface
{
    public function handle($event): void;
}
