<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $query = DB::table('sales as sale')
            ->join('point_of_sales as pointOfSales', 'sale.point_of_sale_id', '=', 'pointOfSales.id')
            ->join('companies as company', 'pointOfSales.company_id', '=', 'company.id')
            ->join('sellers as seller', 'sale.seller_id', '=', 'seller.id')
            ->join('addresses as address', 'pointOfSales.address_id', '=', 'address.id')
            ->join('carts as cart', 'sale.cart_id', '=', 'cart.id')
            ->join('dvds as dvd', 'cart.dvd_id', '=', 'dvd.id')
            ->join('users as userSeller', 'seller.user_id', '=', 'userSeller.id')
            ->join('users as userCustomer', 'cart.customer_id', '=', 'userCustomer.id')
            ->selectRaw("
                company.name as company,
                pointOfSales.name as pointOfSale,
                userSeller.name as seller,
                userCustomer.name as customer,
                address.city as city,
                address.state as state,
                sale.sold_at as soldAt,
                sale.status as status,
                sale.total_amount as totalAmount,
                ROUND(sale.total_amount * company.commission_rate / 100, 2) as comission
            ")
            ->toSql();

        DB::statement("CREATE OR REPLACE VIEW sales_comission_view AS $query");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS sales_comission_view");
    }
};
