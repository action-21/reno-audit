<?php

namespace App\Database\XML;

trait XMLRepository
{
    protected static ?XMLCache $cache = null;
    protected static ?XMLElement $db = null;
    protected string $query = "";

    abstract public static function path(): string;

    public static function instance(): XMLElement
    {
        if (null === static::$db) {
            static::$db = \simplexml_load_file(static::path(), XMLElement::class, LIBXML_NOCDATA);
        }
        return static::$db;
    }

    /** @return XMLElement[] */
    private function execute(): array
    {
        if (false === static::cache()->has($this->query)) {
            static::cache()->set($this->query, static::instance()->xpath($this->query) ?? []);
        }
        return static::cache()->get($this->query);
    }

    protected function getOne(): ?XMLElement
    {
        $collection = $this->execute();
        return \count($collection) ? \reset($rows) : null;
    }

    /** @return XMLElement[] */
    protected function getMany(): array
    {
        return $this->execute();
    }

    protected static function cache(): XMLCache
    {
        if (null === static::$cache) {
            static::$cache = new XMLCache;
        }
        return static::$cache;
    }
}
