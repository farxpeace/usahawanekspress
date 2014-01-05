( function( $ ) {
    // The jQuery.xm namespace will automatically be created if it doesn't exist
    $.widget( "intelmlm.package", {
        // These options will be used as defaults
        options: { 
            
        },
        _create: function() {
            var self = this, op = self.options, el = self.element;

            
        },
        _setOption: function( key, value ) {
            // Use the _setOption method to respond to changes to options
            switch( key ) {
                case "length":
                    break;
            }
            // and call the parent function too!
            return this._superApply( arguments );
        },
        _destroy: function() {
            // Use the destroy method to reverse everything your plugin has applied
            return this._super();
        },
    });
})( jQuery );