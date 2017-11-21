<?php

namespace src;

class Component {
    public function __construct($config = []) {
        foreach ($config as $key => $value) {
            $this->{$key} = $value;
        }
    }
}