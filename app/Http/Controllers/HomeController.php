<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\priceCategory;
use Excel;
use App\slideshow;
use App\option;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $priceList = option::find('priceList')->option_value;
        return view('home', ['priceList' => $priceList]);
    }

    public function representations()
    {
        return view('representations');
    }

    public function contactus()
    {
        return view('contact-us');
    }

    public function aboutus()
    {
        return view('about-us');
    }

    public function preorder()
    {
        return view('preorder');
    }

    public function policies()
    {
        return view('policies');
    }


    public function catalog()
    {
        return view('catPages.catalog');
    }

    public function digitalMarketing()
    {
        return view('catPages.digitalMarketing');
    }

    public function envlope()
    {
        return view('catPages.envlope');
    }

    public function fantasy()
    {
        return view('catPages.fantasy');
    }

    public function formatedforms()
    {
        return view('catPages.formatedforms');
    }

    public function genius()
    {
        return view('catPages.genius');
    }

    public function header()
    {
        return view('catPages.header');
    }


    public function ledBoard()
    {
        return view('catPages.ledBoard');
    }

    public function machinesPrice()
    {
        return view('catPages.machinesPrice');
    }

    public function poster()
    {
        return view('catPages.poster');
    }

    public function promotionalGifts()
    {
        return view('catPages.promotionalGifts');
    }

    public function tracket()
    {
        return view('catPages.tracket');
    }


    public function visitCard()
    {
        return view('catPages.visitCard');
    }

    public function riso()
    {
        return view('catPages.riso');
    }

    public function priceList($name)
    {
        $price = priceCategory::where('name', $name)->firstOrFail();
        $table = "<table class='table table-striped table-bordered'>";
        Excel::load(public_path($price->fileObject->file), function ($reader) use (&$table) {
            $reader->each(function ($sheet) use (&$table) {
                $table .= "<tr>";
                $sheet->each(function ($row) use (&$table) {
                    $table .= ("<td>" . $row . "</td>");
                });
                $table .= "</tr>";
            });
        })->get();
        $table .= "</table>";
        return view('priceList', ['category' => $price, 'name' => $name, 'data' => $table]);
    }


}
