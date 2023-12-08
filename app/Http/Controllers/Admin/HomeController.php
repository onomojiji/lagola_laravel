<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Command;
use App\Models\Company;
use App\Models\Perte;
use App\Models\Seller;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function home(){

        # all this month commands
        $allThisMonthCommands = Command::whereMonth("created_at", Carbon::now()->month)->get();

        $allTodayCommands = Command::whereDay("created_at", Carbon::now()->day)->get();

        // get pertes
        $allPertes = Perte::all();
        $allYearPertes = Perte::whereYear("created_at", Carbon::now()->year)->get();
        $allMonthPertes = Perte::whereMonth("created_at", Carbon::now()->month)->get();
        $allDayPertes = Perte::whereDay("created_at", Carbon::now()->day)->get();

        $totalProductPertes = $totalFinancePertes = $monthProductPertes = $monthFinancePertes = $yearProductPertes = $yearFinancePertes = $dayProductPertes = $dayFinancePertes = 0 ;

        // get total pertes
        foreach ($allPertes as $perte){
            $totalProductPertes += $perte->quantity;
            $totalFinancePertes += $perte->quantity * $perte->product->purchase_price;
        }

        // get year pertes
        foreach ($allYearPertes as $yearPerte){
            $yearProductPertes += $yearPerte->quantity;
            $yearFinancePertes += $yearPerte->quantity * $yearPerte->product->purchase_price;
        }

        // get month pertes
        foreach ($allMonthPertes as $monthPerte){
            $monthProductPertes += $monthPerte->quantity;
            $monthFinancePertes += $monthPerte->quantity * $monthPerte->product->purchase_price;
        }

        // get today pertes
        foreach ($allDayPertes as $dayPerte){
            $dayProductPertes += $dayPerte->quantity;
            $dayFinancePertes += $dayPerte->quantity * $dayPerte->product->purchase_price;
        }

        //dd($dayFinancePertes);

        // get all this month sell products, all money
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

        // top 10 of must sell products of all times

        // first I get all times commands
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

        // transformation of allProducts array
        for ($j=0; $j<count($allProducts)-1; $j+=2){
            $allProducts2[] = [$allProducts[$j], $allProducts[$j + 1]];
        }

        // sorting all product array
        $allProducts3 = collect($allProducts2)->sortBy(1)->reverse()->toArray();

        //dd($allProducts3);

        // put all product name in array
        $productsNames = [];
        foreach ($allProducts3 as $item){
            $productsNames[] = $item[0];
        }

        // put all product quantities in array
        $productsQte = [];
        foreach ($allProducts3 as $item){
            $productsQte[] = $item[1];
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
                'productsQte2' => $productsQte2,
                'totalProductPertes' => number_format($totalProductPertes, 0, ',', " "),
                'totalFinancePertes' => number_format($totalFinancePertes, 0, ',', " ")." Fcfa",
                'yearProductPertes' => number_format($yearProductPertes, 0, ',', " "),
                'yearFinancePertes' => number_format($yearFinancePertes, 0, ',', " ")." Fcfa",
                'monthProductPertes' => number_format($monthProductPertes, 0, ',', " "),
                'monthFinancePertes' => number_format($monthFinancePertes, 0, ',', " ")." Fcfa",
                'dayProductPertes' => number_format($dayProductPertes, 0, ',', " "),
                'dayFinancePertes' => number_format($dayFinancePertes, 0, ',', " ")." Fcfa",
                "totalBenefics" => self::getTotalBenefices(),
                "annualBenefics" => self::getAnnualBenefices(),
                "lastThreeMonthBenefics" => self::getLastTreeMonthsBenefices(),
                "totalLosses" => self::getTotalLosses(),
                "annualLosses" => self::getAnnualLosses(),
                "lastThreeMonthLosses" => self::getLastTreeMonthLosses(),
            ]
        );
    }

    // get all times benfics
    public static function getTotalBenefices(){
        // all commands
        $allCommands = Command::all();

        // benefice total
        $beneficeTotal = 0;

        foreach ($allCommands as $command){
            // benefice = prix vente - prix achat
            $beneficeTotal += ($command->product->price - $command->product->purchase_price) * $command->quantity;
        }

        return $beneficeTotal;
    }

    // get annual benefics
    public static function getAnnualBenefices(){
        // this year commands
        $yearCommamds = Command::whereYear("created_at", Carbon::now()->year)->get();

        // year benefics
        $beneficsYear = 0;

        foreach ($yearCommamds as $commamd) {
            $beneficsYear += ($commamd->product->price - $commamd->product->purchase_price) * $commamd->quantity;
        }

        return $beneficsYear;
    }

    // get last 3 year benefics
    public static function getLastTreeMonthsBenefices (){
        // last 3 months commands
        $lastTreeMonthsCommands = Command::select('*')
            ->whereBetween('created_at',
                [Carbon::now()->subMonth(3), Carbon::now()]
            )
            ->get();

        $lastTreeMonthsBenefics = 0;

        foreach ($lastTreeMonthsCommands as $lastTreeMonthsCommand) {
            $lastTreeMonthsBenefics += ($lastTreeMonthsCommand->product->price - $lastTreeMonthsCommand->product->purchase_price) * $lastTreeMonthsCommand->quantity;
        }

        return $lastTreeMonthsBenefics;
    }

    // get all losses
    public static function getTotalLosses(){
        // all losses
        $allLosses = Perte::all();

        $totalLosses = 0;

        foreach ($allLosses as $allLoss) {
            $totalLosses += $allLoss->product->purchase_price * $allLoss->quantity;
        }

        return $totalLosses;
    }

    // get annual losses
    public static function getAnnualLosses(){
        // annual losses
        $annualeLosses = Perte::whereYear("created_at", Carbon::now()->year)->get();

        $annualLosses = 0;

        foreach ($annualeLosses as $annualLosse) {
            $annualLosses += $annualLosse->product->purchase_price * $annualLosse->quantity;
        }

        return $annualLosses;
    }

    // get last tree month losses
    public static function getLastTreeMonthLosses(){
        // all losses
        $lastTMLosses = Perte::all();

        $lastThreeMonthLosses = 0;

        foreach ($lastTMLosses as $lastTMLoss) {
            $lastThreeMonthLosses += $lastTMLoss->product->purchase_price * $lastTMLoss->quantity;
        }

        return $lastThreeMonthLosses;
    }

}
