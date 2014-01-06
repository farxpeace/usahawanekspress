<style>
.metro .horizontal-menu:hover > .dropdown-menu[data-show="hover"] {
  display: block;
}
</style>
<nav class="navigation-bar dark fixed-bottom">
    <nav class="navigation-bar-content">
        
       <div class="horizontal-menu element">
            <a class="dropdown-toggle" href="#">Admin Panel</a>
            <ul class="dropdown-menu drop-up" data-role='dropdown' data-effect='slide' data-show="click" style="top: auto !important; bottom: 100%">
                <li><a href="#">Main</a></li>
                <li><a href="#">Page Editor</a></li>
                <li class="divider"></li>
                <li><a href="#">Print...</a></li>
                <li class="divider"></li>
                <li><a href="#">Exit</a></li>
            </ul>
        </div>
        <span class="element-divider"></span>
 
        <div class="element input-element">
            <form>
                <div class="input-control text">
                    <input type="text" placeholder="Search..." id="search_anything" />
                    <button class="btn-search"></button>
                </div>
            </form>
        </div>
 

        <span class="element-divider place-right"></span>
        <a class="element place-right" href="#"><span class="icon-locked-2"></span></a>

        
    </nav>
</nav>

<script>
	$(function() {
		var cache = {};
		$( "#search_anything" ).autocomplete({
			minLength: 2,
			source: function( request, response ) {
				var term = request.term;
				if ( term in cache ) {
					response( cache[ term ] );
					return;
				}

				$.getJSON( "?modules=Main&op=search", request, function( data, status, xhr ) {
					cache[ term ] = data;
					response( data );
				});
			},
            open: function(event, ui){
                var autocomplete = $(".ui-autocomplete");
                var oldTop = autocomplete.offset().top;
                var newTop = oldTop - autocomplete.height() - $("#search_anything").height() - 100;
                    console.log(newTop)
                autocomplete.css("top", '-160px');
            }
		});
	});
	</script>