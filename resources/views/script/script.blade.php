
<script>
    $i = 1;
    $j = 1;
    jQuery(document).ready(function($){

        $("#add_number").click(function (){
            $( ".numbers" ).append( "<div class=\"form-group\">" +
                "<label for=\"number\">Number</label>" +
                "<input type=\"tel\" class=\"form-control\" id=\"number\" placeholder=\"Number\" name=\"number[" + (@yield("lastNumberId")+$i++) + "]\"> </div>" );
        });

        $("#add_email").click(function (){
            $( ".emails" ).append( "<div class=\"form-group\">" +
                "<label for=\"email\">Email</label>" +
                "<input type=\"email\" class=\"form-control\" id=\"email\" placeholder=\"Email\" name=\"email[" + (@yield("lastEmailId")+$j++) + "]\"> </div>" );
        })
    });


</script>

