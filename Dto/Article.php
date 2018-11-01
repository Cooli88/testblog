<?php

namespace Dto;

class Article
{
    const STATUS_ACTIVE = 'active';
    const STATUS_DELETED = 'deleted';

    use LoadFromArray;

    /** @var integer */
    public $id;
    /** @var string */
    public $title;
    /** @var string */
    public $image_uri;
    /** @var string */
    public $text;
    /** @var string */
    public $status;
    /** @var string */
    public $created_at;
    /** @var string */
    public $updated_at;
}