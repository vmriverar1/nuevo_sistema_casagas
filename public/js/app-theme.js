var App = function() {
    var MediaSize = {
        xl: 1200,
        lg: 992,
        md: 991,
        sm: 576
    };
    var ToggleClasses = {
        headerhamburger: '.toggle-sidebar',
        inputFocused: 'input-focused',
    };

    var Selector = {
        getBody: 'body',
        mainHeader: '.header.navbar',
        headerhamburger: '.toggle-sidebar',
        fixed: '.fixed-top',
        mainContainer: '.main-container',
        sidebar: '#sidebar',
        sidebarContent: '#sidebar-content',
        sidebarStickyContent: '.sticky-sidebar-content',
        ariaExpandedTrue: '#sidebar [aria-expanded="true"]',
        ariaExpandedFalse: '#sidebar [aria-expanded="false"]',
        contentWrapper: '#content',
        contentWrapperContent: '.container',
        mainContentArea: '.main-content',
        searchFull: '.toggle-search',
        overlay: {
            sidebar: '.overlay',
            cs: '.cs-overlay',
            search: '.search-overlay'
        }
    };

    var toggleFunction = {
        sidebar: function($recentSubmenu) {
            $('.sidebarCollapse').on('click', function (sidebar) {
                sidebar.preventDefault();

                get_CompactSubmenuShow = document.querySelector('#compact_submenuSidebar');
                get_overlay = document.querySelector('.overlay');
                get_mainContainer = document.querySelector('.main-container')
                if (get_CompactSubmenuShow.classList.contains('show') || get_CompactSubmenuShow.classList.contains('hide-sub') ) {
                    console.log('main1');

                    if (get_CompactSubmenuShow.classList.contains('show')) {
                        get_CompactSubmenuShow.classList.remove("show");
                        get_overlay.classList.remove("show");
                        get_CompactSubmenuShow.classList.add("hide-sub");
                        return;
                            console.log('1')
                    }
                    if (get_CompactSubmenuShow.classList.contains('hide-sub')) {

                        if (get_mainContainer.classList.contains('sidebar-closed')) {
                            get_mainContainer.classList.remove("sidebar-closed");
                            get_mainContainer.classList.add("sbar-open");
                            console.log('2')
                            return;
                        }
                        if (get_mainContainer.classList.contains('sbar-open')) {
                            get_mainContainer.classList.remove("sbar-open");
                            get_CompactSubmenuShow.classList.remove("hide-sub");
                            get_CompactSubmenuShow.classList.add("show");
                            get_overlay.classList.add("show");
                            console.log('3')
                            return;
                        }
                        $(Selector.mainContainer).addClass("sidebar-closed");
                    }

                } else  {
                    console.log('main2');
                    $(Selector.mainContainer).toggleClass("sidebar-closed");
                    $(Selector.mainContainer).toggleClass("sbar-open");
                    if (window.innerWidth <= 991) {
                        if (get_overlay.classList.contains('show')) {
                            get_overlay.classList.remove('show');
                        } else {
                            get_overlay.classList.add('show');
                        }
                    }
                    $('html,body').toggleClass('sidebar-noneoverflow');
                    $('footer .footer-section-1').toggleClass('f-close');
                }
            });
        },
        overlay: function() {
            $('.overlay').on('click', function () {
                // hide sidebar
                var windowWidth = window.innerWidth;
                if (windowWidth <= MediaSize.md) {
                    $('.main-container').addClass('sidebar-closed');
                }
                // hide overlay
                $('.overlay').removeClass('show');
                $('html,body').removeClass('sidebar-noneoverflow');

                $('#compact_submenuSidebar').removeClass('show');
            });
        },
        search: function() {
            $(Selector.searchFull).click(function(event) {
               $(this).parents('.search-animated').find('.search-full').addClass(ToggleClasses.inputFocused);
               $(this).parents('.search-animated').addClass('show-search');
               $(Selector.overlay.search).addClass('show');
               $(Selector.overlay.search).addClass('show');
            });

            $(Selector.overlay.search).click(function(event) {
               $(this).removeClass('show');
               $(Selector.searchFull).parents('.search-animated').find('.search-full').removeClass(ToggleClasses.inputFocused);
               $(Selector.searchFull).parents('.search-animated').removeClass('show-search');
            });
        }
    }

    var inBuiltfunctionality = {
        mainCatActivateScroll: function() {
            const ps = new PerfectScrollbar('.menu-categories', {
                wheelSpeed:.5,
                swipeEasing:!0,
                minScrollbarLength:40,
                maxScrollbarLength:100,
                suppressScrollX: true

            });
        },
        subCatScroll: function() {
            const submenuSidebar = new PerfectScrollbar('#compact_submenuSidebar', {
                wheelSpeed:.5,
                swipeEasing:!0,
                minScrollbarLength:40,
                maxScrollbarLength:100,
                suppressScrollX: true

            });
        },
        onSidebarHover: function() {
            var getMenu = document.querySelectorAll('.menu');
            var getMenu_void = document.querySelectorAll('.menu_void');
            var getCompactSubmenu = document.querySelector('#compact_submenuSidebar');

            for (var i = 0; i < getMenu.length; i++) {
                getMenu[i].addEventListener('mouseenter', function() {
                    getHref = this.querySelectorAll('.menu-toggle')[0].getAttribute('href');
                    getOverlayElement = document.querySelector('.overlay');
                    getElement = document.querySelectorAll('#compact_submenuSidebar > ' + getHref)[0];
                    getElementActiveClass = document.querySelector('#compact_submenuSidebar > .show');
                    get_mainContainer = document.querySelector('.main-container')

                    if (getCompactSubmenu) {
                        getCompactSubmenu.classList.add("show");
                        getOverlayElement.classList.add('show');
                        getCompactSubmenu.classList.remove('hide-sub');
                        get_mainContainer.classList.remove('sbar-open');
                    }

                    if (getElementActiveClass) {
                        getElementActiveClass.classList.remove("show");
                    }

                    getElement.className += " show";
                })
            }

            for (var i = 0; i < getMenu_void.length; i++) {
                getMenu_void[i].addEventListener('mouseenter', function() {
                    getOverlayElement = document.querySelector('.overlay');
                    getElementActiveClass = document.querySelector('#compact_submenuSidebar > .show');
                    get_mainContainer = document.querySelector('.main-container')

                    if (getCompactSubmenu) {
                        getCompactSubmenu.classList.remove("show");
                        getOverlayElement.classList.remove('show');
                        getCompactSubmenu.classList.add('hide-sub');
                        get_mainContainer.classList.add('sbar-open');
                    }

                    if (getElementActiveClass) {
                        getElementActiveClass.classList.add("show");
                    }

                })
                getMenu_void[i].addEventListener('click', function(ev) {
                    ev.preventDefault();
                })
            }
        },
        preventScrollBody: function() {
            $('#compactSidebar, #compact_submenuSidebar').bind('mousewheel DOMMouseScroll', function(e) {
                var scrollTo = null;

                if (e.type == 'mousewheel') {
                    scrollTo = (e.originalEvent.wheelDelta * -1);
                }
                else if (e.type == 'DOMMouseScroll') {
                    scrollTo = 40 * e.originalEvent.detail;
                }

                if (scrollTo) {
                    e.preventDefault();
                    $(this).scrollTop(scrollTo + $(this).scrollTop());
                }
            });
        },
        languageDropdown: function() {
            var getDropdownElement = document.querySelectorAll('.more-dropdown .dropdown-item');
            for (var i = 0; i < getDropdownElement.length; i++) {
                getDropdownElement[i].addEventListener('click', function() {
                    document.querySelectorAll('.more-dropdown .dropdown-toggle > img')[0].setAttribute('src', 'assets/img/' + this.getAttribute('data-img-value') + '.png' );
                })
            }
        },
    }

    var colorPallet = {
        createPallet: function() {
            $cPalletHTMl = '<aside id="colorPallet" class="color-pallet">'+
                                '<div class="pallet-icon">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>'+
                                '</div>'+
                                '<div class="p-colors">'+
                                    '<div id="default" class="color-scheme-default colorPallet-tooltip" data-original-title="Default"></div>'+
                                    '<div id="minimal" class="color-scheme-minimal colorPallet-tooltip" data-original-title="Minimal"></div>'+
                                '</div>'+
                            '</aside>';

            $(".main-container").after($cPalletHTMl);
            colorPallet.colorPalletToggle();
            colorPallet.colorSchemeToggle();
            if (!$(Selector.getBody).hasClass('application')) {
                $('.colorPallet-tooltip').tooltip();
            }
        },
        colorPalletToggle: function () {
            $('.pallet-icon').on('click', function(event) {
                event.preventDefault();
                /* Act on the event */
                thisParent = $(this).parents('.color-pallet');

                if (thisParent.hasClass('show')) {
                    thisParent.removeClass('show');
                } else {
                    thisParent.addClass('show');
                }

            });
        },
        colorSchemeToggle: function () {

            if (!$(Selector.getBody).hasClass('single-page')) {

                if ($(Selector.getBody).hasClass('dashboard-analytics')) {

                    $('#default').on('click', function(event) {
                        event.preventDefault();
                        /* Act on the event */
                        $('.dashboard-analytics-minimal').remove();
                        $(Selector.getBody).removeClass('minimal');
                        Cookies.deleteCookie('minimal_theme');
                    });
                    $('#minimal').on('click', function(event) {
                        event.preventDefault();
                        /* Act on the event */
                        $html = '<link href="assets/css/dashboard/dash_1-minimal.css" rel="stylesheet" type="text/css" class="dashboard-analytics-minimal" />';
                        $(".dashboard-analytics").after($html);
                        $(Selector.getBody).addClass('minimal');
                        Cookies.setCookie('minimal_theme', 1, 1);
                    });

                } else if ($(Selector.getBody).hasClass('dashboard-sales')) {

                    $('#default').on('click', function(event) {
                        event.preventDefault();
                        /* Act on the event */
                        $('.dashboard-sales-minimal').remove();
                        $(Selector.getBody).removeClass('minimal');
                        Cookies.deleteCookie('minimal_theme');
                    });
                    $('#minimal').on('click', function(event) {
                        event.preventDefault();
                        /* Act on the event */

                        $html = '<link href="assets/css/dashboard/dash_2-minimal.css" rel="stylesheet" type="text/css" class="dashboard-sales-minimal" />';
                        $(".dashboard-sales").after($html);
                        $(Selector.getBody).addClass('minimal');
                        Cookies.setCookie('minimal_theme', 1, 1);
                    });

                }

                $('#default').on('click', function(event) {
                    event.preventDefault();
                    /* Act on the event */
                    $('.structure-minimal').remove();
                    $(Selector.getBody).removeClass('minimal');
                    Cookies.deleteCookie('minimal_theme');
                });
                $('#minimal').on('click', function(event) {
                    event.preventDefault();
                    /* Act on the event */
                    $html = '<link href="assets/css/structure-minimal.css" rel="stylesheet" type="text/css" class="structure-minimal" />';
                    $(".structure").after($html);
                    $(Selector.getBody).addClass('minimal');
                    Cookies.setCookie('minimal_theme', 1, 1);
                });

            }
        },
        setcolorScheme: function() {
            if (Cookies.getCookie('minimal_theme') != "") {
                console.log('sfdsf');

                if ($(Selector.getBody).hasClass('dashboard-analytics')) {
                    $html = '<link href="assets/css/dashboard/dash_1-minimal.css" rel="stylesheet" type="text/css" class="dashboard-analytics-minimal" />';
                    $(".dashboard-analytics").after($html);
                } else if ($(Selector.getBody).hasClass('dashboard-sales')) {
                    $html = '<link href="assets/css/dashboard/dash_2-minimal.css" rel="stylesheet" type="text/css" class="dashboard-sales-minimal" />';
                    $(".dashboard-sales").after($html);
                }

                $html = '<link href="assets/css/structure-minimal.css" rel="stylesheet" type="text/css" class="structure-minimal" />';
                $(".structure").after($html);
                $(Selector.getBody).addClass('minimal');

            } else {
                $('.dashboard-analytics-minimal').remove();
                $(Selector.getBody).removeClass('minimal');
            }
        },
        setColorPalletTimer: function() {
            if ($(Selector.getBody).hasClass('dashboard-analytics') || $(Selector.getBody).hasClass('dashboard-sales') || $(Selector.getBody).hasClass('starterkit')) {
                setTimeout(function() {
                    $(".color-pallet").addClass('show');
                },3000);
            }
        }
    }

    var Cookies = {
        setCookie: function (cname, cvalue, exdays) {
          var d = new Date();
          d.setTime(d.getTime() + (exdays*24*60*60*1000));
          var expires = "expires="+ d.toUTCString();
          document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        },
        getCookie: function(cname) {
          var name = cname + "=";
          var decodedCookie = decodeURIComponent(document.cookie);
          var ca = decodedCookie.split(';');
          for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
              c = c.substring(1);
              console.log(c)
            }
            if (c.indexOf(name) == 0) {
                console.log(c.substring(name.length, c.length));
              return c.substring(name.length, c.length);
            }
          }
          return "";
        },
        deleteCookie: function (name) {
          document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }
    }

    var _mobileResolution = {
        onRefresh: function() {
            var windowWidth = window.innerWidth;
            if ( windowWidth <= MediaSize.md ) {
                toggleFunction.sidebar();
            }
        },

        onResize: function() {
            $(window).on('resize', function(event) {
                event.preventDefault();
                var windowWidth = window.innerWidth;
                if ( windowWidth <= MediaSize.md ) {
                }
            });
        }

    }

    var _desktopResolution = {
        onRefresh: function() {
            var windowWidth = window.innerWidth;
            if ( windowWidth > MediaSize.md ) {
                toggleFunction.sidebar(true);
            }
        },

        onResize: function() {
            $(window).on('resize', function(event) {
                event.preventDefault();
                var windowWidth = window.innerWidth;
                if ( windowWidth > MediaSize.md ) {
                }
            });
        }

    }

    function sidebarFunctionality() {
        function sidebarCloser() {

            if (window.innerWidth <= 991 ) {


                if (!$('body').hasClass('alt-menu')) {

                    $('.main-container').removeClass('sbar-open');
                    $("#container").addClass("sidebar-closed");
                    $('.overlay').removeClass('show');
                    $('#compact_submenuSidebar').removeClass('show')

                } else {
                    $(".navbar").removeClass("expand-header");
                    $('.overlay').removeClass('show');
                    $('#container').removeClass('sbar-open');
                    $('html, body').removeClass('sidebar-noneoverflow');
                }

            } else if (window.innerWidth > 991 ) {

                if (!$('body').hasClass('alt-menu')) {
                    $("#container").removeClass("sidebar-closed");
                    $('#container').removeClass('sbar-open');
                } else {
                    $('html, body').addClass('sidebar-noneoverflow');
                    $("#container").addClass("sidebar-closed");
                    $(".navbar").addClass("expand-header");
                    $('.overlay').addClass('show');
                    $('#container').addClass('sbar-open');
                    $('.sidebar-wrapper [aria-expanded="true"]').parents('li.menu').find('.collapse').removeClass('show');
                }
            }

        }

        function sidebarMobCheck() {
            if (window.innerWidth <= 991 ) {

                if ( $('.main-container').hasClass('sbar-open') || $('#compact_submenuSidebar').hasClass('show') ) {
                    return;
                } else {
                    sidebarCloser()
                }
            } else if (window.innerWidth > 991 ) {
                sidebarCloser();
            }
        }

        sidebarCloser();

        $(window).resize(function(event) {
            sidebarMobCheck();
        });

    }

    return {
        init: function() {
            toggleFunction.overlay();
            toggleFunction.search();
            /*
                Desktop Resoltion fn
            */
            _desktopResolution.onRefresh();
            _desktopResolution.onResize();

            /*
                Mobile Resoltion fn
            */
            _mobileResolution.onRefresh();
            _mobileResolution.onResize();

            sidebarFunctionality();

            /*
                In Built Functionality fn
            */
            inBuiltfunctionality.mainCatActivateScroll();
            inBuiltfunctionality.subCatScroll();
            inBuiltfunctionality.preventScrollBody();
            inBuiltfunctionality.languageDropdown();
            inBuiltfunctionality.onSidebarHover();


            colorPallet.createPallet();
            colorPallet.setColorPalletTimer();
            colorPallet.setcolorScheme();
        }
    }

}();


// axios.defaults.withCredentials = true;

// ===========================================
// TRADUCCIÓN DE VALIDACIONES
// ===========================================


$(document).ready(function() {
    // Configuración de mensajes de jQuery Validate en español
    jQuery.extend(jQuery.validator.messages, {
        required: "Este dato es requerido",
        remote: "Por favor, rellena este campo.",
        email: "Por favor, escribe una dirección de correo válida",
        url: "Por favor, escribe una URL válida.",
        date: "Por favor, escribe una fecha válida.",
        dateISO: "Por favor, escribe una fecha (ISO) válida.",
        number: "Por favor, escribe un número válido.",
        digits: "Por favor, escribe solo dígitos.",
        creditcard: "Por favor, escribe un número de tarjeta válido.",
        equalTo: "Por favor, escribe el mismo valor de nuevo.",
        extension: "Por favor, escribe un valor con una extensión permitida.",
        maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
        minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
        rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
        range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
        max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
        min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
    });

    // Regla personalizada para validar select2 múltiple
    jQuery.validator.addMethod("select2Required", function(value, element, arg){
        return $(element).find('option:selected').length > 0;
    }, "Por favor, selecciona al menos un elemento.");
});

// ===========================================
// LIMPIAR MODAL
// ===========================================

async function destroyComponents($modal) {
    return new Promise((resolve) => {

        // Destruir wizard
        var $wizard = $modal.find('.wizard');
        if ($wizard.length > 0) {
            $wizard.each(function() {
                var wizardInstance = $(this);
                if (wizardInstance.data('steps')) {
                    console.log("Destruyendo wizard para:", this);
                    wizardInstance.steps('destroy');
                }
            });
        }

        // Destruir file-upload
        $modal.find('.custom-file-container').each(function() {
            var uploadId = $(this).data('upload-id');
            if (uploadId) {
                console.log("Destruyendo file-upload para:", this);
                new FileUploadWithPreview(uploadId).clearPreviewPanel();
            }
        });

        // Destruir select2
        $modal.find(".select2_modal").each(function() {
            var $this = $(this);
            console.log($this.hasClass("select2-hidden-accessible"));
            if ($this.hasClass("select2-hidden-accessible")) {
                console.log("Destruyendo select2 para:", this);
                $this.select2('destroy');
                $(".select2-container").remove();
            } else {
                console.log("Select2 no inicializado para:", this);
            }
        });

        // destruir botones de Touchsan
        $modal.find(".input-group-prepend").remove();
        $modal.find(".input-group-append").remove();

        resolve();
    });
}

async function initializeComponents($modal, modalId, route, callback = null, type) {
    return new Promise((resolve) => {
        console.log("Inicializando componentes...");

        // Inicializar wizard
        var $wizard = $modal.find('.wizard');
        var $form = $modal.find('form');
        if ($wizard.length > 0) {

            var formValidator = $form.validate({
                ignore: ":disabled,:hidden",
                rules: {
                    password: {
                        required: true,
                        minlength: 8
                    },
                    "verify-password": {
                        required: true,
                        minlength: 8,
                        equalTo: "input[name='password']"
                    },
                    role: {
                        required: true
                    },
                    document_type: {
                        required: true
                    },
                    "categories[]": {
                        select2Required: true
                    },
                    "requirements[]": {
                        select2Required: true
                    }
                },
                messages: {
                    password: {
                        required: "Este dato es requerido",
                        minlength: "La contraseña debe tener al menos 8 caracteres"
                    },
                    "verify-password": {
                        required: "Este dato es requerido",
                        minlength: "La contraseña debe tener al menos 8 caracteres",
                        equalTo: "Las contraseñas no coinciden"
                    },
                    role: {
                        required: "El rol de usuario es requerido"
                    },
                    document_type: {
                        required: "Este dato es requerido"
                    },
                    "categories[]": {
                        select2Required: "Por favor, selecciona al menos una categoría"
                    },
                    "requirements[]": {
                        select2Required: "Por favor, selecciona al menos un requerimiento"
                    }
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                }
            });

            $form[0].reset();
            formValidator.resetForm();
            $form.find('.form-control').removeClass('is-invalid');
            $form.find('.error').removeClass('error');

            $wizard.each(function() {
                console.log("Inicializando wizard para:", this);
                $(this).steps({
                    headerTag: "h3",
                    bodyTag: "section",
                    transitionEffect: "slideLeft",
                    autoFocus: true,
                    cssClass: 'circle wizard',
                    onStepChanging: function (event, currentIndex, newIndex)
                    {
                        $form.validate().settings.ignore = ":disabled,:hidden";
                        return $form.valid();
                    },
                    onFinishing: function (event, currentIndex)
                    {
                        $form.validate().settings.ignore = ":disabled";
                        return $form.valid();
                    },
                    onFinished: function (event, currentIndex)
                    {
                        if (type == "save") {
                            submitForm(modalId, route, callback);
                        } else if (type == "update") {
                            updateForm(modalId, route, callback);
                        }
                    }
                });
            });
        }

        // Inicializar file-upload
        $modal.find('.custom-file-container').each(function() {
            var uploadId = $(this).data('upload-id');
            if (uploadId) {
                console.log("Inicializando file-upload para:", this);
                new FileUploadWithPreview(uploadId);
            }
        });

        // Inicializar select2
        $modal.find(".select2_modal").each(function() {
            console.log("Select2 testeo.");
            var $this = $(this);
            if ($this.length > 0) {
                $this.select2({
                    tags: true,
                    dropdownParent: $modal // Asegurarse de que el dropdown parent sea el modal actual
                });

                var select2Instance = $this.data('select2');
                if (select2Instance) {
                    select2Instance.$container.addClass('form-control-sm');
                } else {
                    console.error("No se pudo inicializar select2 para:", this);
                }
            }
        });

        // iniciar botones de Touchspin
        $modal.find(".input_cantidad").TouchSpin({
            initval: 0
        });

        // input precio
        $modal.find(".input_precio").TouchSpin({
            prefix: 'S/.',
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            buttondown_class: "btn btn-classic btn-primary",
            buttonup_class: "btn btn-classic btn-primary"
        });

        resolve();
    });
}

async function resetModal(modalId, route, callback = null, type="save") {
    var $modal = $(`#${modalId}`);

    // Limpiar todos los inputs
    $modal.find('input').val('');
    $modal.find('select').val(null).trigger('change');

    $modal.find('input, select, textarea').each(function() {
        const input = $(this);
        if (input.attr('type') === 'checkbox') {
            input.prop('checked', false);
        } else if (input.attr('type') === 'file') {
            input.val(null);
        } else if (input.is('select[multiple]')) {
            input.val(null).trigger('change');
        } else {
            input.val('');
        }
    });

    // Fase de destrucción e inicialización
    await destroyComponents($modal);
    await initializeComponents($modal, modalId, route, callback, type);
}

// ===========================================
// POST DATA
// ===========================================

/**
 * Recoge los datos del formulario y los envía a la ruta especificada.
 *
 * @param {string} modalId - El ID del modal que contiene el formulario.
 * @param {string} route - La ruta a la que se enviarán los datos.
 * @param {function} callback - Una función opcional que se llamará después de una respuesta exitosa.
 */
function submitForm(modalId, route, callback = null) {
    const $modal = $(`#${modalId}`);
    const formData = new FormData();

    // Recoger los datos del formulario
    $modal.find('input, select, textarea').each(function() {
        const input = $(this);

        if (input.attr('type') === 'file') {
            if (input[0].files.length > 0) {
                formData.append('photo', input[0].files[0]);
            }
        } else if (input.attr('type') === 'checkbox') {
            formData.append(input.attr('name'), input.prop('checked'));
        } else if (input.is('select[multiple]')) {
            const values = input.val();
            if (values) {
                values.forEach(value => {
                    formData.append(input.attr('name') + '[]', value);
                });
            }
        } else {
            formData.append(input.attr('name'), input.val());
        }
    });

    // ===========================================
    // CASOS ESPECIALES
    // ===========================================

    if (route === '/hacer_venta' && typeof caja !== 'undefined') {
        formData.append('caja', JSON.stringify(caja));
    }

    // Enviar los datos utilizando Axios
    axios.post(route, formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(response => {
        console.log(response.data);
        // Cerrar el modal
        $modal.modal('hide');
        // Limpiar el modal
        resetModal(modalId);
        // Llamar al callback si se proporciona
        if (callback) {
            callback(response.data);
        }
    })
    .catch(error => {
        console.error(error);
        // Manejar los errores aquí, por ejemplo, mostrar mensajes de error en el modal
        alert('Ha ocurrido un error. Por favor, inténtelo de nuevo.');
    });
}

// // Ejemplo de uso:
// submitForm('modal-usuarios', '/api/users', (data) => {
//     console.log('Usuario creado:', data);
//     // Aquí puedes añadir código para actualizar la lista de usuarios o cualquier otra cosa
// });

// ===========================================
// GET DATA
// ===========================================

/**
 * Recupera datos de una ruta específica y los ubica en los inputs del modal.
 *
 * @param {string} modalId - El ID del modal que contiene el formulario.
 * @param {string} route - La ruta desde la cual se obtendrán los datos.
 */
function fetchDataToModal(modalId, route, callback=null) {
    const $modal = $(`#${modalId}`);
    resetModal(modalId, route, callback, "update");
    axios.get(route)
        .then(response => {
            const data = response.data;
            console.log(data);
            // Llenar los campos del formulario con los datos del usuario
            $modal.find('.password').removeAttr('required').attr('name', 'new-password');
            $modal.find('.verify-password').removeAttr('required').attr('name', 'new-verify-password');

            // Recorrer todos los inputs, selects y textareas dentro del modal
            $modal.find('input, select, textarea').each(function() {
                const input = $(this);
                const name = input.attr('name');
                console.log({name});
                if (data.hasOwnProperty(name)) {
                    if (input.attr('type') === 'file') {
                        // Los campos de archivo no pueden ser rellenados programáticamente
                    } else if (input.attr('type') === 'checkbox') {
                        input.prop('checked', data[name]);
                    } else {
                        input.val(data[name]);
                    }

                    // Si es un select2, necesitamos trigger 'change' para que se actualice visualmente
                    if (input.hasClass('select2')) {
                        input.trigger('change');
                    }
                }
            });

            // Manejar campos adicionales, por ejemplo, previsualización de imágenes
            $modal.find('.custom-file-container').each(function() {
                const uploadId = $(this).data('upload-id');
                if (uploadId && data[uploadId]) {
                    const uploadInstance = new FileUploadWithPreview(uploadId);
                    uploadInstance.addFiles(data[uploadId]);
                }
            });

            $('#'+modalId).modal('show');
            data['action'] = 'no_tabla';
            callback(data);
        })
        .catch(error => {
            console.error(error);
            alert('Ha ocurrido un error al recuperar los datos. Por favor, inténtelo de nuevo.');
        });
}

// Ejemplo de uso:
// fetchDataToModal('modal-usuarios', '/api/users/1');

// $('#edit-user-button').on('click', function() {
//     fetchDataToModal('modal-usuarios', '/api/users/1');
//     $('#modal-usuarios').modal('show');
// });

// ===========================================
// UPTDATE DATA
// ===========================================

/**
 * Recoge los datos del formulario y los envía a la ruta especificada para actualizar información.
 *
 * @param {string} modalId - El ID del modal que contiene el formulario.
 * @param {string} route - La ruta a la que se enviarán los datos.
 * @param {function} callback - Una función opcional que se llamará después de una respuesta exitosa.
 */
function updateForm(modalId, route, callback = null) {
    const $modal = $(`#${modalId}`);
    const formData = new FormData();
    console.log({route});

    // Recoger los datos del formulario
    $modal.find('input, select, textarea').each(function() {
        const input = $(this);

        if (input.attr('type') === 'file') {
            if (input[0].files.length > 0) {
                formData.append('photo', input[0].files[0]);
            }
        } else if (input.attr('type') === 'checkbox') {
            formData.append(input.attr('name'), input.prop('checked'));
        } else if (input.is('select[multiple]')) {
            const values = input.val();
            if (values) {
                values.forEach(value => {
                    formData.append(input.attr('name') + '[]', value);
                });
            }
        } else {
            formData.append(input.attr('name'), input.val());
        }
    });

    // Añadir el método PUT al formulario
    formData.append('_method', 'PUT');

    // Enviar los datos utilizando Axios
    axios.post(route, formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(response => {
        console.log(response.data);
        // Cerrar el modal
        $modal.modal('hide');
        // Limpiar el modal
        resetModal(modalId);
        // Llamar al callback si se proporciona
        if (callback) {
            callback(response.data);
        }
    })
    .catch(error => {
        console.error(error);
        // Manejar los errores aquí, por ejemplo, mostrar mensajes de error en el modal
        alert('Ha ocurrido un error. Por favor, inténtelo de nuevo.');
    });
}

// Ejemplo de uso:
// updateForm('modal-usuarios', '/api/users/1', (data) => {
//     console.log('Usuario actualizado:', data);
//     // Aquí puedes añadir código para actualizar la lista de usuarios o cualquier otra cosa
// });

// ===========================================
// DELETE DATA
// ===========================================

/**
 * Envía una solicitud DELETE a la ruta especificada para eliminar datos.
 *
 * @param {string} route - La ruta a la que se enviará la solicitud DELETE.
 * @param {function} callback - Una función opcional que se llamará después de una respuesta exitosa.
 */
function deleteData(route, callback = null) {
    if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
        axios.delete(route)
            .then(response => {
                console.log(response.data);
                // Llamar al callback si se proporciona
                if (callback) {
                    callback(response.data);
                }
            })
            .catch(error => {
                console.error(error);
                // Manejar los errores aquí, por ejemplo, mostrar mensajes de error
                alert('Ha ocurrido un error. Por favor, inténtelo de nuevo.');
            });
    }
}

// Ejemplo de uso:
// deleteData('/api/users/1', (data) => {
//     console.log('Usuario eliminado:', data);
//     // Aquí puedes añadir código para actualizar la lista de usuarios o cualquier otra cosa
// });


// ===========================================
// DATA TABLE
// ===========================================

/**
 * Inicializa DataTables con datos obtenidos de una API.
 *
 * @param {string} tableId - El ID de la tabla HTML.
 * @param {string} apiRoute - La ruta de la API para obtener los datos.
 * @param {Array} columns - Un array de objetos de configuración de columnas de DataTables.
 * @param {Array} buttons - Un array de objetos de configuración de botones de DataTables.
 */
function initializeDataTable(tableId, apiRoute, columns, buttons, callback = null) {
    axios.get(apiRoute)
        .then(response => {
            const data = response.data;
            console.log(data);

            // Destruir la instancia existente de DataTable si ya está inicializada
            if ($.fn.DataTable.isDataTable(`#${tableId}`)) {
                $(`#${tableId}`).DataTable().clear().destroy();
            }

            $(`#${tableId}`).empty(); // Limpiar el contenido de la tabla

            $(`#${tableId}`).DataTable({
                dom: 'Bfrtip',
                buttons: buttons,
                oLanguage: {
                    oPaginate: {
                        sPrevious: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        sNext: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                    },
                    sInfo: "Página actual _PAGE_ de _PAGES_",
                    sSearch: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    sSearchPlaceholder: "Buscar...",
                    sLengthMenu: "Resultados :  _MENU_",
                },
                stripeClasses: [],
                lengthMenu: [7, 10, 20, 50],
                pageLength: 7,
                responsive: true,
                data: data,
                columns: [
                    ...columns,
                    {
                        data: null,
                        title: 'Acciones',
                        orderable: false,
                        render: function(data, type, row) {
                            return `
                                <div class="btn-group">
                                    <button type="button" class="btn btn-dark btn-sm">Acciones</button>
                                    <button type="button"
                                        class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split"
                                        id="dropdownMenuReference2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" data-reference="parent">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-chevron-down">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference2">
                                        <a class="dropdown-item" href="#" onclick="fetchDataToModal('modal-${apiRoute}', '${apiRoute}/${row.id}', ${callback ? callback.name : ''})">Editar</a>
                                        <a class="dropdown-item eliminar-${apiRoute}" href="#" onclick="deleteData('${apiRoute}/${row.id}', ${callback ? callback.name : ''})">Eliminar</a>
                                    </div>
                                </div>`;
                        }
                    }
                ]
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}


