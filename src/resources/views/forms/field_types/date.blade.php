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

    <input type="date"
           name="{{ $fieldName }}"
           id="{{ $fieldName }}"
           value="{{ old($fieldName) ?? $entity->$fieldName->format('Y-m-d') }}"
           class="form-control"
           {{ $field->required() ? 'required' : '' }}
           min="{{ isset($params[\Vmorozov\LaravelAdminGenerator\App\Utils\Field::PARAM_KEY_MIN]) ? \Carbon\Carbon::parse($params[\Vmorozov\LaravelAdminGenerator\App\Utils\Field::PARAM_KEY_MIN])->format('Y-m-d') : '' }}"
           max="{{ isset($params[\Vmorozov\LaravelAdminGenerator\App\Utils\Field::PARAM_KEY_MAX]) ? \Carbon\Carbon::parse($params[\Vmorozov\LaravelAdminGenerator\App\Utils\Field::PARAM_KEY_MAX])->format('Y-m-d') : '' }}"
    >

    @if ($errors->has($fieldName))
        <span class="help-block">
            <strong>{{ $errors->first($fieldName) }}</strong>
        </span>
    @endif
</div>
