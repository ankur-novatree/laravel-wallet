(function ($) {

    "use strict";

    var MaterialTextfield = function (element) {
        this.$element = $(element);
        this.maxRows = this.Constant_.NO_MAX_ROWS;
        // Initialize instance.
        this.init();
    };
    
    MaterialTextfield.prototype.init = function () {
        if(this.$element){
            this.$label = this.$element.find('.'+this.CssClasses_.LABEL);
            this.$input = this.$element.find('.'+this.CssClasses_.INPUT);
            if(this.$input){
                if (typeof this.$input.attr(this.Constant_.MAX_ROWS_ATTRIBUTE) !== typeof undefined && this.$input.attr(this.Constant_.MAX_ROWS_ATTRIBUTE) !== false) {
                    this.maxRows = parseInt(this.$input.attr(this.Constant_.MAX_ROWS_ATTRIBUTE),10);
                    if(isNaN(this.maxRows)){
                        this.maxRows = this.Constant_.NO_MAX_ROWS;
                    }
                }
                /*if (this.input_.hasAttribute('placeholder')) {*/
                if (typeof this.$input.attr('placeholder') !== typeof undefined && this.$input.attr('placeholder') !== false) {
                    this.$element.addClass(this.CssClasses_.HAS_PLACEHOLDER);
                }
                this.boundUpdateClassesHandler = this.updateClasses_.bind(this);
                this.boundFocusHandler = this.onFocus_.bind(this);
                this.boundBlurHandler = this.onBlur_.bind(this);
                this.boundResetHandler = this.onReset_.bind(this);
                this.$input.on('input', this.boundUpdateClassesHandler);
                this.$input.on('focus', this.boundFocusHandler);
                this.$input.on('blur', this.boundBlurHandler);
                this.$input.on('reset', this.boundResetHandler);
                if(this.maxRows !== this.Constant_.NO_MAX_ROWS){
                    //TODO
                    this.boundKeyDownHandler = this.onKeyDown_.bind(this);
                    this.$input.on('reset.ca.text-field', this.boundKeyDownHandler);
                }
                var invalid = this.$element.hasClass(this.CssClasses_.IS_INVALID);
                this.updateClasses_();
                this.$element.addClass(this.CssClasses_.IS_UPGRADED);
                if(invalid){
                    this.$element.addClass(this.CssClasses_.IS_INVALID);
                }
                /*var isDrupalInvalid = this.$element.find('.form-type-textfield__error');
                if(isDrupalInvalid){
                    this.$element.addClass(this.CssClasses_.IS_INVALID);
                }*/
                if (typeof this.$input.attr('autofocus') !== typeof undefined && this.$input.attr('autofocus') !== false) {
                    this.$element.focus();
                    this.checkFocus();
                }
            }
        }
    };
    
    MaterialTextfield.VERSION = '1.0';

    MaterialTextfield.prototype.Constant_ = {
        NO_MAX_ROWS: -1,
        MAX_ROWS_ATTRIBUTE: 'maxrows'
    };

    MaterialTextfield.prototype.CssClasses_ = {
        LABEL: 'lg-textfield__label',
        INPUT: 'lg-textfield__input',
        IS_DIRTY: 'is-dirty',
        IS_FOCUSED: 'is-focused',
        IS_DISABLED: 'is-disabled',
        IS_INVALID: 'is-invalid',
        IS_UPGRADED: 'is-upgraded',
        HAS_PLACEHOLDER: 'has-placeholder'
    };

    MaterialTextfield.prototype.onKeyDown_ = function (event) {
        var currentRowCount = event.target.value.split('\n').length;
        if (event.keyCode === 13) {
            if (currentRowCount >= this.maxRows) {
                event.preventDefault();
            }
        }
    };

    MaterialTextfield.prototype.onFocus_ = function (event) {
        this.$element.addClass(this.CssClasses_.IS_FOCUSED);
    };

    MaterialTextfield.prototype.onBlur_ = function (event) {
        this.$element.removeClass(this.CssClasses_.IS_FOCUSED);
    };

    MaterialTextfield.prototype.onReset_ = function (event) {
        this.updateClasses_();
    };

    MaterialTextfield.prototype.updateClasses_ = function () {
        this.checkDisabled();
        this.checkValidity();
        this.checkDirty();
        this.checkFocus();
    };

    MaterialTextfield.prototype.checkDisabled = function () {
        if(this.$input.prop('disabled')){
            this.$element.addClass(this.CssClasses_.IS_DISABLED);
        } else{
            this.$element.removeClass(this.CssClasses_.IS_DISABLED);
        }
    };

    MaterialTextfield.prototype['checkDisabled'] = MaterialTextfield.prototype.checkDisabled;

    MaterialTextfield.prototype.checkFocus = function () {
        if (typeof this.$input.attr('autofocus') !== typeof undefined && this.$input.attr('autofocus') !== false) {
            this.$element.addClass(this.CssClasses_.IS_FOCUSED);
        } else {
            this.$element.removeClass(this.CssClasses_.IS_FOCUSED);
        }
    };
    MaterialTextfield.prototype['checkFocus'] = MaterialTextfield.prototype.checkFocus;

    MaterialTextfield.prototype.checkValidity = function () {
        if (typeof this.$input.get(0).validity !== typeof undefined && this.$input.get(0).validity) {
                if (this.$input.get(0).validity.valid) {
                this.$element.removeClass(this.CssClasses_.IS_INVALID);
            } else {
                this.$element.removeClass(this.CssClasses_.IS_INVALID);
            }
        }
    };
    MaterialTextfield.prototype['checkValidity'] = MaterialTextfield.prototype.checkValidity;

    MaterialTextfield.prototype.checkDirty = function () {
        if ((this.$input.val() !='') && (this.$input.val().length > 0)) {
            this.$element.addClass(this.CssClasses_.IS_DIRTY);
        } else {
            this.$element.removeClass(this.CssClasses_.IS_DIRTY);
        }
    };
    MaterialTextfield.prototype['checkDirty'] = MaterialTextfield.prototype.checkDirty;

    MaterialTextfield.prototype.disable = function () {
        this.$input.prop( "disabled",true);
        this.updateClasses_();
    };
    MaterialTextfield.prototype['disable'] = MaterialTextfield.prototype.disable;

    MaterialTextfield.prototype.enable = function () {
        this.$input.prop( "disabled",false);
        this.updateClasses_();
    };
    MaterialTextfield.prototype['enable'] = MaterialTextfield.prototype.enable;

    MaterialTextfield.prototype.change = function (value) {
        this.$input.val(value || '');
        this.updateClasses_();
    };
    MaterialTextfield.prototype['change'] = MaterialTextfield.prototype.change;


    function Plugin() {
        return this.each(function () {
            var $this = $(this);
            var data  = $this.data('ca.text-field');
            if (!data) $this.data('ca.text-field', (data = new MaterialTextfield(this)));
        });
    }

    $.fn.MaterialTextfield = Plugin;
    $.fn.MaterialTextfield.Constructor = MaterialTextfield;

    $(window).on('load', function () {
        $('.lg-js-textfield').each(function () {
            var $textfileds = $(this);
            Plugin.call($textfileds)
        })
    });

}( jQuery ));

//$('kk').MaterialTextfield();