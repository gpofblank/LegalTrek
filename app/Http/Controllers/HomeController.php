<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Matter;
use App\Currency;
use App\Document;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',[
            'users' => User::all(),
            'clients' => Client::all(),
            'matters' => Matter::all(),
            'currencies' => Currency::all()
        ]);
    }

    public function store(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $client = $this->findOrCreateClient($request);
        $matter = $this->findOrCreateMatter($request);
        $currency = $this->createCurrency($request);
        $invoice = $this->createInvioce($user,
            $client,
            $matter,
            $currency,
            [
                $request->invoice_num,
                $request->issue_date,
                $request->currency_id
            ]);
        $document = $this->createDocument($request);

        return redirect()->route('documents.show', ['document' => $document]);
    }

    public function findOrCreateClient($request)
    {
        $client = Client::where('name', $request->client)->first();
        if (!isset($client)) {
            $request->validate(['name' => 'required']);
            $client = new Client();
            $client->name = $request->client;
            $client->save();
        }

        return $client;
    }

    public function findOrCreateMatter($request)
    {
        $matter = Matter::where('name', $request->matter)->first();

        if (!isset($matter)) {
            $request->validate(['name' => 'required']);
            $matter = new Matter();
            $matter->name = $request->matter;
            $matter->description = $request->description;
            $matter->save();
        }

        return $matter;
    }

    public function createCurrency($request)
    {
        $request->validate([
            'price' => 'numeric|min:1|max:1000000',
            'discount' => 'numeric|min:1|max:1000000',
        ]);

        $currency = new Currency();
        $currency->currency = $request->currency_id;
        $currency->price = $request->amount;
        $currency->discount = $request->discount;
        $currency->save();

        return $currency;
    }

    public function createDocument($request)
    {
        $document = new Document();
        $document->invoice_id = $request->invoice_num;
        $document->location = 'public/Invoice_' . $request->invoice_num . '.docx';
        $document->save();

        return $document;
    }

    public function createInvioce($user, $client, $matter, $currency, $arrayInvoiceNumIssueDate)
    {
        $invoice_num = $arrayInvoiceNumIssueDate[0];
        $issue_date = $arrayInvoiceNumIssueDate[1];
        $currencyId = $arrayInvoiceNumIssueDate[2];

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->addSection();

        $phpWord->addTitleStyle(1,
            ['size' => 14, 'Arial' => true,'bold' => true],
            ['shading' => array('fill' => '00FF00')],
            [ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER]
        );
        $section->addText("INVOICE");
        $section->addTextBreak();

        $this->textAlign('l', $phpWord);
        $section->addText("Client:" . $client->name);

        $this->textAlign('r', $phpWord);
        $section->addText("Invoice No: " . $invoice_num . "/2020");

        $section->addTextBreak();

        $this->textAlign('l', $phpWord);
        $section->addText("Matter:" . $matter->name);

        $this->textAlign('r', $phpWord);
        $section->addText("Date: " . $issue_date);

        $section->addTextBreak();

        $table = $section->addTable();
        $table->addRow();
        $table->addCell(2000)->addText($matter->description);
        $table->addCell(2000)->addText("1");

        $c = Currency::find($currencyId)->currency;
        $c = $c === 'US dollars' ? 'USD' : 'EUR';

        $table->addCell(2000)->addText($currency->price . " " . $c);

        $table->addCell(2000)->addText($currency->price . " " . $c);

        $section->addTextBreak();

        $this->textAlign('r', $phpWord);
        $section->addText("VAT: " . $currency->price * 0.2 . " " . $c);

        $section->addTextBreak();

        $this->textAlign('r', $phpWord);
        $section->addText("Total (with VAT): " . $currency->price * 1.2 . " " . $c);

        $section->addTextBreak();

        $section->addText("Kind regards,");

        $section->addTextBreak();

        $section->addText($user->name);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('Invoice_' . $invoice_num . '.docx');

        return $objWriter;
    }

    public function textAlign($align, $phpWord)
    {
        if ($align === 'r') {
            return $phpWord->addTitleStyle(
                1,
                ['size' => 12, 'Arial' => true],
                ['shading' => array('fill' => '00FF00')],
                [ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::RIGHT]
            );
        } else {
            return $phpWord->addTitleStyle(
                1,
                ['size' => 12, 'Arial' => true],
                ['shading' => array('fill' => '00FF00')],
                [ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::LEFT]
            );
        }
    }
}
