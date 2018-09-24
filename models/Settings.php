<?php

    namespace VojtaSvoboda\Reviews\Models;

    use Lang, Model;
    use Cms\Classes\Theme;
    use Cms\Classes\Page;

    class Settings extends Model {

        public $implement      = ['System.Behaviors.SettingsModel'];
        public $settingsCode   = 'vojtasvoboda_reviews_settings';
        public $settingsFields = 'fields.yaml';

    }

?>