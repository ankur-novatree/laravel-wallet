(function ($) {

    "use strict";

    var MaterialMenuBar = function (element) {
        this.$dropDownBtn = $(element);
        // Initialize instance.
        this.init();
    };
    window['MaterialMenuBar'] = MaterialMenuBar;

    MaterialMenuBar.prototype.init = function () {
        if(this.$dropDownBtn.length){
            //this.$dropdownParent
            var target = this.$dropDownBtn.attr('data-target');
            if(typeof target !== typeof undefined){
                this.$dropdownContainer = $(target)
            }
            else{
                //this.$dropdownContainer = this.$dropDownBtn.next(this.CssClasses_.CONTAINER);
                this.$dropdownContainer = $('.drupal-menu-container');
                if(!this.$dropdownContainer.length){
                    throw new Error('Dropdown menu must be specified.');
                    return null;
                }
            }
            this.width = this.$dropdownContainer.width();
            this.$dropDownBtn.on('click', this.handleForClick_.bind(this));
            this.$dropDownBtn.on('keydown', this.handleForKeyboardEvent_.bind(this));
            var $items = this.$dropdownContainer.find('.'+this.CssClasses_.ITEM);
            this.boundItemKeydown_ = this.handleItemKeyboardEvent_.bind(this);
            this.boundItemClick_ = this.handleItemClick_.bind(this);
            for(var i= 0; i< $items.length; i++){
                $($items[i]).on('click', this.boundItemClick_);
                $($items[i]).attr('tabindex','-1');
                $($items[i]).on('keydown', this.boundItemKeydown_);
            }
            this.$dropdownContainer.addClass(this.CssClasses_.IS_UPGRADED);
        }
    };

    MaterialMenuBar.VERSION = '1.0';

    MaterialMenuBar.prototype.Keycodes_ = {
        ENTER: 13,
        ESCAPE: 27,
        SPACE: 32,
        UP_ARROW: 38,
        DOWN_ARROW: 40
    };

    MaterialMenuBar.prototype.Constant_ = {
        TRANSITION_DURATION_SECONDS: 0.3,
        TRANSITION_DURATION_FRACTION: 0.8,
        CLOSE_TIMEOUT: 300,
        BOTTOM_LEFT: 'bottom left',
        BOTTOM_RIGHT: 'bottom right',
        TOP_LEFT: 'top left',
        TOP_RIGHT: 'top right'
    };

    MaterialMenuBar.prototype.CssClasses_ = {
        CONTAINER: 'lg-menu__container',
        OUTLINE: 'lg-menu__outline',
        ITEM: 'lg-menu__item',
        ITEM_RIPPLE_CONTAINER: 'lg-menu__item-ripple-container',
        RIPPLE_EFFECT: 'lg-js-ripple-effect',
        RIPPLE_IGNORE_EVENTS: 'lg-js-ripple-effect--ignore-events',
        RIPPLE: 'lg-ripple',
        IS_UPGRADED: 'is-upgraded',
        IS_VISIBLE: 'is-visible',
        IS_ANIMATING: 'is-animating',
        BOTTOM_LEFT: 'lg-menu--bottom-left',
        BOTTOM_RIGHT: 'lg-menu--bottom-right',
        TOP_LEFT: 'lg-menu--top-left',
        TOP_RIGHT: 'lg-menu--top-right',
        UNALIGNED: 'lg-menu--unaligned',
        IS_LEAVING: 'is-leaving',
        BACKDROP: 'lg-menu__backdrop',
        IS_OPEN: 'is-open'
    };

    MaterialMenuBar.prototype.handleForKeyboardEvent_ = function(){

    };

    MaterialMenuBar.prototype.handleItemKeyboardEvent_ = function(){

    };

    MaterialMenuBar.prototype.handleItemClick_ = function(){

    };

    MaterialMenuBar.prototype.handleClickForBackDrop = function(){
        this.hide();
    };

    MaterialMenuBar.prototype.handleForClick_ = function(event){
        var rect = this.$dropDownBtn.get(0).getBoundingClientRect();
        console.log(rect);
        if (typeof this.$dropDownBtn.attr('data-position') !== typeof undefined) {
            switch (this.$dropDownBtn.attr('data-position')) {
                case this.Constant_.BOTTOM_LEFT:
                    this.$dropdownContainer.css('transform-origin', 'left top 0');
                    this.$dropdownContainer.css('left', rect.left - this.width).css('top', rect.bottom);
                    break;
                case this.Constant_.BOTTOM_RIGHT:
                    this.$dropdownContainer.css('transform-origin', 'right top 0');
                    this.$dropdownContainer.css('left', rect.right - this.width).css('top', rect.bottom);
                    break;
                case this.Constant_.TOP_LEFT:
                    this.$dropdownContainer.css('transform-origin', 'left bottom 0');
                    this.$dropdownContainer.css('left', rect.left - this.width).css('bottom', rect.height);
                    break;
                case this.Constant_.TOP_RIGHT:
                    this.$dropdownContainer.css('transform-origin', 'right bottom 0');
                    this.$dropdownContainer.css('left', rect.right - this.width).css('bottom', Math.abs(rect.top - rect.bottom));
                    break;
            }
        } else {
            if(this.$dropDownBtn.hasClass('drupal-menu')){
                this.$dropdownContainer.css('transform-origin', 'right bottom 0');
                this.$dropdownContainer.css('left', rect.right - this.width).css('bottom', Math.abs(rect.top - rect.bottom));
            }
        }
        this.toggle(event);
    };

    MaterialMenuBar.prototype.show = function (event){
        if(!$('.'+this.CssClasses_.BACKDROP).length){
            var menuBackdrop = $( "<div></div>");
            menuBackdrop.addClass(this.CssClasses_.BACKDROP);
            $('body').prepend(menuBackdrop.get(0));
            menuBackdrop.on('click', this.handleClickForBackDrop.bind(this));
        }
        this.$dropdownContainer.addClass(this.CssClasses_.IS_OPEN);
        this.$dropDownBtn.attr('aria-hidden', 'false');
    };

    MaterialMenuBar.prototype.hide = function(){
        this.$dropdownContainer.addClass(this.CssClasses_.IS_LEAVING);
        //CLOSE_TIMEOUT
        window.setTimeout(function(){
            this.$dropdownContainer.removeClass(this.CssClasses_.IS_OPEN).removeClass(this.CssClasses_.IS_LEAVING);
        }.bind(this),this.Constant_.CLOSE_TIMEOUT);
        $('.'+this.CssClasses_.BACKDROP).remove();
        this.$dropDownBtn.attr('aria-hidden', 'true');
        //$("body").removeClass('is-menu-open');
    };

    MaterialMenuBar.prototype.toggle = function(event){
        if(this.$dropdownContainer.hasClass(this.CssClasses_.IS_OPEN)){
            this.hide();
        } else{
            this.show(event);
        }
    };
    MaterialMenuBar.prototype['toggle'] = MaterialMenuBar.prototype.toggle;




    function Plugin() {
        return this.each(function () {
            var $this = $(this);
            var data  = $this.data('ca.menu-bar');
            if (!data) $this.data('ca.menu-bar', (data = new MaterialMenuBar(this)));
        });
    }

    $.fn.MaterialMenuBar = Plugin;
    $.fn.MaterialMenuBar.Constructor = MaterialMenuBar;

    $(window).on('load', function () {
        $('[data-toggle="menu-bar"]').each(function () {
            var $menuBar = $(this);
            Plugin.call($menuBar)
        })
    });

}( jQuery ));

