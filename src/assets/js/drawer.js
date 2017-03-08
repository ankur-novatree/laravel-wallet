(function ($) {

    "use strict";

    var MaterialDrawer = function (element) {
        this.$drawerBtn = $(element);
        // Initialize instance.
        this.init();
    };
    window['MaterialDrawer'] = MaterialDrawer;

    MaterialDrawer.prototype.init = function () {
        if(this.$drawerBtn.length){
            var target = this.$drawerBtn.attr('data-target');
            if(typeof target !== typeof undefined){
                this.$drawerWrapper = $(target);
            }
            else{
                throw new Error('Target Drawer not specified.');
                return null;
            }
            this.$drawerElement = this.$drawerWrapper.find('.'+this.CssClasses_.DRAWER);
            this.$drawerShadow = this.$drawerWrapper.find('.'+this.CssClasses_.SHADOW);
            this.boundShowDrawer = this.showDrawer_.bind(this);
            this.boundOnTouchStart = this.onTouchStart_.bind(this);
            this.boundIgnoreClicks = this.ignoreClick_.bind(this);
            this.boundHideDrawer = this.hideDrawer_.bind(this);
            this.boundOnTouchMove = this.onTouchMove_.bind(this);
            this.boundOnTransitionEnd = this.onTransitionEnd_.bind(this);
            this.update = this.update.bind(this);
            this.boundOnTouchEnd = this.onTouchEnd_.bind(this);

            this.$drawerBtn.on('click',this.boundShowDrawer);
            this.$drawerElement.on('click',this.boundIgnoreClicks);
            this.$drawerWrapper.on('click',this.boundHideDrawer);
            this.$drawerWrapper.on('touchstart',this.boundOnTouchStart);
            this.$drawerWrapper.on('touchmove',this.boundOnTouchMove);
            this.$drawerWrapper.on('touchend',this.boundOnTouchEnd);

            this.startX = 0;
            this.currentX = 0;
            this.touchingDrawer = false;
            this.drawerWidth = this.$drawerElement.width();
        }
    };

    MaterialDrawer.VERSION = '1.0';

    MaterialDrawer.prototype.Keycodes_ = {
        ENTER: 13,
        ESCAPE: 27,
        SPACE: 32,
        UP_ARROW: 38,
        DOWN_ARROW: 40
    };

    MaterialDrawer.prototype.Constant_ = {
        TRANSITION_DURATION_SECONDS: 0.3,
        TRANSITION_DURATION_FRACTION: 0.8,
        CLOSE_TIMEOUT: 300
    };

    MaterialDrawer.prototype.CssClasses_ = {
        CONTAINER: 'lg-menu__container',
        DRAWER: 'lg-layout__drawer',
        RIPPLE: 'lg-ripple',
        SHADOW: 'lg-layout__drawer-shadow',
        IS_UPGRADED: 'is-upgraded',
        IS_VISIBLE: 'is-visible',
        IS_ANIMATING: 'is-animating'
    };

    MaterialDrawer.prototype.showDrawer_ = function () {
        var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
        if(w>=992){
            $('body').toggleClass('is-compacting');
            return;
        }

        this.$drawerWrapper.addClass(this.CssClasses_.IS_ANIMATING).addClass(this.CssClasses_.IS_VISIBLE);
        this.$drawerWrapper.on('transitionend', this.boundOnTransitionEnd);
    };

    MaterialDrawer.prototype.hideDrawer_ = function () {
        this.$drawerWrapper.addClass(this.CssClasses_.IS_ANIMATING)
            .removeClass(this.CssClasses_.IS_VISIBLE);
        this.$drawerWrapper.on('transitionend', this.boundOnTransitionEnd)
    };

    MaterialDrawer.prototype.ignoreClick_ = function (e) {
        e.stopPropagation();
    };

    MaterialDrawer.prototype.onTouchStart_ = function (e) {
        if(!this.$drawerWrapper.hasClass(this.CssClasses_.IS_VISIBLE))
            return;
        this.startX = e.originalEvent.touches[0].pageX;
        this.currentX = this.startX;
        this.touchingDrawer = true;
        requestAnimationFrame(this.update);
    };

    MaterialDrawer.prototype.onTouchMove_ = function (e) {
        if(!this.touchingDrawer)
            return;
        this.currentX = e.originalEvent.touches[0].pageX;
    };

    MaterialDrawer.prototype.onTouchEnd_ = function (e) {
        if(!this.touchingDrawer)
            return;
        this.touchingDrawer = false;
        var translateX = Math.min(0,this.currentX - this.startX);
        this.$drawerElement.css('transform','');
        this.$drawerShadow.css('opacity','');
        if(translateX < 0)
            this.hideDrawer_();
    };

    MaterialDrawer.prototype.onTransitionEnd_ = function () {
        this.$drawerWrapper.removeClass(this.CssClasses_.IS_ANIMATING);
        this.$drawerElement.unbind('transitionend',this.boundOnTransitionEnd)
    };

    MaterialDrawer.prototype.update = function () {
        if(!this.touchingDrawer)
            return;
        requestAnimationFrame(this.update);
        var translateX = Math.min(0, this.currentX - this.startX);
        var opacityPercentage = 0;
        if(Math.abs(translateX) <= this.drawerWidth){
            opacityPercentage = (this.drawerWidth - Math.abs(translateX))/(this.drawerWidth);
        }
        this.$drawerElement.css('transform','translateX('+translateX+'px');
        this.$drawerShadow.css('opacity',opacityPercentage);
    };


    function Plugin() {
        return this.each(function () {
            var $this = $(this);
            var data  = $this.data('ca.menu-bar');
            if (!data) $this.data('ca.menu-bar', (data = new MaterialDrawer(this)));
        });
    }

    $.fn.MaterialDrawer = Plugin;
    $.fn.MaterialDrawer.Constructor = MaterialDrawer;

    $(window).on('load', function () {
        $('[data-toggle="drawer"]').each(function () {
            var $drawer = $(this);
            Plugin.call($drawer)
        })
    });

}( jQuery ));

