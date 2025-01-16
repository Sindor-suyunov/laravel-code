<div>
    <form action="{{ route('laravel-code.generate') }}" method="post">
        @csrf
        <div class="row align-items-md-end">
            <div class="col-md-9">
                <div class="form-group">
                    <label for="table_name">Table name</label>
                    <input type="text" name="table_name" id="table_name" class="form-control" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <button type="button" wire:click="addColumn" class="btn btn-primary w-100">
                        Add Column
                    </button>
                </div>
            </div>
        </div>

        @foreach($columns as $column)
            @php $id = $loop->index + 1; @endphp
            <div class="row align-items-md-end mt-2">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="column_name_{{ $id }}"> Column name</label>
                        <input type="text" name="columns[{{ $id }}][name]" id="column_name_{{ $id }}" required
                               class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="column_type_{{ $id }}">Column type</label>
                        <select name="columns[{{ $id }}][type]" id="column_type_{{ $id }}" class="form-control">
                            @foreach(\Sindor\LaravelCode\App\Enums\ColumnTypeEnum::cases() as $type)
                                <option value="{{ $type->value }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="column_default_{{ $id }}">Default value</label>
                        <input type="text" name="columns[{{ $id }}][default]" id="column_default_{{ $id }}"
                               class="form-control">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-check">
                        <input class="form-check-input" name="columns[{{ $id }}][nullable]" type="checkbox"
                               id="column_nullable_{{ $id }}">
                        <label class="form-check-label" for="column_nullable_{{ $id }}">
                            Nullable
                        </label>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-check">
                        <input class="form-check-input" name="columns[{{ $id }}][unique]" type="checkbox"
                               id="column_unique_{{ $id }}">
                        <label class="form-check-label" for="column_unique_{{ $id }}">
                            Unique
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-check">
                        <input class="form-check-input" name="columns[{{ $id }}][index]" type="checkbox"
                               id="column_index_{{ $id }}">
                        <label class="form-check-label" for="column_index_{{ $id }}">
                            Has index
                        </label>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row mt-2">
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" name="add_migration" type="checkbox" checked id="add_migration">
                    <label class="form-check-label" for="add_migration">
                        Generate Migration
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" name="add_model" type="checkbox" checked id="add_model">
                    <label class="form-check-label" for="add_model">
                        Generate Model
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" name="add_factory" type="checkbox" checked id="add_factory">
                    <label class="form-check-label" for="add_factory">
                        Generate Factory
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" name="add_form_request" type="checkbox" checked id="add_form_request">
                    <label class="form-check-label" for="add_form_request">
                        Generate Form Request
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" name="add_resource_controller" type="checkbox" checked id="add_resource_controller">
                    <label class="form-check-label" for="add_resource_controller">
                        Generate Resource Controller (+routes)
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" name="add_dto" type="checkbox" checked id="add_dto">
                    <label class="form-check-label" for="add_dto">
                        Generate DTO
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" name="add_json_resource" type="checkbox" checked id="add_json_resource">
                    <label class="form-check-label" for="add_json_resource">
                        Generate JSON Resource
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" name="add_api_controller" type="checkbox" checked id="add_api_controller">
                    <label class="form-check-label" for="add_api_controller">
                        Generate API Resource Controller (+routes)
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" name="add_observer" type="checkbox" checked id="add_observer">
                    <label class="form-check-label" for="add_observer">
                        Generate Observer
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group mt-2">
            <button type="submit" class="btn btn-success w-100">Generate</button>
        </div>
    </form>
</div>
