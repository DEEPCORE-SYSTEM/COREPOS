<!-- Contenido de la pestaña de configuración de respaldo -->
<div class="pos-tab-content">
    <div class="row">
        <!-- Selección del disco de respaldo -->
        <div class="col-xs-4">
            <div class="form-group">
                <label for="BACKUP_DISK">{{ __('superadmin::lang.backup_disk') }}:</label>
                <select name="BACKUP_DISK" id="BACKUP_DISK" class="form-control">
                    @foreach($backup_disk as $key => $value)
                        <option value="{{ $key }}" {{ $default_values['BACKUP_DISK'] == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Campo para el token de acceso de Dropbox (visible solo si se selecciona Dropbox) -->
        <div class="col-xs-8 {{ env('BACKUP_DISK') != 'dropbox' ? 'hide' : '' }}" id="dropbox_access_token_div">
            <div class="form-group">
                <label for="DROPBOX_ACCESS_TOKEN">{{ __('superadmin::lang.dropbox_access_token') }}:</label>
                <input type="text" name="DROPBOX_ACCESS_TOKEN" id="DROPBOX_ACCESS_TOKEN" class="form-control" 
                    placeholder="{{ __('superadmin::lang.dropbox_access_token') }}" 
                    value="{{ $default_values['DROPBOX_ACCESS_TOKEN'] }}">
            </div>

            <!-- Ayuda sobre cómo obtener el token de acceso de Dropbox -->
            <p class="help-block">
                {!! __('superadmin::lang.dropbox_help', ['link' => 'https://www.dropbox.com/developers/apps/create']) !!}
            </p>
        </div>
    </div>
</div>
