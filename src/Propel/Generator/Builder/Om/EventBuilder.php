<?php

namespace Propel\Generator\Builder\Om;

use Propel\Generator\Model\ForeignKey;

use Propel\Generator\Model\IdMethod;
use Propel\Generator\Model\Table;
use Propel\Generator\Platform\PlatformInterface;

/**
 * Generates the PHP5 event class for user object model (OM).
 *
 * @author Gilles Bourgeat <gilles.bourgeat@gmail.com>
 */
class EventBuilder extends AbstractOMBuilder
{
    /**
     * Gets the package for the map builder classes.
     * @return string
     */
    public function getPackage()
    {
        return parent::getPackage() . '.Event';
    }

    public function getNamespace()
    {
        if (!$namespace = parent::getNamespace()) {
            return 'Event';
        }

        if ($this->getGeneratorConfig()
            && $omns = $this->getBuildProperty('generator.objectModel.namespaceEvent')) {
            return $namespace . '\\' . $omns;
        }

        return $namespace .'Event';
    }

    public function getBaseTableMapClassName()
    {
        return "Event";
    }

    /**
     * Returns the name of the current class being built.
     * @return string
     */
    public function getUnprefixedClassName()
    {
        return $this->getTable()->getPhpName() . 'Event';
    }

    /**
     * Adds class phpdoc comment and opening of class.
     * @param string &$script The script will be modified in this method.
     */
    protected function addClassOpen(&$script)
    {
        $this->addUseClasses($script);

        $script .= "
class ".$this->getUnqualifiedClassName()." extends ActiveRecordEvent
{";
    }

    /**
     * Specifies the methods that are added as part of the map builder class.
     * This can be overridden by subclasses that wish to add more methods.
     * @see ObjectBuilder::addClassBody()
     */
    protected function addClassBody(&$script)
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
    protected function addConstants()
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
    protected $' . lcfirst($this->getTable()->getPhpName()) . ';
';
    }

    protected function addUseClasses(&$script)
    {
$script .= 'use \Propel\Runtime\Event\ActiveRecordEvent;
use \\' . $this->getTable()->getNamespace() . '\\' . $this->getTable()->getPhpName() . ';
';
    }

    protected function addConstruct(&$script)
    {
        $script .= '
    /**
     * @param ' . $this->getTable()->getPhpName() . ' $' . lcfirst($this->getTable()->getPhpName()) . '
     */
    public function __construct(' . $this->getTable()->getPhpName() . ' $' . lcfirst($this->getTable()->getPhpName()) . ')
    {
        $this->' . lcfirst($this->getTable()->getPhpName()) . ' = $' . lcfirst($this->getTable()->getPhpName()) . ';
    }
';
    }

    protected function addGetter(&$script)
    {
        $methodName = 'get' . $this->getTable()->getPhpName();

        $script .= '
    /**
     * @return ' . $this->getTable()->getPhpName() . '
     */
    public function ' . $methodName . '()
    {
        return $this->' . lcfirst($this->getTable()->getPhpName()) . ';
    }
';
    }

    /**
     * @param $script
     */
    protected function addSetter(&$script)
    {
        $methodName = 'set' . $this->getTable()->getPhpName();

        $script .= '
    /**
     * @param ' . $this->getTable()->getPhpName() . ' $' . lcfirst($this->getTable()->getPhpName()) . '
     * @return $this
     */
    public function ' . $methodName . '(' . $this->getTable()->getPhpName() . ' $' . lcfirst($this->getTable()->getPhpName()) . ')
    {
        $this->' . lcfirst($this->getTable()->getPhpName()) . ' = $' . lcfirst($this->getTable()->getPhpName()) . ';
        return $this;
    }
';
    }

    protected function addClassClose(&$script)
    {
        $script .= '}';
    }
}
