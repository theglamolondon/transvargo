$(document).ready(function () {
    //Get CurrentUrl variable by combining origin with pathname, this ensures that any url appendings (e.g. ?RecordId=100) are removed from the URL
    var CurrentUrl = window.location.origin+window.location.pathname;
    //Check which menu item is 'active' and adjust apply 'active' class so the item gets highlighted in the menu
    //Loop over each <a> element of the NavMenu container
    $('.rd-navbar-nav li a').each(function(Key,Value)
    {
        //Check if the current url
        if(Value['href'] === CurrentUrl)
        {
            //We have a match, add the 'active' class to the parent item (li element).
            $(Value).parent().addClass('active');
        }
    });
});