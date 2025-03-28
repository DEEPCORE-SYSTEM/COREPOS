<?php if(Module::has('Essentials')): ?>
  <?php echo $__env->make('essentials::attendance.clock_in_clock_out_modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>
<script type="text/javascript">
	$(document).ready( function(){
        $('#essentials_dob').datepicker();
		$('.clock_in_btn, .clock_out_btn').click( function() {
            var type = $(this).data('type');
            if (type == 'clock_in') {
                $('#clock_in_clock_out_modal').find('#clock_in_text').removeClass('hide');
                $('#clock_in_clock_out_modal').find('#clock_out_text').addClass('hide');
                $('#clock_in_clock_out_modal').find('.clock_in_note').removeClass('hide');
                $('#clock_in_clock_out_modal').find('.clock_out_note').addClass('hide');
            } else if (type == 'clock_out') {
                $('#clock_in_clock_out_modal').find('#clock_in_text').addClass('hide');
                $('#clock_in_clock_out_modal').find('#clock_out_text').removeClass('hide');
                $('#clock_in_clock_out_modal').find('.clock_in_note').addClass('hide');
                $('#clock_in_clock_out_modal').find('.clock_out_note').removeClass('hide');
            }
            $('#clock_in_clock_out_modal').find('input#type').val(type);

            $('#clock_in_clock_out_modal').modal('show');
        });
	});

	$(document).on('submit', 'form#clock_in_clock_out_form', function(e) {
        e.preventDefault();
        $(this).find('button[type="submit"]').attr('disabled', true);
        var data = $(this).serialize();

        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success == true) {
                    $('div#clock_in_clock_out_modal').modal('hide');

                    var shift_details = document.createElement("div");
                    if (result.current_shift) {
                        shift_details.innerHTML = result.current_shift;
                    }

                    swal({
                        title: result.msg,
                        content: shift_details,
                        icon: 'success'
                    });

                    if (typeof attendance_table !== 'undefined') {
                        attendance_table.ajax.reload();
                    }
                    if (result.type == 'clock_in') {
                        $('.clock_in_btn').addClass('hide');
                        $('.clock_out_btn').removeClass('hide');
                    } else if(result.type == 'clock_out') {
                        $('.clock_out_btn').addClass('hide');
                        $('.clock_in_btn').removeClass('hide');
                    }
                } else {
                    var shift_details = document.createElement("p");
                    if (result.shift_details) {
                        shift_details.innerHTML = result.shift_details;
                    }

                    swal({
                        title: result.msg,
                        content: shift_details,
                        icon: 'error'
                    })
                }
                $('#clock_in_clock_out_form')[0].reset();
                $('#clock_in_clock_out_form').find('button[type="submit"]').removeAttr('disabled');
            },
        });
    });

    $('div#clock_in_clock_out_modal').on('shown.bs.modal', function () {
        function getUserLocation () {
            function getUserLocationDetails (latitude, longitude) {

                $.ajax({
                    method: $(this).attr('method'),
                    url: '/essentials/user-location/' + latitude + ',' + longitude,
                    dataType: 'json',
                    success: function(result) {
                        if (typeof result.results[0] !== 'undefined' && typeof result.results[0].formatted_address !== 'undefined') {

                            $("input#clock_in_out_location").val(result.results[0].formatted_address);
                            $("span.clock_in_out_location").text(result.results[0].formatted_address);
                            $("div.ask_location").hide();
                        } else if (typeof result.error_message !== 'undefined') {
                            console.log(result.error_message);
                        }
                    }
                });
            }
            
            function success(position) {
                getUserLocationDetails(position.coords.latitude, position.coords.longitude);
            }

            function error(error) {
                if (error.PERMISSION_DENIED) {
                    $("div.ask_location").show();
                    $("span.location_required").text("<?php echo e(__('essentials::lang.you_must_enable_location'), false); ?>")
                }
            }

            <?php if(!empty(env('GOOGLE_MAP_API_KEY'))): ?>
                if(!navigator.geolocation) {
                    console.error('Geolocation is not supported by this browser');
                } else {
                    navigator.geolocation.getCurrentPosition(success, error);
                }

            <?php endif; ?>
        }

        getUserLocation();

        $("button.allow_location").on('click', function () {
            getUserLocation();
        });
    });
</script><?php /**PATH C:\xampp\htdocs\corepos\Modules\Essentials\Providers/../Resources/views/layouts/partials/footer_part.blade.php ENDPATH**/ ?>