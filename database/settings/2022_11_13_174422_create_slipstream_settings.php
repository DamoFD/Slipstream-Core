<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateSlipstreamSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Slipstream');
        $this->migrator->add('general.guests_can_see_tag_info', true);
        $this->migrator->add('general.hls_streaming_bitrates', [360=>1000,720=>10000,1080=>25000,1440=>33000,2160=>50000]);
    }
}
