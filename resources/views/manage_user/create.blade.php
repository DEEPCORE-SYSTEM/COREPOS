@extends('layouts.app')

@section('title', __( 'user.add_user' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>@lang( 'user.add_user' )</h1>
</section>

<!-- Main content -->
<section class="content">
  <form action="{{ action('ManageUserController@store') }}" method="POST" id="user_add_form">
    @csrf
    <div class="row">
      <div class="col-md-12">
        @component('components.widget')
        <div class="col-md-2">
          <div class="form-group">
            <label for="surname">{{ __('business.prefix') }}:</label>
            <input type="text" id="surname" name="surname" class="form-control" placeholder="{{ __('business.prefix_placeholder') }}">
          </div>
        </div>

        <div class="col-md-5">
        <div class="form-group">
    <label for="first_name">{{ __('business.first_name') }}:*</label>
    <input type="text" id="first_name" name="first_name" class="form-control" required placeholder="{{ __('business.first_name') }}" autocomplete="given-name">
</div>

        </div>

        <div class="col-md-5">
          <div class="form-group">
            <label for="last_name">{{ __('business.last_name') }}:</label>
            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="{{ __('business.last_name') }}">
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-4">
        <div class="form-group">
    <label for="email">{{ __('business.email') }}:*</label>
    <input type="email" id="email" name="email" class="form-control" required placeholder="{{ __('business.email') }}" autocomplete="email">
</div>

        </div>


        <div class="col-md-4">
          <div class="form-group">
            <div class="checkbox">
              <br />
              <label>
                <input type="checkbox" name="is_active" value="active" class="input-icheck status" checked> {{ __('lang_v1.status_for_user') }}
              </label>
              @show_tooltip(__('lang_v1.tooltip_enable_user_active'))
            </div>
          </div>
        </div>
        @endcomponent
      </div>
      <div class="col-md-12">
        @component('components.widget', ['title' => __('lang_v1.roles_and_permissions')])
        <div class="col-md-4">
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="allow_login" value="1" class="input-icheck" id="allow_login" checked>
                {{ __( 'lang_v1.allow_login' ) }}
              </label>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="user_auth_fields">
          <div class="col-md-4">
          <div class="form-group">
    <label for="username">{{ __('business.username') }}:</label>

    @if(!empty($username_ext))
        <div class="input-group">
            <input type="text" id="username" name="username" class="form-control" placeholder="{{ __('business.username') }}" autocomplete="username">
            <span class="input-group-addon">{{$username_ext}}</span>
        </div>
        <p class="help-block" id="show_username"></p>
    @else
        <input type="text" id="username" name="username" class="form-control" placeholder="{{ __('business.username') }}" autocomplete="username">
    @endif
    <p class="help-block">@lang('lang_v1.username_help')</p>
</div>

          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="password">{{ __('business.password') }}:*</label>
             
              <input type="password" id="password" name="password" class="form-control" required placeholder="{{ __('business.password') }}" autocomplete="new-password">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="confirm_password">{{ __('business.confirm_password') }}:*</label>
              <input type="password" id="confirm_password" name="confirm_password" class="form-control" required placeholder="{{ __('business.confirm_password') }}">
            </div>
          </div>

        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="role">{{ __('user.role') }}:*</label>
            @show_tooltip(__('lang_v1.admin_role_location_permission_help'))
            <select name="role" id="role" class="form-control select2">
              @foreach ($roles as $key => $value)
              <option value="{{ $key }}">{{ $value }}</option>
              @endforeach
            </select>

          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-3">
          <h4>@lang( 'role.access_locations' ) @show_tooltip(__('tooltip.access_locations_permission'))</h4>
        </div>
        <div class="col-md-9">
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="access_all_locations" value="access_all_locations" class="input-icheck" checked>
                {{ __( 'role.all_locations' ) }}
              </label>
              @show_tooltip(__('tooltip.all_location_permission'))
            </div>
          </div>
          @foreach($locations as $location)
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="location_permissions[]" value="location.{{ $location->id }}" class="input-icheck">
                {{ $location->name }} @if(!empty($location->location_id))({{ $location->location_id}}) @endif
              </label>
            </div>
          </div>
          @endforeach
        </div>
        @endcomponent
      </div>

      <div class="col-md-12">
        @component('components.widget', ['title' => __('sale.sells')])
        <div class="col-md-4">
          <div class="form-group">
            <label for="cmmsn_percent">{{ __('lang_v1.cmmsn_percent') }}:</label>
            @show_tooltip(__('lang_v1.commsn_percent_help'))
            <input type="text" id="cmmsn_percent" name="cmmsn_percent" class="form-control input_number" placeholder="{{ __('lang_v1.cmmsn_percent') }}">
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label for="max_sales_discount_percent">{{ __('lang_v1.max_sales_discount_percent') }}:</label>
            @show_tooltip(__('lang_v1.max_sales_discount_percent_help'))
            <input type="text" id="max_sales_discount_percent" name="max_sales_discount_percent" class="form-control input_number" placeholder="{{ __('lang_v1.max_sales_discount_percent') }}">
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-4">
          <div class="form-group">
            <div class="checkbox">
              <br />
              <label>
                <input type="checkbox" name="selected_contacts" value="1" class="input-icheck" id="selected_contacts">
                {{ __( 'lang_v1.allow_selected_contacts' ) }}
              </label>
              @show_tooltip(__('lang_v1.allow_selected_contacts_tooltip'))
            </div>
          </div>
        </div>
        <div class="col-sm-4 hide selected_contacts_div">
          <div class="form-group">
            <label for="user_allowed_contacts">{{ __('lang_v1.selected_contacts') }}:</label>
            <div class="form-group">
              <select name="selected_contact_ids[]"  class="form-control select2" multiple style="width: 100%;" id="user_allowed_contacts">
                <!-- Aquí puedes agregar las opciones dinámicamente con un foreach si es necesario -->
              </select>
            </div>
          </div>
        </div>

        @endcomponent
      </div>

    </div>
    @include('user.edit_profile_form_part')

    @if(!empty($form_partials))
    @foreach($form_partials as $partial)
    {!! $partial !!}
    @endforeach
    @endif
    <div class="row">
      <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary btn-big" id="submit_user_button">@lang( 'messages.save' )</button>
      </div>
    </div>
  </form>
</section>
    @stop
    @section('javascript')
    <script type="text/javascript">
      __page_leave_confirmation('#user_add_form');
      $(document).ready(function() {
        $('#selected_contacts').on('ifChecked', function(event) {
          $('div.selected_contacts_div').removeClass('hide');
        });
        $('#selected_contacts').on('ifUnchecked', function(event) {
          $('div.selected_contacts_div').addClass('hide');
        });

        $('#allow_login').on('ifChecked', function(event) {
          $('div.user_auth_fields').removeClass('hide');
        });
        $('#allow_login').on('ifUnchecked', function(event) {
          $('div.user_auth_fields').addClass('hide');
        });

        $('#user_allowed_contacts').select2({
          ajax: {
            url: '/contacts/customers',
            dataType: 'json',
            delay: 250,
            data: function(params) {
              return {
                q: params.term, // search term
                page: params.page,
                all_contact: true
              };
            },
            processResults: function(data) {
              return {
                results: data,
              };
            },
          },
          templateResult: function(data) {
            var template = '';
            if (data.supplier_business_name) {
              template += data.supplier_business_name + "<br>";
            }
            template += data.text + "<br>" + LANG.mobile + ": " + data.mobile;

            return template;
          },
          minimumInputLength: 1,
          escapeMarkup: function(markup) {
            return markup;
          },
        });
      });

      $('form#user_add_form').validate({
        rules: {
          first_name: {
            required: true,
          },
          email: {
            email: true,
            remote: {
              url: "/business/register/check-email",
              type: "post",
              data: {
                email: function() {
                  return $("#email").val();
                }
              }
            }
          },
          password: {
            required: true,
            minlength: 5
          },
          confirm_password: {
            equalTo: "#password"
          },
          username: {
            minlength: 5,
            remote: {
              url: "/business/register/check-username",
              type: "post",
              data: {
                username: function() {
                  return $("#username").val();
                },
                username_ext: "{{ $username_ext ?? '' }}"
              }
            }
          }
        },
        messages: {
          password: {
            minlength: 'Password should be minimum 5 characters',
          },
          confirm_password: {
            equalTo: 'Should be same as password'
          },
          username: {
            remote: 'Invalid username or User already exist'
          },
          email: {
            remote: '{{ __("validation.unique", ["attribute" => __("business.email")]) }}'
          }
        }
      });
      $('#username').change(function() {
        if ($('#show_username').length > 0) {
          if ($(this).val().trim() != '') {
            $('#show_username').html("{{__('lang_v1.your_username_will_be')}}: <b>" + $(this).val() + "{{$username_ext}}</b>");
          } else {
            $('#show_username').html('');
          }
        }
      });
    </script>
    @endsection