@foreach($featured_products as $variation)
<div class="col-md-3 col-xs-4 product_list no-print">
    <div class="product_box" data-toggle="tooltip" data-placement="bottom" data-variation_id="{{$variation->id}}"
        title="{{$variation->full_name}}">

        @php
        $imageUrl = asset('/img/default.png'); // Imagen por defecto

        if (count($variation->media) > 0) {
        $imageUrl = $variation->media->first()->display_url;
        } elseif (!empty($variation->product->image_url)) {
        $imageUrl = $variation->product->image_url;
        }
        @endphp

        <div class="image-container" style="background-image: url('{{ $imageUrl }}'); 
            background-repeat: no-repeat; 
            background-position: center; 
            background-size: contain;">
        </div>


        <div class="text_div">
            <small class="text text-muted">{{$variation->product->name}}
                @if($variation->product->type == 'variable')
                - {{$variation->name}}
                @endif
            </small>

            <small class="text-muted">
                ({{$variation->sub_sku}})
            </small>
        </div>

    </div>
</div>
@endforeach