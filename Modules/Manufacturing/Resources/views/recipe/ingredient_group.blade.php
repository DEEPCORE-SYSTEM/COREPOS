<div class="box box-solid">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                {{-- Botón para eliminar el grupo de ingredientes --}}
                <button class="btn btn-danger pull-right btn-xs remove_ingredient_group">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="row">
            {{-- Nombre del grupo de ingredientes --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="ingredient_group{{ $ig_index }}">
                        @lang('manufacturing::lang.ingredient_group'):
                    </label>
                    <input type="text" 
                        name="ingredient_groups[{{ $ig_index }}]" 
                        id="ingredient_group{{ $ig_index }}" 
                        class="form-control ingredient_group"
                        placeholder="@lang('manufacturing::lang.ingredient_group')" 
                        value="{{ $ig_name ?? '' }}" 
                        data-ig_index="{{ $ig_index }}" 
                        required>
                </div>
            </div>

            {{-- Descripción del grupo de ingredientes --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="ingredient_group_description{{ $ig_index }}">
                        @lang('lang_v1.description'):
                    </label>
                    <textarea name="ingredient_group_description[{{ $ig_index }}]" 
                        id="ingredient_group_description{{ $ig_index }}" 
                        class="form-control" 
                        rows="2"
                        placeholder="@lang('lang_v1.description')">{{ $ig_description ?? '' }}</textarea>
                </div>
            </div>

            {{-- Campo de búsqueda de ingredientes --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="search_product_{{ $ig_index }}">
                        @lang('manufacturing::lang.select_ingredient'):
                    </label>
                    <input type="text" 
                        name="search_product" 
                        id="search_product_{{ $ig_index }}" 
                        class="form-control search_product" 
                        placeholder="@lang('manufacturing::lang.select_ingredient')">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {{-- Tabla de ingredientes --}}
                <table class="table table-striped table-th-green text-center ingredients_table">
                    <thead>
                        <tr>
                            <th>@lang('manufacturing::lang.ingredient')</th>
                            <th>@lang('manufacturing::lang.waste_percent')</th>
                            <th>@lang('manufacturing::lang.final_quantity')</th>
                            <th>@lang('lang_v1.price')</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody class="ingredient-row-sortable">
                        @if(!empty($ingredients))
                            @foreach($ingredients as $ingredient)
                                @include('manufacturing::recipe.ingredient_row', ['ingredient' => (object) $ingredient, 'ig_index' => $ig_index])
                                @php
                                    $row_index++;
                                @endphp
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> <!-- Fin del box -->
