<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Setting web
Breadcrumbs::for('settingWeb', function (BreadcrumbTrail $trail) {
    $trail->push('Setting Web Topup');
});

// Isi saldo
Breadcrumbs::for('isisaldo', function (BreadcrumbTrail $trail) {
    $trail->push('Isi Saldo');
});

// ============================================================================================================
// Roles
Breadcrumbs::for('roles', function (BreadcrumbTrail $trail) {
    $trail->push('Data Roles', route('roles.index'));
});
// Roles > Tambah
Breadcrumbs::for('roles-tambah', function (BreadcrumbTrail $trail) {
    $trail->parent('roles');
    $trail->push('Tambah Roles', route('roles.create'));
});
//Roles > Detail
Breadcrumbs::for('roles-show', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('roles');
    $trail->push('View Role', route('roles.show', $role));
    $trail->push($role->name, route('roles.show', $role));
});
//Roles > Edit
Breadcrumbs::for('roles-edit', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('roles');
    $trail->push('Edit Roles', route('roles.edit', $role));
    $trail->push($role->name, route('roles.edit', $role));
});
// ============================================================================================================
// User
Breadcrumbs::for('user', function (BreadcrumbTrail $trail) {
    $trail->push('Data User', route('user.index'));
});

// User > Tambah
Breadcrumbs::for('user-tambah', function (BreadcrumbTrail $trail) {
    $trail->parent('user');
    $trail->push('Tambah User', route('user.create'));
});

//User > Edit
Breadcrumbs::for('user-edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('user');
    $trail->push('Edit User', route('user.edit', $user));
    $trail->push($user->name, route('user.edit', $user));
});
// ============================================================================================================
// Thumbnail
Breadcrumbs::for('thumbnail', function (BreadcrumbTrail $trail) {
    $trail->push('Thumbnail Games');
});
// ============================================================================================================
// markup harga
Breadcrumbs::for('markup', function (BreadcrumbTrail $trail) {
    $trail->push('Markup Harga');
});
// ============================================================================================================

Breadcrumbs::for('statistik', function (BreadcrumbTrail $trail) {
    $trail->push('Statistik');
});
// ============================================================================================================

Breadcrumbs::for('contact', function (BreadcrumbTrail $trail) {
    $trail->push('Contact Us');
});
// // ============================================================================================================
// category
Breadcrumbs::for('categories', function (BreadcrumbTrail $trail) {
    $trail->push('Data Category', route('categories.index'));
});
// category > Tambah
Breadcrumbs::for('categories-tambah', function (BreadcrumbTrail $trail) {
    $trail->parent('categories');
    $trail->push('Tambah Category', route('categories.create'));
});
//categories > Detail
Breadcrumbs::for('categories-show', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('categories');
    $trail->push('Detail Category', route('categories.show', $category));
    $trail->push($category->name, route('categories.show', $category));
});
//categories > Edit
Breadcrumbs::for('categories-edit', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('categories');
    $trail->push('Edit Category', route('categories.edit', $category));
    $trail->push($category->name, route('categories.edit', $category));
});
// ============================================================================================================
// business
Breadcrumbs::for('business', function (BreadcrumbTrail $trail) {
    $trail->push('Data Bisnis', route('business.index'));
});
// business > Tambah
Breadcrumbs::for('business-tambah', function (BreadcrumbTrail $trail) {
    $trail->parent('business');
    $trail->push('Tambah Bisnis', route('business.create'));
});
//business > Detail
Breadcrumbs::for('business-show', function (BreadcrumbTrail $trail, $business) {
    $trail->parent('business');
    $trail->push('Detail Bisnis', route('business.show', $business));
    $trail->push($business->name, route('business.show', $business));
});
//business > Edit
Breadcrumbs::for('business-edit', function (BreadcrumbTrail $trail, $business) {
    $trail->parent('business');
    $trail->push('Edit Bisnis', route('business.edit', $business));
    $trail->push($business->name, route('business.edit', $business));
});


// business
Breadcrumbs::for('part-business', function (BreadcrumbTrail $trail) {
    $trail->push('Data Business', route('part-bus.business.index'));
});
// business > Tambah
Breadcrumbs::for('part-business-tambah', function (BreadcrumbTrail $trail) {
    $trail->parent('part-business');
    $trail->push('Tambah Business', route('part-bus.business.create'));
});
//business > Detail
Breadcrumbs::for('part-business-show', function (BreadcrumbTrail $trail, $business) {
    $trail->parent('part-business');
    $trail->push('Detail Business', route('part-bus.business.show', $business));
    $trail->push($business->name, route('part-bus.business.show', $business));
});
//business > Edit
Breadcrumbs::for('part-business-edit', function (BreadcrumbTrail $trail, $business) {
    $trail->parent('part-business');
    $trail->push('Edit Business', route('part-bus.business.edit', $business));
    $trail->push($business->name, route('part-bus.business.edit', $business));
});


//============================================================================================================
// partner
Breadcrumbs::for('partners', function (BreadcrumbTrail $trail) {
    $trail->push('Data Partner', route('partners.index'));
});
// Partner > Tambah
Breadcrumbs::for('partners-tambah', function (BreadcrumbTrail $trail) {
    $trail->parent('partners');
    $trail->push('Tambah Partner', route('partners.create'));
});
//partners > Detail
Breadcrumbs::for('partners-show', function (BreadcrumbTrail $trail, $partner) {
    $trail->parent('partners');
    $trail->push('Detail Partner', route('partners.show', $partner));
    $trail->push($partner->name, route('partners.show', $partner));
});
//partners > Edit
Breadcrumbs::for('partners-edit', function (BreadcrumbTrail $trail, $partner) {
    $trail->parent('partners');
    $trail->push('Edit Partner', route('partners.edit', $partner));
    $trail->push($partner->name, route('partners.edit', $partner));
});
//partners > Edit
Breadcrumbs::for('partners-business', function (BreadcrumbTrail $trail, $partner) {
    $trail->parent('partners');
    $trail->push('Partner Business', route('business-partners.edit', $partner));
    $trail->push($partner->name, route('business-partners.edit', $partner));
});
//partners > Edit
Breadcrumbs::for('partner-profile', function (BreadcrumbTrail $trail) {
    $trail->push('Partner Profile');
});


//============================================================================================================
// Type QR
Breadcrumbs::for('type-qrs', function (BreadcrumbTrail $trail) {
    $trail->push('Data Type QR', route('type-qrs.index'));
});
// Type QR > Tambah
Breadcrumbs::for('type-qrs-tambah', function (BreadcrumbTrail $trail) {
    $trail->parent('type-qrs');
    $trail->push('Tambah Type QR', route('type-qrs.create'));
});
//type-qrs > Detail
Breadcrumbs::for('type-qrs-show', function (BreadcrumbTrail $trail, $partner) {
    $trail->parent('type-qrs');
    $trail->push('Detail Type QR', route('type-qrs.show', $partner));
    $trail->push($partner->name, route('type-qrs.show', $partner));
});
//type-qrs > Edit
Breadcrumbs::for('type-qrs-edit', function (BreadcrumbTrail $trail, $partner) {
    $trail->parent('type-qrs');
    $trail->push('Edit Type QR', route('type-qrs.edit', $partner));
    $trail->push($partner->name, route('type-qrs.edit', $partner));
});
//

// product
Breadcrumbs::for('products', function (BreadcrumbTrail $trail) {
    $trail->push('Data Product', route('products.index'));
});
// product > Tambah
Breadcrumbs::for('products-tambah', function (BreadcrumbTrail $trail) {
    $trail->parent('products');
    $trail->push('Tambah Product', route('products.create'));
});
//product > Detail
Breadcrumbs::for('products-show', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('products');
    $trail->push('Detail Product', route('products.show', $product));
    $trail->push($product->name, route('products.show', $product));
});
//product > Edit
Breadcrumbs::for('products-edit', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('products');
    $trail->push('Edit Product', route('products.edit', $product));
    $trail->push($product->name, route('products.edit', $product));
});

// Request QR
Breadcrumbs::for('request-qrs', function (BreadcrumbTrail $trail) {
    $trail->push('Data Request QR', route('request-qrs.index'));
});
// Request QR > Tambah
Breadcrumbs::for('request-qrs-tambah', function (BreadcrumbTrail $trail) {
    $trail->parent('request-qrs');
    $trail->push('Tambah Request QR', route('request-qrs.create'));
});
//product > Detail
Breadcrumbs::for('request-qrs-show', function (BreadcrumbTrail $trail, $requestQrs) {
    $trail->parent('request-qrs');
    $trail->push('Detail Request QR', route('request-qrs.show', $requestQrs));
    $trail->push($requestQrs->id, route('request-qrs.show', $requestQrs));
});
//requestQrs > Edit
Breadcrumbs::for('request-qrs-edit', function (BreadcrumbTrail $trail, $requestQrs) {
    $trail->parent('request-qrs');
    $trail->push('Edit Request QR', route('request-qrs.edit', $requestQrs));
    $trail->push($requestQrs->id, route('request-qrs.edit', $requestQrs));
});

// Kontak
Breadcrumbs::for('kontak', function (BreadcrumbTrail $trail) {
    $trail->push('Data Kontak', route('kontak.index'));
});


// Request QR
Breadcrumbs::for('requestQr', function (BreadcrumbTrail $trail) {
    $trail->push('Data Request QR', route('requestQr.index'));
});
// Sosmed
Breadcrumbs::for('sosmed', function (BreadcrumbTrail $trail) {
    $trail->push('Data Sosial Media', route('sosmed.index'));
});
Breadcrumbs::for('sosmedCreate', function (BreadcrumbTrail $trail) {
    $trail->push('Create Data Sosial Media', route('sosmed.create'));
});
Breadcrumbs::for('sosmedEdit', function (BreadcrumbTrail $trail, $sosmed) {
    $trail->push('Edit Data Sosial Media', route('sosmed.edit', $sosmed));
});
// User Scanned
Breadcrumbs::for('user-scan-admin', function (BreadcrumbTrail $trail) {
    $trail->push('Customer Data', route('customer.admin'));
});
Breadcrumbs::for('user-scan', function (BreadcrumbTrail $trail) {
    $trail->push('Customer Data', route('user.scan.partner'));
});
Breadcrumbs::for('Report', function (BreadcrumbTrail $trail) {
    $trail->push('Data Report Customer', route('report.index'));
});
Breadcrumbs::for('video_pendek', function (BreadcrumbTrail $trail) {
    $trail->push('Tambah Video Pendek', route('partner.video.create'));
});
