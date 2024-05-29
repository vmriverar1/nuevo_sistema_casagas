<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class ProductHelper
{
    public static function formatStock($product)
    {
        if ($product->type == "paquete") {
            // Log::info('Tipo encontrado: ' . $product->id);
            $pack = $product->productsInPackage;

            $minPackages = PHP_INT_MAX; // Inicializa con el valor máximo de un entero en PHP

            foreach ($pack as $prod) {
                if ($prod->type === 'producto') {
                    $stockInStore = $prod->stock;
                }else{
                    $stockInStore = PHP_INT_MAX;
                }
                $minRequired = $prod->pivot->quantity;

                $packagesFromProduct = intdiv($stockInStore, $minRequired);

                if ($packagesFromProduct < $minPackages) {
                    $minPackages = $packagesFromProduct;
                }
            }

            if($minPackages > 100000){
                return '<button class="btn btn-info">--</button>';
            }

            if ($minPackages >= $product->minimum*5){
                return '<button class="btn btn-success">'. $minPackages .'</button>';
            }else if($minPackages <= $product->minimum){
                return '<button class="btn btn-danger">'. $minPackages .'</button>';
            }else{
                return '<button class="btn btn-warning">'. $minPackages .'</button>';
            }
        }

        if($product->type == "servicio"){
            return '<button class="btn btn-info">--</button>';
        }

        if ($product->stock >= $product->minimum*5){
            return '<button class="btn btn-success">'. $product->stock .'</button>';
        }else if($product->stock <= $product->minimum){
            return '<button class="btn btn-danger">'. $product->stock .'</button>';
        }else{
            return '<button class="btn btn-warning">'. $product->stock .'</button>';
        }
    }

    public static function formatCategories($categories)
    {
        $output = '';
        foreach ($categories as $category) {
            $letter = strtolower($category->name[0]);
            $output .= '<button class="btn btn-sm edit_category" data="' . $category->id . '" style="background-color:' . self::lettersInColors($letter) . '; color: #fff; font-size: 12px; margin: 2px; border-radius: 3px;">' . htmlspecialchars($category->name) . '</button>';
        }

        return '<div style="display:flex; max-width: 200px; flex-wrap: wrap;">' . $output . '</div>';
    }

    public static function formatBrand($brand)
    {
        return '<button class="btn btn-info edit_brand" data="' . $brand->id . '" style="padding-left: 5px !important; padding-right: 5px !important;">'. $brand->name .'</button>';
    }

    public static function lettersInColors($letter)
    {
        $colors = [
            'a' => '#d32f2f', // Red 700
            'b' => '#c2185b', // Pink 700
            'c' => '#7b1fa2', // Purple 700
            'd' => '#512da8', // Deep Purple 700
            'e' => '#303f9f', // Indigo 700
            'f' => '#1976d2', // Blue 700
            'g' => '#0288d1', // Light Blue 700
            'h' => '#0097a7', // Cyan 700
            'i' => '#00796b', // Teal 700
            'j' => '#388e3c', // Green 700
            'k' => '#689f38', // Light Green 700
            'l' => '#afb42b', // Lime 700
            'm' => '#fbc02d', // Yellow 700
            'n' => '#ffa000', // Amber 700
            'o' => '#f57c00', // Orange 700
            'p' => '#e64a19', // Deep Orange 700
            'q' => '#5d4037', // Brown 700
            'r' => '#616161', // Grey 700
            's' => '#455a64', // Blue Grey 700
            't' => 'green', // Red 700
            'u' => '#c2185b', // Pink 700
            'v' => 'red', // Purple 700
            'w' => 'black', // Deep Purple 700
            'x' => '#f8538d', // Indigo 700
            'y' => '#e95f2b', // Blue 700
            'z' => '#506690', // Light Blue 700
        ];

        return $colors[$letter];
    }
}
