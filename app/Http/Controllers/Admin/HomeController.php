<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Command;
use App\Models\Company;
use App\Models\Seller;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function home(){

        # all this month commands
        $allThisMonthCommands = Command::whereMonth("created_at", Carbon::now()->month)->get();

        $allTodayCommands = Command::whereDay("created_at", Carbon::now()->day)->get();

        // dd($allTodayCommands);

        # get all this month sell products, all money
        $allThisMonthSellProducts = 0;
        $allThisMonthMoney = 0;
        foreach ($allThisMonthCommands as $thisMonthCommand){
            $allThisMonthSellProducts += $thisMonthCommand->quantity;
            $allThisMonthMoney += $thisMonthCommand->quantity * $thisMonthCommand->product->price;
        }

        # get all today sell products, all money
        $allTodaySellProducts = 0;
        $allTodayMoney = 0;
        foreach ($allTodayCommands as $todayCommand){
            $allTodaySellProducts += $todayCommand->quantity;
            $allTodayMoney += $todayCommand->quantity * $todayCommand->product->price;
        }

        $allProducts = [];
        $allProducts2 = [];

        // to 10 of must sell products of all times

        // first i get all times commands
        $allTimesCommands = Command::all();
        foreach ($allTimesCommands as $command){
            // if product name is not in $allProduct array
            if (!in_array($command->product->name, $allProducts)){
                $qte = 0;
                for ($i=0; $i<count($allTimesCommands); $i++){
                    if ($command->product_id == $allTimesCommands[$i]->product_id){
                        $qte += $allTimesCommands[$i]->quantity;
                    }
                }
                // i push it into allProduct array
                array_push($allProducts, $command->product->name, $qte);
            }
        }

        // tranforamation of allProducts array
        for ($j=0; $j<count($allProducts)-1; $j+=2){
            $allProducts2[] = [$allProducts[$j], $allProducts[$j + 1]];
        }

        // sorting all product array
        $allProducts3 = collect($allProducts2)->sortBy(1)->reverse()->toArray();

        //dd($allProducts3);

        // put all product name in array
        $productsNames = [];
        foreach ($allProducts3 as $item){
            array_push($productsNames, $item[0]);
        }

        // put all product quantities in array
        $productsQte = [];
        foreach ($allProducts3 as $item){
            array_push($productsQte, $item[1]);
        }

        if (count($productsNames) > 10){
            $productsNames1 = array_slice($productsNames,0,10);
            $productsNames2 = array_slice(array_reverse($productsNames), 0, 10);
        }else{
            $productsNames1 = $productsNames;
            $productsNames2 = array_reverse($productsNames);
        }

        if (count($productsQte) > 10){
            $productsQte1 = array_slice($productsQte,0,10);
            $productsQte2 = array_slice(array_reverse($productsQte), 0, 10);
        }else{
            $productsQte1 = $productsQte;
            $productsQte2 = array_reverse($productsQte);
        }

        return view(
            "index",
            [
                "thisMonthSellProducts" => number_format($allThisMonthSellProducts, 0, ", ", " "),
                "thisMonthMoney" => number_format($allThisMonthMoney, 0, ", ", " ")." Fcfa",
                "thisTodaySellProducts" => number_format($allTodaySellProducts, 0, ", ", " "),
                "thisTodayMoney" => number_format($allTodayMoney, 0, ", ", " ")." Fcfa",
                'productsNames' => $productsNames1,
                'productsQte' => $productsQte1,
                'productsNames2' => $productsNames2,
                'productsQte2' => $productsQte2
            ]
        );
    }
}
