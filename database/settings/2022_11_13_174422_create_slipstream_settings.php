<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateSlipstreamSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Slipstream');
        $this->migrator->add('general.guests_can_see_tag_info', true);
        $this->migrator->add('general.hls_streaming_bitrates', [360=>100,720=>500,1080=>1000,1440=>1500,2160=>2160]);
    }
}
