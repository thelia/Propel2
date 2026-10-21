<?php

/**
 * MIT License. This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Propel\Generator\Builder;

use Propel\Generator\Builder\Om\ClassTools;
use Propel\Generator\Config\GeneratorConfig;
use Propel\Generator\Model\Database;

class ResolverBuilder
{
    /**
     * @var \Propel\Generator\Model\Database
     */
    protected $database;

    /**
     * @var \Propel\Generator\Config\GeneratorConfig
     */
    protected $generatorConfig;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @return string
     */
    public function build()
    {
        $database = $this->database;
        $definitions = [
            'table' => [

            ],
        ];

        /** @var \Propel\Generator\Builder\Table $table */
        foreach ($database->getTables() as $table) {
            foreach (['tablemap'] as $target) {
                $builder = $this->generatorConfig->getConfiguredBuilder($table, $target);

                $definitions['table'][$table->getName()] = $builder->getNamespace() . '\\' . $builder->getUnprefixedClassName();
            }
        }

        $script = '<?php

namespace ' . $this->getPackagePath() . ';

class PropelResolver
{
    /**
     * @param string $name name of table
     * @return null|string namspace of tableMap
     */
    public static function getTableMapByTableName($name)
    {
        $list = [
';

        foreach ($definitions['table'] as $name => $namespace) {
            $script .= '            "' . $name . '" => "' . $namespace . '",
';
        }
        $script .= '
        ];
        
        if (isset($list[$name])) {
            return $list[$name];         
        }
        
        return null;
    }
}';

        return $script;
    }

    /**
     * @return void
     */
    public function setGeneratorConfig(GeneratorConfig $generatorConfig)
    {
        $this->generatorConfig = $generatorConfig;
    }

    /**
     * Gets the full path to the file for the current class.
     *
     * @return string
     */
    public function getClassFilePath()
    {
        return ClassTools::createFilePath($this->getPackagePath(), $this->getUnqualifiedClassName());
    }

    /**
     * Returns filesystem path for current package.
     *
     * @return string
     */
    public function getPackagePath()
    {
        return ucfirst($this->database->getName());
    }

    /**
     * Returns the unqualified classname (e.g. Book)
     *
     * @return string
     */
    public function getUnqualifiedClassName()
    {
        return 'PropelResolver';
    }
}
