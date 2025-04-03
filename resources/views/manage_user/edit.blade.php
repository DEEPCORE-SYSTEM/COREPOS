@extends('layouts.app')

@section('title', __('user.edit_user'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('user.edit_user')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ action('ManageUserController@update', [$user->id]) }}" method="POST" id="user_edit_form">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-12">
                    @component('components.widget', ['class' => 'box-primary'])
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="surname">{{ __('business.prefix') }}:</label>
                                <input type="text" name="surname" value="{{ old('surname', $user->surname) }}"
                                    class="form-control" placeholder="{{ __('business.prefix_placeholder') }}">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="first_name">{{ __('business.first_name') }}:*</label>
                                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                                    class="form-control" required placeholder="{{ __('business.first_name') }}">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="last_name">{{ __('business.last_name') }}:</label>
                                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                                    class="form-control" placeholder="{{ __('business.last_name') }}">
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">{{ __('business.email') }}:*</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="form-control" required placeholder="{{ __('business.email') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="checkbox">
                                    <br>
                                    <label>
                                        <input type="checkbox" name="is_active" value="1"
                                            {{ $user->status ? 'checked' : '' }} class="input-icheck status">
                                        {{ __('lang_v1.status_for_user') }}
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
                                        <input type="checkbox" name="allow_login" value="1"
                                            {{ !empty($user->allow_login) ? 'checked' : '' }} class="input-icheck"
                                            id="allow_login">
                                        {{ __('lang_v1.allow_login') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="user_auth_fields {{ empty($user->allow_login) ? 'hide' : '' }}">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="username">{{ __('business.username') }}:</label>
                                    <input type="text" name="username" class="form-control"
                                        placeholder="{{ __('business.username') }}">
                                    <p class="help-block">@lang('lang_v1.username_help')</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">{{ __('business.password') }}:</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="{{ __('business.password') }}"
                                        {{ empty($user->allow_login) ? 'required' : '' }}>
                                    <p class="help-block">@lang('user.leave_password_blank')</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="confirm_password">{{ __('business.confirm_password') }}:</label>
                                    <input type="password" name="confirm_password" class="form-control"
                                        placeholder="{{ __('business.confirm_password') }}"
                                        {{ empty($user->allow_login) ? 'required' : '' }}>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">{{ __('user.role') }}:*</label>
                                @show_tooltip(__('lang_v1.admin_role_location_permission_help'))
                                <select name="role" class="form-control select2" style="width: 100%;">
                                    @foreach ($roles as $id => $role)
                                        <option value="{{ $id }}"
                                            {{ !empty($user->roles->first()->id) && $user->roles->first()->id == $id ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endcomponent
                </div>

                <div class="col-md-12">
                    @component('components.widget', ['title' => __('sale.sells')])
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cmmsn_percent">{{ __('lang_v1.cmmsn_percent') }}:</label>
                                <input type="text" name="cmmsn_percent"
                                    value="{{ old('cmmsn_percent', $user->cmmsn_percent) }}" class="form-control input_number"
                                    placeholder="{{ __('lang_v1.cmmsn_percent') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label
                                    for="max_sales_discount_percent">{{ __('lang_v1.max_sales_discount_percent') }}:</label>
                                <input type="text" name="max_sales_discount_percent"
                                    value="{{ old('max_sales_discount_percent', $user->max_sales_discount_percent) }}"
                                    class="form-control input_number"
                                    placeholder="{{ __('lang_v1.max_sales_discount_percent') }}">
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="checkbox">
                                    <br>
                                    <label>
                                        <input type="checkbox" name="selected_contacts" value="1"
                                            {{ $user->selected_contacts ? 'checked' : '' }} class="input-icheck"
                                            id="selected_contacts">
                                        {{ __('lang_v1.allow_selected_contacts') }}
                                    </label>
                                    @show_tooltip(__('lang_v1.allow_selected_contacts_tooltip'))
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 selected_contacts_div {{ !$user->selected_contacts ? 'hide' : '' }}">
                            <div class="form-group">
                                <label for="user_allowed_contacts">{{ __('lang_v1.selected_contacts') }}:</label>
                                <select name="selected_contact_ids[]" class="form-control select2" multiple
                                    style="width: 100%;" id="user_allowed_contacts">
                                    @foreach ($contact_access as $key => $contact)
                                        <option value="{{ $key }}" selected>{{ $contact }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endcomponent
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btn-big"
                        id="submit_user_button">{{ __('messages.update') }}</button>
                </div>
            </div>
        </form>

    @stop
    @section('javascript')
        <script type="text/javascript">
            $(document).ready(function() {
                __page_leave_confirmation('#user_edit_form');

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

            $('form#user_edit_form').validate({
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
                                },
                                user_id: {{ $user->id }}
                            }
                        }
                    },
                    password: {
                        minlength: 5
                    },
                    confirm_password: {
                        equalTo: "#password",
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
                                @if (!empty($username_ext))
                                    username_ext: "{{ $username_ext }}"
                                @endif
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
                        remote: '{{ __('validation.unique', ['attribute' => __('business.email')]) }}'
                    }
                }
            });
        </script>
    @endsection
