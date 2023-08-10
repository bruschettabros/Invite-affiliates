<?php

return [
    /*
     * When defining a file, the format is each affiliate on a new line, as a json object containing:
     * name, latitude, longitude, affiliate_id
     */
    'file' => env(
        'AFFILIATES_FILE',
        'https://gist.githubusercontent.com/bruschettabros/2bdc205b1ae188c525402e54a6d0ca95/raw/5c8e4caf30bfb83b3e3dc33b660904c13fcaed76/affiliates.txt'
    ),
    /*
     * This boolean value defines whether to use the local file instead of the remote file.
    */
    'local' => env(
        'AFFILIATES_LOCAL',
        false,
    ),
    /*
    * The distance of the affiliates from the user's location you would like to send invites out to
    */
    'distance' => env(
        'AFFILIATES_DISTANCE',
        100
    ),

    /*
    * The unit to use when calculating the distance between the user and the affiliates.
    * currently only miles and km are supported.
    */
    'unit' => env(
        'DEFAULT_UNIT',
        'km'
    ),
];
