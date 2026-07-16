<?php

return [
    /**
     * Ensures hashids are unique to project. Preferrably, use a value
     * that won't change during the project's lifetime.
     */
    'salt' => env("HASHID_SALT",'Think analyze and Build'),

    /**
     * Length of the generated hashid.
     */
    'length' => env('HASHID_LENGTH',16),

    /**
     * Character set used to generate the hashids.
     */
    'charset' =>  env('HASHID_ALPHABET','abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'),

    /**
     * Prefix attached to the generated hash.
     */
    'prefix' => '',

    /**
     * Suffix attached to the generated hash.
     */
    'suffix' => '',

    /**
     * If a prefix of suffix is defined, we use this as a separator
     * between the prefix/suffix.
     */
    'separator' => '-',
];
