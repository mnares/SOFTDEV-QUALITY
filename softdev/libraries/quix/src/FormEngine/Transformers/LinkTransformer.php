<?php

namespace ThemeXpert\FormEngine\Transformers;

class LinkTransformer extends TextTransformer
{
    /**
     * Get the link value.
     *
     * @param $config
     *
     * @return array
     */
    public function getValue($config)
    {
        $value = (array) $this->get($config, "value", []);

        if (count($value) === 0) {
            return [
                "url" => "",
                "target" => "",
                "nofollow" => false
            ];
        } else {
            $value = (array)$value;
        }

        # We do not need any of them that was not defined
        $value = array_pick($value, ["url", "target", "nofollow"], true); //exclusive

        return $value;
    }
}
