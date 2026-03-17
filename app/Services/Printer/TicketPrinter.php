<?php

declare(strict_types=1);

namespace App\Services\Printer;

use App\Models\SubAccount;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

class TicketPrinter
{
    public function printSale(SubAccount $sale, float $total): void
    {
        //$connector = new NetworkPrintConnector('192.168.1.50', 9100); // IP de la impresora
        $connector = new FilePrintConnector('php://stdout');
        $profile = CapabilityProfile::load('default');
        $printer = new Printer($connector, $profile);

        try {
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("MI NEGOCIO\n");
            $printer->text("Ced: 1-111-111\n");
            $printer->feed();

            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("--------------------------------\n");
            foreach ($sale->details as $detail) {
                $price = $detail->quantity > 0 ? (float) $detail->subtotal / $detail->quantity : 0;
                $line = sprintf(
                    "%-20s %3dx %7.2f\n",
                    mb_substr($detail->food->name, 0, 20),
                    $detail->quantity,
                    $price
                );
                $printer->text($line);
            }
            $printer->text("--------------------------------\n");

            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->text('TOTAL: ' . number_format($total, 2) . "\n");

            $printer->feed(3);
            $printer->cut();
        } finally {
            $printer->close();
        }
    }
}
