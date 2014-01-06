(function( $ ) {
    $.widget("metro.dropdown", {

        version: "1.0.0",

        options: {
            effect: 'slide',
            show: 'click'
        },

        _create: function(){
            var  that = this,
                 menu = this.element,
                 name = this.name,
                 parent = this.element.parent(),
                 toggle = parent.children('.dropdown-toggle');

            if (menu.data('effect') != undefined) {
                this.options.effect = menu.data('effect');
            }
            
            if (menu.data('show') != undefined) {
                if((menu.data('show')) == 'hover'){ menu.data('show', 'mouseover'); }
                this.options.show = menu.data('show');
            }
            toggle = toggle.parent();
            toggle.css('cursor', 'pointer');
            toggle.on(this.options.show+'.'+name, function(e){
                e.preventDefault();
                e.stopPropagation();
                
                if (menu.css('display') == 'block' && !menu.hasClass('keep-open')) {
                    that._close(menu);
                } else {
                    $('.dropdown-menu').each(function(i, el){
                        if (!menu.parents('.dropdown-menu').is(el) && !$(el).hasClass('keep-open') && $(el).css('display')=='block') {
                            that._close(el);
                        }
                    });
                    that._open(menu);
                }
            });

            $(menu).find('li.disabled a').on(this.options.show, function(e){
                e.preventDefault();
            });

            $('html').on('click', function(e){
                //e.preventDefault();
                $('.dropdown-menu').each(function(i, el){
                    if (!$(el).hasClass('keep-open') && $(el).css('display')=='block') {
                        that._close(el);
                        /* Почему то срабатывает трижды */
                    }
                });
            });
        },

        _open: function(el){
            switch (this.options.effect) {
                case 'fade': $(el).fadeIn('fast'); break;
                case 'slide': $(el).slideDown('normal'); break;
                default: $(el).hide();
            }
            this._trigger("onOpen", null, el);
        },

        _close: function(el){
            switch (this.options.effect) {
                case 'fade': $(el).fadeOut('fast'); break;
                case 'slide': $(el).slideUp('normal'); break;
                default: $(el).hide();
            }
            this._trigger("onClose", null, el);
        },

        _destroy: function(){
        },

        _setOption: function(key, value){
            this._super('_setOption', key, value);
        }
    });
})( jQuery );

/*
(function($){
    $.fn.PullDown = function( options ){
        var defaults = {
        };

        var $this = $(this)
            ;

        var initSelectors = function(selectors){

            addTouchEvents(selectors[0]);

            selectors.on('click', function(e){
                var $m = $this.parent().children(".element-menu");
                console.log($m);
                if ($m.css('display') == "block") {
                    $m.slideUp('fast');
                } else {
                    $m.slideDown('fast');
                }
                e.preventDefault();
                e.stopPropagation();
            });
        };

        return this.each(function(){
            if ( options ) {
                $.extend(defaults, options);
            }

            initSelectors($this);
        });
    };

    $(function () {
        $('.pull-menu, .menu-pull').each(function () {
            $(this).PullDown();
        });
    });
})(window.jQuery);
*/
