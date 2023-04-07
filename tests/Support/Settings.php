<?php

namespace Tests\Support;

use App\Models\Setting;

class Settings
{
    private Setting $setting;

    private function __construct()
    {
        $this->setting = Setting::factory()->create();
    }

    public static function initialize(): Settings
    {
        return new self();
    }

    public function enableMultipleFullCompanySupport(): void
    {
        $this->update(['full_multiple_companies_support' => 1]);
    }

    /**
     * @param array $attributes Attributes to modify in the application's settings.
     */
    public function set(array $attributes): void
    {
        $this->update($attributes);
    }

    private function update(array $attributes): void
    {
        Setting::unguarded(fn() => $this->setting->update($attributes));
        Setting::$_cache = null;
    }
}
