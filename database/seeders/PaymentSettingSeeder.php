<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment_settings = array(
            array('id' => '1', 'key' => 'paypal_status', 'value' => 'active', 'created_at' => '2024-05-07 18:10:16', 'updated_at' => '2024-05-09 09:57:00'),
            array('id' => '2', 'key' => 'paypal_account_mode', 'value' => 'sandbox', 'created_at' => '2024-05-07 18:10:16', 'updated_at' => '2024-05-09 09:56:55'),
            array('id' => '3', 'key' => 'paypal_country_name', 'value' => 'GB', 'created_at' => '2024-05-07 18:10:16', 'updated_at' => '2024-05-09 09:56:55'),
            array('id' => '4', 'key' => 'paypal_currency_name', 'value' => 'GBP', 'created_at' => '2024-05-07 18:10:16', 'updated_at' => '2024-05-09 13:03:13'),
            array('id' => '5', 'key' => 'paypal_currency_rate', 'value' => '1', 'created_at' => '2024-05-07 18:10:16', 'updated_at' => '2024-05-09 13:03:13'),
            array('id' => '6', 'key' => 'paypal_client_id', 'value' => 'AaWZqfNAQn5EtX292bBUxoRB_rpPDuUSJYA97c8alQ9SbnLn1Ba7wQmVW2r-wcgvpu3OUubfy-PaYnTM', 'created_at' => '2024-05-07 18:10:16', 'updated_at' => '2024-05-09 11:48:05'),
            array('id' => '7', 'key' => 'paypal_secret_key', 'value' => 'EJn42-Vcz86sRia_z5VcuZhAVIrPJfWjMpXft28gq4PGZCfBCah18V56xFrZySnFsX4vmZm4HmRbeVul', 'created_at' => '2024-05-07 18:10:16', 'updated_at' => '2024-05-09 11:48:05'),
            array('id' => '8', 'key' => 'paypal_app_id', 'value' => 'EMHmQpnCv9DFGrlX9_DAgaSzFdbo--QHjXabBHSd5B9SvBFGmu3NwMatCt60LpS08kyiHUriQUmvL5te2', 'created_at' => '2024-05-07 18:10:16', 'updated_at' => '2024-05-09 09:55:33'),
            array('id' => '9', 'key' => 'stripe_status', 'value' => 'active', 'created_at' => '2024-05-09 20:15:49', 'updated_at' => '2024-05-09 20:15:49'),
            array('id' => '10', 'key' => 'stripe_country_name', 'value' => 'GB', 'created_at' => '2024-05-09 20:15:49', 'updated_at' => '2024-05-09 20:15:49'),
            array('id' => '11', 'key' => 'stripe_currency_name', 'value' => 'GBP', 'created_at' => '2024-05-09 20:15:49', 'updated_at' => '2024-05-09 20:15:49'),
            array('id' => '12', 'key' => 'stripe_currency_rate', 'value' => '1', 'created_at' => '2024-05-09 20:15:49', 'updated_at' => '2024-05-09 20:15:49'),
            array('id' => '13', 'key' => 'stripe_publishable_key', 'value' => 'pk_test_a2xBTt980O1eTCRd8LM1MBv3', 'created_at' => '2024-05-09 20:15:49', 'updated_at' => '2024-05-09 20:15:49'),
            array('id' => '14', 'key' => 'stripe_secret_key', 'value' => 'sk_test_9b9EdfK02xNcgbauXZeBEOPH', 'created_at' => '2024-05-09 20:15:49', 'updated_at' => '2024-05-09 20:15:49')
        );

        \DB::table('payment_settings')->insert($payment_settings);
    }
}
