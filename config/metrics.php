<?php

return [
  /**
   * The secret used to protect the /metrics endpoint.
   * This endpoint should be only accessed by Fly.io.
   */
  'secret' => env('METRICS_SECRET'),
];
