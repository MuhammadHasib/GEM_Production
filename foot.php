<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>

<footer>
    <div class="footer text-center">
        <p class="4">&copy; Copyright 2015</p> <p>Developed By: <a href="https://profiles.web.cern.ch/762283" target="_blank">Ola Aboamer</a></p>
    </div>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="css/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<!-- custom GEM js  -->
<script src="plugins/custom_GEM.js"></script>


<!-- Bootstrap core JavaScript
================================================== -->
<script src="../../dist/js/bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="../../assets/js/vendor/holder.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

<script type="text/javascript" src="bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap-datetimepicker-master/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript" src="plugins/chosen_v1.4.2/chosen.proto.js" charset="UTF-8"></script>
<script type="text/javascript" src="plugins/chosen_v1.4.2/chosen.jquery.js" charset="UTF-8"></script>
<!-- ace scripts -->
<script src="ace-master/assets/js/ace-elements.min.js"></script>
<script src="ace-master/assets/js/ace.min.js"></script>




<script type="text/javascript">
    function doSomething() {
        //$.get("actions/test.php");
        //return true;
    }

    $('.dropdown-menu a').on('click', function () {
        //alert($(this).html());
        
        //Set the drop down list to the selected value
        $(this).parent().parent().prev().empty();
        $(this).parent().parent().prev().append($(this).html() + " <span class='caret'></span>");
        
        if ($(this).html() == "Long") {
            $(".version").text("L");
            $(".version").val('L');
            $(".serialInput").val($(".serial").text());
        }
        if ($(this).html() == "Short") {
            $(".version").text("S");
            $(".version").val('S');
            $(".serialInput").val($(".serial").text());
        }
        if ($(this).html() == "Bari") {
            $(".institute").text("BARI");
            //$(".serialInput").val($(".serial").text());
        }
        if ($(this).html() == "CERN") {
            $(".institute").text("CERN");
            //$(".serialInput").val($(".serial").text());
        }
        if ($(this).html() == "Florida Tech(FIT)") {
            $(".institute").text("FLORIDA");
            //$(".serialInput").val($(".serial").text());
        }
        if ($(this).html() == "Frascati(LNF)") {
            $(".institute").text("FRASCATI");
            //$(".serialInput").val($(".serial").text());
        }
        if ($(this).html() == "Ghent") {
            $(".institute").text("GHENT");
            //$(".serialInput").val($(".serial").text());
        }
        if ($(this).html() == "BARC") {
            //$(".institute").text("BARC");
            $(".serialInput").val($(".serial").text());
        }
        if ($(this).html() == "Delhi") {
            $(".institute").text("DELHI");
            //$(".serialInput").val($(".serial").text());
        }
        if ($(this).attr("class") == "PCB-DR"){
            $(this).parent().parent().parent().prev().val();
            $(this).parent().parent().parent().prev().val($(this).html());
        }
        if ($(this).attr("class") == "PCB-RO"){
            $(this).parent().parent().parent().prev().val();
            $(this).parent().parent().parent().prev().val($(this).html());
        }
        if ($(this).attr("class") == "FOIL-VI1"){
            $(this).parent().parent().parent().prev().val();
            $(this).parent().parent().parent().prev().val($(this).html());
        }
        if ($(this).attr("class") == "FOIL-VI2"){
            $(this).parent().parent().parent().prev().val();
            $(this).parent().parent().parent().prev().val($(this).html());
        }
        if ($(this).attr("class") == "FOIL-VI3"){
            $(this).parent().parent().parent().prev().val();
            $(this).parent().parent().parent().prev().val($(this).html());
        }
        if ($(this).attr("class") == "status"){
            $(this).parent().parent().parent().prev().val();
            $(this).parent().parent().parent().prev().val($(this).html());
        }
        if ($(this).attr("class") == "location"){
            $(this).parent().parent().parent().prev().val();
            $(this).parent().parent().parent().prev().val($(this).html());
        }
        if ($(this).attr("class") == "institue"){
            $(this).parent().parent().parent().prev().val();
            $(this).parent().parent().parent().prev().val($(this).html());
        }
         if ($(this).attr("class") == "manufacturer"){
            $(this).parent().parent().parent().prev().val();
            $(this).parent().parent().parent().prev().val($(this).html());
        }
        
        if ($(this).attr("class") == "availablepart"){
            $(this).parent().parent().parent().prev().val();
            $(this).parent().parent().parent().prev().val($(this).html());
            //var x = $(this).html();
            //$("availablepart a[value='"+x+"']").remove();
        }
         if ($(this).hasClass('label')){
            $(this).parent().parent().parent().prev().val();
            $(this).parent().parent().parent().prev().val($(this).html());
        }
        if ($(this).attr("class") == "kinds"){
            $(this).parent().parent().parent().prev().val();
            $(this).parent().parent().parent().prev().val($(this).attr('kind-id'));
            if($(this).val() !== '' && $('.num').val() !== '')$('.subbutt_at').attr('disabled', false);
        }
        // used in Search channel page
        if ($(this).attr("class") == "searchbysdv"){
            $(".searchby").val("");
            $(".searchby").val($(this).html());
            $(".sdv").show();
            $(".epd").hide();
            $(".epd").find("input").val("");
            
        }
        if ($(this).attr("class") == "searchbyepd"){
            $(".searchby").val("");
            $(".searchby").val($(this).html());
            $(".sdv").hide();
            $(".epd").show();
            $(".sdv").find("input").val("");
        }
        
        
        
        $('.dropdown-menu a').dropdown("toggle");
        return false;
        //$('.dropdown-toggle').html($(this).html() + '<span class="caret"></span>');    
    })

    $(".testDiod").change(function () {
        if ($(this).is(':checked')) {
            //alert("check");
            $(".diodes").val(1);
        }
        else {
            //alert("uncheck");
            $(".diodes").val(0);
        }
    });


    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });

    $(".subbutt").click(function(){
        //alert($(".serialInput").val());
        if($(".serialInput").val() == "")
        { 
            $(".alert-danger").show();
            $('html, body').animate({ scrollTop: 0 }, 0);
            return false;
        }
    });
</script>


    <script type="text/javascript">
        $(".chosen-select").chosen();
        $(".chosen-select-gebl").chosen();
        $(".chosen-select-gebs").chosen();
        $(".chosen-select-opto").chosen();
        $(".chosen-select-vfat0").chosen();
        $(".chosen-select-vfat1").chosen();
        $(".chosen-select-vfat2").chosen();
        $(".chosen-select-vfat3").chosen();
        $(".chosen-select-vfat4").chosen();
        $(".chosen-select-vfat5").chosen();
        $(".chosen-select-vfat6").chosen();
        $(".chosen-select-vfat7").chosen();
        $(".chosen-select-vfat8").chosen();
        $(".chosen-select-vfat9").chosen();
        $(".chosen-select-vfat10").chosen();
        $(".chosen-select-vfat11").chosen();
        $(".chosen-select-vfat12").chosen();
        $(".chosen-select-vfat13").chosen();      
        $(".chosen-select-vfat14").chosen();        
        $(".chosen-select-vfat15").chosen();
        $(".chosen-select-vfat16").chosen();
        $(".chosen-select-vfat17").chosen();
        $(".chosen-select-vfat18").chosen();
            $(".chosen-select-vfat19").chosen();
            $(".chosen-select-vfat20").chosen();
            $(".chosen-select-vfat21").chosen();
            $(".chosen-select-vfat22").chosen();
            $(".chosen-select-vfat23").chosen();
            $(".chosen-select-sector").chosen();
            $("select[class^='chosen-select']").chosen();




            jQuery(document).ready(function ($) {

// site preloader -- also uncomment the div in the header and the css style for #preloader
                $(window).load(function () {
                    $('#preloader').fadeOut('fast', function () {/*$(this).remove();*/
                    });
                });

            });


            $('.detach').click(function () {
                
                var item = $(this);
                //<span style='color: red;'>You are going to detach this part from current parent part, Proceed?</span>
                var r = confirm("ATTENTION!\nYou are going to detach this part from current parent part, Proceed?");
                if (r == true) {
                    //txt = "You pressed OK!";
                    $('#preloader').fadeIn('fast', function () {/*$(this).remove();*/
                    });
                    $.ajax({
                        type: 'POST',
                        url: 'functions/ajaxActions.php?detach=true&partid=' + item.attr('id') + '&kind=' + item.attr('kind') + '&user=<?php echo $_SESSION['user']; ?>',
                        success: function (data) {
                            console.log(data);
                            item.parent().remove();
                            $('#preloader').fadeOut('fast', function () {/*$(this).remove();*/
                    });
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert(errorThrown);
                        }

                    });
                    $('body').load(
                            'https://gemdb.web.cern.ch/gemdb/proxy.php', {
                                csurl: 'https://gemdb.web.cern.ch/gemdb/functions/ajaxActions.php',
                                detach: true,
                                partid: item.attr('id'),
                                kind: item.attr('kind'),
                                user: '<?php echo $_SESSION['user']; ?>'
                            }
                    );
                } else {
                    //txt = "You pressed Cancel!";
                }

    
})
    </script>


<link rel="import" href="foot_panel.html">

</body>
</html>