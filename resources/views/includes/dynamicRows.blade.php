<script>
    jQuery(document).ready(function () {
        'use strict';
        var input = {{isset($filter) ? count($filter) + 1 : 2}}
        var input_no = 0;
        $('form').on('click', '.remove', function () {
            input_no =  $(this).attr('name');
            $('.row'+ input_no).next('br').remove();
            $('.row'+ input_no).remove();
            input = input - 1;
        });

        $('form').on('click', '.duplicate', function () {
            $('form').append('<div class="row row' + (input) + '"><div class="form-group col-md-3"><select id="col1" name="filter[' + (input) + '][col]" class="form-control col"><option value="id">ID</option> <option value="first_name">First Name</option> <option value="last_name">Last Name</option> <option value="full_name">Full Name</option> <option value="gender">Gender</option> <option value="num_msgs">Number of Messages</option> <option value="age">Age</option> <option value="creation_date">Creation Date</option> </select></div>'
                +'<div class="form-group col-md-3"><select id="operator1" name="filter[' + (input) + '][operator]" class="form-control operator">  <option value="=">=</option> <option value="!=">!=</option> <option value=">"> > </option> <option value="<"> < </option> <option value="startswith"> starts with </option> <option value="endswith"> ends with </option> <option value="contains"> contains </option> <option value="exact"> exact </option> </select> </div>'
                +'<div class="form-group col-md-3"><input type="text" class="form-control value" name="filter[' + (input) + '][value]"> </div>'
                +'<div class="form-group col-md-2"><select class="form-control" name="filter[' + (input) + '][join]"> <option value="and">AND</option> <option value="or">OR</option> </select></div>'
                +'<div class="form-group col-md-1"><input type="button" class="btn btn-danger remove" name="' + (input) + '" value="x"> </div> </div> <br>'
            );
            input = input + 1;
        });
    });

</script>
