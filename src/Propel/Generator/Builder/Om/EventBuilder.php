<?php

/**
 * MIT License. This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Propel\Generator\Builder\Om;

/**
 * Generates the PHP5 event class for user object model (OM).
 *
 * @author Gilles Bourgeat <gilles.bourgeat@gmail.com>
 */
class EventBuilder extends AbstractOMBuilder
{
    /**
     * Gets the package for the map builder classes.
     *
     * @return string|null
     */
    public function getPackage(): ?string
    {
        return parent::getPackage() . '.Event';
    }

    /**
     * @return string|null
     */
    public function getNamespace(): ?string
    {
        $namespace = parent::getNamespace();
        if (!$namespace) {
            return 'Event';
        }

        if ($this->getGeneratorConfig()) {
            $omns = $this->getBuildProperty('generator.objectModel.namespaceEvent');
            if ($omns) {
                return $namespace . '\\' . $omns;
            }
        }

        return $namespace . 'Event';
    }

    /**
     * @return string
     */
    public function getBaseTableMapClassName(): string
    {
        return 'Event';
    }

    /**
     * Returns the name of the current class being built.
     *
     * @return string
     */
    public function getUnprefixedClassName(): string
    {
        return $this->getTable()->getPhpName() . 'Event';
    }

    /**
     * Adds class phpdoc comment and opening of class.
     *
     * @param string $script
     *
     * @return void
     */
    protected function addClassOpen(&$script): void
    {
        $this->addUseClasses($script);

        $script .= "
class " . $this->getUnqualifiedClassName() . " extends ActiveRecordEvent
{";
    }

    /**
     * Specifies the methods that are added as part of the map builder class.
     * This can be overridden by subclasses that wish to add more methods.
     *
     * @see ObjectBuilder::addClassBody()
     *
     * @param string $script
     *
     * @return void
     */
    protected function addClassBody(&$script): void
    {
        $script .= $this->addConstants();

        $this->addConstruct($script);

        $this->addGetter($script);
    }

    /**
     * Adds any constants needed for this TableMap class.
     *
     * @return string
     */
    protected function addConstants(): string
    {
        return '
    const PRE_SAVE = \'propel.pre.save.' . $this->getTable()->getCommonName() . '\';
    const POST_SAVE = \'propel.post.save.' . $this->getTable()->getCommonName() . '\';
    const PRE_INSERT = \'propel.pre.insert.' . $this->getTable()->getCommonName() . '\';
    const POST_INSERT = \'propel.post.insert.' . $this->getTable()->getCommonName() . '\';
    const PRE_UPDATE = \'propel.pre.update.' . $this->getTable()->getCommonName() . '\';
    const POST_UPDATE = \'propel.post.update.' . $this->getTable()->getCommonName() . '\';
    const PRE_DELETE = \'propel.pre.delete.' . $this->getTable()->getCommonName() . '\';
    const POST_DELETE = \'propel.post.delete.' . $this->getTable()->getCommonName() . '\';

    /** @var ' . $this->getTable()->getPhpName() . ' */
    protected $model;
';
    }

    /**
     * @param string $script
     *
     * @return void
     */
    protected function addUseClasses(&$script): void
    {
        $script .= 'use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Event\ActiveRecordEvent;
use ' . $this->getTable()->getNamespace() . '\\' . $this->getTable()->getPhpName() . ';
';
    }

    /**
     * @param string $script
     *
     * @return void
     */
    protected function addConstruct(&$script): void
    {
        $script .= '
    /**
     * @param ' . $this->getTable()->getPhpName() . '|ActiveRecordInterface $' . lcfirst($this->getTable()->getPhpName()) . '
     */
    public function __construct(' . $this->getTable()->getPhpName() . ' $' . lcfirst($this->getTable()->getPhpName()) . ')
    {
        $this->model = $' . lcfirst($this->getTable()->getPhpName()) . ';
    }
';
    }

    /**
     * @param string $script
     *
     * @return void
     */
    protected function addGetter(&$script): void
    {
        $script .= '
    /**
     * @return ' . $this->getTable()->getPhpName() . '|ActiveRecordInterface
     */
    public function getModel()
    {
        return $this->model;
    }
';
    }

    /**
     * @param string $script
     *
     * @return void
     */
    protected function addClassClose(&$script): void
    {
        $script .= '}';
    }
}
