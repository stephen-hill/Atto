<?php

namespace Atto\ODM;

class AnnotationParser
{
    /**
     * @var string
     */
    protected $comment;

    /**
     * @var array
     */
    protected $annotations;

    public function __construct($comment)
    {
        $this->setComment($comment);
    }

    public function getAnnotation($name)
    {
        return [];
    }

    protected function setComment($comment)
    {
        $this->comment = $comment;
    }
}