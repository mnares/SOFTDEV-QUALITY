<?php

namespace ThemeXpert\FormEngine\Transformers;

class DimensionsTransformer extends TextTransformer
{
    /**
     * Get the dimensions type.
     *
     * @param        $config
     * @param string $type
     *
     * @return string
     */
    public function getType($config, $type = "")
    {
        return "dimensions";
    }

    /**
     * Get the dimensions value.
     *
     * @param $config
     *
     * @return array|mixed|null
     */
    public function getValue($config)
    {
        $value = $this->get($config, "value", null);

        if(!isset($config['responsive'])) {
            $config['responsive'] = false;
        }

        $responsive = true;

        if ($value === null) {
            return [
                "top" => "",
                "left" => "",
                "bottom" => "",
                "right" => "",
                "responsive" => $responsive,
                "responsive_preview" => false,
                "tablet" => [
                    "top" => "",
                    "left" => "",
                    "bottom" => "",
                    "right" => ""
                ],
                "phone" => [
                    "top" => "",
                    "left" => "",
                    "bottom" => "",
                    "right" => ""
                ]
            ];
        } else {
            $defaultValue = (array)$value;

            if(!isset($value["responsive_preview"])) {
                $value["responsive_preview"] = false;
                $value["responsive"] = $responsive;

                $value["tablet"] = [
                    "top" => "",
                    "left" => "",
                    "bottom" => "",
                    "right" => ""
                ];

                $value["phone"] = [
                    "top" => "",
                    "left" => "",
                    "bottom" => "",
                    "right" => ""
                ];
            }

            $value = array_merge($value, $defaultValue);
        }

        $value = array_pick($value,
            ["top", "left", "bottom", "right", "desktop", "phone", "tablet", "responsive_preview", "responsive"],
            true); //exclusive

        return $value;
    }
}
