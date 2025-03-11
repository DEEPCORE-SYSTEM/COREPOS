@extends('layouts.auth')

@section('content')

<div class="row">

    <h1 class="page-header text-center">{{ config('app.name', 'ultimatePOS') }}</h2>
    
    <div class="col-md-8 col-md-offset-2">
        
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title text-center">Register and Get Started in minutes</h3>
            </div>

            <form action="{{ route('business.postRegister') }}" method="POST">
    @csrf

    <div class="box-body">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">Business Name:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-suitcase"></i></span>
                    <input type="text" name="name" class="form-control" placeholder="Business name">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" name="start_date" class="form-control start-date-picker" placeholder="Start Date" readonly>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="currency">Currency:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-money-bill-alt"></i></span>
                    <select name="currency" class="form-control">
                        <option value="">Select Currency</option>
                       
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="country">Country:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                    <input type="text" name="country" class="form-control" placeholder="Country">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="state">State:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                    <input type="text" name="state" class="form-control" placeholder="State">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="city">City:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                    <input type="text" name="city" class="form-control" placeholder="City">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="zip_code">Zip Code:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                    <input type="text" name="zip_code" class="form-control" placeholder="Zip/Postal Code">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="landmark">Landmark:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                    <input type="text" name="landmark" class="form-control" placeholder="Landmark">
                </div>
            </div>
        </div>

        <div class="col-md-12"><hr/></div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="tax_label_1">Tax 1 Name:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="tax_label_1" class="form-control" placeholder="GST / VAT / Other">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="tax_number_1">Tax 1 No.:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="tax_number_1" class="form-control">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="tax_label_2">Tax 2 Name:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="tax_label_2" class="form-control" placeholder="GST / VAT / Other">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="tax_number_2">Tax 2 No.:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="tax_number_2" class="form-control">
                </div>
            </div>
        </div>

        <div class="col-md-12"><hr/></div>

        <!-- Owner Information -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="surname">Surname:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="surname" class="form-control" placeholder="GST / VAT / Other">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="first_name" class="form-control" placeholder="Owner Name">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="last_name" class="form-control" placeholder="Owner Name">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="username">Username:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" name="username" class="form-control" placeholder="Username used for login">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="password">Password:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Login Password">
                </div>
            </div>
        </div>

    </div>
    
    <div class="box-footer">
        <button type="submit" class="btn btn-success pull-right">Register</button>
    </div>

</form>

            
        </div>
          <!-- /.box -->
    </div>

</div>

@endsection