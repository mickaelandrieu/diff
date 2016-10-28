<?php

namespace Diff;

/**
 * Line structure from git diff.
 */
class Line
{
    const TOKEN_PLUS = '+';
    const TOKEN_MINUS = '-';
    const TOKEN_FILENAME = 'diff --git a/';

    private $content;

    public function __construct($lineContent)
    {
        $this->content = $lineContent;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function isAddition()
    {
        return 0 === strpos($this->content, self::TOKEN_PLUS);
    }

    public function isDeletion()
    {
        return 0 === strpos($this->content, self::TOKEN_MINUS);
    }

    public function isFilename()
    {
        return 0 === strpos($this->content, self::TOKEN_FILENAME);
    }

    public function getFilepath()
    {
        if ($this->isFilename()) {
            return basename(substr($this->content, strlen(self::TOKEN_FILENAME)));
        }
    }

    public function match($regexp)
    {
        return 1 === preg_match($regexp, $this->content);
    }
}
