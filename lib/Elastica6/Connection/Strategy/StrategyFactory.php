<?php
namespace Elastica6\Connection\Strategy;

use Elastica6\Exception\InvalidException;

/**
 * Description of StrategyFactory.
 *
 * @author chabior
 */
class StrategyFactory
{
    /**
     * @param mixed|callable|string|StrategyInterface $strategyName
     *
     * @throws \Elastica6\Exception\InvalidException
     *
     * @return \Elastica6\Connection\Strategy\StrategyInterface
     */
    public static function create($strategyName)
    {
        if ($strategyName instanceof StrategyInterface) {
            return $strategyName;
        }

        if (CallbackStrategy::isValid($strategyName)) {
            return new CallbackStrategy($strategyName);
        }

        if (is_string($strategyName)) {
            $requiredInterface = '\\Elastica6\\Connection\\Strategy\\StrategyInterface';
            $predefinedStrategy = '\\Elastica6\\Connection\\Strategy\\'.$strategyName;

            if (class_exists($predefinedStrategy) && class_implements($predefinedStrategy, $requiredInterface)) {
                return new $predefinedStrategy();
            }

            if (class_exists($strategyName) && class_implements($strategyName, $requiredInterface)) {
                return new $strategyName();
            }
        }

        throw new InvalidException('Can\'t create strategy instance by given argument');
    }
}
