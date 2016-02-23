(function (factory) {
if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module depending on jQuery.
    define(['jquery'], factory);
} else {
    // No AMD. Register plugin with global jQuery object.
    factory(jQuery);
}
}(function ($) {
    /**
     * @see https://developer.mozilla.org/en/docs/Web/API/HTMLTextAreaElement#Autogrowing_textarea_example
     */
    function autoGrow (oField) {
        if (oField.scrollHeight > oField.clientHeight) {
            oField.style.height = oField.scrollHeight + "px";
        }
    }

    var Editable = function (el, options){
        this.el = el;
        this.$el = $(el);
        this.options = $.extend(true, {}, $.fn.editable.defaultOptions, options);

        this.$editable = null;
        this.disableArrows = false;

        // var self = this;
        this.$el.on('dblclick', this.options.editableSelector, $.proxy(this.dblclickHandler, this));
        this.$el.on('click', this.options.editableSelector, $.proxy(this.clickHandler, this));
        this.$el.on('keydown', this.options.editableSelector, $.proxy(this.keypressHandler, this));
    }

    Editable.prototype.editElement = function ($el){
        if (!$el.length || !$el.is(this.options.editableSelector) || $el.hasClass('edit')) return false;

        this.$editable = $el;
        var self = this;


        $el.addClass('edit');

        var content = $el.html();

        var $editor = $('<textarea class="editable-editor" />')
            .val(content)
            .css({width: '100%', height: $el.innerHeight() - 16})
            .on('blur', function (event){
                self.disableArrows = false;
                var value = $(this).val();
                $el.removeClass('edit').html(value);
                if (value != content){
                    $el.trigger('change.editable', [value]);
                }
            })
            .on('focus keyup', function (event){
                autoGrow(this);
            });

        $el.html($editor);
        $editor.focus();

        this.$editable.trigger('init.editable', [$editor]);
        return true;
    }

    Editable.prototype.clickHandler = function (event){
        this.editElement($(event.target));
    }

    Editable.prototype.dblclickHandler = function (event){
        this.disableArrows = true;
        this.editElement($(event.target));
    }

    var Plugin = function (options) {
        return this.each(function () {
            var $this = $(this);

            var data  = $this.data('editable');

            if (!data) {
                $this.data('editable', (data = new Editable(this, options)));
            }
            if (typeof options == 'string'){
                data[options]();
            }

        });
    }
    Plugin.defaultOptions = {
        editableSelector: '.editable'
    };

    $.fn.editable             = Plugin
    $.fn.editable.Constructor = Editable

}));