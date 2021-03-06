@php
    /**
     * @var \Vmorozov\LaravelAdminGenerator\App\Utils\Columns\Column $field
     * @var string $fieldName
     * @var array $params
     * @var \Illuminate\Database\Eloquent\Model $entity
     * @var \Illuminate\Support\Collection $errors
     */
@endphp

<div class="form-group col-md-12 {{ $errors->has($fieldName) ? 'has-error' : '' }}">
    <label for="{{ $fieldName }}">{{ $field->getLabel() }}</label>

    <select name="{{ $fieldName }}"
            id="{{ $fieldName }}"
            class="form-control"
            {{ $field->required() ? 'required' : '' }}
    >
        @foreach($relationModels as $relationModel)
            <option value="{{ $relationModel->getKey() }}" {{ (old($fieldName) ?? $entity->$fieldName) == $relationModel->getKey() ? 'selected' : '' }}>
                {{ $relationModel->$relationModelFieldName }}
            </option>
        @endforeach
    </select>

    @if ($errors->has($fieldName))
        <span class="help-block">
            <strong>{{ $errors->first($fieldName) }}</strong>
        </span>
    @endif
</div>
