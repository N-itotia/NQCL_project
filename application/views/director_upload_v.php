<script>
    $(function () {

        //load_reviewers();

        function load_reviewers() {


            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>assign_director/getAJAXDirectors/",
                dataType: "JSON",
                success: function (reviewers) {

                    $.each(reviewers, function (id, city) {
                        var opt = $('<option />'); // here we're creating a new select option for each group
                        opt.val(city.id);
                        opt.text(city.lname + " " + city.fname);
                        $('#reviewer').append(opt);
                    });
                }

            });
        }
    })

</script>
<style type="text/css">
    div.upload {
        width: 400px;
        height: 250px;
        background-color: #E5E5E5;
        margin: auto;
        padding-top: 50px;
        padding-left: 80px;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        border: 3px solid;
        border-color: #009900;

    }

    div.upload1 {
        margin: auto;
    }

    h2 {
        margin: auto;
        color: green;

    }

    p.error {
        color: red;
        font-family: sans-serif;
        font-weight: bolder;
        text-decoration-style: solid;
    / / display: none;

    }

</style>


<legend><a href="<?php echo base_url(); ?>reviewer">Home</a></legend>
<hr/>
<div class="upload">

    <p class=""><?php echo @$error; ?></p>

    <?php echo form_open_multipart('directors/do_upload_director/' . $labref); ?>


    <p>
    <h2>Kindly only upload <?php echo $labref . '.docx'; ?> file!</h2></p>

    <p>


        <select name="director" required id="reviewer" class=" form-control select select2" style="width:300px;">
            <option value="5" selected="selected">Documentation</option>

        </select>




    </p>

    <p></p><input type="file" name="worksheet" size="20" required/></p>



    <p></p><input type="submit" value="upload && Assign"/></p>

    </form>
</div>

