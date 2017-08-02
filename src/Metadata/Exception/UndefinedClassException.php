<?php
/**
 * @see       https://github.com/zendframework/zend-expressive-hal for the canonical source repository
 * @copyright Copyright (c) 2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive-hal/blob/master/LICENSE.md New BSD License
 */

namespace Zend\Expressive\Hal\Metadata\Exception;

use UnexpectedValueException;

class UndefinedClassException extends UnexpectedValueException implements Exception
{
    public static function create($class)
    {
        return new self(sprintf(
            'Cannot map metadata for class "%s"; class does not exist',
            $class
        ));
    }
}
