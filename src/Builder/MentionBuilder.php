<?php
namespace Kaom\Mentions\Builder;

use Collective\Html\FormBuilder;

class MentionBuilder extends FormBuilder
{
    /**
     * Create a text input field.
     *
     * @param string $name
     * @param string $value
     * @param string $type
     * @param string $column
     *
     * @return string
     */
    public function asText($name, $value, $type, $column)
    {
        $input = $this->text($name, $value, [
            'id' => 'mention-'.$name,
        ]);

        $scriptTag = '<script type="text/javascript">$(function(){enableMentions("#mention-'.$name.'", "'.$type.'", "'.$column.'");});</script>';

        return $scriptTag.$input;
    }

    /**
     * Create a textarea input field.
     *
     * @param string $name
     * @param string $value
     * @param string $column
     *
     * @return string
     */
    public function asTextArea($name, $value, $model, $column)
    {
        $input = $this->textarea($name, $value, [
            'id' => 'mention-'.$name,
        ]);

        $scriptTag = '<script type="text/javascript">$(function(){enableMentions("#mention-'.$name.'", "'.$type.'", "'.$column.'");});</script>';

        return $scriptTag.$input;
    }
}
