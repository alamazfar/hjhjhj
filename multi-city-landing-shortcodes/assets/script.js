// Multi-City Landing Shortcodes JavaScript

jQuery(document).ready(function($) {
    
    // Initialize all interactive elements
    initializeContactModal();
    initializeFAQToggles();
    initializeSmoothScrolling();
    initializeScrollAnimations();
    
    // Contact Modal Functionality
    function initializeContactModal() {
        // Create modal HTML if it doesn't exist
        if ($('#city-contact-modal').length === 0) {
            var modalHTML = `
                <div id="city-contact-modal" class="city-modal" style="display: none;">
                    <div class="modal-overlay">
                        <div class="modal-content">
                            <button class="modal-close" aria-label="Close modal">✕</button>
                            <h3>Get Your Free Consultation</h3>
                            <p>Choose how you'd like to connect with us:</p>
                            <div class="contact-options">
                                <a href="#" class="contact-option whatsapp" rel="noopener" data-action="whatsapp">
                                    💬 WhatsApp Chat
                                </a>
                                <a href="#" class="contact-option phone" data-action="phone">
                                    📞 Call Now: +91 9062217468
                                </a>
                                <a href="#" class="contact-option email" data-action="email">
                                    ✉️ Send Email
                                </a>
                            </div>
                            <div class="consultation-benefits">
                                <div class="benefits-header">
                                    <span class="check-icon">✅</span>
                                    <strong>Free consultation includes:</strong>
                                </div>
                                <ul>
                                    <li>Website audit & recommendations</li>
                                    <li>Local SEO strategy discussion</li>
                                    <li>Custom quote for your project</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $('body').append(modalHTML);
        }
        
        // CTA Button Click Handler
        $(document).on('click', '.city-cta-trigger', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Get city from the current page context
            var cityName = getCurrentCityName();
            
            // Update modal contact links
            updateModalContactLinks(cityName);
            
            $('#city-contact-modal').fadeIn(300);
            $('body').addClass('modal-open');
        });
        
        // Modal Close Handlers
        $(document).on('click', '.modal-close', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeModal();
        });
        
        $(document).on('click', '.modal-overlay', function(e) {
            if (e.target === this) {
                e.preventDefault();
                e.stopPropagation();
                closeModal();
            }
        });
        
        // Close modal with Escape key
        $(document).on('keydown', function(e) {
            if (e.keyCode === 27 && $('#city-contact-modal').is(':visible')) {
                closeModal();
            }
        });
        
        // Handle contact option clicks
        $(document).on('click', '.contact-option', function(e) {
            var action = $(this).data('action');
            var cityName = getCurrentCityName();
            
            if (action === 'whatsapp') {
                e.preventDefault();
                var whatsappUrl = getWhatsAppUrl(cityName);
                window.open(whatsappUrl, '_blank');
            } else if (action === 'phone') {
                e.preventDefault();
                var phoneNumber = '+919062217468';
                window.open('tel:' + phoneNumber, '_blank');
            } else if (action === 'email') {
                e.preventDefault();
                var emailUrl = getEmailUrl(cityName);
                window.open(emailUrl, '_blank');
            }
        });
        
        function closeModal() {
            $('#city-contact-modal').fadeOut(300);
            $('body').removeClass('modal-open');
        }
        
        function getCurrentCityName() {
            // Try to extract city name from page title or content
            var cityName = 'Kolkata'; // default
            
            // Look for city name in hero title
            var heroTitle = $('.hero-title').text();
            if (heroTitle) {
                var matches = heroTitle.match(/Website Development in (\w+)/);
                if (matches && matches[1]) {
                    cityName = matches[1];
                }
            }
            
            // Look for city name in section titles
            if (cityName === 'Kolkata') {
                $('.section-title').each(function() {
                    var text = $(this).text();
                    var matches = text.match(/(\w+) Businesses|(\w+) Areas|(\w+) Clients/);
                    if (matches) {
                        cityName = matches[1] || matches[2] || matches[3];
                        return false; // break loop
                    }
                });
            }
            
            return cityName;
        }
        
        function updateModalContactLinks(cityName) {
            // Update phone display in modal
            $('.contact-option.phone').text('📞 Call Now: +91 9062217468');
        }
        
        function getWhatsAppUrl(cityName) {
            var phoneNumber = '919062217468';
            var message = encodeURIComponent("Hi! I'm interested in website development services for my " + cityName + " business.");
            return "https://wa.me/" + phoneNumber + "?text=" + message;
        }
        
        function getEmailUrl(cityName) {
            var email = 'sales@webinnoovators.com';
            var subject = encodeURIComponent("Website Development Inquiry");
            var body = encodeURIComponent("Hi, I'm interested in your website development services for my business in " + cityName + ".");
            return "mailto:" + email + "?subject=" + subject + "&body=" + body;
        }
    }
    
    // FAQ Toggle Functionality
    function initializeFAQToggles() {
        $(document).on('click', '.faq-question', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            var $question = $(this);
            var target = $question.data('target');
            var $answer = $('#' + target);
            var $icon = $question.find('.faq-icon');
            var isOpen = $answer.hasClass('show');
            
            // Close all other FAQs first
            $('.faq-answer').removeClass('show').hide();
            $('.faq-icon').removeClass('rotated').text('▼');
            
            // Toggle current FAQ
            if (!isOpen) {
                $answer.addClass('show').slideDown(300);
                $icon.addClass('rotated').text('▲');
            }
            
            return false;
        });
        
        // Keyboard accessibility
        $(document).on('keydown', '.faq-question', function(e) {
            if (e.keyCode === 13 || e.keyCode === 32) {
                e.preventDefault();
                $(this).click();
            }
        });
    }
    
    // Smooth Scrolling for Anchor Links
    function initializeSmoothScrolling() {
        $(document).on('click', 'a[href^="#"]', function(e) {
            var href = $(this).attr('href');
            var target = $(href);
            
            if (target.length && href !== '#' && !$(this).hasClass('city-cta-trigger')) {
                e.preventDefault();
                
                var offset = target.offset().top - 80;
                
                $('html, body').animate({
                    scrollTop: offset
                }, 800, 'swing');
            }
        });
    }
    
    // Scroll Animations
    function initializeScrollAnimations() {
        var animatedElements = $('.stat-card, .portfolio-card, .testimonial-card, .service-card, .challenge-card, .neighborhood-card, .faq-item');
        
        // Set initial state
        animatedElements.css({
            'opacity': '0',
            'transform': 'translateY(20px)',
            'transition': 'opacity 0.6s ease, transform 0.6s ease'
        });
        
        function checkScroll() {
            var windowTop = $(window).scrollTop();
            var windowBottom = windowTop + $(window).height();
            
            animatedElements.each(function() {
                var $this = $(this);
                var elementTop = $this.offset().top;
                var elementBottom = elementTop + $this.outerHeight();
                
                if (elementBottom > windowTop && elementTop < windowBottom - 100) {
                    if (!$this.hasClass('animate-in')) {
                        $this.addClass('animate-in').css({
                            'opacity': '1',
                            'transform': 'translateY(0)'
                        });
                    }
                }
            });
        }
        
        $(window).on('scroll resize', throttle(checkScroll, 100));
        setTimeout(checkScroll, 100);
    }
    
    // Utility function to throttle scroll events
    function throttle(func, wait) {
        var timeout;
        return function executedFunction() {
            var context = this;
            var args = arguments;
            var later = function() {
                timeout = null;
                func.apply(context, args);
            };
            if (!timeout) {
                timeout = setTimeout(later, wait);
            }
        };
    }
    
    // Contact form tracking
    $(document).on('click', '.contact-option', function() {
        var contactType = $(this).hasClass('whatsapp') ? 'WhatsApp' : 
                         $(this).hasClass('phone') ? 'Phone' : 'Email';
        
        if (typeof gtag !== 'undefined') {
            gtag('event', 'contact_method_selected', {
                'method': contactType,
                'page_location': window.location.href
            });
        }
    });
    
    // Service card interactions
    $('.service-card').hover(
        function() {
            $(this).find('.service-indicator').css('opacity', '1');
        },
        function() {
            $(this).find('.service-indicator').css('opacity', '0');
        }
    );
    
    // Add focus styles for keyboard navigation
    $('.btn, .faq-question, .contact-option').on('focus', function() {
        $(this).css('outline', '2px solid #2563eb');
    }).on('blur', function() {
        $(this).css('outline', 'none');
    });
    
});