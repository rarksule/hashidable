<?php

namespace rarksule\Hashidable;

trait Hashidable
{
    /**
     * Finds a model by the hashid
     *
     * @param string $hash
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function findByHashid(string $hash)
    {
        $static = new static();

        return $static->find($static->hashidableEncoder()->decode($hash));
    }

    /**
     * Finds a model by the hashid or fails
     *
     * @param string $hash
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function findByHashidOrFail(string $hash)
    {
        $static = new static();

        return $static->findOrFail($static->hashidableEncoder()->decode($hash));
    }

     /**
     * Finds a model by the hashid or fails
     *
     * @param string $hash
     * @return integer
     */
    public static function decode(string $hash)
    {
        $static = new static();

        return $static->hashidableEncoder()->decode($hash);
    }

    /**
     * Finds a model by the hashid or fails
     *
     * @param integer $id
     * @return string
     */
    public static function encode(int $id)
    {
        $static = new static();

        return $static->hashidableEncoder()->encode($id);
    }

    /**
     * Finds a model by the hashid or fails
     *
     * @param string $hash
     * @param string $column By default it is the primary key but can be diferent some developers
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeWhereHashid($query,string $hash, ?string $column = null)
    {
        $static = new static();

        return $query->where($column ?? $static->getKeyName(), $static->hashidableEncoder()->decode($hash));
    }

    /**
     * Getter for the calling model to return the generated hashid
     *
     * @return string
     */
    public function getHashidAttribute($value)
    {
        return $this->hashidableEncoder()->encode($this->getKey());
    }

    /** @inheritDoc */
    public function getRouteKey()
    {
        return $this->hashid;
    }

    /** @inheritDoc */
    public function resolveRouteBinding($hash, $field = null)
    {
        return $this->where(
            $this->getKeyName(),
            $this->hashidableEncoder()->decode($hash)
        )->firstOrFail();
    }

    /**
     * Hashid Encoder-decoder
     *
     * @return \rarksule\Hashidable\Encoder
     */
    final private function hashidableEncoder()
    {
        $interfaces = class_implements(get_called_class());
        $exists = array_key_exists(HashidableConfigInterface::class, $interfaces);
        $custom = $exists ? $this->hashidableConfig() : [];
        $config = array_merge(config('hashidable'), $custom);

        return new Encoder(class_basename(get_called_class()), $config);
    }
}
