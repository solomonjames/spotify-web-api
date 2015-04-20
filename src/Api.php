<?php

namespace Spotify\WebApi;

class Api
{
    public function search()
    {
        return new Endpoint\Search();
    }
}
