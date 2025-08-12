<?php
/**
 * Plugin Name: Multi-City Landing Shortcodes
 * Description: Complete multi-city website development landing pages with city-specific content and portfolio items
 * Version: 2.1.0
 * Author: WebInnoovators
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class MultiCityLandingShortcodes {
    
    public function __construct() {
        add_action('init', array($this, 'register_shortcodes'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
        add_action('wp_head', array($this, 'add_inline_styles'));
    }
    
    public function register_shortcodes() {
        add_shortcode('city_hero', array($this, 'city_hero_shortcode'));
        add_shortcode('city_stats', array($this, 'city_stats_shortcode'));
        add_shortcode('city_challenges', array($this, 'city_challenges_shortcode'));
        add_shortcode('city_neighborhoods', array($this, 'city_neighborhoods_shortcode'));
        add_shortcode('city_portfolio', array($this, 'city_portfolio_shortcode'));
        add_shortcode('city_testimonials', array($this, 'city_testimonials_shortcode'));
        add_shortcode('city_services', array($this, 'city_services_shortcode'));
        add_shortcode('city_faq', array($this, 'city_faq_shortcode'));
        add_shortcode('city_cta', array($this, 'city_cta_shortcode'));
        add_shortcode('city_full_landing', array($this, 'city_full_landing_shortcode'));
    }
    
    public function enqueue_assets() {
        wp_enqueue_style(
            'city-landing-styles',
            plugin_dir_url(__FILE__) . 'assets/style.css',
            array(),
            '2.1.0'
        );
        
        wp_enqueue_script(
            'city-landing-scripts',
            plugin_dir_url(__FILE__) . 'assets/script.js',
            array('jquery'),
            '2.1.0',
            true
        );
    }
    
    public function add_inline_styles() {
        echo '<style>
        body .city-container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; }
        body .city-hero { background: linear-gradient(135deg, #dbeafe, #e0e7ff, #f3e8ff); padding: 5rem 0; text-align: center; }
        body .hero-title { font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 700 !important; color: #111827 !important; margin-bottom: 1.5rem; line-height: 1.2; }
        body .city-blue { color: #2563eb !important; }
        body .city-white { color: white !important; }
        </style>';
    }
    
    // City configuration data
    private function get_city_config($city = 'kolkata') {
        $configs = array(
            'kolkata' => array(
                'name' => 'Kolkata',
                'state' => 'West Bengal',
                'focus' => 'Heritage & Technology',
                'industries' => array('IT Services', 'Heritage Tourism', 'Traditional Crafts', 'Education'),
                'neighborhoods' => array(
                    'Salt Lake & Sector V',
                    'Park Street',
                    'New Town & Rajarhat',
                    'Gariahat & Southern Avenue',
                    'Howrah & Shibpur'
                ),
                'phone_suffix' => '001',
                'challenges' => array(
                    array(
                        'icon' => '⚡',
                        'title' => 'Infrastructure Gaps',
                        'problem' => 'Power outages and slow internet in areas like Behala and Baranagar impact website maintenance',
                        'solution' => 'We offer lightweight, offline-resilient solutions that work seamlessly even with connectivity issues.'
                    ),
                    array(
                        'icon' => '🧭',
                        'title' => 'Navigation & Local SEO',
                        'problem' => 'Many businesses struggle with poor Google Maps visibility in areas like Gariahat',
                        'solution' => 'Our hyper-local SEO strategy ensures maximum visibility across all Kolkata neighborhoods.'
                    ),
                    array(
                        'icon' => '🌐',
                        'title' => 'Language Barriers',
                        'problem' => 'Bilingual audiences (Bengali and English) often feel ignored by generic websites',
                        'solution' => 'We create dual-language websites to maximize reach across diverse Kolkata communities.'
                    ),
                    array(
                        'icon' => '📱',
                        'title' => 'Mobile Optimization',
                        'problem' => 'With 75% of traffic from mobile, many sites fail to deliver proper mobile experiences',
                        'solution' => 'We prioritize ultra-responsive mobile design that works perfectly on all devices.'
                    )
                ),
                'stats' => array(
                    array('number' => '87%', 'text' => 'of Kolkata businesses lack modern websites'),
                    array('number' => '34%', 'text' => 'growth in mobile internet usage in West Bengal'),
                    array('number' => '75%', 'text' => 'of traffic comes from mobile devices'),
                    array('number' => '3', 'text' => 'major digital business hubs emerging')
                ),
                'testimonials' => array(
                    array(
                        'text' => 'After launching our new site, foot traffic to our Lake Town outlet grew by 40%. Love the design and ease of updates!',
                        'author' => 'Priya Das',
                        'role' => 'Café Owner, Lake Town',
                        'rating' => 5
                    ),
                    array(
                        'text' => 'Your SEO team got our Gariahat store to rank on Page 1. We\'ve never been this visible!',
                        'author' => 'Arindam Mukherjee',
                        'role' => 'Fashion Retailer, Gariahat',
                        'rating' => 5
                    )
                ),
                'portfolio_items' => array(
                    array(
                        'title' => 'Spice Garden Restaurant',
                        'location' => 'Park Street',
                        'description' => 'Traditional Bengali restaurant with online ordering and table booking',
                        'image' => 'https://images.pexels.com/photos/262978/pexels-photo-262978.jpeg?auto=compress&cs=tinysrgb&w=600&h=400',
                        'features' => array('Online Menu', 'Table Booking', 'Bengali/English')
                    ),
                    array(
                        'title' => 'Heritage Handloom',
                        'location' => 'New Market',
                        'description' => 'Traditional Bengali textile e-commerce platform',
                        'image' => 'https://images.pexels.com/photos/1488463/pexels-photo-1488463.jpeg?auto=compress&cs=tinysrgb&w=600&h=400',
                        'features' => array('Handloom Products', 'Cultural Heritage', 'Online Store')
                    ),
                    array(
                        'title' => 'Tech Solutions Hub',
                        'location' => 'Salt Lake Sector V',
                        'description' => 'IT consulting firm with modern corporate website',
                        'image' => 'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=600&h=400',
                        'features' => array('Corporate Design', 'Client Portal', 'Tech Focus')
                    )
                ),
                'faqs' => array(
                    array(
                        'question' => 'Can you help my business rank on Google for "near me" searches in Kolkata?',
                        'answer' => 'Yes. We optimize for "Kolkata" + your service category and configure Google Business profiles for visibility in neighborhoods like Salt Lake, Tollygunge, and Dum Dum.'
                    ),
                    array(
                        'question' => 'Do you provide services in Bengali?',
                        'answer' => 'Absolutely. Our content team can build bilingual websites for English and Bengali speakers.'
                    ),
                    array(
                        'question' => 'How long does a local business website take to launch?',
                        'answer' => 'Usually 7–14 days, depending on features. For urgent needs (e.g., Durga Puja specials), we offer a 3-day express launch plan.'
                    ),
                    array(
                        'question' => 'Can I integrate local delivery apps or WhatsApp chat?',
                        'answer' => 'Yes, we support Zomato, Swiggy, and WhatsApp integrations for real-time ordering and communication.'
                    ),
                    array(
                        'question' => 'Do you offer in-person consultations in Kolkata?',
                        'answer' => 'Yes, we can meet clients in areas like New Town, South City, and Salt Lake. Virtual meetings are also available.'
                    )
                )
            ),
            'mumbai' => array(
                'name' => 'Mumbai',
                'state' => 'Maharashtra',
                'focus' => 'Financial & Entertainment',
                'industries' => array('Financial Services', 'Entertainment', 'Textiles', 'Information Technology'),
                'neighborhoods' => array(
                    'Bandra-Kurla Complex',
                    'Lower Parel',
                    'Andheri East',
                    'Worli',
                    'Powai'
                ),
                'phone_suffix' => '002',
                'challenges' => array(
                    array(
                        'icon' => '🏢',
                        'title' => 'High Competition',
                        'problem' => 'Mumbai\'s saturated digital market makes it difficult for businesses to stand out online',
                        'solution' => 'We create distinctive, premium designs that capture attention and convert visitors into customers.'
                    ),
                    array(
                        'icon' => '⚡',
                        'title' => 'Fast-Paced Environment',
                        'problem' => 'Mumbai businesses need quick turnaround times without compromising quality',
                        'solution' => 'Our streamlined development process delivers professional websites in record time.'
                    ),
                    array(
                        'icon' => '💼',
                        'title' => 'Premium Expectations',
                        'problem' => 'Mumbai clients expect sophisticated, enterprise-level web solutions',
                        'solution' => 'We specialize in high-end designs with advanced functionality and premium user experiences.'
                    ),
                    array(
                        'icon' => '🌍',
                        'title' => 'Global Reach Requirements',
                        'problem' => 'Many Mumbai businesses need websites that appeal to international audiences',
                        'solution' => 'We build globally-minded websites with multi-currency, multi-language, and international SEO.'
                    )
                ),
                'stats' => array(
                    array('number' => '92%', 'text' => 'of Mumbai businesses need mobile optimization'),
                    array('number' => '45%', 'text' => 'growth in e-commerce adoption in Maharashtra'),
                    array('number' => '80%', 'text' => 'of customers research online before visiting stores'),
                    array('number' => '5', 'text' => 'major business districts driving digital growth')
                ),
                'testimonials' => array(
                    array(
                        'text' => 'Our BKC office needed a corporate website that matched our premium brand. The result exceeded expectations and impressed our international clients.',
                        'author' => 'Rajesh Sharma',
                        'role' => 'Managing Director, Bandra',
                        'rating' => 5
                    ),
                    array(
                        'text' => 'The e-commerce platform they built helped us scale from local to pan-India operations. Revenue increased 300% in 6 months!',
                        'author' => 'Meera Patel',
                        'role' => 'Fashion Retailer, Lower Parel',
                        'rating' => 5
                    )
                ),
                'portfolio_items' => array(
                    array(
                        'title' => 'FinTech Solutions Hub',
                        'location' => 'Bandra-Kurla Complex',
                        'description' => 'Enterprise financial services platform with advanced security',
                        'image' => 'https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg?auto=compress&cs=tinysrgb&w=600&h=400',
                        'features' => array('Enterprise Security', 'API Integration', 'Multi-Currency')
                    ),
                    array(
                        'title' => 'Bollywood Production House',
                        'location' => 'Lower Parel',
                        'description' => 'Entertainment industry website with media gallery',
                        'image' => 'https://images.pexels.com/photos/3184292/pexels-photo-3184292.jpeg?auto=compress&cs=tinysrgb&w=600&h=400',
                        'features' => array('Media Gallery', 'Video Streaming', 'Entertainment Focus')
                    ),
                    array(
                        'title' => 'Luxury Fashion Brand',
                        'location' => 'Worli',
                        'description' => 'High-end fashion e-commerce with premium design',
                        'image' => 'https://images.pexels.com/photos/3184418/pexels-photo-3184418.jpeg?auto=compress&cs=tinysrgb&w=600&h=400',
                        'features' => array('Luxury Design', 'Premium Products', 'Global Shipping')
                    )
                ),
                'faqs' => array(
                    array(
                        'question' => 'Can you handle enterprise-level website development for Mumbai corporations?',
                        'answer' => 'Yes. We specialize in enterprise solutions for BKC, Lower Parel, and Worli businesses with advanced security, scalability, and integration capabilities.'
                    ),
                    array(
                        'question' => 'Do you provide 24/7 support for Mumbai businesses?',
                        'answer' => 'Absolutely. We understand Mumbai\'s fast-paced environment and offer round-the-clock support for critical business operations.'
                    ),
                    array(
                        'question' => 'Can you integrate with international payment gateways?',
                        'answer' => 'Yes, we support all major international payment systems including Stripe, PayPal, and multi-currency processing for global businesses.'
                    ),
                    array(
                        'question' => 'How quickly can you deliver a website for Mumbai businesses?',
                        'answer' => 'For standard business websites: 5-10 days. For enterprise solutions: 2-4 weeks. We offer express delivery for urgent Mumbai business needs.'
                    ),
                    array(
                        'question' => 'Do you provide SEO services for competitive Mumbai markets?',
                        'answer' => 'Yes, we specialize in competitive SEO strategies that help Mumbai businesses rank above their competition in local and national searches.'
                    )
                )
            ),
            'bengaluru' => array(
                'name' => 'Bengaluru',
                'state' => 'Karnataka',
                'focus' => 'Technology & Innovation',
                'industries' => array('Information Technology', 'Biotechnology', 'Aerospace', 'Research & Development'),
                'neighborhoods' => array(
                    'Electronic City',
                    'Koramangala',
                    'Whitefield',
                    'Indiranagar',
                    'HSR Layout'
                ),
                'phone_suffix' => '003',
                'challenges' => array(
                    array(
                        'icon' => '🚀',
                        'title' => 'Innovation Expectations',
                        'problem' => 'Bengaluru\'s tech-savvy audience expects cutting-edge web technologies and innovative features',
                        'solution' => 'We use the latest web technologies, AI integration, and innovative UX/UI designs that wow tech audiences.'
                    ),
                    array(
                        'icon' => '⚡',
                        'title' => 'Startup Speed Requirements',
                        'problem' => 'Startups need rapid development cycles to keep up with fast-moving markets',
                        'solution' => 'Our agile development process delivers MVP websites quickly, then iterates based on user feedback.'
                    ),
                    array(
                        'icon' => '🔧',
                        'title' => 'Technical Complexity',
                        'problem' => 'Tech companies need sophisticated integrations, APIs, and complex functionality',
                        'solution' => 'Our team specializes in complex technical implementations, API integrations, and scalable architectures.'
                    ),
                    array(
                        'icon' => '📈',
                        'title' => 'Scalability Demands',
                        'problem' => 'Growing startups need websites that can scale from hundreds to millions of users',
                        'solution' => 'We build cloud-native, scalable solutions that grow with your business from startup to enterprise.'
                    )
                ),
                'stats' => array(
                    array('number' => '95%', 'text' => 'of Bengaluru startups need modern web presence'),
                    array('number' => '60%', 'text' => 'growth in tech company website requirements'),
                    array('number' => '85%', 'text' => 'of businesses expect cutting-edge web technology'),
                    array('number' => '6', 'text' => 'major tech hubs driving innovation')
                ),
                'testimonials' => array(
                    array(
                        'text' => 'They built our SaaS platform with cutting-edge technology. The scalable architecture helped us grow from 1K to 100K users seamlessly.',
                        'author' => 'Karthik Reddy',
                        'role' => 'CTO, Koramangala Startup',
                        'rating' => 5
                    ),
                    array(
                        'text' => 'Our enterprise needed a sophisticated web platform. They delivered beyond expectations with innovative features our competitors don\'t have.',
                        'author' => 'Priya Nair',
                        'role' => 'Product Manager, Electronic City',
                        'rating' => 5
                    )
                ),
                'portfolio_items' => array(
                    array(
                        'title' => 'AI Startup Platform',
                        'location' => 'Koramangala',
                        'description' => 'Cutting-edge AI company with innovative design',
                        'image' => 'https://images.pexels.com/photos/1181675/pexels-photo-1181675.jpeg?auto=compress&cs=tinysrgb&w=600&h=400',
                        'features' => array('AI Integration', 'Modern Tech', 'Startup Focus')
                    ),
                    array(
                        'title' => 'SaaS Enterprise Platform',
                        'location' => 'Electronic City',
                        'description' => 'Scalable software platform for enterprise clients',
                        'image' => 'https://images.pexels.com/photos/574071/pexels-photo-574071.jpeg?auto=compress&cs=tinysrgb&w=600&h=400',
                        'features' => array('SaaS Platform', 'Enterprise Scale', 'Cloud Native')
                    ),
                    array(
                        'title' => 'FinTech Innovation Lab',
                        'location' => 'HSR Layout',
                        'description' => 'Financial technology startup with blockchain integration',
                        'image' => 'https://images.pexels.com/photos/3184339/pexels-photo-3184339.jpeg?auto=compress&cs=tinysrgb&w=600&h=400',
                        'features' => array('Blockchain', 'FinTech', 'Innovation')
                    )
                ),
                'faqs' => array(
                    array(
                        'question' => 'Can you build scalable platforms for fast-growing Bengaluru startups?',
                        'answer' => 'Yes. We specialize in cloud-native, scalable architectures that grow from startup MVP to enterprise-scale platforms serving millions of users.'
                    ),
                    array(
                        'question' => 'Do you work with the latest web technologies and frameworks?',
                        'answer' => 'Absolutely. We use cutting-edge technologies including React, Node.js, AI/ML integration, blockchain, and cloud-native solutions.'
                    ),
                    array(
                        'question' => 'Can you integrate complex APIs and third-party services?',
                        'answer' => 'Yes, we excel at complex integrations including payment gateways, AI services, analytics platforms, and custom API development.'
                    ),
                    array(
                        'question' => 'How quickly can you deliver an MVP for a Bengaluru startup?',
                        'answer' => 'We can deliver a functional MVP in 2-4 weeks, then iterate rapidly based on user feedback and market requirements.'
                    ),
                    array(
                        'question' => 'Do you provide ongoing technical support for growing tech companies?',
                        'answer' => 'Yes, we offer comprehensive technical support, performance monitoring, scaling assistance, and feature development as you grow.'
                    )
                )
            ),
            'malda' => array(
                'name' => 'Malda',
                'state' => 'West Bengal',
                'focus' => 'Agriculture & Trade',
                'industries' => array('Agriculture', 'Silk Production', 'Jute Processing', 'Trade & Commerce'),
                'neighborhoods' => array(
                    'English Bazar',
                    'Old Malda',
                    'Manikchak',
                    'Kaliachak',
                    'Habibpur'
                ),
                'phone_suffix' => '120',
                'challenges' => array(
                    array(
                        'icon' => '🌾',
                        'title' => 'Agricultural Digitization',
                        'problem' => 'Traditional farming and trade businesses in Malda lack modern digital presence for market expansion',
                        'solution' => 'We create agricultural business websites with market integration, crop information systems, and farmer-buyer connectivity platforms.'
                    ),
                    array(
                        'icon' => '🏪',
                        'title' => 'Local Market Reach',
                        'problem' => 'Small businesses struggle to reach customers beyond traditional local markets in Malda district',
                        'solution' => 'Our local SEO strategies help businesses appear in "near me" searches and connect with customers across the district.'
                    ),
                    array(
                        'icon' => '📱',
                        'title' => 'Mobile-First Needs',
                        'problem' => 'Most customers in Malda access internet primarily through mobile devices, requiring mobile-optimized websites',
                        'solution' => 'We prioritize mobile-first design ensuring perfect functionality on smartphones and tablets used by local customers.'
                    ),
                    array(
                        'icon' => '🌐',
                        'title' => 'Language Accessibility',
                        'problem' => 'Businesses need websites that serve both Bengali-speaking locals and Hindi/English-speaking traders',
                        'solution' => 'We develop multilingual websites supporting Bengali, Hindi, and English to maximize customer reach.'
                    )
                ),
                'stats' => array(
                    array('number' => '78%', 'text' => 'of Malda businesses lack professional websites'),
                    array('number' => '65%', 'text' => 'of local customers search online before visiting stores'),
                    array('number' => '85%', 'text' => 'of internet usage happens on mobile devices'),
                    array('number' => '4', 'text' => 'major business areas driving local economy')
                ),
                'testimonials' => array(
                    array(
                        'text' => 'Our silk business website helped us connect with buyers from Kolkata and Delhi. Online orders increased by 150% in just 6 months!',
                        'author' => 'Ramesh Agarwal',
                        'role' => 'Silk Trader, English Bazar',
                        'rating' => 5
                    ),
                    array(
                        'text' => 'The agricultural portal they built helps farmers in our area get better prices. It\'s been a game-changer for our cooperative.',
                        'author' => 'Sita Devi',
                        'role' => 'Farmers Cooperative Head, Manikchak',
                        'rating' => 5
                    )
                ),
                'portfolio_items' => array(
                    array(
                        'title' => 'Malda Silk Emporium',
                        'location' => 'English Bazar',
                        'description' => 'Traditional silk business website with online catalog and buyer inquiry system',
                        'image' => 'https://images.pexels.com/photos/1488463/pexels-photo-1488463.jpeg?auto=compress&cs=tinysrgb&w=600&h=400',
                        'features' => array('Product Catalog', 'Buyer Inquiry', 'Bengali/English')
                    ),
                    array(
                        'title' => 'Farmers Market Portal',
                        'location' => 'Kaliachak',
                        'description' => 'Agricultural marketplace connecting farmers with wholesale buyers',
                        'image' => 'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=600&h=400',
                        'features' => array('Crop Listings', 'Price Discovery', 'Direct Contact')
                    ),
                    array(
                        'title' => 'Heritage Hotel Website',
                        'location' => 'Old Malda',
                        'description' => 'Tourism website for heritage hotel with online booking system',
                        'image' => 'https://images.pexels.com/photos/262978/pexels-photo-262978.jpeg?auto=compress&cs=tinysrgb&w=600&h=400',
                        'features' => array('Online Booking', 'Photo Gallery', 'Tourist Information')
                    )
                ),
                'faqs' => array(
                    array(
                        'question' => 'Can you help agricultural businesses in Malda get online?',
                        'answer' => 'Yes! We specialize in creating websites for agricultural businesses, including crop information systems, market price displays, and buyer-seller connectivity platforms for Malda\'s farming community.'
                    ),
                    array(
                        'question' => 'Do you provide websites in Bengali for local Malda businesses?',
                        'answer' => 'Absolutely. We create multilingual websites in Bengali, Hindi, and English to serve Malda\'s diverse customer base effectively.'
                    ),
                    array(
                        'question' => 'How can small traders in Malda benefit from having a website?',
                        'answer' => 'A website helps Malda traders showcase products to buyers beyond local markets, receive online inquiries, and establish credibility with larger wholesale buyers from Kolkata and other cities.'
                    ),
                    array(
                        'question' => 'Can you integrate payment systems for Malda businesses?',
                        'answer' => 'Yes, we integrate secure payment gateways suitable for Indian businesses, including UPI, digital wallets, and bank transfers for seamless transactions.'
                    ),
                    array(
                        'question' => 'Do you provide training for managing websites to Malda business owners?',
                        'answer' => 'Yes, we provide comprehensive training in Bengali and Hindi to help Malda business owners easily manage their websites, update content, and handle customer inquiries.'
                    )
                )
            )
        );
        
        return isset($configs[$city]) ? $configs[$city] : $configs['kolkata'];
    }
    
    // Enhanced shortcode functions with city parameter
    public function city_hero_shortcode($atts) {
        $atts = shortcode_atts(array(
            'city' => 'kolkata',
            'title' => '',
            'subtitle' => '',
            'primary_button' => 'Get Free Consultation',
            'secondary_button' => 'View Our Work'
        ), $atts);
        
        $config = $this->get_city_config($atts['city']);
        $title = !empty($atts['title']) ? $atts['title'] : 'Website Development in <span class="city-blue">' . $config['name'] . '</span>';
        $subtitle = !empty($atts['subtitle']) ? $atts['subtitle'] : 'Empowering ' . $config['name'] . ' Businesses with World-Class Web Solutions';
        
        return '<section class="city-hero">
            <div class="city-container">
                <div class="hero-content">
                    <h1 class="hero-title">🌐 ' . $title . '</h1>
                    <p class="hero-subtitle">' . esc_html($subtitle) . '</p>
                    <div class="hero-buttons">
                        <button class="btn btn-primary city-cta-trigger">
                            ' . esc_html($atts['primary_button']) . '
                        </button>
                        <a href="#portfolio" class="btn btn-secondary">
                            ' . esc_html($atts['secondary_button']) . ' 
                            <span class="icon">🔗</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>';
    }
    
    public function city_stats_shortcode($atts) {
        $atts = shortcode_atts(array(
            'city' => 'kolkata',
            'title' => ''
        ), $atts);
        
        $config = $this->get_city_config($atts['city']);
        $title = !empty($atts['title']) ? $atts['title'] : 'Why <span class="city-blue">' . $config['name'] . '</span> is Going Digital Fast';
        
        $output = '<section class="city-stats">
            <div class="city-container">
                <div class="section-header">
                    <h2 class="section-title">📊 ' . $title . '</h2>
                    <p class="section-subtitle">The digital transformation is happening now. Don\'t get left behind.</p>
                </div>
                <div class="stats-grid">';
        
        foreach ($config['stats'] as $stat) {
            $output .= '<div class="stat-card">
                        <div class="stat-number">' . esc_html($stat['number']) . '</div>
                        <div class="stat-text">' . esc_html($stat['text']) . '</div>
                    </div>';
        }
        
        $output .= '</div>
                <div class="stats-insight">
                    <p><strong>Key Insights:</strong> ' . $config['name'] . ' is experiencing rapid digital transformation with growing demand for professional web solutions across all business sectors.</p>
                </div>
            </div>
        </section>';
        
        return $output;
    }
    
    public function city_challenges_shortcode($atts) {
        $atts = shortcode_atts(array(
            'city' => 'kolkata',
            'title' => ''
        ), $atts);
        
        $config = $this->get_city_config($atts['city']);
        $title = !empty($atts['title']) ? $atts['title'] : 'We Understand <span class="city-blue">' . $config['name'] . '\'s</span> Unique Business Challenges';
        
        $output = '<section class="city-challenges">
            <div class="city-container">
                <div class="section-header">
                    <h2 class="section-title">💡 ' . $title . '</h2>
                    <p class="section-subtitle">Local problems require local solutions.</p>
                </div>
                <div class="challenges-grid">';
        
        foreach ($config['challenges'] as $challenge) {
            $output .= '<div class="challenge-card">
                        <div class="challenge-header">
                            <span class="challenge-icon">' . $challenge['icon'] . '</span>
                            <h3 class="challenge-title">' . esc_html($challenge['title']) . '</h3>
                        </div>
                        <div class="challenge-problem">
                            <strong>Problem:</strong> ' . esc_html($challenge['problem']) . '
                        </div>
                        <div class="challenge-solution">
                            <strong>Our Solution:</strong> ' . esc_html($challenge['solution']) . '
                        </div>
                    </div>';
        }
        
        $output .= '</div>
            </div>
        </section>';
        
        return $output;
    }
    
    public function city_neighborhoods_shortcode($atts) {
        $atts = shortcode_atts(array(
            'city' => 'kolkata',
            'title' => ''
        ), $atts);
        
        $config = $this->get_city_config($atts['city']);
        $title = !empty($atts['title']) ? $atts['title'] : 'We Serve All Major <span class="city-blue">' . $config['name'] . '</span> Areas';
        
        $colors = array('#3b82f6', '#8b5cf6', '#10b981', '#f59e0b', '#6366f1');
        
        $output = '<section class="city-neighborhoods">
            <div class="city-container">
                <div class="section-header">
                    <h2 class="section-title">🏙️ ' . $title . '</h2>
                    <p class="section-subtitle">Tailored solutions for every area of the city.</p>
                </div>
                <div class="neighborhoods-grid">';
        
        foreach ($config['neighborhoods'] as $index => $area) {
            $color = $colors[$index % count($colors)];
            $output .= '<div class="neighborhood-card">
                        <div class="neighborhood-header">
                            <div class="neighborhood-dot" style="background-color: ' . esc_attr($color) . '"></div>
                            <span class="location-icon">📍</span>
                            <h3 class="neighborhood-name">' . esc_html($area) . '</h3>
                        </div>
                        <p class="neighborhood-focus">Specialized web solutions for ' . esc_html($area) . ' businesses</p>
                    </div>';
        }
        
        $output .= '</div>
            </div>
        </section>';
        
        return $output;
    }
    
    public function city_portfolio_shortcode($atts) {
        $atts = shortcode_atts(array(
            'city' => 'kolkata',
            'title' => '',
            'subtitle' => ''
        ), $atts);
        
        $config = $this->get_city_config($atts['city']);
        $title = !empty($atts['title']) ? $atts['title'] : 'Our Recent Work in <span class="city-blue">' . $config['name'] . '</span>';
        $subtitle = !empty($atts['subtitle']) ? $atts['subtitle'] : 'Real websites for real ' . $config['name'] . ' businesses.';
        
        $output = '<section class="city-portfolio" id="portfolio">
            <div class="city-container">
                <div class="section-header">
                    <h2 class="section-title">🎨 ' . $title . '</h2>
                    <p class="section-subtitle">' . esc_html($subtitle) . '</p>
                </div>
                <div class="portfolio-grid">';
        
        foreach ($config['portfolio_items'] as $item) {
            $output .= '<div class="portfolio-card">
                        <div class="portfolio-image" style="background-image: url(\'' . esc_url($item['image']) . '\')">
                            <div class="portfolio-overlay">
                                <span class="location">📍 ' . esc_html($item['location']) . '</span>
                            </div>
                        </div>
                        <div class="portfolio-content">
                            <h3 class="portfolio-title">' . esc_html($item['title']) . '</h3>
                            <p class="portfolio-description">' . esc_html($item['description']) . '</p>
                            <div class="portfolio-features">';
            
            foreach ($item['features'] as $feature) {
                $output .= '<span class="feature-tag">' . esc_html($feature) . '</span>';
            }
            
            $output .= '</div>
                        </div>
                    </div>';
        }
        
        $output .= '</div>
                <div class="portfolio-cta">
                    <button class="btn btn-primary city-cta-trigger">Start Your Project</button>
                </div>
            </div>
        </section>';
        
        return $output;
    }
    
    public function city_testimonials_shortcode($atts) {
        $atts = shortcode_atts(array(
            'city' => 'kolkata',
            'title' => '',
            'subtitle' => ''
        ), $atts);
        
        $config = $this->get_city_config($atts['city']);
        $title = !empty($atts['title']) ? $atts['title'] : 'What Our <span class="city-blue">' . $config['name'] . '</span> Clients Say';
        $subtitle = !empty($atts['subtitle']) ? $atts['subtitle'] : 'Real results from real businesses.';
        
        $output = '<section class="city-testimonials" id="testimonials">
            <div class="city-container">
                <div class="section-header">
                    <h2 class="section-title">💬 ' . $title . '</h2>
                    <p class="section-subtitle">' . esc_html($subtitle) . '</p>
                </div>
                <div class="testimonials-grid">';
        
        foreach ($config['testimonials'] as $testimonial) {
            $initials = '';
            $names = explode(' ', $testimonial['author']);
            foreach ($names as $name) {
                $initials .= substr($name, 0, 1);
            }
            
            $output .= '<div class="testimonial-card">
                        <div class="testimonial-rating">';
            
            for ($i = 0; $i < $testimonial['rating']; $i++) {
                $output .= '<span class="star">⭐</span>';
            }
            
            $output .= '</div>
                        <blockquote class="testimonial-text">
                            "' . esc_html($testimonial['text']) . '"
                        </blockquote>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                ' . esc_html($initials) . '
                            </div>
                            <div class="author-info">
                                <div class="author-name">' . esc_html($testimonial['author']) . '</div>
                                <div class="author-role">' . esc_html($testimonial['role']) . '</div>
                            </div>
                        </div>
                    </div>';
        }
        
        $output .= '</div>
            </div>
        </section>';
        
        return $output;
    }
    
    public function city_services_shortcode($atts) {
        $atts = shortcode_atts(array(
            'city' => 'kolkata',
            'title' => 'Our Services',
            'subtitle' => ''
        ), $atts);
        
        $config = $this->get_city_config($atts['city']);
        $subtitle = !empty($atts['subtitle']) ? $atts['subtitle'] : 'Complete web solutions for <span class="city-blue">' . $config['name'] . '</span> businesses.';
        
        $services = array(
            array('title' => 'Custom Website Design & Redesign', 'icon' => '💻'),
            array('title' => 'Mobile-first Development', 'icon' => '📱'),
            array('title' => 'eCommerce Solutions', 'icon' => '🛒'),
            array('title' => 'Local SEO Optimization', 'icon' => '🔍'),
            array('title' => 'Booking, Payment, and CRM Integrations', 'icon' => '📅'),
            array('title' => 'Multi-language Content Integration', 'icon' => '🌐')
        );
        
        $output = '<section class="city-services" id="services">
            <div class="city-container">
                <div class="section-header">
                    <h2 class="section-title">🎯 ' . esc_html($atts['title']) . '</h2>
                    <p class="section-subtitle">' . $subtitle . '</p>
                </div>
                <div class="services-grid">';
        
        foreach ($services as $service) {
            $output .= '<div class="service-card">
                        <div class="service-header">
                            <span class="service-icon">' . $service['icon'] . '</span>
                            <h3 class="service-title">' . esc_html($service['title']) . '</h3>
                        </div>
                        <div class="service-indicator"></div>
                    </div>';
        }
        
        $output .= '</div>
            </div>
        </section>';
        
        return $output;
    }
    
    public function city_faq_shortcode($atts) {
        $atts = shortcode_atts(array(
            'city' => 'kolkata',
            'title' => 'Frequently Asked Questions',
            'subtitle' => ''
        ), $atts);
        
        $config = $this->get_city_config($atts['city']);
        $subtitle = !empty($atts['subtitle']) ? $atts['subtitle'] : '<span class="city-blue">' . $config['name'] . '</span>-specific answers to common questions.';
        
        $output = '<section class="city-faq" id="faq">
            <div class="city-container">
                <div class="section-header">
                    <h2 class="section-title">❓ ' . esc_html($atts['title']) . '</h2>
                    <p class="section-subtitle">' . $subtitle . '</p>
                </div>
                <div class="faq-list">';
        
        foreach ($config['faqs'] as $index => $faq) {
            $output .= '<div class="faq-item">
                        <button class="faq-question" data-target="faq-' . $index . '" type="button" aria-expanded="false">
                            <h3>' . esc_html($faq['question']) . '</h3>
                            <span class="faq-icon">▼</span>
                        </button>
                        <div id="faq-' . $index . '" class="faq-answer">
                            <p>' . esc_html($faq['answer']) . '</p>
                        </div>
                    </div>';
        }
        
        $output .= '</div>
            </div>
        </section>';
        
        return $output;
    }
    
    public function city_cta_shortcode($atts) {
        $atts = shortcode_atts(array(
            'city' => 'kolkata',
            'title' => '',
            'subtitle' => '',
            'button_text' => 'Get a Free Consultation Now'
        ), $atts);
        
        $config = $this->get_city_config($atts['city']);
        $title = !empty($atts['title']) ? $atts['title'] : 'Ready to Build Your Online Presence in <span class="city-white">' . $config['name'] . '</span>?';
        $subtitle = !empty($atts['subtitle']) ? $atts['subtitle'] : 'Let\'s create a site that works as hard as you do.';
        
        return '<section class="city-cta" id="contact">
            <div class="city-container">
                <div class="cta-content">
                    <h2 class="cta-title">🚀 ' . $title . '</h2>
                    <p class="cta-subtitle">' . esc_html($subtitle) . '</p>
                    
                    <div class="cta-button-wrapper">
                        <button class="btn btn-cta city-cta-trigger" type="button">
                            👉 ' . esc_html($atts['button_text']) . '
                        </button>
                    </div>
                    
                    <div class="cta-contact">
                        <a href="tel:+919062217468" class="contact-link">
                            <span class="contact-icon">📞</span>
                            <span>+91 9062217468</span>
                        </a>
                        <a href="mailto:sales@webinnoovators.com" class="contact-link">
                            <span class="contact-icon">✉️</span>
                            <span>sales@webinnoovators.com</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>';
    }
    
    public function city_full_landing_shortcode($atts) {
        $atts = shortcode_atts(array(
            'city' => 'kolkata',
            'sections' => 'hero,stats,challenges,neighborhoods,portfolio,testimonials,services,faq,cta'
        ), $atts);
        
        $sections = explode(',', $atts['sections']);
        $output = '';
        
        foreach ($sections as $section) {
            $section = trim($section);
            switch ($section) {
                case 'hero':
                    $output .= $this->city_hero_shortcode(array('city' => $atts['city']));
                    break;
                case 'stats':
                    $output .= $this->city_stats_shortcode(array('city' => $atts['city']));
                    break;
                case 'challenges':
                    $output .= $this->city_challenges_shortcode(array('city' => $atts['city']));
                    break;
                case 'neighborhoods':
                    $output .= $this->city_neighborhoods_shortcode(array('city' => $atts['city']));
                    break;
                case 'portfolio':
                    $output .= $this->city_portfolio_shortcode(array('city' => $atts['city']));
                    break;
                case 'testimonials':
                    $output .= $this->city_testimonials_shortcode(array('city' => $atts['city']));
                    break;
                case 'services':
                    $output .= $this->city_services_shortcode(array('city' => $atts['city']));
                    break;
                case 'faq':
                    $output .= $this->city_faq_shortcode(array('city' => $atts['city']));
                    break;
                case 'cta':
                    $output .= $this->city_cta_shortcode(array('city' => $atts['city']));
                    break;
            }
        }
        
        return $output;
    }
}

new MultiCityLandingShortcodes();
?>