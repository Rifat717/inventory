<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Employee Route.........................................................
Route::get('/add-employee', 'EmployeeController@index')->name('add.employee');
Route::post('/insert-employee','EmployeeController@store');
Route::get('/all-employee', 'EmployeeController@AllEmployees')->name('all.employee');
Route::get('/view-employe/{id}', 'EmployeeController@ViewEmployees');
Route::get('/delete-employe/{id}', 'EmployeeController@DeleteEmployees');
Route::get('/edit-employe/{id}', 'EmployeeController@EditEmployees');
Route::post('/update-employee/{id}','EmployeeController@UpdateEmployee');


//Customer Route.........................................................
Route::get('/add-customer', 'CustomerController@index')->name('add.customer');
Route::post('/insert-customer','CustomerController@store');
Route::get('/all-customer', 'CustomerController@AllCustomer')->name('all.customer');
Route::get('/view-customer/{id}','CustomerController@ViewCustomer');
Route::get('/delete-customer/{id}', 'CustomerController@DeleteCustomer');
Route::get('/edit-customer/{id}','CustomerController@EditCustomer');
Route::post('/update-customer/{id}','CustomerController@UpdateCustomer');



//Supplier Route.........................................................
Route::get('/add-supplier', 'SupplierController@index')->name('add.supplier');
Route::post('/insert-supplier','SupplierController@store');
Route::get('/all-supplier', 'SupplierController@AllSupplier')->name('all.supplier');
Route::get('/view-supplier/{id}','SupplierController@ViewSupplier');
Route::get('/delete-supplier/{id}', 'SupplierController@DeleteSupplier');
Route::get('/edit-supplier/{id}','SupplierController@EditSupplier');
Route::post('/update-supplier/{id}','SupplierController@UpdateSupplier');


//Salary Route...........................................................
Route::get('/add-advanced-salary', 'SalaryController@AddAdvancedSalary')->name('add.advancedsalary');
Route::post('/insert-advancedsalary','SalaryController@InsertAdvanced');
Route::get('/all-advanced-salary', 'SalaryController@AllSalary')->name('all.advancedsalary');
Route::get('/pay-salary', 'SalaryController@PaySalary')->name('pay.salary');



//Category Routes.......................................................
Route::get('/add-category', 'CategoryController@AddCategory')->name('add.category');
Route::post('/insert-category','CategoryController@InsertCategory');
Route::get('/all-category', 'CategoryController@AllCategory')->name('all.category');
Route::get('/delete-category/{id}', 'CategoryController@DeleteCategory');
Route::get('/edit-category/{id}','CategoryController@EditCategory');
Route::post('/update-category/{id}','CategoryController@UpdateCategory');


//Product Routes.........................................................
Route::get('/add-product', 'ProductController@AddProduct')->name('add.product');
Route::post('/insert-product','ProductController@InsertCategory');
Route::get('/all-product', 'ProductController@AllProduct')->name('all.product');
Route::get('/delete-product/{id}', 'ProductController@DeleteProduct');
Route::get('/view-product/{id}', 'ProductController@ViewProduct');
Route::get('/edit-product/{id}','ProductController@EditProduct');
Route::post('/update-product/{id}','ProductController@UpdateProduct');


//Import and Export Product Route................................................
Route::get('/import-product', 'ProductController@ImportProduct')->name('import.product');
Route::get('/export', 'ProductController@export')->name('export');
Route::post('/import', 'ProductController@import')->name('import');




//Expense Route..........................................................
Route::get('/add-expense', 'ExpenseController@AddExpense')->name('add.expense');
Route::post('/insert-expense','ExpenseController@InsertExpense');
Route::get('/today-expense','ExpenseController@TodayExpense')->name('today.expense');
Route::get('/edit-today-expense/{id}','ExpenseController@EditTodayExpense');
Route::post('/update-today-expense/{id}','ExpenseController@UpdateTodayExpense');

Route::get('/monthly-expense','ExpenseController@MonthlyExpense')->name('monthly.expense');
Route::get('/yearly-expense','ExpenseController@YearlyExpense')->name('yearly.expense');



//Monthly More expense Route....................................................

Route::get('/january-expense','ExpenseController@JanuaryExpense')->name('january.expense');
Route::get('/february-expense','ExpenseController@FebruaryExpense')->name('february.expense');
Route::get('/march-expense','ExpenseController@MarchExpense')->name('march.expense');
Route::get('/april-expense','ExpenseController@AprilExpense')->name('april.expense');
Route::get('/may-expense','ExpenseController@MayExpense')->name('may.expense');
Route::get('/june-expense','ExpenseController@JuneExpense')->name('june.expense');
Route::get('/july-expense','ExpenseController@JulyExpense')->name('july.expense');
Route::get('/august-expense','ExpenseController@AugustExpense')->name('august.expense');
Route::get('/september-expense','ExpenseController@SeptemberExpense')->name('september.expense');
Route::get('/octobar-expense','ExpenseController@OctoberExpense')->name('octobar.expense');
Route::get('/november-expense','ExpenseController@NovemberExpense')->name('november.expense');
Route::get('/december-expense','ExpenseController@DecemberExpense')->name('december.expense');



//Attendence Route...........................................................
Route::get('/take-attendence','AttendenceController@TakeAttendence')->name('take.attendence');
Route::post('/insert-attendence','AttendenceController@InsertAttendence');
Route::get('/all-attendence','AttendenceController@AllAttendence')->name('all.attendence');
Route::get('/edit-attendence/{edit_date}','AttendenceController@EditAttendence');
Route::post('/update-attendence','AttendenceController@UpdateAttedence');
Route::get('/view-attendence/{edit_date}','AttendenceController@ViewAttedence');



//Settings Route.............................................................
Route::get('/website-setting','AttendenceController@Setting')->name('setting');
Route::post('/update-website/{id}','AttendenceController@UpdateWebsite');



//Pos Controller Route......................................................
Route::get('/pos', 'PosController@index')->name('pos');
Route::get('/pending-order', 'PosController@PendingOrder')->name('pending.orders');
Route::get('/view-order-status/{id}', 'PosController@ViewOrder');
Route::get('/pos-done/{id}', 'PosController@PosDONE');
Route::get('/success-order', 'PosController@SuccessOrder')->name('success.orders');






//Cart Controller Route................................................
Route::post('/add-cart','CartController@index');
Route::post('/cart-update/{rowId}','CartController@CartUpdate');
Route::get('/cart-remove/{rowId}','CartController@CartRemove');
Route::post('/invoice','CartController@CreateInvoice');
Route::post('/final-invoice','CartController@FinalInvoice');

