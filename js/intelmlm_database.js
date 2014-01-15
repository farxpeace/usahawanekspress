
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

    publicMethod.create = function(dbname, schema, callback){
        var args = Array.prototype.slice.call(arguments, 1);

        if(!dbname){ publicMethod.error('create', { dbname: dbname }); return false; }
        
        console.log('Create database name: '+dbname);
        
        
        db = new ydn.db.Storage(dbname, schema);
        
        if(callback){
            callback('create',{ name: dbname, db: db });
        }
    }
    
    publicMethod.insert = function(tablename, array, callback){
        var args = Array.prototype.slice.call(arguments, 1);

        db.put(tablename, array);
        
        if(callback){
            callback('create',{ name: tablename, db: db });
        }
    }
    
    publicMethod.select = function(tablename, query, column, callback){
        var args = Array.prototype.slice.call(arguments, 1);
        var result_arr = [];
        var nocallback = [];
        var select = db.executeSql(query).then(function(results) {
            
            if(column.length == 0){
                column = '*';
            }
            
            if(column == '*'){
                $.each(results, function(i){
                    result_arr.push(this);
                });
            }else{
                $.each(results, function(i, el){
                    var d = {};
                    $.each(column, function(j, cel){
                        d[cel] = el[cel];
                    });
                    result_arr.push(d);
                });
            }
            
            if(callback){
                callback({ tablename: tablename, db: db, row: result_arr });
            }                       

            
            
        }, function(e) {
          throw e;
        });
        
        
    }
    
    function returnfunction(data){
        return data;
    }
    
    
    
    
    jqinfoname = 'jqinfo';
    var jqinfoarr = {
        
    }
    publicMethod = $.fn[jqinfoname] = $[jqinfoname] = function (method, callback) {
        var $this = this, args = Array.prototype.slice.call(arguments, 1);
        
        var returndata = { method: method }
        return arguments;
    }
    
    
    
    publicMethod.session = function(callback){
        var args = Array.prototype.slice.call(arguments, 1);
        var userid = jQinfo_object.userid;
        var select = $.database.select('users', "SELECT * FROM users WHERE userid=\'"+userid+"\' LIMIT 1", '*', function(resultsdata){
            
        });
        
        
        if(callback){
            callback();
        }else{
            return 
        }
    }
    
    // The jQuery.aj namespace will automatically be created if it doesn't exist
    $.widget( "intel.jqinfo", {
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