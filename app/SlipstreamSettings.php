<?php

namespace App;

use Spatie\LaravelSettings\Settings;

class SlipstreamSettings extends Settings
{

    public string $site_name;

    public bool $guests_can_see_tag_info;

    public array $hls_streaming_bitrates;

    public static function group(): string
    {
        return 'general';
    }
}
