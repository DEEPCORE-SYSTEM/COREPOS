@extends('layouts.app')
@section('title', __('manufacturing::lang.add_ingredients'))

@section('content')
@include('manufacturing::layouts.nav')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('manufacturing::lang.add_ingredients')</h1>
</section>

<!-- Main content -->
<section class="content">
    {{-- Formulario para crear una receta --}}
    <form action="{{ action('\Modules\Manufacturing\Http\Controllers\RecipeController@store') }}" method="POST" id="recipe_form">
        @csrf
        <div id="box_group">
            <div class="box box-solid">
                <div class="box-header"> 
                    <h4 class="box-title">
                        <strong>@lang('sale.product'): </strong>
                        {{ $variation->product_name }} 
                        @if($variation->product_type == 'variable') 
                            - {{ $variation->product_variation_name }} - {{ $variation->name }} 
                        @endif
                    </h4>
                </div>

                <div class="box-body">
                    <div class="row">
                        {{-- Botón para agregar grupo de ingredientes --}}
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success pull-right" id="add_ingredient_group">
                                @lang('manufacturing::lang.add_ingredient_group')
                            </button>
                        </div>

                        {{-- Input para buscar ingredientes --}}
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="search_product">@lang('manufacturing::lang.select_ingredient'):</label>
                                
                                <input type="text" name="search_product" id="search_product" class="form-control" placeholder="@lang('manufacturing::lang.select_ingredient')" autofocus>
                                <input type="hidden" name="variation_id" value="{{ $variation->id }}">
                            </div>
                        </div>
                    </div>

                    {{-- Tabla de ingredientes --}}
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped text-center ingredients_table">
                                <thead>
                                    <tr>
                                        <th>@lang('manufacturing::lang.ingredient')</th>
                                        <th>@lang('manufacturing::lang.waste_percent')</th>
                                        <th>@lang('manufacturing::lang.final_quantity')</th>
                                        <th>@lang('lang_v1.price')</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $ingredient_total = 0; @endphp
                                    @foreach($ingredients as $ingredient)
                                        @php 
                                            $price = $ingredient['quantity'] * $ingredient['dpp_inc_tax'] * $ingredient['multiplier'];
                                            $ingredient_total += $price;
                                        @endphp
                                        <tr>
                                            <td>{{ $ingredient['name'] }}</td>
                                            <td>{{ $ingredient['waste_percent'] }}%</td>
                                            <td>{{ $ingredient['final_quantity'] }}</td>
                                            <td>{{ number_format($price, 2) }}</td>
                                            <td><button type="button" class="btn btn-danger btn-sm">X</button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Costos y detalles adicionales --}}
            <div class="box box-solid">
                <div class="box-body">
                    <div class="row">
                        {{-- Costo total de ingredientes --}}
                        <div class="col-md-12 text-right">
                            <strong>@lang('manufacturing::lang.ingredients_cost'): </strong>
                            <span id="ingredients_cost_text">{{ number_format($ingredient_total, 2) }}</span>
                            <input type="hidden" name="ingredients_cost" value="{{ $ingredient_total }}">
                        </div>

                        {{-- Porcentaje de desperdicio --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="waste_percent">@lang('manufacturing::lang.wastage'):</label>
                                <div class="input-group">
                                    <input type="text" name="waste_percent" id="waste_percent" class="form-control" value="{{ $recipe->waste_percent ?? 0 }}">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>

                        {{-- Cantidad total de salida --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="total_quantity">@lang('manufacturing::lang.total_output_quantity'):</label>
                                <input type="text" name="total_quantity" class="form-control" value="{{ $recipe->total_quantity ?? 1 }}">
                            </div>
                        </div>

                        {{-- Costos de producción --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="extra_cost">@lang('manufacturing::lang.production_cost'):</label>
                                <div class="input-group">
                                    <input type="text" name="extra_cost" id="extra_cost" class="form-control" value="{{ $recipe->extra_cost ?? 0 }}">
                                    <select name="production_cost_type" class="form-control">
                                        <option value="fixed">@lang('lang_v1.fixed')</option>
                                        <option value="percentage">@lang('lang_v1.percentage')</option>
                                        <option value="per_unit">@lang('manufacturing::lang.per_unit')</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Total Final --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="total">@lang('sale.total'):</label>
                                <div class="input-group">
                                    <input type="text" name="total" id="total" class="form-control" value="{{ number_format($ingredient_total, 2) }}" readonly>
                                    <span class="input-group-addon">{{ $currency_details->symbol }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Instrucciones de la receta --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="instructions">@lang('manufacturing::lang.recipe_instructions'):</label>
                                <textarea name="instructions" id="instructions" class="form-control">{{ $recipe->instructions ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Botón de guardar --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary pull-right">@lang('messages.save')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

@stop
@section('javascript')
	@include('manufacturing::layouts.partials.common_script')
	<script type="text/javascript">
		$('.ingredient-row-sortable').sortable({
			cursor: "move",
			handle: ".handle",
			update: function(event, ui) {
				$(this).children().each(function(index) {
					$(this).find('input.sort_order').val(++index)
				});
			}
		});
	</script>
@endsection
