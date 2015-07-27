<?php
/*
 *  $Id: Builder.php 2939 2007-10-19 14:23:42Z Jonathan.Wage $
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information, see
 * <http://www.phpdoctrine.org>.
 */

/**
 * Doctrine_Migration_Builder
 *
 * @package     Doctrine
 * @subpackage  Migration
 * @author      Konsta Vesterinen <kvesteri@cc.hut.fi>
 * @author      Jonathan H. Wage <jwage@mac.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.phpdoctrine.org
 * @since       1.0
 * @version     $Revision: 2939 $
 */
class Doctrine_Migration_Builder extends Doctrine_Builder
{
    /**
     * The path to your migration classes directory
     *
     * @var string
     */
    private $migrationsPath = '';

    /**
     * File suffix to use when writing class definitions
     *
     * @var string $suffix
     */
    private $suffix = '.php';

    /**
     * Instance of the migration class for the migration classes directory
     *
     * @var Doctrine_Migration $migration
     */
    private $migration;

    /**
     * Class template used for writing classes
     *
     * @var $tpl
     */
    private static $tpl;

    /**
     * Instantiate new instance of the Doctrine_Migration_Builder class
     *
     * <code>
     * $builder = new Doctrine_Migration_Builder('/path/to/migrations');
     * </code>
     *
     * @return void
     */
    public function __construct($migrationsPath = null)
    {
        if ($migrationsPath instanceof Doctrine_Migration) {
            $this->setMigrationsPath($migrationsPath->getMigrationClassesDirectory());
            $this->migration = $migrationsPath;
        } else if (is_dir($migrationsPath)) {
            $this->setMigrationsPath($migrationsPath);
            $this->migration = new Doctrine_Migration($migrationsPath);
        }

        $this->loadTemplate();
    }

    /**
     * Set the path to write the generated migration classes
     *
     * @param string path   the path where migration classes are stored and being generated
     * @return void
     */
    public function setMigrationsPath($path)
    {
        Doctrine_Lib::makeDirectories($path);

        $this->migrationsPath = $path;
    }

    /**
     * Get the path where generated migration classes are written to
     *
     * @return string       the path where migration classes are stored and being generated
     */
    public function getMigrationsPath()
    {
        return $this->migrationsPath;
    }

    /**
     * Loads the class template used for generating classes
     *
     * @return void
     */
    protected function loadTemplate()
    {
        if (isset(self::$tpl)) {
            return;
        }

        self::$tpl =<<<END
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class %s extends %s
{
    public function up()
    {
%s
    }

    public function down()
    {
%s
    }
}
END;
    }

    /**
     * Generate migrations from a Doctrine_Migration_Diff instance
     *
     * @param  Doctrine_Migration_Diff $diff Instance to generate changes from
     * @return array $changes  Array of changes produced from the diff
     */
    public function generateMigrationsFromDiff(Doctrine_Migration_Diff $diff)
    {
        $changes = $diff->generateChanges();

        $up = array();
        $down = array();

        if ( ! empty($changes['dropped_tables'])) {
            foreach ($changes['dropped_tables'] as $tableName => $table) {
                $up[] = $this->buildDropTable($table);
                $down[] = $this->buildCreateTable($table);
            }
        }

        if ( ! empty($changes['created_tables'])) {
            foreach ($changes['created_tables'] as $tableName => $table) {
                $up[] = $this->buildCreateTable($table);
                $down[] = $this->buildDropTable($table);
            }
        }

        if ( ! empty($changes['dropped_columns'])) {
            foreach ($changes['dropped_columns'] as $tableName => $removedColumns) {
                foreach ($removedColumns as $name => $column) {
                    $up[] = $this->buildRemoveColumn($tableName, $name, $column);
                    $down[] = $this->buildAddColumn($tableName, $name, $column);
                }
            }
        }

        if ( ! empty($changes['created_columns'])) {
            foreach ($changes['created_columns'] as $tableName => $addedColumns) {
                foreach ($addedColumns as $name => $column) {
                    $up[] = $this->buildAddColumn($tableName, $name, $column);
                    $down[] = $this->buildRemoveColumn($tableName, $name, $column);
                }
            }
        }

        if ( ! empty($changes['changed_columns'])) {
            foreach ($changes['changed_columns'] as $tableName => $changedColumns) {
                foreach ($changedColumns as $name => $column) {
                    $up[] = $this->buildChangeColumn($tableName, $name, $column);
                }
            }
        }

        if ( ! empty($up) || ! empty($down)) {
            $up = implode("\n", $up);
            $down = implode("\n", $down);
            $className = 'Version' . $this->migration->getNextMigrationClassVersion();
            $this->generateMigrationClass($className, array(), $up, $down);
        }

        $up = array();
        $down = array();
        if ( ! empty($changes['dropped_foreign_keys'])) {
            foreach ($changes['dropped_foreign_keys'] as $tableName => $droppedFks) {
                foreach ($droppedFks as $name => $foreignKey) {
                    $up[] = $this->buildDropForeignKey($tableName, $foreignKey);
                    $down[] = $this->buildCreateForeignKey($tableName, $foreignKey);
                }
            }
        }

        if ( ! empty($changes['dropped_indexes'])) {
            foreach ($changes['dropped_indexes'] as $tableName => $removedIndexes) {
                foreach ($removedIndexes as $name => $index) {
                    $up[] = $this->buildRemoveIndex($tableName, $name, $index);
                    $down[] = $this->buildAddIndex($tableName, $name, $index);
                }
            }
        }

        if ( ! empty($changes['created_foreign_keys'])) {
            foreach ($changes['created_foreign_keys'] as $tableName => $createdFks) {
                foreach ($createdFks as $name => $foreignKey) {
                    $up[] = $this->buildCreateForeignKey($tableName, $foreignKey);
                    $down[] = $this->buildDropForeignKey($tableName, $foreignKey);
                }
            }
        }

        if ( ! empty($changes['created_indexes'])) {
            foreach ($changes['created_indexes'] as $tableName => $addedIndexes) {
                foreach ($addedIndexes as $name => $index) {
                    $up[] = $this->buildAddIndex($tableName, $name, $index);
                    $down[] = $this->buildRemoveIndex($tableName, $name, $index);
                }
            }
        }

        if ( ! empty($up) || ! empty($down)) {
            $up = implode("\n", $up);
            $down = implode("\n", $down);
            $className = 'Version' . $this->migration->getNextMigrationClassVersion();
            $this->generateMigrationClass($className, array(), $up, $down);
        }
        return $changes;
    }

    /**
     * Generate a set of migration classes from the existing databases
     *
     * @return void
     */
    public function generateMigrationsFromDb()
    {
        $directory = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'tmp_doctrine_models';

        Doctrine::generateModelsFromDb($directory);

        $result = $this->generateMigrationsFromModels($directory, Doctrine::MODEL_LOADING_CONSERVATIVE);

        Doctrine_Lib::removeDirectories($directory);

        return $result;
    }

    /**
     * Generate a set of migrations from a set of models
     *
     * @param  string $modelsPath    Path to models
     * @param  string $modelLoading  What type of model loading to use when loading the models
     * @return boolean
     */
    public function generateMigrationsFromModels($modelsPath = null, $modelLoading = null)
    {
        if ($modelsPath !== null) {
            $models = Doctrine::filterInvalidModels(Doctrine::loadModels($modelsPath, $modelLoading));
        } else {
            $models = Doctrine::getLoadedModels();
        }

        $models = Doctrine::initializeModels($models);

        $foreignKeys = array();

        foreach ($models as $model) {
            $table = Doctrine::getTable($model);
            if ($table->getTableName() !== $this->migration->getTableName()) {
                $export = $table->getExportableFormat();

                $foreignKeys[$export['tableName']] = $export['options']['foreignKeys'];

                $up = $this->buildCreateTable($export);
                $down = $this->buildDropTable($export);

                $className = 'Add' . Doctrine_Inflector::classify($export['tableName']);

                $this->generateMigrationClass($className, array(), $up, $down);
            }
        }

        if ( ! empty($foreignKeys)) {
            $className = 'AddFks';

            $up = array();
            $down = array();
            foreach ($foreignKeys as $tableName => $definitions)    {
                $tableForeignKeyNames[$tableName] = array();

                foreach ($definitions as $definition) {
                    $up[] = $this->buildCreateForeignKey($tableName, $definition);
                    $down[] = $this->buildDropForeignKey($tableName, $definition);
                }
            }

            $up = implode("\n", $up);
            $down = implode("\n", $down);
            if ($up || $down) {
                $this->generateMigrationClass($className, array(), $up, $down);
            }
        }

        return true;
    }

    /**
     * Build the code for creating foreign keys
     *
     * @param  string $tableName
     * @param  array  $definition
     * @return string $code
     */
    public function buildCreateForeignKey($tableName, $definition)
    {
        return "\t\t\$this->createForeignKey('" . $tableName . "', '" . $definition['name'] . "', " . $this->varExport($definition, true) . ");";
    }

    /**
     * Build the code for dropping foreign keys
     *
     * @param  string $tableName
     * @param  array  $definition
     * @return string $code
     */
    public function buildDropForeignKey($tableName, $definition)
    {
        return "\t\t\$this->dropForeignKey('" . $tableName . "', '" . $definition['name'] . "');";
    }

    /**
     * Build the code for creating tables
     *
     * @param  string $tableData
     * @return string $code
     */
    public function buildCreateTable($tableData)
    {
        $code  = "\t\t\$this->createTable('" . $tableData['tableName'] . "', ";

        $code .= $this->varExport($tableData['columns'], true) . ", ";

        $optionsWeNeed = array('type', 'indexes', 'primary', 'collate', 'charset');

        $options = array();
        foreach ($optionsWeNeed as $option) {
            if (isset($tableData['options'][$option])) {
                $options[$option] = $tableData['options'][$option];
            }
        }

        $code .= $this->varExport($options, true);

        $code .= ");";

        return $code;
    }

    /**
     * Build the code for dropping tables
     *
     * @param  string $tableData
     * @return string $code
     */
    public function buildDropTable($tableData)
    {
        return "\t\t\$this->dropTable('" . $tableData['tableName'] . "');";
    }

    /**
     * Build the code for adding columns
     *
     * @param string $tableName
     * @param string $columnName
     * @param string $column
     * @return string $code
     */
    public function buildAddColumn($tableName, $columnName, $column)
    {
        $length = $column['length'];
        $type = $column['type'];
        unset($column['length'], $column['type']);
        return "\t\t\$this->addColumn('" . $tableName . "', '" . $columnName. "', '" . $type . "', '" . $length . "', " . $this->varExport($column) . ");";
    }

    /**
     * Build the code for removing columns
     *
     * @param string $tableName
     * @param string $columnName
     * @param string $column
     * @return string $code
     */
    public function buildRemoveColumn($tableName, $columnName, $column)
    {
        return "\t\t\$this->removeColumn('" . $tableName . "', '" . $columnName. "');";
    }

    /**
     * Build the code for changing columns
     *
     * @param string $tableName
     * @param string $columnName
     * @param string $column
     * @return string $code
     */
    public function buildChangeColumn($tableName, $columnName, $column)
    {
        $length = $column['length'];
        $type = $column['type'];
        unset($column['length'], $column['type']);
        return "\t\t\$this->changeColumn('" . $tableName . "', '" . $columnName. "', '" . $length . "', '" . $type . "', " . $this->varExport($column) . ");";
    }

    /**
     * Build the code for adding indexes
     *
     * @param string $tableName
     * @param string $indexName
     * @param string $index
     * @return sgtring $code
     */
    public function buildAddIndex($tableName, $indexName, $index)
    {
        return "\t\t\$this->addIndex('$tableName', '$indexName', " . $this->varExport($index) . ");";
    }

    /**
     * Build the code for removing indexes
     *
     * @param string $tableName
     * @param string $indexName
     * @param string $index
     * @return string $code
     */
    public function buildRemoveIndex($tableName, $indexName, $index)
    {
        return "\t\t\$this->removeIndex('$tableName', '$indexName', " . $this->varExport($index) . ");";
    }

    /**
     * Generate a migration class
     *
     * @param string  $className   Class name to generate
     * @param array   $options     Options for the migration class
     * @param string  $up          The code for the up function
     * @param string  $down        The code for the down function
     * @param boolean $return      Whether or not to return the code.
     *                             If true return and false it writes the class to disk.
     * @return mixed
     */
    public function generateMigrationClass($className, $options = array(), $up = null, $down = null, $return = false)
    {
        $className = Doctrine_Inflector::urlize($className);
        $className = str_replace('-', '_', $className);
        $className = Doctrine_Inflector::classify($className);

        if ($return || ! $this->getMigrationsPath()) {
            return $this->buildMigrationClass($className, null, $options, $up, $down);
        } else {
            if ( ! $this->getMigrationsPath()) {
                throw new Doctrine_Migration_Exception('You must specify the path to your migrations.');
            }

            $next = time() + $this->migration->getNextMigrationClassVersion();
            $fileName = $next . '_' . Doctrine_Inflector::tableize($className) . $this->suffix;

            $class = $this->buildMigrationClass($className, $fileName, $options, $up, $down);

            $path = $this->getMigrationsPath() . DIRECTORY_SEPARATOR . $fileName;
            if (class_exists($className) || file_exists($path)) {
                $this->migration->loadMigrationClass($className);
                return false;
            }

            file_put_contents($path, $class);
            require_once($path);
            $this->migration->loadMigrationClass($className);

            return true;
        }
    }

    /**
     * Build the code for a migration class
     *
     * @param string  $className   Class name to generate
     * @param string  $fileName    File name to write the class to
     * @param array   $options     Options for the migration class
     * @param string  $up          The code for the up function
     * @param string  $down        The code for the down function
     * @return string $content     The code for the generated class
     */
    public function buildMigrationClass($className, $fileName = null, $options = array(), $up = null, $down = null)
    {
        $extends = isset($options['extends']) ? $options['extends']:'Doctrine_Migration_Base';

        $content  = '<?php' . PHP_EOL;

        $content .= sprintf(self::$tpl, $className,
                                       $extends,
                                       $up,
                                       $down);

        return $content;
    }
}