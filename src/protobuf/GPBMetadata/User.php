<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: User.proto

namespace GPBMetadata;

class User
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(hex2bin(
            "0a650a0a557365722e70726f746f120870726f746f62756622450a045573" .
            "6572120a0a02696418012001280512100a08757365726e616d6518022001" .
            "2809120d0a05726f6c657318032003280912100a0870617373776f726418" .
            "0420012809620670726f746f33"
        ), true);

        static::$is_initialized = true;
    }
}
