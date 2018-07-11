<?php

namespace ThemeXpert\FormEngine\Transformers;

class TypographyTransformer extends SliderTransformer
{
    /**
     * Get type for the typography.
     *
     * @param        $config
     * @param string $type
     *
     * @return string
     */
    public function getType($config, $type = "")
    {
        return "typography";
    }

    /**
     * Transform the slider.
     *
     * @param $config
     *
     * @return array
     */
    public function transform($config, $path)
    {
        $c = parent::transform($config, $path);

        $c['value'] = $this->getValue($config);
        $c['default'] = $this->getDefaultValue($config);

        return $c;
    }

    /**
     * Get default value.
     */
    public function getDefaultValue()
    {
        return [
            "family" => "",
            "weight" => "",
            "size" => [
                'desktop' => 0,
                'tablet' => 0,
                'phone' => 0
            ],
            "transform" => '',
            "style" =>'',
            "decoration" =>'',
            "spacing" => [
                'desktop' => 0,
                'tablet' => 0,
                'phone' => 0
            ],
            "height" => [
                'desktop' => 1,
                'tablet' => 1,
                'phone' => 1
            ],
        ];
    }

    /**
     * Get typography value.
     *
     * @param $config
     *
     * @return array|mixed|null
     */
    public function getValue($config)
    {
        $value = $this->get($config, "value", null);

        if ($value === null) {
            return $this->getDefaultValue();
        } else {
            $value = (array)$value;
        }

        $value = array_pick($value, [
            "family",
            "weight",
            "size",
            "transform",
            "style",
            "decoration",
            "spacing",
            "height",
        ], true); //exclusive

        return $value;
    }

    /**
     * Get desktop value.
     *
     * @param $config
     * @return mixed
     */
    public function getDesktopValue($config)
    {
        return $this->getValue($config)['size'];
    }

    /**
     * Determine element is by default responsive mode.
     *
     * @return bool
     */
    public function isResponsive()
    {
        return true;
    }
}
