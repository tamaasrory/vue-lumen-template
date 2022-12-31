<?php

namespace App\Supports\Processor;

use Illuminate\Database\DatabaseManager;
use Krlove\CodeGenerator\Model\DocBlockModel;
use Krlove\CodeGenerator\Model\VirtualPropertyModel;
use Krlove\EloquentModelGenerator\Config;
use Krlove\EloquentModelGenerator\Model\EloquentModel;
use Krlove\EloquentModelGenerator\Processor\ProcessorInterface;
use Krlove\EloquentModelGenerator\TypeRegistry;

/**
 * Class FieldProcessor
 * @package Krlove\EloquentModelGenerator\Processor
 */
class FieldProcessor implements ProcessorInterface
{
    /**
     * @var DatabaseManager
     */
    protected $databaseManager;

    /**
     * @var TypeRegistry
     */
    protected $typeRegistry;

    /**
     * FieldProcessor constructor.
     * @param DatabaseManager $databaseManager
     * @param TypeRegistry $typeRegistry
     */
    public function __construct(DatabaseManager $databaseManager, TypeRegistry $typeRegistry)
    {
        $this->databaseManager = $databaseManager;
        $this->typeRegistry = $typeRegistry;
    }

    /**
     * @inheritdoc
     */
    public function process(EloquentModel $model, Config $config)
    {
        $schemaManager = $this->databaseManager
            ->connection($config->get('connection'))->getDoctrineSchemaManager();
        $prefix = $this->databaseManager
            ->connection($config->get('connection'))->getTablePrefix();

        $tableDetails = $schemaManager->listTableDetails($prefix . $model->getTableName());
        $primaryColumnNames = $tableDetails->getPrimaryKey() ?
            $tableDetails->getPrimaryKey()->getColumns() : [];

        $columnNames = [];
        $_type = [
            'json' => 'array',
        ];

        $casting = [];

        foreach ($tableDetails->getColumns() as $column) {
            $detail = json_decode($column->getComment());
            $typeData = '';
            if (isset($detail->type) && isset($_type[$detail->type])) {
                $typeData = $_type[$detail->type];
                $casting[$column->getName()] = $detail->type;
            } else {
                $typeData = $this->typeRegistry->resolveType($column->getType()->getName());
            }

            $model->addProperty(new VirtualPropertyModel($column->getName() . (isset($detail->format) ? ' ' . json_encode($detail->format) : ''), $typeData));

            if (!in_array($column->getName(), $primaryColumnNames)) {
                $columnNames[] = $column->getName();
            }
        }

        $fillableProperty = new PropertyModel('fillable');
        $fillableProperty->setAccess('protected')
            ->setValue($columnNames)
            ->setDocBlock(new DocBlockModel(
                'The attributes that are mass assignable.', '', '@var array'
            ));

        $model->addProperty($fillableProperty);

        if (count($casting)) {
            $castsProperty = new PropertyModel('casts');
            $castsProperty->setAccess('protected')
                ->setValue($casting)
                ->setDocBlock(new DocBlockModel(
                    'The attributes that should be cast.', '', '@var array'
                ));

            $model->addProperty($castsProperty);
        }

        $searchableProperty = new PropertyModel('searchable');
        $searchableProperty->setAccess('public')
            ->setValue($columnNames)
            ->setDocBlock(new DocBlockModel(
                'The attributes that are searchable.', '', '@var array'
            ));
        $model->addProperty($searchableProperty);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPriority()
    {
        return 5;
    }
}
