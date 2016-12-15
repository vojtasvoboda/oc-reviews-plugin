<?php

return [

    /**
     * Review random hash. Useful for identify review by some unique non predictable identifier. For disable set to 0.
     */
    'hash' => 32,

    /**
     * Minimum amount of time between two form submissions.
     *
     * @see http://carbon.nesbot.com/docs/ for syntax
     */
    'protection_time' => '-30 seconds',

];
