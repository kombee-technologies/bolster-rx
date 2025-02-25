function checkAgree(e) {
    var t = !1;
    return jQuery(".long-question input:checkbox").is(":checked") ? 0 == t ? void 0 : !1 : (alert("Please agree to the survey terms and conditions"), t = !0, !1)
}

function copyForm() {
    var e = !1,
        t = !1,
        n = "",
        r = [];
    jQuery(".spinner-wrapper").show(), jQuery("input[name='product-check']:checked").each(function() {
        r.push(jQuery(this).data("id"))
    });
    var o = jQuery(".fancybox-inner .copy_form").val(),
        a = jQuery(".fancybox-inner .form_id").val(),
        i = jQuery(".fancybox-inner .component_form_id").val();
    return a && i || (t = !0, n += "Internal error please contact admin.\n"), o || (t = !0, n += "- Select an entry to copy data from.\n"), r.length < 1 && (t = !0, n += "- Select some entries from the table to copy data to.\n"), 0 != t ? (n = "Please correct the the following errors:\n" + n, alert(n), jQuery(".spinner-wrapper").hide(), !1) : (jQuery.get(ajaxurl, {
        action: "copy_forest",
        from: o,
        to: r,
        form_id: a,
        component_form_id: i
    }, function(e) {}).done(function() {
        jQuery.fancybox.close(), jQuery(".spinner-wrapper").hide(), e || alert("Selected product(s) have been updated."), window.location.reload(), e = !0
    }).fail(function() {
        e || alert("Selected product(s) could not be updated a this time. Please try again."), jQuery(".spinner-wrapper").hide(), e = !0
    }), !1);
    event.preventDefault()
}

function bindOfficeWorks() {
    jQuery("li[class*='popup'] label").on("click", function() {
        jQuery.get(ajaxurl, {
            action: "get_popup",
            popup: "product_codes"
        }, function(e) {
            jQuery.fancybox({
                content: jQuery.parseJSON(e).result,
                fitToView: !0,
                type: "html",
                helpers: {
                    overlay: {
                        locked: !0
                    }
                }
            })
        })
    }), jQuery("#products-list .icon-remove").each(function() {
        jQuery(this).on("click", function() {
            var e = jQuery(this).parent().prev().text();
            if (confirm("Are you sure you wish to delete this item:\n\n" + e + "\n")) {
                var t = jQuery(this).data("id");
                jQuery.get(ajaxurl, {
                    action: "remove_product",
                    id: t
                }, function(e) {
                    jQuery("#product-" + t).hide("fade")
                })
            }
        })
    }), jQuery("#product-add").on("click", function(e) {
        var t = jQuery("input[name='product-check']:checked").size();
        if (1 > t) return jQuery.fancybox({
            content: jQuery("#adding-new-product-warning").html(),
            fitToView: !0,
            type: "html",
            afterShow: function() {}
        }), !1;
        var n = [],
            r = [];
        jQuery("input[name='product-check']:checked").each(function() {
            n.push(jQuery(this).data("position"))
        }), jQuery("input[name='product-check']:checked").each(function() {
            r.push(jQuery(this).data("id"))
        });
        var o = jQuery(this).data("link") + "&selected_ids=" + r.join("|");
        o && window.open(o, "_blank", "scrollbars=1,height=1000,width=800"), e.preventDefault()
    }), jQuery("#product-edit").on("click", function(e) {
        var t = jQuery("input[name='product-check']:checked").val();
        t && window.open(t, "_blank", "scrollbars=1,height=1000,width=800"), e.preventDefault()
    }), jQuery(".product-edit").on("click", function(e) {
        if (jQuery(this).hasClass("lock")) return alert("This product has been marked as 'product has no forestry content' you can not re-edit it."), e.preventDefault(), !1;
        var t = jQuery(this).attr("href");
        t && window.open(t, "_blank", "scrollbars=1,height=1000,width=800"), e.preventDefault()
    }), jQuery("#product-copy").on("click", function(e) {
        e.preventDefault(), jQuery.fancybox({
            content: jQuery("#table-operaions").html(),
            fitToView: !0,
            type: "html",
            afterShow: function() {}
        })
    }), jQuery("#gform_" + SUBMISSION_FORM_ID).find("input[type=text], input[type=email]").on("change", function() {
        var e = jQuery(this),
            t = jQuery(this).val(),
            n = jQuery(this).attr("name");
        jQuery.ajax({
            url: office_works.ajax_url,
            type: "post",
            data: {
                action: "officeworks_save_field",
                field: n,
                value: t,
                form: SUBMISSION_FORM_ID,
                _wpnonce: office_works._nonce
            },
            success: function(t) {
                e.attr("title", "Saved")
            }
        })
    }), jQuery("#product-not").on("click", function(e) {
        e.preventDefault();
        var t = !1,
            n = !1,
            r = [];
        return jQuery(".spinner-wrapper").show(), jQuery("input[name='product-check']:checked").each(function() {
            "yes" == jQuery(this).data("entered") && (n = !0), r.push(jQuery(this).data("id"))
        }), 1 == n ? (alert("Some products that you have selected cannot be marked as containing no forest content, as these products already contain forestry information. Please deselect the products that contain this information and try again."), void jQuery(".spinner-wrapper").hide()) : r.length <= 0 ? (alert("Please check the product(s) which contain no forestry components and try again."), void jQuery(".spinner-wrapper").hide()) : void jQuery.get(ajaxurl, {
            action: "not_forest",
            ids: r
        }, function(e) {}).done(function() {
            jQuery(".spinner-wrapper").hide(), t || alert("Selected product(s) have been updated."), t = !0, window.location.reload(!0)
        }).fail(function() {
            jQuery(".spinner-wrapper").hide(), t || alert("Selected product(s) could not be updated a this time. Please try again."), t = !0
        })
    })
}
var arrayUnique = function(e) {
    return e.reduce(function(e, t) {
        return e.indexOf(t) < 0 && e.push(t), e
    }, [])
};
jQuery(function() {
    jQuery("li.timber_species select").chosen({
        max_selected_options: 6,
        width: "35%"
    }), jQuery(document).bind("gform_confirmation_loaded", function(e, t) {
        //t == PRODUCT_FORM_ID && (opener.location.reload(), opener.focus(), window.close())
    }), jQuery("#field_" + SUBMISSION_FORM_ID + "_1 input").attr("readonly", "readonly"), jQuery("#back_button").click(function(e) {
        e.preventDefault(), opener.location.reload(), opener.focus(), window.close()
    })
});