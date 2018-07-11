<?php

namespace ThemeXpert\FormEngine\Transformers\Legacy;

class DatePickerTransformer extends TextTransformer
{
    /**
     * Get date picker type.
     *
     * @param        $config
     * @param string $type
     *
     * @return string
     */
    public function getType($config, $type = "")
    {
        return "date";
    }
}
