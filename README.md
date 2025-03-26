# Fast Deeplink Module for Magento 2

This module provides a fast and efficient way to resolve Magento URLs and determine the type of page being accessed. It's particularly useful for mobile applications or any external systems that need to quickly identify the type of content they're dealing with.

## Features

- Fast URL resolution without loading full page content
- Multi-store support with locale-based routing
- Supports product, category, and CMS page resolution
- Returns structured data about the resolved page type
- Handles store view mapping based on URL locale

## API Endpoint

```
GET /rest/V1/fast-deeplink?deeplink=https://www.mumzworld.com/ar/product-name
```

## Response Types

The module returns different response types based on the URL:

### Product Page
```json
{
    "name": "Product Name",
    "sku": "PRODUCT-SKU",
    "category_id": 123,
    "brandLabel": "Brand Name",
    "brandId": "brand_value",
    "is_yalla_applied": true,
    "response_type": "product_details"
}
```

### Category Page
```json
{
    "name": "Category Name",
    "category_id": 123,
    "response_type": "product_list"
}
```

### CMS Page
```json
{
    "name": "Page Title",
    "response_type": "cms-page"
}
```

### Not Found
```json
{
    "response_type": "not_found"
}
```

## Store View Mapping

The module automatically maps URL locales to store views:
- `en` → `ae_en` (UAE English)
- `ar` → `ae_ar` (UAE Arabic)
- `sa-en` → `sa_en` (Saudi Arabia English)
- `sa-ar` → `sa_ar` (Saudi Arabia Arabic)

## Installation

1. Copy the module files to `app/code/Vendor/PageType/`
2. Run `bin/magento setup:upgrade`
3. Run `bin/magento cache:clean`

## Usage Example

```php
// Example API call
$deeplink = 'https://www.mumzworld.com/ar/product-name';
$response = $pageTypeResolver->resolve($deeplink);
```

## Requirements

- Magento 2.x
- PHP 7.4 or higher

Example curls:

1. direct graphql
```
curl --location 'https://s3-pwa-prod.mumzworld.com/graphql?query=query+getRouteData%28%24countryCode%3AString%24url%3AString%21%29%7Broute%28url%3A%24url%29%7Bredirect_code+relative_url+type+...on+BrandPage%7Battribute_code+brandInfo%7Battribute_option_text+description+image+label+meta_description+meta_title+option_id+__typename%7D__typename%7D...on+CmsPage%7Bcontent+content_heading+identifier+is_strapi_enabled+meta_description+meta_title+title+__typename%7D...on+CategoryTree%7Bbreadcrumbs%7Bcategory_id+category_name+category_url_key+category_url_path+__typename%7DcategoryDescription%3Adescription+display_mode+id+image+meta_description+meta_title+name+url_key+uid+__typename%7D...on+ProductInterface%7Bamrma_default_resolution_period+brand+brand_info%7Bimg_src+title+url+__typename%7Dcategories%7Bbreadcrumbs%7Bcategory_id+category_name+category_url_key+category_url_path+__typename%7Dlevel+id+name+url_path+url_key+__typename%7Dcautions+cross_border_product%28countryCode%3A%24countryCode%29%7Bis_allowed+disallow_countries+__typename%7Ddescription%7Bhtml+__typename%7Ddimensions+features+id+is_yalla+media_gallery%7Bdisabled+label+position+url+__typename%7Dmedia_gallery_entries%7Bdisabled+file+id+label+position+uid+__typename%7Dmeta_description+meta_title+name+pkgdimensions+price%7BregularPrice%7Bamount%7Bcurrency+value+__typename%7D__typename%7D__typename%7Dprice_range%7Bminimum_price%7Bdiscount%7Bamount_off+percent_off+__typename%7Dfinal_price%7Bcurrency+value+__typename%7Dregular_price%7Bcurrency+value+__typename%7D__typename%7D__typename%7Dbase_price_range%7Bminimum_price%7Bfinal_price%7Bcurrency+value+__typename%7Dregular_price%7Bcurrency+value+__typename%7D__typename%7D__typename%7Dusd_price_range%7Bminimum_price%7Bfinal_price%7Bcurrency+value+__typename%7D__typename%7D__typename%7Dproduct_label%7Bactive_from+active_to+background_color+label_id+label_text+name+text_color+__typename%7Drating_summary+recom_age+review_count+reviews%7Bitems%7Baverage_rating+created_at+nickname+ratings_breakdown%7Bname+value+__typename%7Dtext+__typename%7Dpage_info%7Bpage_size+total_pages+__typename%7D__typename%7Dshipping_weight+sku+small_image%7Burl+__typename%7Dstock_status+uid+url_key+...on+PhysicalProductInterface%7Bweight+__typename%7D...on+SimpleProduct%7Boptions%7Boption_id+required+title+uid+...on+CustomizableFieldOption%7Bsort_order+title+value%7Bmax_characters+price+price_type+sku+uid+__typename%7D__typename%7D...on+CustomizableAreaOption%7Bsort_order+title+value%7Bmax_characters+price+price_type+sku+uid+__typename%7D__typename%7D...on+CustomizableDropDownOption%7Bsort_order+title+values%3Avalue%7Boption_type_id+price+price_type+sku+sort_order+title+uid+__typename%7D__typename%7D...on+CustomizableRadioOption%7Bsort_order+title+values%3Avalue%7Boption_type_id+price+price_type+sku+sort_order+title+uid+__typename%7D__typename%7D__typename%7D__typename%7D...on+BundleProduct%7Bbundle_price_without_options+items%7Boption_id+options%7Bid+is_default+label+option_price_with_tax+position+price+price_type+product%7Bid+sku+stock_status+__typename%7Dquantity+uid+__typename%7Drequired+title+uid+__typename%7D__typename%7D...on+ConfigurableProduct%7Bconfigurable_options%7Badditional_data%7Bswatch_input_type+update_product_preview_image+use_product_image_for_swatch+__typename%7Dattribute_code+attribute_id+frontend_input+id+label+values%7Bdefault_label+label+store_label+swatch_data%7B...on+ImageSwatchData%7Bthumbnail+__typename%7Dvalue+__typename%7Dvalue_index+uid+use_default_value+__typename%7D__typename%7Doptions%7Boption_id+required+title+uid+...on+CustomizableFieldOption%7Bsort_order+title+value%7Bmax_characters+price+price_type+sku+uid+__typename%7D__typename%7D...on+CustomizableAreaOption%7Bsort_order+title+value%7Bmax_characters+price+price_type+sku+uid+__typename%7D__typename%7D...on+CustomizableDropDownOption%7Bsort_order+title+values%3Avalue%7Boption_type_id+price+price_type+sku+sort_order+title+uid+__typename%7D__typename%7D...on+CustomizableRadioOption%7Bsort_order+title+values%3Avalue%7Boption_type_id+price+price_type+sku+sort_order+title+uid+__typename%7D__typename%7D__typename%7Dusd_price_range%7Bminimum_price%7Bfinal_price%7Bcurrency+value+__typename%7D__typename%7D__typename%7Dvariants%7Battributes%7Bcode+uid+value_index+__typename%7Dproduct%7Bid+is_yalla+media_gallery%7Bdisabled+label+position+url+__typename%7Dmedia_gallery_entries%7Bdisabled+file+id+label+position+uid+__typename%7Dsku+stock_status+price%7BregularPrice%7Bamount%7Bcurrency+value+__typename%7D__typename%7D__typename%7Dprice_range%7Bminimum_price%7Bdiscount%7Bamount_off+percent_off+__typename%7Dfinal_price%7Bcurrency+value+__typename%7Dregular_price%7Bcurrency+value+__typename%7D__typename%7D__typename%7Dbase_price_range%7Bminimum_price%7Bfinal_price%7Bcurrency+value+__typename%7D__typename%7D__typename%7Dusd_price_range%7Bminimum_price%7Bfinal_price%7Bcurrency+value+__typename%7D__typename%7D__typename%7D__typename%7D__typename%7D__typename%7D__typename%7D%7D&operationName=getRouteData&variables=%7B%22countryCode%22%3A%22AE%22%2C%22url%22%3A%22%2Fbumble-bird-nestease-5-in-1-car-seat-stroller-black-40561597-s366%22%7D' \
--header 'accept: */*' \
--header 'accept-language: en-US,en;q=0.9' \
--header 'authorization;' \
--header 'cache-control: no-cache' \
--header 'content-currency: AED' \
--header 'content-type: application/json' \
--header 'pragma: no-cache' \
--header 'priority: u=1, i' \
--header 'referer: https://s3-pwa-prod.mumzworld.com/en/bumble-bird-nestease-5-in-1-car-seat-stroller-black-40561597-s366' \
--header 'sec-fetch-dest: empty' \
--header 'sec-fetch-mode: cors' \
--header 'sec-fetch-site: same-origin' \
--header 'store: en' \
--header 'user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1' \
--header 'x-magento-cache-id: 06fc1522ea47e4c06809431745776788b939207cb2de6517227cb74a1b72a64b' \
--header 'Cookie: app_country=AE; _gcl_au=1.1.1500317358.1741329862; WZRK_G=e60b40110fff4053b95b2e1654867ac4; _tt_enable_cookie=1; _ttp=01JNQNJ391DTK89FX26H8PK47G_.tt.1; _fbp=fb.1.1741329862038.480071331104145814; _ga=GA1.1.1750365273.1741329862; _scid=TzF3Jw3bFhd_cgDC4knAlYdGM6R5YmeI; _ScCbts=%5B%5D; _ym_uid=1741329862909731374; _ym_d=1741329862; _sctr=1%7C1741291200000; countrySelection=%7B%22city%22%3A%22Sharjah%22%2C%22country%22%3A%22United%20Arab%20Emirates%22%2C%22locale%22%3A%22AE%22%7D; private_content_version=6981cf67337e783963839db4eb02a442; _dyid_server=-6300535627841701819; _dyjsession=k5qtztq9pueouu5a5gkhksfgf4b3qlwi; __rtbh.lid=%7B%22eventType%22%3A%22lid%22%2C%22id%22%3A%22nAyARH7KdN0LT2f2ZVjD%22%2C%22expiryDate%22%3A%222026-03-09T11%3A16%3A14.610Z%22%7D; _scid_r=ZrF3Jw3bFhd_cgDC4knAlYdGM6R5YmeIrTHd0g; WZRK_S_6KZ-K4W-RZ7Z=%7B%22p%22%3A7%2C%22s%22%3A1741518915%2C%22t%22%3A1741519434%7D; _ga_VR5P1KMDLS=GS1.1.1741518916.3.1.1741519434.60.0.0'
```
2. curl via proxy: 
```
curl --location 'https://api.app.mumzworld.com/api-request/deep-link?country=AE&deeplink=https%3A%2F%2Fwww.mumzworld.com%2Far%2Ftravel-gear' \
--header 'version: 19' \
--header 'country: AE' \
--header 'store: ar'
```