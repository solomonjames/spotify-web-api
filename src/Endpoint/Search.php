<?php

namespace Spotify\WebApi\Endpoint;

class Search
{
    const OPERATOR_OR        = 'OR';

    const OPERATOR_NOT       = 'NOT';

    const FILTER_YEAR        = 'year:';

    const FILTER_TAG_NEW     = 'tag:new';

    const FILTER_TAG_HIPSTER = 'tag:hipster';

    private $type;

    private $query = [];

    public function artist()
    {
        $this->type = self::TYPE_ARTIST;

        return $this;
    }

    public function album()
    {
        $this->type = self::TYPE_ALBUM;

        return $this;
    }

    public function track()
    {
        $this->type = self::TYPE_TRACK;

        return $this;
    }

    public function playlist()
    {
        $this->type = self::TYPE_PLAYLIST;

        return $this;
    }

    public function isHipster()
    {
        $this->query[] = self::FILTER_TAG_HIPSTER;

        return $this;
    }

    public function isNew()
    {
        $this->query[] = self::FILTER_TAG_NEW;

        return $this;
    }

    public function year($filterYear)
    {
        $this->query[] = self::FILTER_YEAR . $filterYear;

        return $this;
    }

    public function not($keyword)
    {
        if (!isset($this->query[OPERATOR_NOT])) {
            $this->query[OPERATOR_NOT] = [];
        }

        $this->query[OPERATOR_NOT][] = $keyword;

        return $this;
    }

    public function or($keyword)
    {
        if (isset($this->query[self::OPERATOR_OR])) {
            throw new Exception\SearchException('Only one OR statement is allowed at a time.');
        }

        $this->query[self::OPERATOR_OR] = $keyword;

        return $this;
    }
}
