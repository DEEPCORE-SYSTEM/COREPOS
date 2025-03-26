@php
    $quantity = isset($quantity) ? $quantity : 1;
    $multiplier = isset($multiplier) ? $multiplier : 1;
    $unit_id = isset($unit_id) ? $unit_id : null;
@endphp

@foreach($variations as $variation)
    <tr>
        <td class="text-center">
            @if($product->type == 'variable')
                {{ $product->name }} ({{ $variation->name }}) - {{ $variation->sub_sku }}
            @else
                {{ $product->name }} - {{ $variation->sub_sku }}
            @endif

            <input type="hidden" name="composition_variation_id[]" value="{{ $variation->id }}">
        </td>
        <td class="text-center">
            <input type="text" name="quantity[]" value="{{ number_format($quantity, 2) }}" class="form-control col-sm-12 input-sm quantity input_number mousetrap" required style="width: 77px">

            @if(!empty($sub_units))
                <br>
                <select name="unit[]" class="form-control input-sm sub_unit">
                    @foreach($sub_units as $key => $value)
                        <option value="{{ $key }}" data-multiplier="{{ $value['multiplier'] }}" @if($unit_id == $key) selected @endif>
                            {{ $value['name'] }}
                        </option>
                    @endforeach
                </select>
            @else 
                <input type="hidden" name="unit[]" value="{{ $product->unit->id }}">
                {{ $product->unit->short_name }}
            @endif
        </td>
        <td class="text-center">
            <span class="purchase_price display_currency purchase_price_text" data-currency_symbol="true">
                {{ number_format($variation->default_purchase_price, 2) }}
            </span>
            <input type="hidden" class="purchase_price" value="{{ $variation->default_purchase_price }}">
        </td>
        <td class="text-center">
            <span class="item_level_purchase_price display_currency" data-currency_symbol="true">
                {{ number_format($variation->default_purchase_price * $quantity * $multiplier, 2) }}
            </span>
            <input type="hidden" class="item_level_purchase_price" value="{{ $variation->default_purchase_price * $quantity * $multiplier }}">
        </td>
        <td class="text-center">
            <span>
                <i class="fa fa-times remove_combo_product_entry_row text-danger" title="Remove" style="cursor:pointer;"></i>
            </span>
        </td>
    </tr>
@endforeach
