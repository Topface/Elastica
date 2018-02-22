<?php
namespace TestElastica\Connection\Strategy;

use TestElastica\Exception\InvalidException;

/**
 * Description of CallbackStrategy.
 *
 * @author chabior
 */
class CallbackStrategy implements StrategyInterface
{
    /**
     * @var callable
     */
    protected $_callback;

    /**
     * @param callable $callback
     *
     * @throws \TestElastica\Exception\InvalidException
     */
    public function __construct($callback)
    {
        if (!self::isValid($callback)) {
            throw new InvalidException(sprintf('Callback should be a callable, %s given!', gettype($callback)));
        }

        $this->_callback = $callback;
    }

    /**
     * @param array|\TestElastica\Connection[] $connections
     *
     * @return \TestElastica\Connection
     */
    public function getConnection($connections)
    {
        return call_user_func_array($this->_callback, [$connections]);
    }

    /**
     * @param callable $callback
     *
     * @return bool
     */
    public static function isValid($callback)
    {
        return is_callable($callback);
    }
}
