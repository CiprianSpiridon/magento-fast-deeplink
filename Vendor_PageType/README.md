# Fast Deeplink Module for Magento 2

> **TODO**: Store mappings need to be updated for Mumzworld. Current mappings are:
> ```php
> $storeMap = [
>     'en' => 'ae_en',
>     'ar' => 'ae_ar',
>     'sa-en' => 'sa_en',
>     'sa-ar' => 'sa_ar',
> ];
> ```

## Installation

1. In your Magento installation, create the following directory structure:
   ```bash
   app/code/Vendor/PageType/
   ```

2. Copy the module files from this repository into the new directory:
   ```bash
   # From your Magento root directory
   cp -r Vendor_PageType/* app/code/Vendor/PageType/
   ```

3. Run Magento commands:
   ```bash
   bin/magento setup:upgrade
   bin/magento cache:clean
   ```

## Module Structure

```
app/code/Vendor/PageType/
├── Api/
│   └── PageTypeResolverInterface.php
├── Model/
│   └── PageTypeResolver.php
├── etc/
│   ├── di.xml
│   ├── module.xml
│   └── webapi.xml
├── README.md
└── registration.php
```

## API Endpoint

```
GET /rest/V1/fast-deeplink?deeplink=https://www.mumzworld.com/ar/product-name
```

## Response Format

The module returns a simplified response with the following fields:

```json
{
    "name": "Page Title",
    "sku": "PRODUCT-SKU",  // null for non-product pages
    "category_id": 123,    // null for non-category pages
    "brandLabel": "Brand Name",  // null for non-brand pages
    "brandId": "brand_value",    // null for non-brand pages
    "is_yalla_applied": true,    // null for non-product pages
    "response_type": "product_details | cms-page | product_list | brand"
}
```

## Response Types

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

### Brand Page
```json
{
    "name": "Brand Name",
    "brandLabel": "Brand Name",
    "brandId": "brand_value",
    "response_type": "brand"
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

## Example Curls

1. direct graphql
```
curl --location 'https://s3-pwa-prod.mumzworld.com/graphql?query=query+getRouteData%28%24countryCode%3AString%24url%3AString%21%29%7Broute%28url%3A%24url%29%7Bredirect_code+relative_url+type+...on+BrandPage%7Battribute_code+brandInfo%7Battribute_option_text+description+image+label+meta_description+meta_title+option_id+__typename%7D__typename%7D...on+CmsPage%7Bcontent+content_heading+identifier+is_strapi_enabled+meta_description+meta_title+title+__typename%7D...on+CategoryTree%7Bbreadcrumbs%7Bcategory_id+category_name+category_url_key+category_url_path+__typename%7DcategoryDescription%3Adescription+display_mode+id+image+meta_description+meta_title+name+url_key+uid+__typename%7D...on+ProductInterface%7Bamrma_default_resolution_period+brand+brand_info%7Bimg_src+title+url+__typename%7Dcategories%7Bbreadcrumbs%7Bcategory_id+category_name+category_url_key+category_url_path+__typename%7Dlevel+id+name+url_path+url_key+__typename%7Dcautions+cross_border_product%28countryCode%3A%24countryCode%29%7Bis_allowed+disallow_countries+__typename%7Ddescription%7Bhtml+__typename%7Ddimensions+features+id+is_yalla+media_gallery%7Bdisabled+label+position+url+__typename%7Dmedia_gallery_entries%7Bdisabled+file+id+label+position+uid+__typename%7Dmeta_description+meta_title+name+pkgdimensions+price%7BregularPrice%7Bamount%7Bcurrency+value+__typename%7D__typename%7D__typename%7Dprice_range%7Bminimum_price%7Bdiscount%7Bamount_off+percent_off+__typename%7Dfinal_price%7Bcurrency+value+__typename%7Dregular_price%7Bcurrency+value+__typename%7D__typename%7D__typename%7Dbase_price_range%7Bminimum_price%7Bfinal_price%7Bcurrency+value+__typename%7Dregular_price%7Bcurrency+value+__typename%7D__typename%7D__typename%7Dusd_price_range%7Bminimum_price%7Bfinal_price%7Bcurrency+value+__typename%7D__typename%7D__typename%7Dproduct_label%7Bactive_from+active_to+background_color+label_id+label_text+name+text_color+__typename%7Drating_summary+recom_age+review_count+reviews%7Bitems%7Baverage_rating+created_at+nickname+ratings_breakdown%7Bname+value+__typename%7Dtext+__typename%7Dpage_info%7Bpage_size+total_pages+__typename%7D__typename%7Dshipping_weight+sku+small_image%7Burl+__typename%7Dstock_status+uid+url_key+...on+PhysicalProductInterface%7Bweight+__typename%7D...on+SimpleProduct%7Boptions%7Boption_id+required+title+uid+...on+CustomizableFieldOption%7Bsort_order+title+value%7Bmax_characters+price+price_type+sku+uid+__typename%7D__typename%7D...on+CustomizableAreaOption%7Bsort_order+title+value%7Bmax_characters+price+price_type+sku+uid+__typename%7D__typename%7D...on+CustomizableDropDownOption%7Bsort_order+title+values%3Avalue%7Boption_type_id+price+price_type+sku+sort_order+title+uid+__typename%7D__typename%7D...on+CustomizableRadioOption%7Bsort_order+title+values%3Avalue%7Boption_type_id+price+price_type+sku+sort_order+title+uid+__typename%7D__typename%7D__typename%7D__typename%7D...on+BundleProduct%7Bbundle_price_without_options+items%7Boption_id+options%7Bid+is_default+label+option_price_with_tax+position+price+price_type+product%7Bid+sku+stock_status+__typename%7Dquantity+uid+__typename%7Drequired+title+uid+__typename%7D__typename%7D...on+ConfigurableProduct%7Bconfigurable_options%7Badditional_data%7Bswatch_input_type+update_product_preview_image+use_product_image_for_swatch+__typename%7Dattribute_code+attribute_id+frontend_input+id+label+values%7Bdefault_label+label+store_label+swatch_data%7B...on+ImageSwatchData%7Bthumbnail+__typename%7Dvalue+__typename%7Dvalue_index+uid+use_default_value+__typename%7D__typename%7Doptions%7Boption_id+required+title+uid+...on+CustomizableFieldOption%7Bsort_order+title+value%7Bmax_characters+price+price_type+sku+uid+__typename%7D__typename%7D...on+CustomizableAreaOption%7Bsort_order+title+value%7Bmax_characters+price+price_type+sku+uid+__typename%7D__typename%7D...on+CustomizableDropDownOption%7Bsort_order+title+values%3Avalue%7Boption_type_id+price+price_type+sku+sort_order+title+uid+__typename%7D__typename%7D...on+CustomizableRadioOption%7Bsort_order+title+values%3Avalue%7Boption_type_id+price+price_type+sku+sort_order+title+uid+__typename%7D__typename%7D__typename%7Dusd_price_range%7Bminimum_price%7Bfinal_price%7Bcurrency+value+__typename%7D__typename%7D__typename%7Dvariants%7Battributes%7Bcode+uid+value_index+__typename%7Dproduct%7Bid+is_yalla+media_gallery%7Bdisabled+label+position+url+__typename%7Dmedia_gallery_entries%7Bdisabled+file+id+label+position+uid+__typename%7Dsku+stock_status+price%7BregularPrice%7Bamount%7Bcurrency+value+__typename%7D__typename%7D__typename%7Dprice_range%7Bminimum_price%7Bdiscount%7Bamount_off+percent_off+__typename%7Dfinal_price%7Bcurrency+value+__typename%7Dregular_price%7Bcurrency+value+__typename%7D__typename%7D__typename%7Dbase_price_range%7Bminimum_price%7Bfinal_price%7Bcurrency+value+__typename%7D__typename%7D__typename%7Dusd_price_range%7Bminimum_price%7Bfinal_price%7Bcurrency+value+__typename%7D__typename%7D__typename%7D__typename%7D__typename%7D__typename%7D%7D&operationName=getRouteData&variables=%7B%22countryCode%22%3A%22AE%22%2C%22url%22%3A%22%2Fbumble-bird-nestease-5-in-1-car-seat-stroller-black-40561597-s366%22%7D' \
--header 'accept: */*' \
--header 'accept-language: en-US,en;q=0.9'
```

2. api request
```
curl --location 'https://api.app.mumzworld.com/api-request/deep-link?country=AE&deeplink=https%3A%2F%2Fwww.mumzworld.com%2Fsa-en%2Fteknum' \
--header 'version: 19' \
--header 'country: AE' \
--header 'store: ar'
``` 