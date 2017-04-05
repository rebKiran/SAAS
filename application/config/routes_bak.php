<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
/*
 * Routes for fronend static pages
 */
$route['default_controller'] = 'frontend/Pages/home';
$route['contact-us'] = 'frontend/Pages/contactUs';
$route['about-us'] = 'frontend/Pages/aboutUs';
$route['testimonials'] = 'frontend/Pages/testimonials';
$route['testimonials-detail'] = 'frontend/Pages/testimonialsDetail';
$route['brand-services'] = 'frontend/Pages/brandServices';
$route['terms-and-conditions'] = 'frontend/Pages/termsAndConditions';
$route['privacy-policy'] = 'frontend/Pages/privacyPolicy';
$route['faq'] = 'frontend/Pages/faq';
$route['calendar'] = 'frontend/Pages/calendar';

$route['building-services'] = 'frontend/Pages/buildingServices';
$route['housekeepers'] = 'frontend/Pages/houseKeepers';
$route['razor-foundation'] = 'frontend/Pages/razorFoundation';
$route['towing'] = 'frontend/Pages/towing';


//$route['(:any)'] = 'frontend/Blog/getBlogDetails/$1';
$route['allblog'] = 'frontend/Blog/allBlogs';
$route['allblog/(:any)'] = 'frontend/Blog/allBlogs/$1';
$route['blog'] = 'frontend/Blog/viewBlogList';
$route['blog/(:any)'] = 'frontend/Blog/viewBlogList/$1';
$route['search_blog'] = 'frontend/Blog/searchBlog';
$route['search_blog/(:any)'] = 'frontend/Blog/searchBlog/$1';
$route['blog/(:any)/(:any)'] = 'frontend/Blog/archiveBlogs/$1/$2';
$route['blog/(:any)/(:any)/(:any)'] = 'frontend/Blog/archiveBlogs/$1/$2/$3';
$route['addComment/(:any)'] = 'frontend/Blog/addComment/$1';

$route['checkout'] = 'frontend/cart/checkout';
$route['add_to_cart'] = 'frontend/cart/addToCart';
$route['cart'] = 'frontend/cart/cart';
$route['remove_item_cart'] = 'frontend/cart/removeCartItem';
$route['update_cart'] = 'frontend/cart/updateCart';


$route['login'] = 'frontend/login';
$route['signup'] = 'frontend/signup';
$route['logout'] = 'frontend/Login/logout';
$route['submitlogin'] = 'backend/login/adminlogin';
$route['admin/dashboard'] = 'backend/Dashboard/admin';
$route['user/dashboard'] = 'backend/Dashboard/user';
$route['register/employee'] = 'frontend/Register/employee';


/*  Manage  Blog section Start */
//$route['admin/blog'] = "backend/Blog/manage_blog_posts";
$route['admin/blog'] = "backend/Blog/manage_blog_posts";
$route['admin/blog/add-post'] = "backend/blog/edit_post";
$route['admin/blog/edit-post/(:any)'] = "backend/blog/edit_post/$1";
$route['admin/blog/delete-post'] = "backend/blog/delete_post";
$route['admin/blog/view-comments/(:any)'] = "backend/blog/view_post_comments/$1";
$route['admin/blog/add-post-comment/(:any)'] = "backend/blog/add_post_comment/$1";
$route['admin/blog/edit-post-comment/(:any)/(:any)'] = "backend/blog/edit_post_comment/$1/$2";
$route['admin/blog/delete-post-comment'] = "backend/blog/delete_post_comment";
$route['admin/blog/change-status'] = "backend/blog/changeStatus";
$route['check-empty-blog'] = "backend/blog/check_empty_post";
$route['check-empty-cms'] = "backend/cms/check_empty_cms";
$route['admin/edit-blog-language/(:any)'] = "backend/blog/editBlogLanguage/$1";
$route['admin/collection/get-blog-language'] = "backend/blog/getBlogLanguage";
/*  Manage  Blog section End */

/**
 * Routes for category
 */
$route['admin/category-list'] = "backend/category/list1";
$route['admin/subcategory-list'] = "backend/category/subcat_list";
$route['admin/subcategory-add'] = "backend/category/sub_category";
$route['admin/subcategory-edit/(:any)'] = "backend/category/editSubCategory/$1";
$route['admin/category-add'] = "backend/category/index";
$route['admin/category-edit'] = "backend/category/editCategory";
$route['admin/category-edit/(:any)'] = "backend/category/editCategory/$1";


/*
 * Product categories routes
 */

$route['admin/product-category-list'] = "backend/product_category/list1";
$route['admin/product-subcategory-list'] = "backend/product_category/subcat_list";
$route['admin/product-subcategory-add'] = "backend/product_category/sub_category";
$route['admin/product-subcategory-edit/(:any)'] = "backend/product_category/editSubCategory/$1";
$route['admin/product-category-add'] = "backend/product_category/index";
$route['admin/product-category-add/(:any)'] = "backend/product_category/index/$1";
$route['admin/product-category-edit'] = "backend/product_category/editCategory";
$route['admin/product-category-edit/(:any)'] = "backend/product_category/editCategory/$1";


/*
 * Routes for variants
 */
$route['admin/variant-list'] = "backend/variant/variantList";
$route['admin/add-variant'] = "backend/variant/addVariant";
$route['admin/edit-variant'] = "backend/variant/addVariant";
$route['admin/edit-variant/(:any)'] = "backend/variant/editVariant/$1";

/*
 * Routes for coupons
 */
$route['admin/coupon-list'] = "backend/coupon/couponList";
$route['admin/add-coupon'] = "backend/coupon/addCoupon";
$route['admin/edit-coupon'] = "backend/coupon/addCoupon";
$route['admin/edit-coupon/(:any)'] = "backend/coupon/editCoupon/$1";
$route['validateCoupon'] = "backend/coupon/validateCoupon";
/*
 * Routes for product backend
 */
$route['admin/product-list'] = 'backend/product/productList';
$route['admin/add-product'] = 'backend/product/addProduct';
/*
 * Routes for admin backend
 */
$route['admin/global-setting'] = 'backend/Global_setting/listGlobalSettings';
$route['admin/global-settings/edit/(:any)'] = "backend/global_setting/editGlobalSettings/$1";


/*
 * Routes for frontend
 */

$route['frontLogin'] = 'frontend/Login/frontLogin';

$route['home'] = 'frontend/pages/home';
$route['about-us'] = 'frontend/pages/aboutUs';
$route['checkout'] = 'frontend/pages/checkout';
$route['contact-us'] = 'frontend/pages/contactUs';
$route['register'] = 'frontend/pages/register';
$route['support'] = 'frontend/pages/support';
$route['login'] = 'frontend/pages/login';
$route['blog'] = 'frontend/pages/blog';
$route['research-page'] = 'frontend/pages/researchPage';
$route['management-page'] = 'frontend/pages/managementPage';
$route['engineering-page'] = 'frontend/pages/engineeringPage';