<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\ChildcategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PickupController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\RoleController;

Route::get('/admin-login', [LoginController::class, 'adminLogin'])->name('admin.login');


Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function () {
	Route::get('/admin/home', [AdminController::class, 'admin'])->name('admin.home');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

	// Category routes
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
        Route::get('/edit/{id}', [CategoryController::class, 'edit']);
        Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
    });

	// Global route
	Route::get('/get-child-category/{id}', [CategoryController::class, 'GetChildCategory'])->name('get-child-category');

	// Subcategory routes
	Route::prefix('subcategory')->group(function () {
		Route::get('/', [SubcategoryController::class, 'index'])->name('subcategory.index');
		Route::post('/store', [SubcategoryController::class, 'store'])->name('subcategory.store');
		Route::get('/delete/{id}', [SubcategoryController::class, 'destroy'])->name('subcategory.delete');
		Route::get('/edit/{id}', [SubcategoryController::class, 'edit']);
		Route::post('/update', [SubcategoryController::class, 'update'])->name('subcategory.update');
	});

	// Warehouse routes
	Route::prefix('warehouse')->group(function () {
		Route::get('/', [WarehouseController::class, 'index'])->name('warehouse.index');
		Route::post('/store', [WarehouseController::class, 'store'])->name('warehouse.store');
		Route::get('/delete/{id}', [WarehouseController::class, 'destroy'])->name('warehouse.delete');
		Route::get('/edit/{id}', [WarehouseController::class, 'edit']);
		Route::post('/update', [WarehouseController::class, 'update'])->name('warehouse.update');
	});

	// Childcategory routes
	Route::prefix('childcategory')->group(function () {
		Route::get('/', [ChildcategoryController::class, 'index'])->name('childcategory.index');
		Route::post('/store', [ChildcategoryController::class, 'store'])->name('childcategory.store');
		Route::get('/delete/{id}', [ChildcategoryController::class, 'destroy'])->name('childcategory.delete');
		Route::get('/edit/{id}', [ChildcategoryController::class, 'edit']);
		Route::post('/update', [ChildcategoryController::class, 'update'])->name('childcategory.update');
	});

	// Brand routes
	Route::prefix('brand')->group(function () {
		Route::get('/', [BrandController::class, 'index'])->name('brand.index');
		Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
		Route::get('/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete');
		Route::get('/edit/{id}', [BrandController::class, 'edit']);
		Route::post('/update', [BrandController::class, 'update'])->name('brand.update');
	});

	// Product routes
	Route::prefix('product')->group(function () {
		Route::get('/', [ProductController::class, 'index'])->name('product.index');
		Route::get('/create', [ProductController::class, 'create'])->name('product.create');
		Route::post('/store', [ProductController::class, 'store'])->name('product.store');
		Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
		Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
		Route::post('/update', [ProductController::class, 'update'])->name('product.update');
		Route::get('/active-featured/{id}', [ProductController::class, 'activefeatured']);
		Route::get('/not-featured/{id}', [ProductController::class, 'notfeatured']);
		Route::get('/active-deal/{id}', [ProductController::class, 'activedeal']);
		Route::get('/not-deal/{id}', [ProductController::class, 'notdeal']);
		Route::get('/active-status/{id}', [ProductController::class, 'activestatus']);
		Route::get('/not-status/{id}', [ProductController::class, 'notstatus']);
		Route::get('/active-product-slider/{id}', [ProductController::class, 'active_product_slider']);
		Route::get('/not-product-slider/{id}', [ProductController::class, 'not_product_slider']);
		Route::get('/product-show/{id}', [ProductController::class, 'ProductShow']);
	});
	// Coupon routes
	Route::prefix('coupon')->group(function () {
		Route::get('/', [CouponController::class, 'index'])->name('coupon.index');
		Route::post('/store', [CouponController::class, 'store'])->name('store.coupon');
		Route::delete('/delete/{id}', [CouponController::class, 'destroy'])->name('coupon.delete');
		Route::get('/edit/{id}', [CouponController::class, 'edit']);
		Route::post('/update', [CouponController::class, 'update'])->name('update.coupon');
	});

	// Campaign routes
	Route::prefix('campaign')->group(function () {
		Route::get('/', [CampaignController::class, 'index'])->name('campaign.index');
		Route::post('/store', [CampaignController::class, 'store'])->name('campaign.store');
		Route::get('/delete/{id}', [CampaignController::class, 'destroy'])->name('campaign.delete');
		Route::get('/edit/{id}', [CampaignController::class, 'edit']);
		Route::post('/update', [CampaignController::class, 'update'])->name('campaign.update');
	});

	// Campaign product routes
	Route::prefix('campaign-product')->group(function () {
		Route::get('/{campaign_id}', [CampaignController::class, 'campaignProduct'])->name('campaign.product');
		Route::get('/add/{id}/{campaign_id}', [CampaignController::class, 'ProductAddToCampaign'])->name('add.product.to.campaign');
		Route::get('/list/{campaign_id}', [CampaignController::class, 'ProductListCampaign'])->name('campaign.product.list');
		Route::get('/remove/{id}', [CampaignController::class, 'RemoveProduct'])->name('product.remove.campaign');
		// Uncomment and update if you want to include an update route
		// Route::post('/update', [CampaignController::class, 'update'])->name('campaign.update');
	});

	// Order routes
	Route::prefix('order')->group(function () {
		Route::get('/', [OrderController::class, 'index'])->name('admin.order.index');
		// Uncomment and update if you want to include a store route
		// Route::post('/store', [CampaignController::class, 'store'])->name('campaign.store');
		Route::get('/admin/edit/{id}', [OrderController::class, 'Editorder']);
		Route::post('/update/order/status', [OrderController::class, 'updateStatus'])->name('update.order.status');
		Route::get('/view/admin/{id}', [OrderController::class, 'ViewOrder']);
		Route::get('/delete/{id}', [OrderController::class, 'delete'])->name('order.delete');
	});

	// Setting Routes
	Route::prefix('setting')->group(function () {
		// SEO Setting
		Route::prefix('seo')->group(function () {
			Route::get('/', [SettingController::class, 'seo'])->name('seo.setting');
			Route::post('/update/{id}', [SettingController::class, 'seoUpdate'])->name('seo.setting.update');
		});

		// SMTP Setting
		Route::prefix('smtp')->group(function () {
			Route::get('/', [SettingController::class, 'smtp'])->name('smtp.setting');
			Route::post('/update/', [SettingController::class, 'smtpUpdate'])->name('smtp.setting.update');
		});

		// PROFILE Setting
		Route::prefix('profile')->group(function () {
			Route::get('/', [SettingController::class, 'profile'])->name('profile.setting');
			Route::post('/password/update', [SettingController::class, 'passwordUpdate'])->name('password.setting.update');
			Route::post('/profile/update', [SettingController::class, 'profileUpdate'])->name('profile.setting.update');
		});

		// Website Setting
		Route::prefix('website')->group(function () {
			Route::get('/', [SettingController::class, 'website'])->name('website.setting');
			Route::post('/update/{id}', [SettingController::class, 'WebsiteUpdate'])->name('website.setting.update');
		});

		// Payment Gateway Setting
		Route::prefix('payment-gateway')->group(function () {
			Route::get('/', [SettingController::class, 'PaymentGateway'])->name('payment.gateway');
			Route::post('/update-aamarpay', [SettingController::class, 'AamarpayUpdate'])->name('update.aamarpay');
			Route::post('/update-surjopay', [SettingController::class, 'SurjopayUpdate'])->name('update.surjopay');
		});

		// Page Setting
		Route::prefix('page')->group(function () {
			Route::get('/', [PageController::class, 'index'])->name('page.index');
			Route::get('/create', [PageController::class, 'create'])->name('create.page');
			Route::post('/store', [PageController::class, 'store'])->name('page.store');
			Route::get('/delete/{id}', [PageController::class, 'destroy'])->name('page.delete');
			Route::get('/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
			Route::post('/update/{id}', [PageController::class, 'update'])->name('page.update');
		});

		// Pickup Point
		Route::prefix('pickup-point')->group(function () {
			Route::get('/', [PickupController::class, 'index'])->name('pickuppoint.index');
			Route::post('/store', [PickupController::class, 'store'])->name('store.pickup.point');
			Route::delete('/delete/{id}', [PickupController::class, 'destroy'])->name('pickup.point.delete');
			Route::get('/edit/{id}', [PickupController::class, 'edit']);
			Route::post('/update', [PickupController::class, 'update'])->name('update.pickup.point');
		});

		// Ticket
		Route::prefix('ticket')->group(function () {
			Route::get('/', [TicketController::class, 'index'])->name('ticket.index');
			Route::get('/ticket/show/{id}', [TicketController::class, 'show'])->name('admin.ticket.show');
			Route::post('/ticket/reply', [TicketController::class, 'ReplyTicket'])->name('admin.store.reply');
			Route::get('/ticket/close/{id}', [TicketController::class, 'CloseTicket'])->name('admin.close.ticket');
			Route::delete('/ticket/delete/{id}', [TicketController::class, 'destroy'])->name('admin.ticket.delete');
		});

		// Blog Category
		Route::prefix('blog-category')->group(function () {
			Route::get('/', [BlogController::class, 'index'])->name('admin.blog.category');
			Route::post('/store', [BlogController::class, 'store'])->name('blog.category.store');
			Route::get('/delete/{id}', [BlogController::class, 'destroy'])->name('blog.category.delete');
			Route::get('/edit/{id}', [BlogController::class, 'edit']);
			Route::post('/update', [BlogController::class, 'update'])->name('blog.category.update');
		});

		// Role
		Route::prefix('role')->group(function () {
			Route::get('/', [RoleController::class, 'index'])->name('manage.role');
			Route::get('/create', [RoleController::class, 'create'])->name('create.role');
			Route::post('/store', [RoleController::class, 'store'])->name('store.role');
			Route::get('/delete/{id}', [RoleController::class, 'destroy'])->name('role.delete');
			Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
			Route::post('/update', [RoleController::class, 'update'])->name('update.role');
		});

		// Report
		Route::prefix('report')->group(function () {
			Route::get('/order', [OrderController::class, 'Reportindex'])->name('report.order.index');
			Route::get('/order/print', [OrderController::class, 'ReportOrderPrint'])->name('report.order.print');
			Route::get('/product/review', [OrderController::class, 'ProductReviewReportIndex'])->name('product.review.report.index');
			Route::get('/product/review/print', [OrderController::class, 'ProductReviewReportPrint'])->name('product.review.report.print');
			Route::get('/web/review', [OrderController::class, 'WebReviewReportIndex'])->name('web.review.report.index');
			Route::get('/web/review/print', [OrderController::class, 'WebReviewReportPrint'])->name('web.review.report.print');
		});
	});


});
