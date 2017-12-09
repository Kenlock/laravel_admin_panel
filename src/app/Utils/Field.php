<?php

namespace Vmorozov\LaravelAdminGenerator\App\Utils;


use Illuminate\Database\Eloquent\Model;
use Vmorozov\LaravelAdminGenerator\AdminGeneratorServiceProvider;

class Field
{
    const DEFAULT_TYPE = 'text';

    protected $fieldName = '';

    protected $params = [];

    protected $availableTypes = [];

    protected $viewParams;

    protected function getAvailableTypes(): array
    {
        return [
            'text' => [
                'column' => AdminGeneratorServiceProvider::VIEWS_NAME.'::list.column_types.text',
                'field' => AdminGeneratorServiceProvider::VIEWS_NAME.'::forms.field_types.text',
            ],
//            'file' => [
//                'column' => '',
//                'field' => '',
//            ],
//        Todo: add all other needed types here
        ];
    }

    public function __construct(string $fieldName, array $params)
    {
        $this->availableTypes = $this->getAvailableTypes();
        $this->fieldName = $fieldName;
        $this->params = $params;

        $type = isset($this->params['field_type']) ? $this->params['field_type'] : self::DEFAULT_TYPE;
        $this->viewParams = $this->availableTypes[$type] ?: $this->availableTypes[self::DEFAULT_TYPE];
    }

    public function renderField(Model $model = null)
    {
        $viewName = $this->viewParams['field'];

        return view($viewName)->with([
            'params' => $this->params,
            'fieldName' => $this->fieldName,
            'entity' => $model,
            'field' => $this,
        ]);
    }

    public function renderColumn(Model $model)
    {
        $viewName = $this->viewParams['column'];

        return view($viewName)->with([
            'params' => $this->params,
            'fieldName' => $this->fieldName,
            'entity' => $model,
            'field' => $this,
        ]);
    }

    public function required(): bool
    {
        return isset($this->params['required']) && $this->params['required'] === true;
    }

    public function getLabel(): string
    {
        return isset($this->params['label']) ? $this->params['label'] : title_case($this->fieldName);
    }
}