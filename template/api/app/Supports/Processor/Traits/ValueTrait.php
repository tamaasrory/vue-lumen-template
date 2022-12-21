<?php

namespace App\Supports\Processor\Traits;

/**
 * Trait PHPValueTrait
 * @package Krlove\CodeGenerator\Model\Traits
 */
trait ValueTrait
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    protected function renderValue()
    {
        return $this->renderTyped($this->value);
    }

    /**
     * @param mixed $value
     * @return string|null
     */
    protected function renderTyped($value)
    {
        $type = gettype($value);

        switch ($type) {
            case 'boolean':
                $value = $value ? 'true' : 'false';

                break;
            case 'int':
                // do nothing

                break;
            case 'string':
                $value = sprintf('\'%s\'', addslashes($value));

                break;
            case 'array':
                $parts = [];
                foreach ($value as $key => $item) {
                    $val = $this->renderTyped($item);
                    if (is_string($key)) {
                        $val = "'{$key}' => " . $val;
                    }
                    $parts[] = $val;
                }
                $value = '[' . implode(', ', $parts) . ']';

                break;
            default:
                $value = null; // TODO: how to render null explicitly?
        }

        return $value;
    }
}
