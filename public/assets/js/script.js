$(document).ready(function () {
    $(".btn[data-z-target]").click(function (e) { 
        e.preventDefault();
        let x = $($(this).data("z-target")).attr("data-z-collapse") === "true";
        if(x){
            $($(this).data("z-target")).attr("data-z-collapse", "false");
        } else{
            $($(this).data("z-target")).attr("data-z-collapse", "true");
        }
    });
});