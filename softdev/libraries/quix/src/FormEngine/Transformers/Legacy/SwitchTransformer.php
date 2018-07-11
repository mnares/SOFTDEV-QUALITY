<?php

namespace ThemeXpert\FormEngine\Transformers\Legacy;

class SwitchTransformer extends TextTransformer
{
    /**
     * Get switch value.
     *
     * @param $config
     *
     * @return mixed|null
     */
    public function getValue($config)
    {
        return $this->get($config, 'value', false);
    }
}
