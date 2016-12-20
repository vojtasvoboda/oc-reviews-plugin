<?php namespace VojtaSvoboda\Reviews\FormWidgets;

use Backend\Classes\FormWidgetBase;

/**
 * StarRating Form Widget
 */
class StarRating extends FormWidgetBase
{
    protected $defaultAlias = 'starrating';

    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('starrating');
    }

    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;
    }

    public function loadAssets()
    {
        $this->addCss('css/jquery.rateyo.min.css', 'VojtaSvoboda.Reviews');
        $this->addJs('js/jquery.rateyo.min.js', 'VojtaSvoboda.Reviews');
        $this->addJs('js/starrating.js', 'VojtaSvoboda.Reviews');
    }

    public function getSaveValue($value)
    {
        if (!is_numeric($value)) {
            return null;
        }

        return $value;
    }
}
