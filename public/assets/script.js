jQuery(document).ready(function($){
    $("#add_number").click(function (){
        $( ".numbers" ).append( "<div class=\"form-group\">" +
            "<label for=\"number\">Number</label>" +
            "<input type=\"tel\" class=\"form-control\" id=\"number\" placeholder=\"Number\" name=\"number[]\"> </div>" +
            "@error('number')\n" +
            "<div class=\"alert alert-danger\">{{ $message }}</div>\n" +
            "@enderror");
    });

    $("#add_email").click(function (){
        $( ".emails" ).append( "<div class=\"form-group\">" +
            "<label for=\"email\">Email</label>" +
            "<input type=\"email\" class=\"form-control\" id=\"email\" placeholder=\"Email\" name=\"email[]\"> </div>" +
            "@error('email')\n" +
            "<div class=\"alert alert-danger\">{{ $message }}</div>\n" +
            "@enderror");
    })
});


