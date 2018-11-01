<?php

namespace Dto;


trait LoadFromArray
{
    public static function loadFromArray(array $data)
    {
        $self = new static();
        foreach ($data as $propertyName => $propertyValue) {
            if (!property_exists($self, $propertyName)) {
                continue;
            }
            $self->$propertyName = $propertyValue;
        }

        return $self;
    }
}