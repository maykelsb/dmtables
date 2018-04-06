<?php
/**
  * This file is part of Tables4DMs project.
  *
  * @license https://opensource.org/licenses/MIT The MIT License
  * @copyright 2017 Maykel S. Braz
  * @link http://github.com/maykelsb/tables4dms-api
  */

namespace Tables4dms\Traits;

/**
 * Provides implementation to use with \Iterator and \ArrayAccess.
 *
 * This implmentation use textual keys, so, it works like a hashmap.
 *
 * @author Maykel s. Braz <maykelsb@yahoo.com.br>
 */
trait HashMapTrait
{
    /**
     * @var int Position of the selected textual key.
     */
    protected $offset = 0;

    /**
     * @var mixed[] Textual indexed hashmap items.
     */
    protected $items = [];

    /**
     * Return the current item. \Iterator::current().
     *
     * @return mixed
     */
    public function current()
    {
        return $this->items[$this->getCurrentKey()];
    }

    /**
     * Return the current key. \Iterator::key().
     *
     * @return string
     */
    public function key()
    {
        return $this->getCurrentKey();
    }

    /**
     * Advance the pointer to the next item. \Iterator::next().
     */
    public function next()
    {
        ++$this->offset;
    }

    /**
     * Rewind the pointer to the previous item. \Iterator::rewind().
     */
    public function rewind()
    {
        $this->offset = 0;
    }

    /**
     * Verifies if the current selected item is valid. \Iterator::valid().
     *
     * @return bool
     */
    public function valid()
    {
        return array_key_exists(
            $this->getCurrentKey(),
            $this->items
        );
    }

    /**
     * Verify if an offset exists. \ArrayAccess::offsetExists().
     *
     * @param string $offset Item offset.
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);       
    }

    /**
     * Return the item in an offset. \ArrayAccess::offsetGet().
     *
     * @param string $offset Item offset.
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return isset($this->items[$offset])
            ?$this->items[$offset]
            :null;
    }

    /**
     * Defines a value to an offset. \ArrayAccess::offsetSet().
     *
     * @param string $offset Item offset.
     * @param mixed $value Item value.
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            throw new Exception("HashMap key could not be null.");
        }

        $this->items[$offset] = $value;
    }

    /**
     * Unset an offset. \ArrayAccess::offsetUnset().
     *
     * @param string $offset Item offset.
     */
    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    /**
     * Add a new element into the hastable. If the key already exists, that key
     * is considered an array and the new item is add to the end of the list.
     *
     * @param string $key The new item id.
     * @param mixed $value The new value to be added.
     * @return self
     */ 
    public function add($key, $value)
    {
        if (!array_key_exists($key, $this->items)) {
            $this->items[$key] = $value;
            return $this;
        }

        // -- Transform the key value into an array
        if (!is_array($this->items[$key])) {
            $this->items[$key] = [$this->items[$key]];
        }

        $this->items[$key][] = $value;
        return $this;
    }

    /**
     * Helper method to help identify the position of the string key.
     *
     * @return string
     */
    protected function getCurrentKey()
    {
        $keys = array_keys($this->items);
        if (array_key_exists($this->offset, $keys)) {
            return $keys[$this->offset];
        }

        return null;
    }
}

