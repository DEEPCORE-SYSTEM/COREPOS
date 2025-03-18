<div class="pos-tab-content">
    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
                <!-- Etiqueta para el campo de prefijo de To-Dos -->
                <label for="essentials_todos_prefix">@lang('essentials::lang.essentials_todos_prefix'):</label>
                
                <!-- Campo de entrada para el prefijo de To-Dos -->
                <input type="text" name="essentials_todos_prefix" id="essentials_todos_prefix" 
                       class="form-control" placeholder="@lang('essentials::lang.essentials_todos_prefix')" 
                       value="{{ $settings['essentials_todos_prefix'] ?? '' }}">
            </div>
        </div>
    </div>
</div>
