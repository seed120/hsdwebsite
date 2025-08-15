jQuery("body").on("click", ".ajax-post-link", function (e) {
    e.preventDefault();
    const postID = jQuery(this).data("post-id");
    const postType = jQuery(this).data("type");
    const titleContainer = jQuery(".page-title");
    const breadcrumbContent = jQuery(".breadcrumb.nav li span.current");
    var contentContainer = "";
    if (postType == "cea-portfolio" || postType == "cea-service") {
        contentContainer = jQuery(".portfolio-content-area");
    } else if (postType == "cea-testimonial") {
        contentContainer = jQuery(".testimonial-content-area");
    } else if (postType == "cea-event") {
        contentContainer = jQuery(".event-content-area");
    } else if (postType == "cea-team") {
        contentContainer = jQuery(".team-content-area");
    }

    jQuery.ajax({
        url: cea_ajax_var.ajax_url,
        type: "POST",
        dataType: "json",
        data: {
            action: "load_single_post",
            post_id: postID,
            post_type: postType,
        },
        beforeSend: function () {
            console.log("Loading!...");
        },
        success: function (response) {
            if (response.success) {
                titleContainer.html(response.data.title + response.data.style_url);
                breadcrumbContent.html(response.data.title);
                contentContainer.html(response.data.content);
                // Update the browser URL without reloading the page
                if (response.data.url) {
                    window.history.pushState({}, "", response.data.url);
                }
                if (response.data.doc_title) {
                    document.title = response.data.doc_title;
                }
                let editLink = jQuery("#wp-admin-bar-edit a");
                if (editLink.length) {
                    // Update the href attribute with new edit URL
                    editLink.attr("href", response.data.edit_url);
                }
                let elementorLink = jQuery("#wp-admin-bar-elementor_edit_page a");
                if (elementorLink.length) {
                    // Update the href attribute with new elementor edit URL
                    elementorLink.attr("href", response.data.elementor_url);
                }
                // Initialize Elementor if needed
                if (response.data.is_elementor) {
                    if (response.data.style_url) {
                        jQuery('head').append(response.data.style_url);
                        var light_styles =
                            "<style> .dialog-widget-content.dialog-lightbox-widget-content {  top: 0px !important; left: 0px !important; } </style>";
                        jQuery('head').append(light_styles);
                    }
                    if (typeof elementorFrontend !== "undefined" && elementorFrontend.init) {
                        elementorFrontend.init();
                    }
                }
                
            } else {
                console.error("AJAX failed, data:", response);
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
        },
    });
});