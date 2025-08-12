# Multi-City Landing Shortcodes - Usage Examples

This document provides practical examples of how to use the Multi-City Landing Shortcodes plugin for different scenarios.

## Basic Usage

### Complete Landing Page for a Single City

The simplest way to create a city-specific landing page is to use the full landing shortcode:

```
[city_full_landing city="mumbai"]
```

This will create a complete landing page for Mumbai with all sections:
- Hero section
- Statistics
- Business challenges
- Neighborhoods
- Portfolio
- Testimonials
- Services
- FAQ
- Call-to-action

### Customizing Section Order

You can customize which sections appear and in what order:

```
[city_full_landing city="delhi" sections="hero,challenges,portfolio,testimonials,cta"]
```

This will create a landing page for Delhi with only the specified sections in that order.

## Advanced Usage

### Building a Page Section by Section

For maximum control, you can add each section individually:

```
[city_hero city="bengaluru"]
[city_stats city="bengaluru"]
[city_challenges city="bengaluru"]
[city_neighborhoods city="bengaluru"]
[city_portfolio city="bengaluru"]
[city_testimonials city="bengaluru"]
[city_services city="bengaluru"]
[city_faq city="bengaluru"]
[city_cta city="bengaluru"]
```

This approach allows you to:
- Add your own content between sections
- Apply different styling to specific sections
- Mix sections from different cities (though not recommended for SEO)

### Creating a Multi-City Comparison Page

You can create a page that showcases multiple cities:

```
<h2>Our Services in Major Cities</h2>

<h3>Mumbai</h3>
[city_hero city="mumbai"]
[city_stats city="mumbai"]

<h3>Delhi</h3>
[city_hero city="delhi"]
[city_stats city="delhi"]

<h3>Bengaluru</h3>
[city_hero city="bengaluru"]
[city_stats city="bengaluru"]

<h3>Contact Us</h3>
[city_cta city="mumbai"]
```

## Real-World Examples

### Example 1: Web Development Agency with Multiple Service Areas

**Goal:** Create landing pages for 5 major cities

**Implementation:**
1. Create 5 separate pages
2. Add full landing shortcode to each:
   - Page 1: `[city_full_landing city="mumbai"]`
   - Page 2: `[city_full_landing city="delhi"]`
   - Page 3: `[city_full_landing city="bengaluru"]`
   - Page 4: `[city_full_landing city="chennai"]`
   - Page 5: `[city_full_landing city="hyderabad"]`
3. Set SEO-friendly titles and URLs for each page

**Result:** 5 unique landing pages targeting different cities with minimal effort

### Example 2: Local Business Focusing on Specific Neighborhoods

**Goal:** Target specific neighborhoods in a city

**Implementation:**
1. Create a page for the city
2. Add the neighborhoods section prominently:

```
[city_hero city="kolkata"]
[city_neighborhoods city="kolkata"]
[city_challenges city="kolkata"]
[city_services city="kolkata"]
[city_cta city="kolkata"]
```

**Result:** A focused landing page highlighting neighborhood-specific services

### Example 3: Industry-Specific Landing Pages

**Goal:** Create landing pages for cities with similar industry focus

**Implementation:**
1. Group cities by industry focus (e.g., IT hubs)
2. Create pages for each city in that group:

```
<!-- For IT-focused cities -->
[city_full_landing city="bengaluru"]
[city_full_landing city="hyderabad"]
[city_full_landing city="pune"]

<!-- For manufacturing-focused cities -->
[city_full_landing city="ahmedabad"]
[city_full_landing city="surat"]
[city_full_landing city="coimbatore"]
```

**Result:** Industry-targeted landing pages across multiple cities

## Creative Applications

### Mini City Profiles

Create compact city profiles for a "Cities We Serve" page:

```
<div class="city-grid">
  <div class="city-card">
    <h3>Mumbai</h3>
    [city_stats city="mumbai"]
    [city_cta city="mumbai"]
  </div>
  
  <div class="city-card">
    <h3>Delhi</h3>
    [city_stats city="delhi"]
    [city_cta city="delhi"]
  </div>
  
  <div class="city-card">
    <h3>Bengaluru</h3>
    [city_stats city="bengaluru"]
    [city_cta city="bengaluru"]
  </div>
</div>
```

### State-Specific Landing Pages

Group cities by state for state-focused campaigns:

```
<h2>Our Services in Maharashtra</h2>

[city_hero city="mumbai"]
[city_neighborhoods city="mumbai"]

[city_hero city="pune"]
[city_neighborhoods city="pune"]

[city_hero city="nagpur"]
[city_neighborhoods city="nagpur"]

<h2>Contact Us</h2>
[city_cta city="mumbai"]
```

### Industry Showcase

Highlight your expertise in specific industries across cities:

```
<h2>Our IT Services Expertise</h2>

<h3>Bengaluru - India's Silicon Valley</h3>
[city_challenges city="bengaluru"]
[city_portfolio city="bengaluru"]

<h3>Hyderabad - Cyberabad</h3>
[city_challenges city="hyderabad"]
[city_portfolio city="hyderabad"]

<h3>Pune - Tech Hub</h3>
[city_challenges city="pune"]
[city_portfolio city="pune"]
```

## SEO Best Practices

For optimal SEO results:

1. **One City Per Page**: Create separate pages for each city
2. **Consistent URL Structure**: Use format like `/website-development-[city]/`
3. **Unique Page Titles**: Include city name in page title
4. **Meta Descriptions**: Write unique descriptions for each city
5. **Internal Linking**: Link between city pages with descriptive anchor text
6. **Canonical Tags**: Set proper canonical URLs to avoid duplicate content issues
7. **Sitemap**: Include all city pages in your XML sitemap

## Customization Examples

### Custom Hero Section

```
[city_hero city="mumbai" title="Premium Website Development in <span class='city-blue'>Mumbai</span>" subtitle="Elevate Your Business with Custom Web Solutions Tailored for Mumbai's Competitive Market"]
```

### Custom CTA

```
[city_cta city="delhi" title="Ready to Dominate Delhi's Digital Landscape?" subtitle="Get a website that stands out in India's capital"]
```

## Troubleshooting Examples

### Issue: City name not displaying correctly

**Solution:** Ensure you're using the correct city slug:

```
<!-- WRONG -->
[city_full_landing city="Bengaluru"]

<!-- CORRECT -->
[city_full_landing city="bengaluru"]
```

### Issue: Sections not appearing

**Solution:** Check if you're using the correct shortcode names:

```
<!-- WRONG -->
[city_neighborhood city="mumbai"]

<!-- CORRECT -->
[city_neighborhoods city="mumbai"]
```

## Advanced Integration

### With Contact Form 7

```
[city_hero city="kolkata"]
[city_stats city="kolkata"]

<h2>Contact Our Kolkata Team</h2>
[contact-form-7 id="123" title="Kolkata Contact Form"]

[city_testimonials city="kolkata"]
```

### With WooCommerce

```
[city_hero city="surat"]
[city_challenges city="surat"]

<h2>Our Surat-Specific Packages</h2>
[products category="surat-services" columns="3"]

[city_cta city="surat"]
```

## Performance Optimization Tips

1. **Caching**: Use a caching plugin to improve page load times
2. **Lazy Loading**: Enable lazy loading for images
3. **Selective Loading**: Only include necessary sections
4. **Minification**: Minify CSS and JavaScript files
5. **CDN**: Use a CDN for static assets

---

These examples demonstrate the versatility of the Multi-City Landing Shortcodes plugin. By combining different shortcodes and customizing their parameters, you can create highly targeted, SEO-optimized landing pages for any city in India.