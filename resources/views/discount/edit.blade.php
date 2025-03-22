<div class="modal-dialog" role="document">
  <div class="modal-content">

<!-- Formulario para actualizar un descuento -->
<form action="{{ route('discounts.update', $discount->id) }}" method="POST" id="discount_form">
    @csrf <!-- Token de seguridad obligatorio en Laravel -->
    @method('PUT') <!-- Método PUT para actualizar el registro -->

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">{{ __('sale.edit_discount') }}</h4>
    </div>

    <div class="modal-body">
        <div class="row">
            <!-- Nombre del descuento -->
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name">{{ __('unit.name') }}:*</label>
                    <input type="text" name="name" id="name" class="form-control" required 
                        value="{{ old('name', $discount->name) }}" placeholder="{{ __('unit.name') }}">
                </div>
            </div>

            <!-- Productos asociados al descuento -->
            <div class="col-md-12">
                <div class="form-group">
                    <label for="variation_ids">{{ __('report.products') }}:</label>
                    <select name="variation_ids[]" id="variation_ids" class="form-control" multiple>
                        @foreach($variations as $id => $name)
                            <option value="{{ $id }}" {{ in_array($id, array_keys($variations)) ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Marca del producto (oculto si hay productos seleccionados) -->
            <div class="col-md-6 {{ !empty($variations) ? 'd-none' : '' }}" id="brand_input">
                <div class="form-group">
                    <label for="brand_id">{{ __('product.brand') }}:</label>
                    <select name="brand_id" id="brand_id" class="form-control select2">
                        <option value="">{{ __('messages.please_select') }}</option>
                        @foreach($brands as $id => $brand)
                            <option value="{{ $id }}" {{ $discount->brand_id == $id ? 'selected' : '' }}>
                                {{ $brand }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Categoría del producto -->
            <div class="col-md-6 {{ !empty($variations) ? 'd-none' : '' }}" id="category_input">
                <div class="form-group">
                    <label for="category_id">{{ __('product.category') }}:</label>
                    <select name="category_id" id="category_id" class="form-control select2">
                        <option value="">{{ __('messages.please_select') }}</option>
                        @foreach($categories as $id => $category)
                            <option value="{{ $id }}" {{ $discount->category_id == $id ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Ubicación del descuento -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="location_id">{{ __('sale.location') }}:*</label>
                    <select name="location_id" id="location_id" class="form-control select2" required>
                        <option value="">{{ __('messages.please_select') }}</option>
                        @foreach($locations as $id => $location)
                            <option value="{{ $id }}" {{ $discount->location_id == $id ? 'selected' : '' }}>
                                {{ $location }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Prioridad del descuento -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="priority">{{ __('lang_v1.priority') }}:</label>
                    <input type="number" name="priority" id="priority" class="form-control input_number" required 
                        value="{{ old('priority', $discount->priority) }}" placeholder="{{ __('lang_v1.priority') }}">
                </div>
            </div>

            <!-- Tipo de descuento -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="discount_type">{{ __('sale.discount_type') }}:*</label>
                    <select name="discount_type" id="discount_type" class="form-control select2" required>
                        <option value="">{{ __('messages.please_select') }}</option>
                        <option value="fixed" {{ $discount->discount_type == 'fixed' ? 'selected' : '' }}>
                            {{ __('lang_v1.fixed') }}
                        </option>
                        <option value="percentage" {{ $discount->discount_type == 'percentage' ? 'selected' : '' }}>
                            {{ __('lang_v1.percentage') }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- Monto del descuento -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="discount_amount">{{ __('sale.discount_amount') }}:*</label>
                    <input type="text" name="discount_amount" id="discount_amount" class="form-control input_number" required 
                        value="{{ old('discount_amount', $discount->discount_amount) }}" 
                        placeholder="{{ __('sale.discount_amount') }}">
                </div>
            </div>

            <!-- Fechas de inicio y fin del descuento -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="starts_at">{{ __('lang_v1.starts_at') }}:</label>
                    <input type="text" name="starts_at" id="starts_at" class="form-control discount_date" required 
                        value="{{ old('starts_at', $starts_at) }}" placeholder="{{ __('lang_v1.starts_at') }}" readonly>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="ends_at">{{ __('lang_v1.ends_at') }}:</label>
                    <input type="text" name="ends_at" id="ends_at" class="form-control discount_date" required 
                        value="{{ old('ends_at', $ends_at) }}" placeholder="{{ __('lang_v1.ends_at') }}" readonly>
                </div>
            </div>

            <!-- Grupo de precios -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="spg">{{ __('lang_v1.selling_price_group') }}:</label>
                    <select name="spg" id="spg" class="form-control">
                        <option value="" {{ is_null($discount->spg) ? 'selected' : '' }}>
                            {{ __('lang_v1.all') }}
                        </option>
                        @foreach($price_groups as $id => $group)
                            <option value="{{ $id }}" {{ $discount->spg == (string) $id ? 'selected' : '' }}>
                                {{ $group }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Checkboxes -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="applicable_in_cg" value="1" class="input-icheck"
                            {{ !empty($discount->applicable_in_cg) ? 'checked' : '' }}>
                        <strong>{{ __('lang_v1.applicable_in_cg') }}</strong>
                    </label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="is_active" value="1" class="input-icheck"
                            {{ !empty($discount->is_active) ? 'checked' : '' }}>
                        <strong>{{ __('lang_v1.is_active') }}</strong>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.close') }}</button>
    </div>
</form>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->