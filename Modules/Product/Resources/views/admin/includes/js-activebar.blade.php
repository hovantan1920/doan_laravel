<script>
    var name = "{{$name}}";
    switch(name){
        case "users":
            $("#menu-users").addClass("active");
            break;
        case "bookings":
            $("#menu-bookings").addClass("active");
            break;
        case "categories":
            $("#menu-categories").addClass("active");
            break;
        case "products":
            $("#menu-products").addClass("active");
            break;  
        case "groups":
            $("#menu-groups").addClass("active");
            break;  
        case "gallerys":
            $("#menu-gallerys").addClass("active");
            break;    
        default:
            $("#menu-home").addClass("active");
            break;  
    }
</script>