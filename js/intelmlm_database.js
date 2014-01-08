
( function( $, window ) {
    var namespace = 'intel';
    var widgetName = 'database';
    var defaultOptions = {
        log: true,
        version: '1.0',
        maxSize: 1048576
    }
    // Overwrite default options 
    // with user provided ones 
    // and merge them into "options". 
    var options = $.extend({}, defaultOptions, options);
    
    
    // ****************
	// PUBLIC FUNCTIONS
	// Usage format: $.database.close();
	// Usage from within an iframe: parent.jQuery.database.close();
	// ****************
    publicMethod = $.fn[widgetName] = $[widgetName] = function (method, callback) {
        var $this = this, args = Array.prototype.slice.call(arguments, 1);
        
        var returndata = { method: method }
        return arguments;
    }
    
    publicMethod.error = function(method, data){
        if(!options.log){return false; }
        
        if(method == 'create'){
            console.group("Create database");
            if(!data.dbname){ console.error('database name: '+data.dbname); }
            console.groupEnd();
        }
        
    }

    publicMethod.create = function(dbname, callback){
        var args = Array.prototype.slice.call(arguments, 1);

        if(!dbname){ publicMethod.error('create', { dbname: dbname }); return false; }
        
        console.log('Create database name: '+dbname);
        $.db.open_db({
            shortName: dbname,
            version:   '1.0',
            name:      dbname,
            maxSize:   options.maxSize //allow up to 1 mb to be stored
        });
        
        if(callback){
            callback('create',{ shortName: dbname, version: options.version, name: dbname, maxSize: options.maxSize });
        }
    }
    
    
    
    // The jQuery.aj namespace will automatically be created if it doesn't exist
    $.widget( "intel.database", {
        // These options will be used as defaults
        options: { 
            className : "" 
        },
        _create: function() {
            
            
        },
        create: function(){
            console.log('aa');
        },
        // Keep various pieces of logic in separate methods
        filter: function() {
            // Methods without an underscore are "public"
        },
        _hover: function() {
            // Methods with an underscore are "private"
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
})( jQuery, window );