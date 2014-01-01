( function( $ ) {
    // The jQuery.aj namespace will automatically be created if it doesn't exist
    $.widget( "aj.payment", {
        // These options will be used as defaults
        options: { 
            debug: false,
            status: '',
            number: '',
            trx_ref: ''
        },
        _create: function() {
            var self = this, op = self.options, el = self.element;
            //extract data
            self.extractData();
            
            
            //set mainframe
            
            
            
            
            self.check_status();
            self.debug();
        },
        addClassSelected: function(){
            var self = this, op = self.options, el = self.element;
            
            
            
        },
        set_mainframe: function(status){
          var self = this, op = self.options, el = self.element;
          var number = op.number;
          var mainframe = $("#mainframe_purchase_"+number); 
          var listupline = mainframe.find('a.list_upline');
          if(status == 'waiting_for_payment'){
            $(listupline).addClass('waiting_for_payment');
          }else if(status == 'paid'){
            $(listupline).addClass('paid');
            $(listupline).addClass('selected');
          }
          
        },
        check_status: function(){
            var self = this, op = self.options, el = self.element;
            var data = $(el).data();
            console.log('status: '+op.number+' - '+data.status);
            
            if(data.status == 'paid'){
                self.hide_payment_tab_paid();
                self.show_receipt();
            }else if(data.status == 'waiting_for_payment'){
                self.hide_receipt();
                self.show_payment_tab();
            }else{
                self.hide_receipt();
                self.hide_payment_tab();
            }
            op.status = data.status;
            console.log(data.status);
            
        },
        show_receipt: function(){
            var self = this, op = self.options, el = self.element;
            
            $("#frame_receipt_hide_"+op.number).hide();
            $("#frame_receipt_show_"+op.number).show();
        },
        hide_receipt: function(){
            var self = this, op = self.options, el = self.element;
            $("#frame_receipt_hide_"+op.number).show();
            $("#frame_receipt_show_"+op.number).hide();
            
        },
        hide_payment_tab_paid: function(){
            var self = this, op = self.options, el = self.element;
            
            $('#frame_pembayaran_hide_paid_'+op.number).show();
            $('#frame_pembayaran_hide_'+op.number).hide();
            $(el).hide();
                
        },
        show_payment_tab: function(){
            var self = this, op = self.options, el = self.element;
            
            var tab = $('#frame_pembayaran_hide_'+op.number).hide();
            $(el).show();
        },
        hide_payment_tab: function(){
            var self = this, op = self.options, el = self.element;
            
            var tab = $('#frame_pembayaran_hide_'+op.number).show();
            $(el).hide();
        },
        debug: function(){
            var self = this, op = self.options, el = self.element;
            if(op.debug){
                $(el).find('.list-debug').show();
            }else{
                $(el).find('.list-debug').hide();
            }
        },
        extractData: function(){
            var self = this, op = self.options, el = self.element;
            var data = $(el).data();
            op.status = data.status;
            op.number = data.number;
            op.trx_ref = data.trx_ref;
            console.log(data)
        },
        _set_trx_ref: function(trx_ref){
            var self = this, op = self.options, el = self.element;
            op.trx_ref = trx_ref;
            $(el).data('trx_ref', trx_ref);
            console.log('ref set to '+trx_ref)
        },
        _set_status: function(status){
            var self = this, op = self.options, el = self.element;
            op.status = status;
            $(el).data('status', status);
            self.check_status();
            self.set_mainframe(status);
            console.log('status set to '+status)
        },
        
        _setOption: function( key, value ) {
            var self = this, op = self.options, el = self.element;
            // Use the _setOption method to respond to changes to options
            console.log(key)
            switch( key ) {
                case "length":
                    break;
                case "trx_ref":
                    self._set_trx_ref(value);
                    break;
                case "status":
                    self._set_status(value);
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
$(function(){
    $(".frame_pembayaran_tab").payment();
});




